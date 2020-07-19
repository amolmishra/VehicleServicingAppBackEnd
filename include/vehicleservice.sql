-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 19, 2020 at 09:42 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicleservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(69) NOT NULL,
  `registered_car_id` varchar(69) NOT NULL,
  `date` text NOT NULL,
  `time` text NOT NULL,
  `centerid` int(69) NOT NULL,
  `pickup` varchar(10) NOT NULL,
  `charges` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `username`, `registered_car_id`, `date`, `time`, `centerid`, `pickup`, `charges`) VALUES
(39, '9876543210', 'Manisa1234', '19-7-2020', '14:33', 9, 'Y', 0),
(38, '7770920002', 'MH14FL4820', '22-7-2020', '5:10', 10, 'Y', 0),
(37, '7770920002', 'MH14FL4828', '22-7-2020', '5:10', 11, 'Y', 0),
(36, '7770920002', 'MH14FL4828', '21-7-2020', '5:10', 8, 'Y', 0),
(35, '7770920002', 'MH14FL4828', '20-7-2020', '5:10', 9, 'Y', 0),
(34, '7770920002', 'MH14FL4828', '19-7-2020', '5:10', 7, 'Y', 0);

-- --------------------------------------------------------

--
-- Table structure for table `registered_cars`
--

DROP TABLE IF EXISTS `registered_cars`;
CREATE TABLE IF NOT EXISTS `registered_cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(69) NOT NULL,
  `model` varchar(69) NOT NULL,
  `regno` varchar(69) NOT NULL,
  `username` varchar(69) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registered_cars`
--

INSERT INTO `registered_cars` (`id`, `name`, `model`, `regno`, `username`) VALUES
(7, 'Chevrolet', 'Tavera', 'Manisa1234', '9876543210'),
(6, 'Chevrolet', 'Tavera', 'MH14FL4820', '7770920002'),
(5, 'Chevrolet', 'Beat', 'MH14FL4828', '7770920002');

-- --------------------------------------------------------

--
-- Table structure for table `service_centers`
--

DROP TABLE IF EXISTS `service_centers`;
CREATE TABLE IF NOT EXISTS `service_centers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(69) NOT NULL,
  `address` varchar(69) NOT NULL,
  `phone` varchar(69) NOT NULL,
  `company` varchar(69) NOT NULL,
  `email` varchar(69) NOT NULL,
  `lat` varchar(69) NOT NULL,
  `lon` varchar(69) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_centers`
--

INSERT INTO `service_centers` (`id`, `name`, `address`, `phone`, `company`, `email`, `lat`, `lon`) VALUES
(10, 'London Service Center', '221 B, Backer St, London', '1246557276', 'Chevrolet', 'bakerstcenter@gmail.com', '51.520476666666674', '-0.15674000000000002'),
(9, 'Vidisha Service Center', 'Vidisha, MP', '9876543210', 'Chevrolet', 'servicevidisha@gmail.com', '23.523571666666665', '77.81397166666667'),
(8, 'Mishra Service Center', 'Hinjewadi, Pune', '9425958028', 'Chevrolet', 'manisa.das1408@gmail.com', '18.59127', '73.73890833333333'),
(7, 'Das Service Center', 'Nipaniya, Indore', '9425958028', 'Chevrolet', 'manisa.das1408@gmail.com', '22.761736666666668', '75.92731833333333'),
(11, 'Kerala Service Center', 'Kazzakuttham, Kerala', '8989898989', 'Chevrolet', 'indoreservice@gmail.com', '10.010565000000001', '76.36317833333332');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(69) NOT NULL,
  `username` varchar(69) NOT NULL,
  `email` varchar(69) NOT NULL,
  `password` varchar(69) NOT NULL,
  `lat` varchar(69) NOT NULL,
  `lon` varchar(69) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `lat`, `lon`) VALUES
(5, 'Manisa', '9876543210', 'manisa.das1408@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '20.462519999999998', '85.88298833333334'),
(4, 'Amol', '7770920002', 'amolmaheshmishra@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '22.759534999999996', '75.91874166666666');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
