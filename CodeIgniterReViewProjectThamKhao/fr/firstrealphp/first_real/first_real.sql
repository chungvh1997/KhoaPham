-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 14, 2018 lúc 04:39 AM
-- Phiên bản máy phục vụ: 10.1.36-MariaDB
-- Phiên bản PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `first_real`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `ID` int(11) NOT NULL,
  `Parent_ID` int(11) NOT NULL,
  `Level` int(1) NOT NULL,
  `Set_level` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Date_create` int(11) NOT NULL,
  `Rank` int(3) NOT NULL,
  `Display` int(1) NOT NULL,
  `Slogan` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`ID`, `Parent_ID`, `Level`, `Set_level`, `Name`, `Content`, `Thumb`, `Link`, `Keywords`, `Description`, `Date_create`, `Rank`, `Display`, `Slogan`) VALUES
(24, 0, 1, '', 'Tiện ích', '', 'danh-muc-cap-1b-393.jpg', 'tien-ich', 'Tiện ích', 'Tiện ích', 1544618211, 2, 1, ''),
(28, 0, 1, '', 'Giới thiệu', '', 'danh-muc-cap-1a-486.jpg', 'gioi-thieu', 'Giới thiệu', 'Giới thiệu', 1544618197, 1, 1, 'MƠ ƯỚC CỦA VINCITY'),
(42, 0, 1, '', 'Dự án', '', '', 'du-an', 'Dự án', 'Dự án', 1544618221, 3, 1, ''),
(43, 0, 1, '', 'Giải pháp Tài Chính', '', '', 'giai-phap-tai-chinh', 'Giải pháp Tài Chính', 'Giải pháp Tài Chính', 1544618239, 4, 1, ''),
(44, 0, 1, '', 'Liên hệ', '', '', 'lien-he', 'Liên hệ', 'Liên hệ', 1544618267, 5, 1, ''),
(45, 42, 2, '42', 'The Light', '', '', 'the-light', '', '', 1544673605, 0, 1, ''),
(46, 42, 2, '42', 'The resort', '', '', 'the-resort', '', '', 1544681388, 0, 1, ''),
(47, 42, 2, '42', 'The Center', '', '', 'the-center1', '', '', 1544681388, 0, 1, ''),
(48, 42, 2, '42', 'The Center', '', '', 'the-center2', '', '', 1544681388, 0, 1, ''),
(49, 42, 2, '42', 'The Center', '', '', 'the-center3', '', '', 1544681388, 0, 1, ''),
(50, 0, 1, '', 'Tin tức', '', '', 'tin-tuc', 'Liên hệ', 'Liên hệ', 1544757918, 5, 0, '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `ID` int(11) NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Full_Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Content` text COLLATE utf8_unicode_ci NOT NULL,
  `Cat_ID` int(10) NOT NULL,
  `Phone` int(10) NOT NULL,
  `Date_create` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`ID`, `Email`, `Full_Name`, `Address`, `Content`, `Cat_ID`, `Phone`, `Date_create`) VALUES
(1, 'trongtam10171981@gmail.com', '123213', '', '123123', 1, 1677106870, 127),
(2, 'trongtam10171981@gmail.com', '123213', '', '123123', 1, 1677106870, 1544693009),
(3, 'trongtam10171981@gmail.com', '123213', '', '123123', 1, 1677106870, 1544693257),
(4, 'trongtam10171981@gmail.com', 'admin', '', '312321321', 1, 123123456, 1544693286),
(5, 'trongtam10171981@gmail.com', 'admin', '', '123123', 1, 1312321, 1544694600),
(6, 'trongtam10171981@gmail.com', 'admin', '', '123123', 2, 1312321, 1544694613),
(7, 'thanhaideveloper@gmail.com', 'ádasdsad', '', '123123123123', 0, 0, 1544700316),
(8, 'trongtam10171981@gmail.com', 'admin', '', 'adsadas', 1, 1677106870, 1544702070);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `district`
--

CREATE TABLE `district` (
  `ID` int(3) NOT NULL,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Province_ID` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `Parent_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Content` text COLLATE utf8_unicode_ci NOT NULL,
  `Thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Date_create` int(11) NOT NULL,
  `Province_ID` int(3) NOT NULL,
  `Rank` int(2) NOT NULL,
  `Display` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`ID`, `Parent_ID`, `Name`, `Content`, `Thumb`, `Link`, `Keywords`, `Description`, `Date_create`, `Province_ID`, `Rank`, `Display`) VALUES
(7, '0', 'Dự án test posts 1', '<p>Dự &aacute;n test posts 1</p>\r\n', 'du-an-test-posts-1-27.jpg', 'du-an-test-posts-1', 'Dự án test posts 1', 'Dự án test posts 1', 1544675640, 2, 0, 1),
(8, '50', 'VINHOMES ra mắt “Thành phố thể thao” VinCity Sportia', '<p>Dự &aacute;n test posts 1</p>', 'du-an-test-posts-1-27.jpg', 'vin-1', '', '', 1544675688, 1, 0, 1),
(9, '50', 'VINHOMES ra mắt “Thành phố thể thao” VinCity Sportia', '<p>Dự &aacute;n test posts 1</p>', 'du-an-test-posts-1-27.jpg', 'vin-2', '', '', 1544675688, 1, 0, 1),
(10, '50', 'VINHOMES ra mắt “Thành phố thể thao” VinCity Sportia', '<p>Dự &aacute;n test posts 1</p>', 'du-an-test-posts-1-27.jpg', 'vin-3', '', '', 1544675688, 1, 0, 1),
(11, '50', 'VINHOMES ra mắt “Thành phố thể thao” VinCity Sportia', '<p>Dự &aacute;n test posts 1</p>', 'du-an-test-posts-1-27.jpg', 'vin-4', '', '', 1544675688, 1, 0, 1),
(12, '50', 'VINHOMES ra mắt “Thành phố thể thao” VinCity Sportia', '<p>Dự &aacute;n test posts 1</p>', 'du-an-test-posts-1-27.jpg', 'vin-5', '', '', 1544675688, 1, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `province`
--

CREATE TABLE `province` (
  `ID` int(5) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Type` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `ID` int(3) NOT NULL,
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Hotline` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Content` text COLLATE utf8_unicode_ci NOT NULL,
  `Location` text COLLATE utf8_unicode_ci NOT NULL,
  `Extension` text COLLATE utf8_unicode_ci NOT NULL,
  `Logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Favicon` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `setting`
--

INSERT INTO `setting` (`ID`, `Title`, `Keywords`, `Description`, `Name`, `Email`, `Hotline`, `Address`, `Content`, `Location`, `Extension`, `Logo`, `Favicon`) VALUES
(1, '', 'aaaaaaaaaaaaa', 'aaaaaaa', 'CÔNG TY CỔ PHẦN ĐỊA ỐC FIRST REAL MIỀN NAM', 'hotromiennam@fir.vn', '0931.777.122 - 0286 6786565', 'L4 - SH. 05 Tòa Lank mark 4 vinhomes Central Park,208 Nguyễn Hữu Cảnh,phường 22,Quận Bình Thạnh,TP.Hồ Chí Minh', '', ' <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7838.469521570985!2d106.717607974624!3d10.79332341924021!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528a98f124785%3A0x61f3bc81b7ef4017!2zVmluaG9tZXMgQ2VudHJhbCBQYXJrLCBQaMaw4budbmcgMjIsIELDrG5oIFRo4bqhbmgsIEhvIENoaSBNaW5oIENpdHksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1544500089950\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '', '78964118.png', '66527655.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slider`
--

CREATE TABLE `slider` (
  `ID` int(11) NOT NULL,
  `Slider_ID` int(10) NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Display` int(1) NOT NULL,
  `Date_create` int(11) NOT NULL,
  `Rank` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slider`
--

INSERT INTO `slider` (`ID`, `Slider_ID`, `Name`, `Thumb`, `Link`, `Description`, `Display`, `Date_create`, `Rank`) VALUES
(1, 19, 'sadsad', '', '', '', 1, 0, 0),
(2, 19, 'sads', '', '', '', 1, 0, 0),
(3, 19, 'sadsad', '', '', '', 1, 0, 0),
(4, 19, 'sads', '', '', '', 1, 0, 0),
(6, 0, 'phong', '79.jpg', '', 'sssssssssss', 1, 1544754854, 1),
(10, 19, 'dd', '76.jpg', '', 'dddd', 1, 1544756423, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slider_cat`
--

CREATE TABLE `slider_cat` (
  `ID` int(11) NOT NULL,
  `Parent_ID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Name2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Date_create` int(11) NOT NULL,
  `Rank` int(2) NOT NULL,
  `Display` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slider_cat`
--

INSERT INTO `slider_cat` (`ID`, `Parent_ID`, `Name`, `Name2`, `Thumb`, `Link`, `Description`, `Date_create`, `Rank`, `Display`) VALUES
(19, '28', 'Slider giới thiệu 1', 'phần tên nhỏ', 'slider-gioi-thieu-1-48.jpg', '', 'mô ta o đây hi hi', 1544702237, 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Role` int(1) NOT NULL,
  `Display` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `Role`, `Display`) VALUES
(1, 'admin', '40689d3350ea8930b692def7df07df8f', 1, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `slider_cat`
--
ALTER TABLE `slider_cat`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `district`
--
ALTER TABLE `district`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `province`
--
ALTER TABLE `province`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `setting`
--
ALTER TABLE `setting`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `slider`
--
ALTER TABLE `slider`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `slider_cat`
--
ALTER TABLE `slider_cat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
