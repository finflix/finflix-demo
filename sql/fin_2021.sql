-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2022 at 09:57 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fin_2021`
--

-- --------------------------------------------------------

--
-- Table structure for table `favourite_videos`
--

CREATE TABLE `favourite_videos` (
  `favourite_video_id` int(20) NOT NULL,
  `favourite_video_uuid` varchar(200) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `video_info_id` varchar(200) NOT NULL,
  `from_ip` varchar(200) NOT NULL,
  `from_browser` varchar(200) NOT NULL,
  `from_time` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favourite_videos`
--

INSERT INTO `favourite_videos` (`favourite_video_id`, `favourite_video_uuid`, `user_id`, `video_info_id`, `from_ip`, `from_browser`, `from_time`) VALUES
(7, '3b575b27-b155-4dcd-a20f-8f792add1834', '', '52ff0b28-0baa-4c32-9217-0752c5960b20', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', 'Wed, 29 Jun 2022 20:03:53 +0530');

-- --------------------------------------------------------

--
-- Table structure for table `metamask_login`
--

CREATE TABLE `metamask_login` (
  `ID` int(11) NOT NULL,
  `address` varchar(42) NOT NULL,
  `publicName` tinytext DEFAULT NULL,
  `nonce` tinytext DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_time_login` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metamask_login`
--

INSERT INTO `metamask_login` (`ID`, `address`, `publicName`, `nonce`, `created`, `first_time_login`) VALUES
(31, '0xed9b1756dbf760a79547677f598bf001dad50fd1', NULL, '62bd41d706e17', '2022-06-29 10:18:54', '');

-- --------------------------------------------------------

--
-- Table structure for table `video_info`
--

CREATE TABLE `video_info` (
  `video_id` int(20) NOT NULL,
  `video_uuid` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `video_desc` varchar(200) NOT NULL,
  `thumbnail_ipfs` varchar(200) NOT NULL,
  `video_uid` varchar(200) NOT NULL,
  `module` varchar(200) NOT NULL,
  `from_time` varchar(200) NOT NULL,
  `from_browser` varchar(200) NOT NULL,
  `from_ip` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video_info`
--

INSERT INTO `video_info` (`video_id`, `video_uuid`, `name`, `video_desc`, `thumbnail_ipfs`, `video_uid`, `module`, `from_time`, `from_browser`, `from_ip`) VALUES
(22, 'fddb9130-e382-4058-a885-af9ceab9f2c0', 'What is JASMY: Japan’s First Approved Crypto', 'Jasmy is an organization that develops Internet of Things (IoT) platforms and decentralized data lockers.', 'bafybeibw637dcctdmzb6dnk5y3dvj4yoiisznhspngp367ztvd4p6q2mau', 'aa085fd1-4198-4e05-bece-bd0028a7c647', 'Cryptonite', 'Sat, 25 Jun 2022 01:03:29pm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1'),
(23, '47f5e19b-2d4a-42d5-baa9-576401469d95', '5 Crypto Research Tools जो बनाएंगे आपकी Trading Smart', 'Trading से पहले हमेशा Research Important होती है, अगर आप भी Crypto मे कर रहे है Investments तो यह ', 'bafybeih3nylvwemdkfaqas57xukp3cqpg3zqweabt2pnoxwqbecmztjxtu', '5e807d18-7b09-4c24-abb7-ef668ff8857a', 'Cryptonext', 'Sat, 25 Jun 2022 01:05:54pm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1'),
(24, '52ff0b28-0baa-4c32-9217-0752c5960b20', 'Big News: Football Star Cristiano Ronaldo and Binance inks NFT Partnership', 'Crypto exchange Binance partners with Cristiano Ronaldo for NFT push', 'bafybeie3luadbjpf3ybtxtzx2j5mv2nr4urr4o2r4p4svbt2ityxjulhny', '31640887-7147-4336-99e6-124e86a9c27d', 'Cryptonite', 'Sat, 25 Jun 2022 01:09:01pm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1'),
(25, 'ac6cf51c-9ac8-4bd0-a6c8-3c1c01d0bb07', 'How Can You Make Passive Income Lending Cryptocurrency', 'Nexo, you can earn industry-leading interest on your crypto, borrow against your digital assets, or exchange between hundreds of market pairs', 'bafybeien3liccddalw6sy6dftsl2eneq5efijyexwcfx566ywtlkwaqmeq', '065b3a95-2a61-4300-a353-32eefbbb7d94', 'Cryptonext', 'Sat, 25 Jun 2022 01:40:47pm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1'),
(26, '7b9cb175-ae27-477c-b055-2d918bf7d45d', 'WazirX Token', 'WRX is WazirX’s native utility token. \r\nIt is programmed to serve as the backbone \r\nof the entire WazirX ecosystem', 'bafybeicqijlfnofihgtefl26akuabfsnyc7robm5nuqwfga4a7gnya3dpe', '5b3907f2-e114-46b3-aba1-c077dcd447cd', 'Cryptonext', 'Sat, 25 Jun 2022 01:44:28pm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1'),
(27, '9f43d4cc-62e6-46d1-ac2c-90b20b962609', '#cryptonewstoday : क्या #ShibaInu करेगा 80% पार', 'आज की  #cryptonews में जानिये की...', 'bafybeif6quqizfnr4pd5mlzkwzshbiequmjz2m6hohon3ttlgesnurjvmi', '08ae1204-7588-420d-ada7-1ffcbdf75a7f', 'Cryptonite', 'Sat, 25 Jun 2022 01:49:13pm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1'),
(29, 'bed1667b-4d80-4083-b028-f4a0934608f9', 'Vechain: What is VeChain? Real-World Applications To The Economy, Project Analysis', 'The VeChain network and its native VET coin have very unique and interesting plans to provide their services to businesses. Can they revolutionize the supply chain industry?', 'bafybeibdlsizaf3ue4fgxti6255nvmsicobwhkccjuk3zynrtkyn4bxnui', '529add58-5f14-4cf4-a843-6199441cf86c', 'Cryptonite', 'Mon, 27 Jun 2022 01:28:11pm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.0.0 Safari/537.36', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourite_videos`
--
ALTER TABLE `favourite_videos`
  ADD PRIMARY KEY (`favourite_video_id`);

--
-- Indexes for table `metamask_login`
--
ALTER TABLE `metamask_login`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `address` (`address`);

--
-- Indexes for table `video_info`
--
ALTER TABLE `video_info`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourite_videos`
--
ALTER TABLE `favourite_videos`
  MODIFY `favourite_video_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `metamask_login`
--
ALTER TABLE `metamask_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `video_info`
--
ALTER TABLE `video_info`
  MODIFY `video_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
