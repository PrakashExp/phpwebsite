-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2016 at 05:19 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbflowershop`
--
CREATE DATABASE IF NOT EXISTS `dbflowershop` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `dbflowershop`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts` (
  `UserID` varchar(8) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ID người dùng',
  `Username` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên tài khoản',
  `Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Thông tin tài khoản người dùng';

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
CREATE TABLE `bills` (
  `BillID` varchar(8) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ID hóa đơn',
  `Time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Ngày lập hóa đơn',
  `CustomerID` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ID khách hàng',
  `EmployeeID` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ID nhân viên',
  `Address` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ giao hàng',
  `BillValue` int(11) NOT NULL COMMENT 'Giá trị hóa đơn',
  `Status` int(11) NOT NULL DEFAULT '1' COMMENT 'Trạng thái hóa đơn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Hóa đơn bán hàng';

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL COMMENT 'ID nhóm sản phẩm',
  `Time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian thêm nhóm sản phẩm',
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên nhóm sản phẩm',
  `Priority` tinyint(4) NOT NULL COMMENT 'Thứ tự ưu tiên các nhóm',
  `Hide` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Nhóm sản phẩm ẩn',
  `Active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Trạng thái hoạt động',
  `Keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Từ khóa cho nhóm sản phẩm',
  `LastTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian cập nhật gần nhất'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Nhóm sản phẩm';

-- --------------------------------------------------------

--
-- Table structure for table `detailofbill`
--

DROP TABLE IF EXISTS `detailofbill`;
CREATE TABLE `detailofbill` (
  `BillID` varchar(8) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ID hóa đơn',
  `ProductID` varchar(8) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ID sản phẩm',
  `Quantity` int(11) NOT NULL COMMENT 'Số lượng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Chi tiết hóa đơn';

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `GroupID` tinyint(4) NOT NULL COMMENT 'ID nhóm người dùng',
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên nhóm người dùng',
  `Active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Trạng thái hoạt động',
  `LastTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian cập nhật gần nhất'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Nhóm người dùng';

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `ProductID` varchar(8) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ID sản phẩm',
  `Time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian thêm',
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên sản phẩm',
  `CategoryID` int(11) NOT NULL COMMENT 'Nhóm sản phẩm',
  `Unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Đơn vị tính',
  `Price` int(11) NOT NULL COMMENT 'Giá sản phẩm',
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mô tả',
  `Color` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Màu sắc',
  `Quantity` int(11) NOT NULL COMMENT 'Số lượng',
  `LinkImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ hình ảnh',
  `Hide` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Ẩn sản phẩm',
  `Active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Trạng thái hoạt động',
  `Keyword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Từ khóa cho sản phẩm',
  `Home` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Hiển thị trên trang chủ',
  `UpdatedBy` varchar(8) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Người cập nhật lần cuối',
  `LastTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian cập nhật gần nhất'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Sản phẩm';

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

DROP TABLE IF EXISTS `slideshow`;
CREATE TABLE `slideshow` (
  `SlideShowID` int(11) NOT NULL COMMENT 'ID slideshow',
  `Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tiêu đề',
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mô tả',
  `LinkImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Hình ảnh',
  `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Liên kết',
  `Priority` int(11) NOT NULL COMMENT 'Thứ tự',
  `Hide` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Ẩn',
  `Active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Trạng thái hoạt động'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='SlideShow';

-- --------------------------------------------------------

--
-- Table structure for table `statusbills`
--

DROP TABLE IF EXISTS `statusbills`;
CREATE TABLE `statusbills` (
  `StatusID` int(11) NOT NULL COMMENT 'ID trạng thái',
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên trạng thái'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Các trạng thái của hóa đơn';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `UserID` varchar(8) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ID người dùng',
  `Time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian đăng ký',
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên người dùng',
  `Sex` tinyint(1) NOT NULL COMMENT 'Giới tính',
  `Birthday` date NOT NULL COMMENT 'Ngày sinh',
  `IDCard` varchar(9) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Số CMND / Hộ chiếu',
  `Address` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ hiện tại',
  `TelNumber` varchar(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Số điện thoại',
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Địa chỉ email',
  `Active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Trạng thái hoạt động',
  `GroupID` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Nhóm người dùng',
  `Revenue` bigint(20) NOT NULL DEFAULT '0' COMMENT 'Doanh thu',
  `LastTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Thời gian cập nhật gần nhất'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `FK_ACCOUNTS_USERS_UserID` (`UserID`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`BillID`),
  ADD KEY `FK_BILLS_USERS_CustomerID` (`CustomerID`),
  ADD KEY `FK_BILLS_USERS_EmployeeID` (`EmployeeID`),
  ADD KEY `FK_BILLS_STATUSBILLS_StatusID` (`Status`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`),
  ADD UNIQUE KEY `Priority` (`Priority`);

--
-- Indexes for table `detailofbill`
--
ALTER TABLE `detailofbill`
  ADD PRIMARY KEY (`BillID`,`ProductID`),
  ADD KEY `FK_DETAILOFBILL_BILLS_BillID` (`BillID`),
  ADD KEY `FK_DETAILOFBILL_BILLS_ProductID` (`ProductID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`GroupID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `FK_PRODUCTS_CAREGORIES_CategoryID` (`CategoryID`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`SlideShowID`),
  ADD UNIQUE KEY `Priority` (`Priority`);

--
-- Indexes for table `statusbills`
--
ALTER TABLE `statusbills`
  ADD PRIMARY KEY (`StatusID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `IDCard` (`IDCard`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `FK_USERS_GROUPS_GroupID` (`GroupID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID nhóm sản phẩm', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `SlideShowID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID slideshow', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `statusbills`
--
ALTER TABLE `statusbills`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID trạng thái', AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `FK_ACCOUNTS_USERS_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `FK_BILLS_STATUSBILLS_StatusID` FOREIGN KEY (`Status`) REFERENCES `statusbills` (`StatusID`),
  ADD CONSTRAINT `FK_BILLS_USERS_CustomerID` FOREIGN KEY (`CustomerID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `FK_BILLS_USERS_EmployeeID` FOREIGN KEY (`EmployeeID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `detailofbill`
--
ALTER TABLE `detailofbill`
  ADD CONSTRAINT `FK_DETAILOFBILL_BILLS_BillID` FOREIGN KEY (`BillID`) REFERENCES `bills` (`BillID`),
  ADD CONSTRAINT `FK_DETAILOFBILL_BILLS_ProductID` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_PRODUCTS_CAREGORIES_CategoryID` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_USERS_GROUPS_GroupID` FOREIGN KEY (`GroupID`) REFERENCES `groups` (`GroupID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
