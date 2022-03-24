-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 24, 2022 lúc 09:56 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_service`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `baiviet`
--

CREATE TABLE `baiviet` (
  `bv_id` int(11) NOT NULL,
  `bv_tieude` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bv_thoigian` datetime NOT NULL,
  `bv_tacgia` int(11) NOT NULL,
  `cd_id` int(11) NOT NULL,
  `bv_status` bit(1) NOT NULL DEFAULT b'0',
  `bv_view` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `baiviet`
--

INSERT INTO `baiviet` (`bv_id`, `bv_tieude`, `bv_thoigian`, `bv_tacgia`, `cd_id`, `bv_status`, `bv_view`) VALUES
(133, 'Nhiều nước đồng loạt phát cảnh báo về biến chủng nCoV mới', '2021-11-26 07:40:08', 2, 1, b'1', 70),
(135, 'Hai tuần lây lan xuyên lục địa của chủng Omicron', '2021-11-27 08:08:54', 2, 9, b'1', 61),
(138, 'Đề xuất gói củng cố hệ thống y tế 76.000 tỷ đồng123', '2021-12-05 07:45:03', 2, 3, b'0', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `bl_id` int(11) NOT NULL,
  `bl_noidung` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bl_thoigian` datetime NOT NULL,
  `bv_id` int(11) NOT NULL,
  `nd_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`bl_id`, `bl_noidung`, `bl_thoigian`, `bv_id`, `nd_id`) VALUES
(8, 'Kiểm tra bình luận', '2021-11-28 05:58:10', 135, 6),
(9, 'Kiểm tra bình luận', '2021-11-28 05:59:33', 133, 6),
(10, 'hay', '2021-12-05 04:14:41', 133, 1),
(11, 'Hay quá', '2021-12-05 04:17:57', 135, 2),
(12, 'san pham hay qua troi', '2021-12-05 07:46:44', 138, 2),
(13, 'demo123', '2021-12-05 07:48:49', 138, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chude`
--

CREATE TABLE `chude` (
  `cd_id` int(11) NOT NULL,
  `cd_chude` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `chude`
--

INSERT INTO `chude` (`cd_id`, `cd_chude`) VALUES
(1, 'Lịch sử'),
(3, 'Âm nhạc'),
(8, 'Xã hội'),
(9, 'Y tế'),
(10, 'Kinh tế'),
(12, 'Chính trị');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `images`
--

CREATE TABLE `images` (
  `img_id` int(11) NOT NULL,
  `img_source` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `bv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `images`
--

INSERT INTO `images` (`img_id`, `img_source`, `bv_id`) VALUES
(6, '133_poke.png', 133),
(8, '135_meme.jpg', 135),
(11, '138_menu.png', 138);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `link`
--

CREATE TABLE `link` (
  `link_id` int(11) NOT NULL,
  `link_url` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `bv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `link`
--

INSERT INTO `link` (`link_id`, `link_url`, `bv_id`) VALUES
(2, 'https://www.facebook.com/', 133),
(4, 'https://vnexpress.net/hai-tuan-lay-lan-xuyen-luc-dia-cua-chung-omicron-4395316.html', 135),
(6, 'https://vnexpress.net/du-kien-cac-ngay-nghi-le-tet-nam-2022-4398418.html', 138);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `nd_id` int(11) NOT NULL,
  `nd_hoten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nd_taikhoan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nd_matkhau` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nd_loai` int(11) NOT NULL DEFAULT 2 CHECK (`nd_loai` = 0 or `nd_loai` = 1 or `nd_loai` = 2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--

INSERT INTO `nguoidung` (`nd_id`, `nd_hoten`, `nd_taikhoan`, `nd_matkhau`, `nd_loai`) VALUES
(1, 'Phạm Thanh Duy', 'admin', '21232f297a57a5a743894a0e4a801fc3', 0),
(2, 'Phạm Thanh Duy', 'demo123', '21232f297a57a5a743894a0e4a801fc3', 1),
(3, 'Phạm Thanh Duy', 'test', '21232f297a57a5a743894a0e4a801fc3', 2),
(6, 'admin', 'duy123', '21232f297a57a5a743894a0e4a801fc3', 2),
(7, 'Nguyễn Văn A', 'sieucapvip', '202cb962ac59075b964b07152d234b70', 2),
(9, 'duy123', 'vn1231', '202cb962ac59075b964b07152d234b70', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `noidung`
--

CREATE TABLE `noidung` (
  `nd_id` int(11) NOT NULL,
  `nd_noidung` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `bv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `noidung`
--

INSERT INTO `noidung` (`nd_id`, `nd_noidung`, `bv_id`) VALUES
(23, 'Israel, Singapore hạn chế đi lại với các nước châu Phi, trong khi Ấn Độ, Australia cảnh báo theo dõi chặt chẽ biến chủng mới B.1.1.529 tại khu vực này.\n\nChính phủ Israel hôm 25/11 thông báo cấm công dân tới các quốc gia miền nam châu Phi và cũng cấm người từ khu vực này nhập cảnh, do lo ngại về biến chủng B.1.1.529 mới được phát hiện tại đây.', 133),
(25, 'Biến chủng Omicron được phát hiện lần đầu ở Botswana, lan nhanh ra các nước phía nam châu Phi và xuất hiện tại nhiều nơi khác trên thế giới.\n\nCa nhiễm biến chủng B.1.1.529, có tên gọi Omicron, đầu tiên được phát hiện ở Botswana, quốc gia láng giềng của Nam Phi, vào ngày 9/11. Giới chức y tế Nam Phi hôm 23/11 phát hiện biến chủng mới trong mẫu bệnh phẩm thu ngày 14-16/11, sau đó thông báo cho Tổ chức Y tế Thế giới (WHO).', 135),
(28, 'Đề xuất gói củng cố hệ thống y tế 76.000 tỷ đồng123', 138);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  ADD PRIMARY KEY (`bv_id`),
  ADD KEY `bv_tacgia` (`bv_tacgia`),
  ADD KEY `cd_id` (`cd_id`);

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`bl_id`),
  ADD KEY `bv_id` (`bv_id`),
  ADD KEY `nd_id` (`nd_id`);

--
-- Chỉ mục cho bảng `chude`
--
ALTER TABLE `chude`
  ADD PRIMARY KEY (`cd_id`);

--
-- Chỉ mục cho bảng `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `bv_id` (`bv_id`);

--
-- Chỉ mục cho bảng `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `bv_id` (`bv_id`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`nd_id`);

--
-- Chỉ mục cho bảng `noidung`
--
ALTER TABLE `noidung`
  ADD PRIMARY KEY (`nd_id`),
  ADD KEY `bv_id` (`bv_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  MODIFY `bv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `bl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `chude`
--
ALTER TABLE `chude`
  MODIFY `cd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `link`
--
ALTER TABLE `link`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `nd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `noidung`
--
ALTER TABLE `noidung`
  MODIFY `nd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `baiviet`
--
ALTER TABLE `baiviet`
  ADD CONSTRAINT `baiviet_ibfk_1` FOREIGN KEY (`bv_tacgia`) REFERENCES `nguoidung` (`nd_id`),
  ADD CONSTRAINT `baiviet_ibfk_2` FOREIGN KEY (`cd_id`) REFERENCES `chude` (`cd_id`);

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `binhluan_ibfk_1` FOREIGN KEY (`bv_id`) REFERENCES `baiviet` (`bv_id`),
  ADD CONSTRAINT `binhluan_ibfk_2` FOREIGN KEY (`nd_id`) REFERENCES `nguoidung` (`nd_id`);

--
-- Các ràng buộc cho bảng `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`bv_id`) REFERENCES `baiviet` (`bv_id`);

--
-- Các ràng buộc cho bảng `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `link_ibfk_1` FOREIGN KEY (`bv_id`) REFERENCES `baiviet` (`bv_id`);

--
-- Các ràng buộc cho bảng `noidung`
--
ALTER TABLE `noidung`
  ADD CONSTRAINT `noidung_ibfk_1` FOREIGN KEY (`bv_id`) REFERENCES `baiviet` (`bv_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
