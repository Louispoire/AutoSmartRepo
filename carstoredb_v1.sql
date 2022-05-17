-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: May 10, 2021 at 12:52 AM
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
-- Database: `carstoredb_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_inventory`
--

DROP TABLE IF EXISTS `car_inventory`;
CREATE TABLE IF NOT EXISTS `car_inventory` (
  `item` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size_id` int(11) NOT NULL,
  `car_stock` int(11) NOT NULL,
  PRIMARY KEY (`id`,`size_id`),
  KEY `fk_car_inventory_car_store_idx` (`id`),
  KEY `fk_car_inventory_store_car_size1_idx` (`size_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `car_inventory`
--

INSERT INTO `car_inventory` (`item`, `id`, `size_id`, `car_stock`) VALUES
('Dodge Demon', 1, 1, 3),
('Fiat 500 Abarth', 2, 5, 5),
('Mercedes E-Class', 3, 2, 7),
('BMW Series 5', 4, 2, 2),
('Nissan Juke', 5, 3, 14),
('PT Loser', 6, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `car_store`
--

DROP TABLE IF EXISTS `car_store`;
CREATE TABLE IF NOT EXISTS `car_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `car_title` varchar(75) DEFAULT NULL,
  `car_price` float DEFAULT NULL,
  `car_desc` varchar(250) DEFAULT NULL,
  `car_image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `car_store`
--

INSERT INTO `car_store` (`id`, `cat_id`, `car_title`, `car_price`, `car_desc`, `car_image`) VALUES
(1, 1, 'Dodge Demon', 100000, 'The heart of this demonic Challenger is its 808-hp supercharged 6.2-liter Hemi V-8', 'demon.jpeg'),
(2, 1, 'Fiat 500 Abarth', 35000, '160-hp turbocharged four-cylinder Italian car with a great handling, speed and fabulous design', 'fiat500abarth.jpg'),
(3, 3, 'Mercedes E-Class', 56000, 'The 2021 Mercedes-Benz E-class epitomizes sophistication with its bleeding technology, classy appearance, and extravagant cabin', 'eclass.jpeg'),
(4, 3, 'BMW Series 5', 65800, 'If quiet luxury and handsome styling are high on your new-car priorities list, the 2021 BMW 5-series sedan could very well be the answer', 'bmw5.jpeg'),
(5, 2, 'Nissan Juke', 26800, 'Ugly, but reliable. Will go from point A to point B', 'juke.jpeg'),
(6, 2, 'PT Loser', 6780, 'Yoyoyo', 'ptcruiser.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`) VALUES
(1, 'Sports Car', 'Great sports car for the braves!'),
(2, 'SUV', 'To go above and beyond!'),
(3, 'Sedans', 'For the enthusiast who wants more!');

-- --------------------------------------------------------

--
-- Table structure for table `store_car_size`
--

DROP TABLE IF EXISTS `store_car_size`;
CREATE TABLE IF NOT EXISTS `store_car_size` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_size` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`size_id`),
  UNIQUE KEY `size_id_UNIQUE` (`size_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `store_car_size`
--

INSERT INTO `store_car_size` (`size_id`, `car_size`) VALUES
(1, 'Muscle'),
(2, 'Midsize Sedan'),
(3, 'Midsize SUV'),
(4, 'Vividly Horrendous SUV'),
(5, 'Sports Car');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(125) DEFAULT NULL,
  `lastname` varchar(125) DEFAULT NULL,
  `username` varchar(125) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(125) DEFAULT NULL,
  `user_rank` varchar(125) DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `email`, `user_rank`) VALUES
(10, 'TestAccount', 'Tremblay', 'T_Account123', 'c06db68e819be6ec3d26c6038d8e8d1f', 't_account@xyz.com', 'user'),
(8, 'Brian', 'Smith', 'bsmith345', 'bb3b28c895dce2e40ecc92dc2c6779a9', 'briansmith@outlook.com', 'user'),
(9, 'Benoit', 'Thiviege', 'BLT74', '10ff747875fc8abdc3aae3d594808cee', 'benoitthiviege', 'user'),
(7, 'Pierre', 'Laberge', 'PierreLeRocher', '2fb6b0aaf6f2f0a0175e23946399fbc6', 'pierrelaberge@gmail.com', 'admin'),
(11, 'Michel', 'ForeverTonight', 'michel_FT', '1ea00ae084f92e9913ee42e61525f4ef', 'michealft@forevertonight.com', 'user'),
(12, 'Marcus', 'Severus', 'mseverus', '1aaf637e9550ec0544d43bb6949ea46f', 'marcusseverus@gmail.com', 'user'),
(13, 'alex', 'alex', 'alexalex', '0bf4375c81978b29d0f546a1e9cd6412', 'alex@alex.com', 'user'),
(14, 'james', 'john', 'jamesJ', '0875bdd6907a5b0cebb6170c84fe8b14', 'jamesjohn@johnny.com', 'user'),
(15, 'alicia', 'Smith', 'aliciaSmith', '25d55ad283aa400af464c76d713c07ad', 'aliciasmith@outlook.com', 'user'),
(16, 'patricia', 'test', 'test123', '05a671c66aefea124cc08b76ea6d30bb', 'patriciatest@test.test', 'user'),
(17, 'vincent', 'vincent', 'vvincent', '1a1e37b9d883641cc6fd04cc7286e421', 'vincent@vincent.vincent', 'admin'),
(18, 'Conan', 'OBrien', 'conan34', '2edcccef9a7c7e97fd85da66c46af132', 'conanobrien@show.com', 'user'),
(19, 'Jean-Marc', 'Marc', 'JeanMarcSmith', '25d55ad283aa400af464c76d713c07ad', 'jeanmarcsmith@outlook.com', 'user'),
(22, 'Louis-Philippe', 'Simard', 'lpsimard', 'bd9c4fb8edbdc5d0950ea6125fe87c8d', 'l.psimard901@gmail.com', 'user'),
(23, 'test', 'test', 'test the test', '098f6bcd4621d373cade4e832627b4f6', 'test@test.test', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
