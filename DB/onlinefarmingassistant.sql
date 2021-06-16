-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jun 07, 2021 at 09:14 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinefarmingassistant`
--
CREATE DATABASE IF NOT EXISTS `onlinefarmingassistant` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `onlinefarmingassistant`;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `no` int(11) NOT NULL,
  `buyers_id` int(11) DEFAULT NULL,
  `sellers_id` int(11) DEFAULT NULL,
  `buyers_name` text DEFAULT NULL,
  `sellers_name` text DEFAULT NULL,
  `message_from` text DEFAULT NULL,
  `message_to` text DEFAULT NULL,
  `messageRead` varchar(7) DEFAULT 'unseen',
  `message` varchar(7) DEFAULT 'unseen',
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`no`, `buyers_id`, `sellers_id`, `buyers_name`, `sellers_name`, `message_from`, `message_to`, `messageRead`, `message`, `date`, `time`) VALUES
(142, 15, 27, 'Kashfia Arfa                                                    \n                                                ', 'Obayed Ullah', NULL, 'hi.. apnar koto kg broiler lagbe?', 'seen', 'seen', '2021-06-02', '10:36:17'),
(143, 15, 27, 'Kashfia Arfa', 'Obayed Ullah                                                    \n                                                ', 'i need 20 kg', NULL, 'seen', 'unseen', '2021-06-02', '10:37:48'),
(144, 32, 16, 'Hasan Mahmud', 'Chashi Sultan                                                    \n                                                ', 'hi', NULL, 'seen', 'seen', '2021-06-08', '01:03:12'),
(145, 32, 16, 'Hasan Mahmud', 'Chashi Sultan                                                    \n                                                ', 'hi', NULL, 'seen', 'seen', '2021-06-08', '01:05:07'),
(146, 32, 16, 'Hasan Mahmud                                                    \n                                                ', 'Chashi Sultan', NULL, 'hi', 'unseen', 'seen', '2021-06-08', '01:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `no` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `notice` text DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`no`, `title`, `name`, `notice`, `date`) VALUES
(18, 'গরু মোটাতাজাকরণ প্রযুক্তি', 'Saqline Mustaq', 'বাংলাদেশে গরুর মাংস খুব জনপ্রিয় এবং চাহিদাও প্রচুর। তাছাড়া মুসলমাদের ধমীয় উৎসব কুরবানীর সময় অনেক গরু জবাই করা হয়। সূতরাং “ গরু মোটাতাজাকরন” পদ্ধতি বাংলাদেশের জন্য খুব গুরুত্বপূর্ন এবং একটি লাভজনক ব্যবসা।\r\n\r\nগরু মোটাতাজাকরন প্রক্রিয়ায় ধারাবহিকভাবে যে সকল বিষয়গুলো সম্পন্ন করতে হব তা নিম্নরুপ।\r\n\r\n০১. পশু নির্বাচন,\r\n০২. কৃমিমুক্তকরন ও টিকা প্রদান ,\r\n০৩. পুষ্টি ও খাদ্য ব্যবস্থাপনা এবং\r\n০৪. বাজারজাতকরন।', '2021-06-03 01:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `no` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `title` text DEFAULT NULL,
  `post` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `position` text DEFAULT NULL,
  `commentNo` int(11) DEFAULT NULL,
  `approved` text NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`no`, `user_id`, `name`, `date`, `time`, `title`, `post`, `image`, `position`, `commentNo`, `approved`) VALUES
(123, 16, 'Chashi Sultan', '2021-06-01', '13:00:52', 'মোটা চালের (সিদ্ধ)', 'মোটা চালের (সিদ্ধ) পাইকারী মূল্য প্রতি কেজি ৪১.০০-৪২.০০ টাকা \r\n \r\nমোটা চালের (সিদ্ধ) খুচরা মূল্য প্রতি কেজি       ৪৫.০০-৪৬.০০ টাকা', '../../assets/img/5424Going-against-the-grain-Declining-political-and-price-interference-provides-rice-sourcing-boost-to-Asia-food-firms.jpg', 'Sellers', NULL, 'yes'),
(124, 27, 'Obayed Ullah', '2021-06-01', '13:22:16', 'ব্রয়লার মুরগী', '@ ব্রয়লার মুরগী\r\n\r\n৳ ১২০/- কেজি (মাঝারী)\r\n৳ ১৩০/- কেজি (বড় সাইজ)\r\n\r\nপাইকারী ও খুচরা বিক্রয় করা হয় ।', '../../assets/img/9215131245_17.jpg', 'Sellers', NULL, 'yes'),
(125, 28, 'Md. Tayub', '2021-06-01', '13:49:24', 'ঘরের গাছের আম ', '@ঘরের গাছের আম  (১০০% ফরমালিন মুক্ত)\r\nদেশের যেকোন স্থানে কুরিয়ার করা হয় ।\r\nবিস্তারিত জানতে: 01822518997', '../../assets/img/3776Mango-business.jpg', 'Sellers', NULL, 'no'),
(127, 27, 'Obayed Ullah', '2021-06-01', '14:20:54', 'ফাউমি মুরগির ', 'ফাউমি মুরগির একদিন বয়সী বাচ্চার অর্ডার নেয়া হয় ।\r\nপ্রতি পিচ ৩০/- টাকা (হ্যাচারী রেট)\r\nCall: 01819066770', '../../assets/img/5180IMG_3475.jpg', 'Sellers', NULL, 'yes'),
(128, 15, 'Kashfia Arfa', '2021-06-01', '15:22:37', NULL, 'Wow! MashaAllah... I\'m interested to get this mangoes!', NULL, NULL, 125, 'yes'),
(129, 15, 'Kashfia Arfa', '2021-06-01', '17:42:19', ' fresh Lychee', '#seeking_post\r\nI need fresh Lychee! Does anyone provide in Dhaka?\r\nplease let me know through comment box.\r\ni\'ll confirm', '../../assets/img/5398shutterstock-663826174.jpg', 'Buyers', NULL, 'no'),
(130, 16, 'Chashi Sultan', '2021-06-01', '17:45:59', NULL, 'Ami dite parbo! kotogula lagbe apnar?', NULL, NULL, 129, 'yes'),
(131, 15, 'Kashfia Arfa', '2021-06-02', '10:32:36', NULL, 'Minimum 500 pcs ', NULL, NULL, 129, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `product_confirm`
--

CREATE TABLE `product_confirm` (
  `no` int(11) NOT NULL,
  `user_id_From` int(11) DEFAULT NULL,
  `user_id_To` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `pnumber` text DEFAULT NULL,
  `item` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `status` text NOT NULL DEFAULT '0',
  `product` text DEFAULT NULL,
  `units` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_confirm`
--

INSERT INTO `product_confirm` (`no`, `user_id_From`, `user_id_To`, `name`, `pnumber`, `item`, `address`, `date`, `time`, `status`, `product`, `units`, `rating`) VALUES
(19, 15, 28, 'Kashfia', '01855504570', '10', 'Uttara, Dhaka', '2021-06-01', '17:35:57', '0', '125', 'pieces', NULL),
(20, 15, 27, 'Kashfia', '01855504570', '20', 'Uttara', '2021-06-02', '10:33:34', '1', '124', 'pieces', NULL),
(21, 15, 16, 'ARFA', '01865232773', '2', 'Chittagong', '2021-06-02', '21:09:36', '1', '123', 'pieces', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `no` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `pnumber` text DEFAULT NULL,
  `position` text DEFAULT NULL,
  `cname` text DEFAULT NULL,
  `pass` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `emailtoken` varchar(6) NOT NULL DEFAULT 'no',
  `recover` text DEFAULT NULL,
  `checkActive` text NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`no`, `name`, `email`, `pnumber`, `position`, `cname`, `pass`, `address`, `image`, `emailtoken`, `recover`, `checkActive`) VALUES
(13, 'Minhajul Arefin', 'minhajularefin98@gmail.com', '01865232773', 'Admin', NULL, '4fd4fb92d494be0609c4d8a1dad9c6ae', 'Hathazari', '../../assets/img/761Photo-a338b736-13c0-4faa-bf72-78fd878943e5.jpg', 'yes', '518902', 'yes'),
(15, 'Kashfia Arfa', 'arfa@gmail.com', '01850751716', 'Buyers', 'BGI', '4fd4fb92d494be0609c4d8a1dad9c6ae', 'Rongpur', '../../assets/img/261416-4160158_profile-hero-girl-hd-png-download.png', 'yes', '382454', 'yes'),
(16, 'Chashi Sultan', 'ha@mail.com', '01850751714', 'Sellers', 'BGI', '4fd4fb92d494be0609c4d8a1dad9c6ae', 'Fatikchari', '../../assets/img/709S. Chashi Alam.jpg', 'yes', NULL, 'yes'),
(22, 'Jubair Hossain', 'Jubair@mail.net', '01850751714', 'Buyers', 'KDS', '4fd4fb92d494be0609c4d8a1dad9c6ae', 'Raozan', '../../assets/img/733M=011.jpg', 'yes', NULL, 'yes'),
(24, 'Saqline Mustaq', 'Saqline@gmail.com', '01850751714', 'Admin', NULL, '4fd4fb92d494be0609c4d8a1dad9c6ae', 'Muradpur, CTG', NULL, 'yes', '776780', 'no'),
(26, 'Hossain Ahmed', 'h.Ahmed@mail.com', '01589632147', 'Buyers', 'Gents Hunt', '4fd4fb92d494be0609c4d8a1dad9c6ae', 'LalKhan Bazar, CTG', '../../assets/img/363M=008.png', 'yes', NULL, 'yes'),
(27, 'Obayed Ullah', 'sahara@gmail.com', '01819066770', 'Sellers', 'Sahara Agrovet', '4fd4fb92d494be0609c4d8a1dad9c6ae', 'Tangail, Dhaka', '../../assets/img/309S. Obayed Ullah.jpg', 'yes', NULL, 'yes'),
(28, 'Md. Tayub', 'oravana4u@gmail.com', '01865222777', 'Sellers', 'Oravana LTD', '4fd4fb92d494be0609c4d8a1dad9c6ae', 'Charia, Hathazari', '../../assets/img/820wharton-1805-0035541-1.jpg', 'yes', '534025', 'yes'),
(29, 'Jubair Ahmed', 'jubaiahmed@revutap.com', '01850751714', 'Sellers', NULL, '4fd4fb92d494be0609c4d8a1dad9c6ae', 'Chittagong', NULL, 'yes', NULL, 'no'),
(32, 'Hasan Mahmud', 'h.Tipu.Mahmud@gmail.com', '01850751714', 'Expert', NULL, '4fd4fb92d494be0609c4d8a1dad9c6ae', 'Muradpur', NULL, 'yes', NULL, 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `product_confirm`
--
ALTER TABLE `product_confirm`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `product_confirm`
--
ALTER TABLE `product_confirm`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
