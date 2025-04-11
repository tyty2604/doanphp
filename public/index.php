<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sự Kiện</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <?php
        session_start();

        define('ROOT', dirname(__DIR__));

        $requiredFiles = [
            ROOT . '/config/database.php',
            ROOT . '/app/controllers/AuthController.php',
            ROOT . '/app/controllers/EventController.php',
            ROOT . '/app/controllers/UserController.php'
        ];
        
        foreach ($requiredFiles as $file) {
            if (file_exists($file)) {
                require_once $file;
            } else {
                die("Error: File not found - $file");
            }
        }

        $controller = filter_input(INPUT_GET, 'controller', FILTER_SANITIZE_STRING) ?? 'auth';
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? 'login';
        $filterType = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_STRING) ?? 'all';

        switch ($controller) {
            case 'auth':
                $authController = new AuthController();
                if (method_exists($authController, $action)) {
                    $authController->$action();
                } else {
                    echo "Action not found";
                }
                break;
        
            case 'event':
                $eventController = new EventController();
                if (method_exists($eventController, $action)) {
                    if ($action == 'edit' || $action == 'delete') {
                        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                        if ($id === false || $id === null) {
                            echo "Invalid event ID";
                        } elseif ($action == 'edit') {
                            $eventController->edit($id);
                        } elseif ($action == 'delete') {
                            $eventController->delete($id);
                        }
                    } elseif ($action == 'filter') {
                        $eventController->filter($filterType);
                    } elseif ($action == 'detail') {
                        // Xử lý action detail
                        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                        if ($id === false || $id === null) {
                            echo "Invalid event ID";
                        } else {
                            $eventController->detail($id);
                        }
                    } else {
                        $eventController->$action();
                    }
                } else {
                    echo "Action not found";
                }
                break;

                case 'user':
                    $userController = new UserController();
                    if (method_exists($userController, $action)) {
                        if ($action == 'edit' || $action == 'delete') {
                            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                            if ($id === false || $id === null) {
                                echo "Invalid user ID";
                            } elseif ($action == 'edit') {
                                $userController->edit($id);
                            } elseif ($action == 'delete') {
                                $userController->delete($id);
                            }
                        } else {
                            $userController->$action();
                        }
                    } else {
                        echo "Action not found";
                    }
                    break;
        
            default:
                echo "Controller not found";
        }
        
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>