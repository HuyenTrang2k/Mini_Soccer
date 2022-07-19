-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 05, 2020 lúc 03:24 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cnpm`
--
CREATE DATABASE IF NOT EXISTS `cnpm` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `cnpm`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `datsan`
--

CREATE TABLE `datsan` (
  `idHoaDon` int(10) NOT NULL,
  `IdUser` int(10) NOT NULL,
  `HoTen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Sdt` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `NgayDat` datetime NOT NULL,
  `MaSan` int(10) NOT NULL,
  `TongTien` int(100) NOT NULL,
  `ThanhToan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `TrangThai` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `datsan`
--

INSERT INTO `datsan` (`idHoaDon`, `IdUser`, `HoTen`, `Sdt`, `NgayDat`, `MaSan`, `TongTien`, `ThanhToan`, `TrangThai`) VALUES
(19, 18, 'hoàng tùng', '0329433479', '2020-12-05 22:46:00', 22, 220000, 'Tiền mặt', 'Chưa duyệt'),
(23, 18, 'hoàngtùng', '0329433479', '2020-12-12 22:46:00', 22, 220000, 'Tiền mặt', 'Chưa duyệt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san`
--

CREATE TABLE `san` (
  `MaSan` int(10) NOT NULL,
  `TenSan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ChiNhanh` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `GiaThue` int(100) NOT NULL,
  `DiaChi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `MoTa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `AnhSan` char(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `san`
--

INSERT INTO `san` (`MaSan`, `TenSan`, `ChiNhanh`, `GiaThue`, `DiaChi`, `MoTa`, `AnhSan`) VALUES
(22, 'Sân 1', 'Quận 7', 220000, '580 Lê Văn Lương, Tân Phong, Quận 7', 'Sân cỏ tự nhiên mini', 'img/sanbong1.jpg'),
(23, 'Sân 2', 'Quận 7', 250000, '580 Lê Văn Lương, Tân Phong, Quận 7', 'Sân cỏ tự nhiên mini', 'img/sanbong2.jpg'),
(24, 'Sân 3', 'Quận 7', 300000, '580 Lê Văn Lương, Tân Phong, Quận 7', 'Sân cỏ tự nhiên mini', 'img/sanbong3.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `IdUser` int(10) NOT NULL,
  `UserName` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Email` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `Sdt` char(12) COLLATE utf8_unicode_ci NOT NULL,
  `Address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Pass` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `Role` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `Avt` char(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`IdUser`, `UserName`, `FirstName`, `LastName`, `Email`, `Sdt`, `Address`, `Pass`, `Role`, `Avt`) VALUES
(18, 'thanhtung', 'hoàng', 'tùng', 'tunghoang@gmail.com', '0329433479', 'Quận 1', '$2y$10$toLjQTsssXZSgOQH2B3TQOOlfbrgwsbANTeuO9q.ltDW16fQmHCnW', 'Customer', 'img/avt.jpg'),
(19, 'trangnguyen', 'Nguyễn Thị', 'Trang', 'trangnguyen9b2013@gmail.com', '0377542554', 'Đức Cơ', '$2y$10$a8b9bI/kpuyR3I0nwjbpDegAdiZpsRNk3itAucYM2m/4NUlIUuqpW', 'Staff', 'img/nắng cf.jpg'),
(20, 'huyentrang', 'Huyền', 'Trang', 'trang@gmail.com', '0873268673', 'Quận 7', '$2y$10$5D653F4s2o1bBYwGVEqeie93WYVg4bJ7rJJ4s/BKB6gfip5LHBEPG', 'Admin', 'img/đồi chè.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `datsan`
--
ALTER TABLE `datsan`
  ADD PRIMARY KEY (`idHoaDon`),
  ADD KEY `MaSan` (`MaSan`),
  ADD KEY `IdUser` (`IdUser`);

--
-- Chỉ mục cho bảng `san`
--
ALTER TABLE `san`
  ADD PRIMARY KEY (`MaSan`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`IdUser`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `datsan`
--
ALTER TABLE `datsan`
  MODIFY `idHoaDon` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `san`
--
ALTER TABLE `san`
  MODIFY `MaSan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `IdUser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `datsan`
--
ALTER TABLE `datsan`
  ADD CONSTRAINT `datsan_ibfk_2` FOREIGN KEY (`MaSan`) REFERENCES `san` (`MaSan`),
  ADD CONSTRAINT `datsan_ibfk_3` FOREIGN KEY (`IdUser`) REFERENCES `user` (`IdUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
