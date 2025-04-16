-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 16, 2025 lúc 02:55 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `event_management`
--
CREATE DATABASE IF NOT EXISTS `event_management` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `event_management`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `events`
--

INSERT INTO `events` (`id`, `user_id`, `title`, `description`, `date`, `location`, `image`) VALUES
(19, 2, 'LEGEND FEST 2025 IN DONG HOI', 'Lễ hội âm nhạc bên biển đáng mong chờ nhất mùa hè chính thức diễn ra tại phố đi bộ biển Hoàng Vân, khu đô thị Regal Legend, Đồng Hới, Quảng Bình! Với quy mô 15.000 khán giả, sân khấu hoành tráng, hệ thống âm thanh – ánh sáng chuẩn quốc tế, Legend Fest 2025 mang đến dàn nghệ sĩ hàng đầu Việt Nam, những màn trình diễn bùng nổ cùng không gian biển xanh cát trắng đầy cảm hứng. Legend Fest 2025 là một festival thương hiệu của Regal Group, diễn ra trong quy mô của dự án Regal Legend đẳng cấp. Không chỉ là một festival âm nhạc, đây còn là nơi hội tụ văn hóa, nghệ thuật, du lịch, tạo nên một kỳ nghỉ hội hè đáng nhớ. Sẵn sàng quẩy hết mình vào ngày 30/04/2025!', '2025-04-30', 'Regal Legend Đồng Hới', '1744728546_sk1.jpg'),
(20, 2, ' Hài Kịch: Tung Hoành Pattaya', 'Tác giả: Nguyễn Duy Xăng - Hiếu Nghĩa - Long Duy\r\nĐạo diễn:  Hồng Ngọc\r\nDiễn viên: Huỳnh Nhựt, Hải Triều, Tuấn Kiệt, Mai Bảo Vinh, Long Chun, Bé 7, Giỏi Lee, Duy Tiến, Huỳnh Thi, Huyền Duy, Lê Nghĩa và Khương Ngọc.', '2025-04-20', 'Nhà Văn Hóa Thanh Niên Hồ Chí Minh', '1744728670_sk2.jpg'),
(21, 2, 'CINÉ FUTURE HITS #9: CAPTAIN BOY', 'Tiếp nối hành trình tôn vinh và phát triển văn hoá, nghệ thuật Việt, Ciné Saigon chính thức mang Future Hits quay lại với số thứ 9, cùng với đó sẽ hiện thực hoá mong chờ của Cừu Có Cánh khi mang đến cái tên đã khuấy đảo các nền tảng mạng xã hội trong suốt thời gian qua: CAPTAIN BOY!\r\n\r\nLà một nghệ sĩ đa tài khi hoạt động trong mọi lĩnh vực như ca sĩ, rapper, nhạc sĩ và nhà sản xuất âm nhạc, CAPTAIN BOY đã trở thành một \"hiện tượng\" nổi bật trong lứa nghệ sĩ GenZ triển vọng. Với sự cố gắng không ngừng nghỉ, từ Giọng Hát Việt Nhí đến Anh Trai Say Hi, CAPTAIN BOY không chỉ để lại dấu ấn mạnh mẽ trong làng nhạc Việt mà còn \"bỏ túi\" cho mình một cộng đồng fandom hùng hậu và đầy sự gắn kết - Cừu Có Cánh. Với sự đa tài và nỗ lực không ngừng, CAPTAIN BOY đang từng bước khẳng định vị trí vững chắc của mình trong làng nhạc Việt Nam.', '2025-04-18', 'CINÉ Saigon', '1744728781_sk3.jpg'),
(22, 2, '[DẾ GARDEN] Kokedama Workshop', 'Kokedama, nghệ thuật trồng cây độc đáo của Nhật Bản, tạo ra quả cầu đất bọc rễ cây, giúp chúng phát triển tự nhiên. Kết nối con người với thiên nhiên, thể hiện triết lý Wabi Sabi – cái đẹp trong sự không hoàn hảo, khơi gợi cảm hứng và chiêm nghiệm vẻ đẹp của sự tạm bợ trong cuộc sống.\r\nTại buổi gặp gỡ này, Dế sẽ cùng bạn khám phá Kokedama:\r\n🌱 Chúng ta sẽ tìm hiểu nguồn gốc và ý nghĩa của Kokedama, từ truyền thuyết cổ xưa đến sự kết nối giữa con người và thiên nhiên.\r\n🌱 Dế sẽ chia sẻ bí quyết chăm sóc cây, tưới nước và kỹ thuật trồng mà không cần chậu, giúp cây phát triển khỏe mạnh trong quả cầu đất.\r\n🌱 Cuối cùng, bạn sẽ thực hành tạo ra viên ngọc rêu (Moss Gem) của riêng mình, thể hiện sự sáng tạo và mang thiên nhiên về nhà', '2025-04-15', 'Dế Garden', '1744728912_sk4.png'),
(23, 2, ' NHỮNG CON MA NHÀ HÁT', 'Đây sẽ là tác phẩm hài kịch châm biến, mới lạ được NSƯT Thành Lộc chỉ huy công tác dàn dựng bên cạnh nghệ thuật diễn xuất.\r\nVới sự tham gia của các diễn viên: NSƯT Thành Lộc, NSƯT Hữu Châu, Hương Giang, Trương Hạ, Hồ Giang Bảo Sơn, Trang Tuyền, Mạnh Hùng, Minh Thư, Huy An, Yến Nhi, Hữu Khang, Tuyết Trinh, Nhật Minh, Trần Trung, Hoàng Phong, Khải Nguyên, Sơn Giang. \r\nTrân trọng kính mời quý khán giả!', '2025-04-16', 'TẦNG 12B TÒA NHÀ IMC', '1744728977_sk5.jpg'),
(24, 2, 'The “Traditional Water Puppet Show” ', 'Nhà Hát Múa Rối Nước RỒNG VÀNG Thành phố Hồ Chí Minh -Việt Nam xin gửi tới Quý khách Nghệ thuật múa rối nước cổ truyền độc đáo đã có từ thế kỷ XI. Chương trình này đã được giới thiệu tại nhiều Liên Hoan Quốc tế và nhiều nước trên thế giới.', '2025-04-15', 'Cung Văn Hoá Lao Động TP.HCM', '1744729289_sk6.png'),
(25, 2, 'VIETNAM PICKLEBALL OPEN CUP ARTISTS', 'Ngày 16/04, sự kiện Vietnam Pickleball Open Cup Artists sẽ khuấy động giải đấu Vietnam Pickleball Open Cup – Saigon Stage với không khí bùng nổ chưa từng có!\r\n🔥 Dàn nghệ sĩ Anh Trai Say Hi cùng loạt KOLs và influencers đình đám sẽ tranh tài trên sân Pickleball \r\n👮‍♂️ Giao lưu cùng các vận động viên từ CLB Pickleball Công An Nhân Dân\r\n🔥 Đặc biệt: Meet & Greet cùng Phoenix Flames ', '2025-04-16', 'KĐT Him Lam, Q.7, TP. HCM', '1744729427_sk7.jpeg'),
(26, 2, 'SÂN KHẤU THIÊN ĐĂNG: XÓM VỊT TRỜI', 'Với sự tham gia của các Nghệ sỹ:  NSƯT Hữu Châu, Hoàng Thái Quốc, Phương Dung, Phi Phụng, Huy Tứ, Hương Giang, Lương Thế Thành, Quốc Trung, Kiều Ngân, Trương Hạ, Ngọc Xuyên, Ngô Phương Anh, Trang Tuyền, Xuân Phạm, Mai Chi, Mạnh Hùng, Sơn Giang, Nhật Minh cùng các diễn viên trẻ sân khấu Thiên Đăng.\r\nTrân trọng kính mời quý khán giả!', '2025-04-17', 'TẦNG 12B TÒA NHÀ IMC', '1744729508_sk8.jpg'),
(27, 2, 'Kịch Ma 4D: Mặt Nạ Quỷ', '\"MẶT NẠ QUỶ\" - VỞ KỊCH MA 4D ĐÃ TRỞ LẠI\r\nBác sĩ Mai, người phụ nữ được mệnh danh là \'người gieo mầm hy vọng\' cho những tâm hồn lạc lối trong viện tâm thần, ẩn sâu trong đôi mắt ấy là một bí mật đen tối. Một sự cố kinh hoàng, cái chết đầy bí ẩn của một bệnh nhân, đã kéo cô trở lại vực sâu của những ký ức kinh hoàng nơi những con quỷ quá khứ trỗi dậy, đòi nợ...\r\nNhưng đó chưa phải là tất cả.\r\nNhững tiếng thì thầm vang vọng trong bóng tối, những bóng hình mờ ảo lảng vảng trong hành lang bệnh viện, những cơn ác mộng ngày càng trở nên chân thực... Liệu bác sĩ Mai có thể đối mặt với những con quỷ đang ẩn náu trong bóng tối, hay chính cô sẽ trở thành con mồi tiếp theo', '2025-04-18', 'Sân Khấu Quốc Thảo', '1744729596_sk9.jpg'),
(28, 2, 'Mambo Jumbo Nights', 'Get ready for an electrifying night of live music, dazzling drag performances, and high-energy DJ sets! Mambo Jumbo is bringing you an unforgettable mix of rhythm, glam, and beats—so gather your crew and let’s party!', '2025-02-26', 'georges @ Saigon', '1744731607_sk10.png'),
(29, 2, 'Agile Vietnam Open Space', 'we’re crafting a unique and exciting unconference experience—one that puts you in the driver’s seat. No predetermined agenda, no keynotes—just meaningful, participant-driven discussions where anyone can be a speaker, and everyone is welcome to join.', '2025-03-29', 'Athena Studio', '1744731687_sk11.jpeg'),
(30, 2, 'ĐÁM CƯỚI BÊN CỒN', 'Đám Cưới Bên Cồn là vở Hài Kịch nói về cô gái trong một chuyến du lịch trốn khỏi hôn nhân sắp đặt từ gia đình, gặp những vị khách từ nhiều quốc gia khác nhau và tất cả đều \"Ế\", trong đó anh chàng việt kiều điển trai và tính tình hài hước. Có rất nhiều tình tiết vui nhộn, trớ trêu, đáng nhớ tại Cái Cồn đến với cô gái. Liệu cuộc hôn nhân sắp đặt có thành? chuyện gì sẽ xảy ra trong suốt chuyến du lịch? Mời quý khán giả đến xem ', '2025-04-07', 'Sân Khấu Kịch Quốc Thảo', '1744731800_sk12.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `feedbacks`
--

INSERT INTO `feedbacks` (`id`, `user_id`, `content`, `created_at`, `is_read`) VALUES
(1, 7, 'Cần cập nhật thêm chức năng mới', '2025-04-12 02:16:18', 0),
(2, 8, 'thêm chức năng mới', '2025-04-12 03:33:49', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(2, 'admin', '', '$2y$10$gvtb7LGkZCVZ/O4g79FXeOu0UUmhS.uGPG1NHLlULhLEjJfZKshpy', 'admin'),
(3, 'hung', '', '$2y$10$hyr/l2WrN9FOMPaUIYPAz.SX.4GSMBXOfyI8pqivx65.8kLq0VAge', 'user'),
(6, 'tyty', '', '$2y$10$Wkrw268/Zmi59xg65ADrxeV9gNta5816NZHlFzp2MUdpGYwbQGbxa', 'user'),
(7, 'khiet', '', '$2y$10$oTKYiSJUK5uYhSbaXMj1C.G9zzbSuX.nxQAO2tmB5JD68usVtS1/e', 'admin'),
(8, 'khiet1', 'khiet1@gmail.com', '$2y$10$JideAikcAm8e.XWutCqqNebmnc06aA/g28gpZfMjKqTEtHVmSRxQi', 'user');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
