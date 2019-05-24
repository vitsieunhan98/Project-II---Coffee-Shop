-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 24, 2019 lúc 05:00 AM
-- Phiên bản máy phục vụ: 10.1.36-MariaDB
-- Phiên bản PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `online_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_order` date NOT NULL,
  `total` double NOT NULL,
  `note` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `bills`
--

INSERT INTO `bills` (`id`, `id_user`, `date_order`, `total`, `note`, `status`, `address`) VALUES
(1, 1, '2019-03-10', 58000, 'Không có', 1, 'Hà Nội'),
(2, 1, '2019-03-10', 29000, 'Không có', 1, 'HN'),
(3, 1, '2019-03-13', 29000, 'Không có', 1, 'Hà Nội'),
(4, 1, '2019-03-14', 60000, 'Không có', 1, 'Hà Nội');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill_detail`
--

CREATE TABLE `bill_detail` (
  `id` int(11) NOT NULL,
  `id_bill` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `bill_detail`
--

INSERT INTO `bill_detail` (`id`, `id_bill`, `id_product`, `quantity`, `unit_price`) VALUES
(1, 1, 1, 1, 29000),
(2, 1, 2, 1, 29000),
(3, 2, 3, 1, 29000),
(4, 3, 3, 1, 29000),
(5, 4, 1, 2, 20000),
(6, 4, 2, 1, 20000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `content`, `id_user`, `id_product`) VALUES
(1, 'ngon!', 1, 1),
(2, 'cực ngon', 1, 1),
(3, 'sasasasa', 1, 1),
(4, 'ngon', 1, 23),
(5, 'wow', 1, 2),
(6, 'ừ', 1, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(400) NOT NULL,
  `image` varchar(255) NOT NULL,
  `rate` double NOT NULL,
  `total_rate` int(11) NOT NULL,
  `promotion_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `id_type`, `name`, `price`, `description`, `image`, `rate`, `total_rate`, `promotion_price`) VALUES
(1, 1, 'Cà phê phin đen nóng', 29000, 'Dành cho những tín đồ cà phê đích thực! Hương vị cà phê truyền thống được phối trộn độc đáo tại Highlands. Cà phê đậm đà pha từ Phin, cho thêm 1 thìa đường, mang đến vị cà phê đậm đà chất Phin', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/AMERICANO.png', 9, 1, 20000),
(2, 1, 'Cà phê phin sữa nóng', 29000, 'Hương vị cà phê Việt Nam đích thực! Từng hạt cà phê hảo hạng được chọn bằng tay, phối trộn độc đáo giữa hạt Robusta từ cao nguyên Việt Nam, thêm Arabica thơm lừng. Kết hợp với nước sôi từng giọt cà phê được chiết xuất từ Phin truyền thống, hoà cùng sữa đặc sánh tạo nên ly Phin Sữa Nóng – Đậm đà chất Phin', 'https://www.highlandscoffee.com.vn/vnt_upload/product/06_2018/PHIN-SUA-NONG.png', 10, 1, 20000),
(3, 1, 'Cà phê phin sữa đá', 29000, 'Hương vị cà phê Việt Nam đích thực! Từng hạt cà phê hảo hạng được chọn bằng tay, phối trộn độc đáo giữa hạt Robusta từ cao nguyên Việt Nam, thêm Arabica thơm lừng. Cà phê được pha từ Phin truyền thống, hoà cùng sữa đặc sánh và thêm vào chút đá tạo nên ly Phin Sữa Đá – Đậm Đà Chất Phin.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/PHIN-SUA-DA.png', 0, 0, 29000),
(4, 1, 'Cà phê phin đen đá', 29000, 'Dành cho những tín đồ cà phê đích thực! Hương vị cà phê truyền thống được phối trộn độc đáo tại Highlands. Cà phê đậm đà pha hoàn toàn từ Phin, cho thêm 1 thìa đường, một ít đá viên mát lạnh, tạo nên Phin Đen Đá mang vị cà phê đậm đà chất Phin. ', 'https://www.highlandscoffee.com.vn/vnt_upload/product/05_2018/CFD.png', 0, 0, 29000),
(5, 1, 'Caramel Phin Freeze', 49000, 'Thơm ngon khó cưỡng! Được kết hợp từ cà phê truyền thống chỉ có tại Highlands Coffee, cùng với caramel, thạch cà phê và đá xay mát lạnh. Trên cùng là lớp kem tươi thơm béo và caramel ngọt ngào. Món nước phù hợp trong những cuộc gặp gỡ bạn bè, bởi sự ngọt ngào thường mang mọi người xích lại gần nhau.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/.png', 0, 0, 49000),
(6, 1, 'Classic Phin Frezze', 49000, 'Thơm ngon đậm đà! Được kết hợp từ cà phê pha Phin truyền thống chỉ có tại Highlands Coffee, cùng với thạch cà phê và đá xay mát lạnh. Trên cùng là lớp kem tươi thơm béo và bột ca cao đậm đà. Món nước hoàn hảo để khởi đầu câu chuyện cùng bạn bè.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/05_2018/CLASSIC-FREEZE.png', 0, 0, 49000),
(7, 1, 'Freeze Trà Xanh', 49000, 'Thức uống rất được ưa chuộng! Trà xanh thượng hạng từ cao nguyên Việt Nam, kết hợp cùng đá xay, thạch trà dai dai, thơm ngon và một lớp kem dày phủ lên trên vô cùng hấp dẫn. Freeze Trà Xanh thơm ngon, mát lạnh, chinh phục bất cứ ai!', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/GTF.png', 0, 0, 49000),
(8, 1, 'Cookies & Cream', 49000, 'Một thức uống ngon lạ miệng bởi sự kết hợp hoàn hảo giữa cookies sô cô la giòn xốp cùng hỗn hợp sữa tươi cùng sữa đặc đem say với đá viên, và cuối cùng không thể thiếu được chính là lớp kem whip mềm mịn cùng cookies sô cô la say nhuyễn.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/05_2018/COOKIES-CREAM.png', 0, 0, 49000),
(9, 1, 'Freeze Sô-cô-la', 49000, 'Thiên đường đá xay sô cô la! Từ những thanh sô cô la Việt Nam chất lượng được đem xay với đá cho đến khi mềm mịn, sau đó thêm vào thạch sô cô la dai giòn, ở trên được phủ một lớp kem whip beo béo và sốt sô cô la ngọt ngào. Tạo thành Freeze Sô-cô-la ngon mê mẩn chinh phục bất kì ai!', 'https://www.highlandscoffee.com.vn/vnt_upload/product/05_2018/CHOCOLATE-FREEZE.png', 0, 0, 49000),
(10, 1, 'Trà Sen Vàng', 39000, 'Thức uống chinh phục những thực khách khó tính! Sự kết hợp độc đáo giữa trà Ô long, hạt sen thơm bùi và củ năng giòn tan. Thêm vào chút sữa sẽ để vị thêm ngọt ngào.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/TRASENVANG.png', 0, 0, 39000),
(11, 1, 'Trà Thạch Vải', 39000, 'Một sự kết hợp thú vị giữa trà đen, những quả vải thơm ngon và thạch vàng giòn béo, mang đến thức uống tuyệt hảo!', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/TRATHACHVAI.png', 0, 0, 39000),
(12, 1, 'Trà Thạch Đào', 39000, 'Vị trà đậm đà kết hợp cùng những miếng đào thơm ngon mọng nước cùng thạch đào giòn dai. Thêm vào ít sữa để gia tăng vị béo.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/TRATHACHDAO.png', 0, 0, 39000),
(13, 1, 'Trà Thanh Đào', 39000, 'Một trải nghiệm thú vị khác! Sự hài hòa giữa vị trà cao cấp, vị sả thanh mát và những miếng đào thơm ngon mọng nước sẽ mang đến cho bạn một thức uống tuyệt vời.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/TRATHANHDAO.png', 0, 0, 39000),
(14, 2, 'Bánh Mì Thịt Nướng', 19000, 'Đặc sản của Việt Nam! Bánh mì giòn với nhân thịt nướng, rau thơm và gia vị đậm đà, hòa quyện trong lớp nước sốt tuyệt hảo.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/BMTHITNUONG.png', 0, 0, 15000),
(15, 2, 'Bánh Mì Xíu Mại', 19000, 'Bánh mì Việt Nam giòn thơm, với nhân thịt viên hấp dẫn, phủ thêm một lớp nước sốt cà chua ngọt, cùng với rau tươi và gia vị đậm đà.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/BMXIUMAI.png', 0, 0, 19000),
(16, 2, 'Bánh Mì Chả Lụa Xá Xíu', 19000, 'Bánh mì Việt Nam giòn thơm với chả lụa và thịt xá xíu thơm ngon, kết hợp cùng rau và gia vị, hòa quyện cùng nước sốt độc đáo.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/BMCHALUAXAXIU.png', 0, 0, 19000),
(17, 2, 'Bánh Mì Gà Xé Nước Tương', 19000, 'Bánh mì Việt Nam giòn thơm với nhân gà xé, rau, gia vị hòa quyện cùng nước sốt đặc biệt.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/BMGAXE.png', 0, 0, 19000),
(18, 2, 'Bánh Mousse Cacao', 29000, 'Bánh Mousse Ca Cao, là sự kết hợp giữa ca-cao Việt Nam đậm đà cùng kem tươi.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/MOUSSECACAO.png', 0, 0, 29000),
(19, 2, 'Bánh Mousse Đào', 29000, 'Một sự kết hợp khéo léo giữa kem và lớp bánh mềm, được phủ lên trên vài lát đào ngon tuyệt.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/MOUSSEDAO.png', 0, 0, 29000),
(20, 2, 'Bánh Sô-cô-la Highlands', 29000, 'Một chiếc bánh độc đáo! Sô cô la ngọt ngào và kem tươi béo ngậy, được phủ thêm một lớp sô cô la mỏng bên trên cho thêm phần hấp dẫn.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/SOCOLAHL.png', 0, 0, 29000),
(21, 2, 'Bánh Phô  Mai Cà Phê', 29000, 'Làm từ cà phê truyền thống của Highlands, kết hợp với phô mai thơm ngon! Chiếc bánh phù hợp đi cùng với bất cứ món cà phê nào!', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/PHOMAICAPHE.jpg', 0, 0, 29000),
(22, 2, 'Bánh Phô Mai Chanh Dây', 29000, 'Vị béo của phô mai cùng với vị chua của chanh dây, tạo nên chiếc bánh thơm ngon hấp dẫn!', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/PHOMAICHANHDAY.jpg', 0, 0, 29000),
(23, 2, 'Bánh Phô Mai Trà Xanh', 29000, 'Một sự sáng tạo mới mẻ, kết hợp giữa trà xanh đậm đà và phô mai ít béo.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/PHOMAITRAXANH.jpg', 0, 0, 29000),
(24, 2, 'Bánh Caramel Phô Mai', 29000, 'Ngon khó cưỡng! Bánh phô mai thơm béo được phủ bằng lớp caramel ngọt ngào.', 'https://www.highlandscoffee.com.vn/vnt_upload/product/03_2018/CARAMELPHOMAI.jpg', 0, 0, 29000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `product_type`
--

INSERT INTO `product_type` (`id`, `name`) VALUES
(1, 'Drink'),
(2, 'Food');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reply_comment`
--

CREATE TABLE `reply_comment` (
  `id` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `reply_comment`
--

INSERT INTO `reply_comment` (`id`, `id_comment`, `id_user`, `content`) VALUES
(1, 1, 1, 'like'),
(2, 1, 1, 'asdas'),
(3, 3, 1, 'd'),
(4, 5, 1, 'thế à'),
(5, 5, 1, 'uh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `id_role` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `id_role`, `status`) VALUES
(1, 'Nguyễn Việt Anh', 'nguyenva091198@gmail.com', '$2y$10$q6VzOBE9SMgLN1WZskZ8husCjhv2LFEj05MqWfdS87q31IMjpzUN.', '0917714205', 2, 1),
(2, 'Admin', 'nhimstone69@gmail.com', '$2y$10$mmu4uV6TPBTnn8yUnMnrjOqH4HtcqLGvAsE4vhdJOueufMQvqgyyO', '0917714205', 1, 1),
(3, 'NVA', 'abc@gmail.com', '$2y$10$DQ29Ctv9VfRO0xpZ1a/uoO4y2enrmnAu1jyj4OptWMUHhehY9egUu', '0917714205', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_rate`
--

CREATE TABLE `user_rate` (
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `user_rate`
--

INSERT INTO `user_rate` (`id_user`, `id_product`, `rate`) VALUES
(1, 1, 9),
(1, 2, 10);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bill_user` (`id_user`);

--
-- Chỉ mục cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bill_bill-detail` (`id_bill`),
  ADD KEY `fk_product_bill-detail` (`id_product`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cmt_user` (`id_user`),
  ADD KEY `fk_product_cmt` (`id_product`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_product-type` (`id_type`);

--
-- Chỉ mục cho bảng `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reply_comment`
--
ALTER TABLE `reply_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rplcmt_user` (`id_user`),
  ADD KEY `fk_rep_cmt` (`id_comment`);

--
-- Chỉ mục cho bảng `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_user_role` (`id_role`);

--
-- Chỉ mục cho bảng `user_rate`
--
ALTER TABLE `user_rate`
  ADD KEY `fk_rate_user` (`id_user`),
  ADD KEY `fk_rate_product` (`id_product`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `reply_comment`
--
ALTER TABLE `reply_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `fk_bill_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `bill_detail`
--
ALTER TABLE `bill_detail`
  ADD CONSTRAINT `fk_bill_bill-detail` FOREIGN KEY (`id_bill`) REFERENCES `bills` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_bill-detail` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_cmt_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_cmt` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_product-type` FOREIGN KEY (`id_type`) REFERENCES `product_type` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `reply_comment`
--
ALTER TABLE `reply_comment`
  ADD CONSTRAINT `fk_rep_cmt` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rplcmt_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `user_rate`
--
ALTER TABLE `user_rate`
  ADD CONSTRAINT `fk_rate_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rate_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
