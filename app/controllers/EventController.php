<?php
class EventController {
    private $event;
    private $user;
    private $current_role;

    public function __construct() {
        require_once ROOT . '/app/models/Event.php';
        require_once ROOT . '/app/models/User.php';
        $this->event = new Event();
        $this->user = new User();

        if (!isset($_SESSION['user_id'])) {
            header("Location: ?controller=auth&action=login");
            exit();
        }

        $this->current_role = $this->user->getRole($_SESSION['user_id']);
    }

    public function index() {
        $this->filter('all');
    }

    public function filter($filterType) {
        $currentDate = date('Y-m-d');
        $page = $_GET['page'] ?? 1;
        $perPage = 6; // 6 events per page
        $searchQuery = $_GET['search'] ?? ''; // Get the search query from the URL

        // Lấy tất cả sự kiện
        $allEvents = $this->event->getAll();
        
        // Lọc sự kiện theo loại và tìm kiếm
        $filteredEvents = array_filter($allEvents, function($event) use ($currentDate, $filterType, $searchQuery) {
            // Lọc theo loại (upcoming, ongoing, past, all)
            $typeMatch = true;
            switch ($filterType) {
                case 'upcoming':
                    $typeMatch = $event['date'] > $currentDate;
                    break;
                case 'ongoing':
                    $typeMatch = $event['date'] == $currentDate;
                    break;
                case 'past':
                    $typeMatch = $event['date'] < $currentDate;
                    break;
                default:
                    $typeMatch = true;
            }

            // Lọc theo tìm kiếm (theo tiêu đề)
            $searchMatch = true;
            if (!empty($searchQuery)) {
                $searchMatch = stripos($event['title'], $searchQuery) !== false;
            }

            return $typeMatch && $searchMatch;
        });

        // Phân trang
        $totalEvents = count($filteredEvents);
        $totalPages = max(1, ceil($totalEvents / $perPage));
        $page = min(max(1, $page), $totalPages);
        $offset = ($page - 1) * $perPage;
        $paginatedEvents = array_slice($filteredEvents, $offset, $perPage);

        $data = [
            'events' => $paginatedEvents,
            'current_role' => $this->current_role,
            'current_filter' => $filterType,
            'current_page' => $page,
            'total_pages' => $totalPages,
            'total_events' => $totalEvents,
            'search_query' => $searchQuery // Pass the search query to the view
        ];
        
        extract($data);
        require_once ROOT . '/app/views/events/index.php';
    }

    public function add() {
        if ($this->current_role !== 'admin') {
            $_SESSION['error'] = "Bạn không có quyền thêm sự kiện!";
            header("Location: ?controller=event&action=index");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $date = $_POST['date'] ?? '';
            $location = $_POST['location'] ?? '';
            $imageName = null;
    
            // Xử lý upload ảnh nếu có
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imageTmpPath = $_FILES['image']['tmp_name'];
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $uploadDir = ROOT . '/public/upload/events/';
                $uploadPath = $uploadDir . $imageName;
    
                // Tạo thư mục nếu chưa có
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                move_uploaded_file($imageTmpPath, $uploadPath);
            }
    
            if ($this->event->add($title, $description, $date, $location, $imageName)) {
                $_SESSION['success'] = "Thêm sự kiện thành công!";
                header("Location: ?controller=event&action=index");
                exit();
            } else {
                $_SESSION['error'] = "Thêm sự kiện thất bại!";
            }
        }
        require_once ROOT . '/app/views/events/add.php';
    }
    
    public function edit($id) {
        if ($this->current_role !== 'admin') {
            $_SESSION['error'] = "Bạn không có quyền chỉnh sửa sự kiện!";
            header("Location: ?controller=event&action=index");
            exit();
        }
    
        $event = $this->event->getById($id);
        if (!$event) {
            $_SESSION['error'] = "Không tìm thấy sự kiện!";
            header("Location: ?controller=event&action=index");
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $date = $_POST['date'] ?? '';
            $location = $_POST['location'] ?? '';
            $imageName = null;
    
            // Nếu người dùng upload ảnh mới
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $imageTmpPath = $_FILES['image']['tmp_name'];
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $uploadDir = ROOT . '/public/upload/events/';
                $uploadPath = $uploadDir . $imageName;
    
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                move_uploaded_file($imageTmpPath, $uploadPath);
            }
    
            if ($this->event->edit($id, $title, $description, $date, $location, $imageName)) {
                $_SESSION['success'] = "Cập nhật sự kiện thành công!";
                header("Location: ?controller=event&action=index");
                exit();
            } else {
                $_SESSION['error'] = "Cập nhật sự kiện thất bại!";
            }
        }
    
        require_once ROOT . '/app/views/events/edit.php';
    }
    
    public function delete($id) {
        if ($this->current_role !== 'admin') {
            $_SESSION['error'] = "Bạn không có quyền xóa sự kiện!";
            header("Location: ?controller=event&action=index");
            exit();
        }

        if ($this->event->delete($id)) {
            $_SESSION['success'] = "Xóa sự kiện thành công!";
        } else {
            $_SESSION['error'] = "Xóa sự kiện thất bại!";
        }
        header("Location: ?controller=event&action=index");
        exit();
    }

    public function detail($id) {
        $event = $this->event->getById($id);
    
        if (!$event) {
            $_SESSION['error'] = "Không tìm thấy sự kiện!";
            header("Location: ?controller=event&action=index");
            exit();
        }
    
        require_once ROOT . '/app/views/events/detail.php';
    }

    public function dashboard() {
        if ($this->current_role !== 'admin') {
            $_SESSION['error'] = "Bạn không có quyền truy cập Dashboard!";
            header("Location: ?controller=event&action=index");
            exit();
        }
    
        // Lấy dữ liệu cho Dashboard
        $totalEvents = count($this->event->getAll());
        $upcomingEvents = count(array_filter($this->event->getAll(), function($event) {
            return $event['date'] > date('Y-m-d');
        }));
        $ongoingEvents = count(array_filter($this->event->getAll(), function($event) {
            return $event['date'] == date('Y-m-d');
        }));
        $pastEvents = count(array_filter($this->event->getAll(), function($event) {
            return $event['date'] < date('Y-m-d');
        }));
    
        $data = [
            'total_events' => $totalEvents,
            'upcoming_events' => $upcomingEvents,
            'ongoing_events' => $ongoingEvents,
            'past_events' => $pastEvents,
            'current_role' => $this->current_role
        ];

        $recentEvents = array_slice(array_filter($this->event->getAll(), function($event) {
            return $event['date'] >= date('Y-m-d');
        }), 0, 5); // Lấy 5 sự kiện sắp diễn ra
        $data['recent_events'] = $recentEvents;
    
        extract($data);
        require_once ROOT . '/app/views/events/dashboard.php';
    }
}
?>