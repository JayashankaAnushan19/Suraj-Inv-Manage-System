-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2022 at 07:05 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_suraj_shipping`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_buyandsell`
--

CREATE TABLE `tb_buyandsell` (
  `buyAndSell_ID` int(11) NOT NULL,
  `buyAndSell_PaidDate` datetime DEFAULT NULL,
  `buyAndSell_Ebay_OrderID` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `buyAndSell_Ali_OrderID` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `buyAndSell_TrackingID` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `buyAndSell_Carrier` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `buyAndSell_Qty` int(11) DEFAULT NULL,
  `buyAndSell_SellingUnitCostUSD` int(11) NOT NULL,
  `buyAndSell_SellingShippingCostUSD` int(11) NOT NULL,
  `buyAndSell_PaypalCharge_USD` int(11) DEFAULT NULL,
  `buyAndSell_USD_LKR_Rate` int(11) DEFAULT NULL,
  `tb_mylisting_mylisting_ID` int(11) NOT NULL,
  `buyAndSell_active` varchar(1) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tb_buyandsell`
--

INSERT INTO `tb_buyandsell` (`buyAndSell_ID`, `buyAndSell_PaidDate`, `buyAndSell_Ebay_OrderID`, `buyAndSell_Ali_OrderID`, `buyAndSell_TrackingID`, `buyAndSell_Carrier`, `buyAndSell_Qty`, `buyAndSell_SellingUnitCostUSD`, `buyAndSell_SellingShippingCostUSD`, `buyAndSell_PaypalCharge_USD`, `buyAndSell_USD_LKR_Rate`, `tb_mylisting_mylisting_ID`, `buyAndSell_active`) VALUES
(1, '2022-03-02 00:00:00', '12', '12', '23', '12', 23, 0, 0, 12, 21, 1, '1'),
(2, '2021-01-01 00:00:00', '1', '1', '1', '1', 1, 1, 1, 1, 1, 2, '1'),
(3, '2022-08-18 00:00:00', '1', '1', '1', '1', 1, 123, 434, 1, 1, 2, '1'),
(4, '2022-02-08 00:00:00', '1', '1', '1', '1', 1, 0, 0, 1, 1, 2, '1'),
(5, '2022-08-19 00:00:00', '1', '1', '1', '1', 2, 123, 434, 1, 1, 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `login_ID` int(11) NOT NULL,
  `login_UserName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `login_Password` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `login_level` varchar(2) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`login_ID`, `login_UserName`, `login_Password`, `login_level`) VALUES
(1, 'admin', 'admin1234', '0'),
(2, 'admin', 'admin1234', '0'),
(3, 'jayashanka', 'j1234', '0'),
(4, 'creater', 'creater1234', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mylisting`
--

CREATE TABLE `tb_mylisting` (
  `mylisting_ID` int(11) NOT NULL,
  `mylisting_Name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `mylisting_Status` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `mylisting_URL` varchar(2048) COLLATE utf8_bin DEFAULT NULL,
  `mylisting_List_Qty` int(11) DEFAULT NULL,
  `mylisting_UnitPrice_USD` int(11) DEFAULT NULL,
  `mylisting_ShippingCost_USD` int(11) DEFAULT NULL,
  `mylisting_active` varchar(1) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tb_mylisting`
--

INSERT INTO `tb_mylisting` (`mylisting_ID`, `mylisting_Name`, `mylisting_Status`, `mylisting_URL`, `mylisting_List_Qty`, `mylisting_UnitPrice_USD`, `mylisting_ShippingCost_USD`, `mylisting_active`) VALUES
(1, 'Jayashanka Anushan', '0', 'https://www.tinkercad.com/dashboard?type=circuits&collection=designs', 23, 4234, 34234, '1'),
(2, 'Shan Akila Jayashanka', '1', 'qwqwewrwererqewrqwqwewrwererqewrqwqwewrwererqewrqwqwewrwererqewrqwqwewrwererqewr', 23, 123, 434, '1'),
(3, 'Updated Akila Details Jayashanka', '0', 'Updated Details', 111, 11, 25, '1'),
(4, 'Anushan Details Shampoo Akila', '0', 'qwqwewrwererqewrqwqwewrwererqewrqwqwewrwererqewrqwqwewrwererqewrqwqwewrwererqewr', 34, 43, 34, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_buyandsell`
--
ALTER TABLE `tb_buyandsell`
  ADD PRIMARY KEY (`buyAndSell_ID`,`tb_mylisting_mylisting_ID`),
  ADD KEY `fk_tb_buyAndSell_tb_mylisting_idx` (`tb_mylisting_mylisting_ID`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`login_ID`);

--
-- Indexes for table `tb_mylisting`
--
ALTER TABLE `tb_mylisting`
  ADD PRIMARY KEY (`mylisting_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_buyandsell`
--
ALTER TABLE `tb_buyandsell`
  MODIFY `buyAndSell_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `login_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_mylisting`
--
ALTER TABLE `tb_mylisting`
  MODIFY `mylisting_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_buyandsell`
--
ALTER TABLE `tb_buyandsell`
  ADD CONSTRAINT `fk_tb_buyAndSell_tb_mylisting` FOREIGN KEY (`tb_mylisting_mylisting_ID`) REFERENCES `tb_mylisting` (`mylisting_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
