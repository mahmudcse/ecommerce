-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2017 at 06:26 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silicon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `componentId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`componentId`, `username`, `emailAddress`, `firstName`, `lastName`, `password`, `status`, `image`) VALUES
(1, 'admin', 'admin@oisd.info', 'Admin', '', '$2y$10$Hn4Ckrcw3wMHMHmfcvgGxObyft1fSbkXVS9JIoKQvvnrs4pbtrSWO', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `componentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cartproduct`
--

CREATE TABLE `cartproduct` (
  `componentId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `componentId` int(11) NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`componentId`, `catName`) VALUES
(5, 'Men'),
(11, 'Womens');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `componentId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `offerType` varchar(255) NOT NULL,
  `offer` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updateDate` datetime NOT NULL,
  `validFrom` datetime NOT NULL,
  `validTill` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `componentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--

CREATE TABLE `orderproduct` (
  `componentId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `componentId` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `userId` int(50) NOT NULL,
  `brandName` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `availableSizes` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `subCatId` int(11) NOT NULL,
  `specificCatId` int(11) NOT NULL,
  `keyFeatures` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `availableColors` varchar(255) NOT NULL,
  `mainMaterial` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `style` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `productionCountry` varchar(255) NOT NULL,
  `warranty` varchar(255) NOT NULL,
  `otherFeatures` text NOT NULL,
  `availableQuantity` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `version` int(11) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`componentId`, `sku`, `userId`, `brandName`, `model`, `availableSizes`, `price`, `catId`, `subCatId`, `specificCatId`, `keyFeatures`, `type`, `color`, `availableColors`, `mainMaterial`, `gender`, `style`, `weight`, `productionCountry`, `warranty`, `otherFeatures`, `availableQuantity`, `status`, `version`, `createdBy`, `createDate`, `updatedBy`, `updateDate`) VALUES
(18, '', 18, 'Walton', 'F1', '', 13000, 1, 1, 2, 'Ram 1 gb, Rom 8 gb', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(19, '', 17, 'We', '445', '', 13000, 1, 1, 2, 'Ram 2GB, Camera 13 mp', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(20, '', 17, 'Nokia', '3', '', 12500, 1, 1, 3, 'Ram 2 gb, Rom 16 gb', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `productimages`
--

CREATE TABLE `productimages` (
  `componentId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productimages`
--

INSERT INTO `productimages` (`componentId`, `productId`, `userId`, `image`) VALUES
(48, 18, 18, 'assets/images/product/1499253928595ccca8645a8.jpg'),
(50, 18, 18, 'assets/images/product/1499253928595ccca864982.jpg'),
(52, 19, 17, 'assets/images/product/1499254056595ccd28403a7.jpg'),
(53, 19, 17, 'assets/images/product/1499254056595ccd284067f.jpg'),
(54, 19, 17, 'assets/images/product/1499254056595ccd284088c.jpg'),
(55, 20, 17, 'assets/images/product/1499254298595cce1a3aa31.jpg'),
(56, 20, 17, 'assets/images/product/1499254298595cce1a3ac44.jpg'),
(57, 20, 17, 'assets/images/product/1499254298595cce1a3adcc.jpg'),
(58, 20, 17, 'assets/images/product/1499254298595cce1a3af55.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `productoptions`
--

CREATE TABLE `productoptions` (
  `componentId` int(11) NOT NULL,
  `productOptionName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `subCatId` int(11) NOT NULL,
  `specificCatId` int(11) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productoptions`
--

INSERT INTO `productoptions` (`componentId`, `productOptionName`, `catId`, `subCatId`, `specificCatId`, `level`) VALUES
(1, 'SKU', 0, 0, 0, -1),
(2, 'BrandName', 0, 0, 0, -1),
(3, 'Color', 1, 1, 1, 0),
(4, 'Weight', 2, 2, 2, 0),
(5, 'Water Proof', 1, 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `promocontent`
--

CREATE TABLE `promocontent` (
  `componentId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `contentType` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `validFrom` datetime NOT NULL,
  `validTill` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `componentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specificcat`
--

CREATE TABLE `specificcat` (
  `componentId` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `subcatId` int(11) NOT NULL,
  `specificCatName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `componentId` int(11) NOT NULL,
  `catId` int(11) NOT NULL,
  `subCatName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trackorder`
--

CREATE TABLE `trackorder` (
  `componentId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tracksale`
--

CREATE TABLE `tracksale` (
  `componentId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `componentId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `subscriptionType` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `signupKey` varchar(255) DEFAULT NULL,
  `presentAddress` varchar(255) NOT NULL,
  `permanentAddress` varchar(255) NOT NULL,
  `createdBy` varchar(50) NOT NULL,
  `createDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updateDate` datetime NOT NULL,
  `oauth_provider` varchar(255) NOT NULL,
  `oauth_uid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`componentId`, `firstName`, `lastName`, `subscriptionType`, `username`, `email`, `password`, `mobile`, `status`, `signupKey`, `presentAddress`, `permanentAddress`, `createdBy`, `createDate`, `updatedBy`, `updateDate`, `oauth_provider`, `oauth_uid`) VALUES
(1, 'Masum', 'Billa', '2', 'mbillah', 'ma@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123456', 1, '7b4303dafffb3a77e6f65572cf7c85e6', 'Kathalbagan', 'Dhaka', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', ''),
(3, 'Mahmudul', 'Hasan', '2', 'mhasan', 'mahmudul.ruet12@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123456', 1, '4486182b7b6e7c0e578633973976e8d0', 'Kathalbagan', 'Dhaka', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', ''),
(6, 'Moidul', 'Kader', '1', 'mkader', 'm@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '123456', 1, 'd0355fe7ecaa06ff28a572e0b075a937', 'Kathalbagan', 'Dhaka', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', ''),
(7, 'Kamal', 'Ahmed', '1', 'kahmed', 'kamal@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234544', 1, '43d94ccf8b0b8bee18626cd619675758', 'Kathalbagan, green road', 'Dhaka', '', '2017-06-17 00:00:00', '', '0000-00-00 00:00:00', '', ''),
(11, 'Robert', 'Brown', '1', 'rbrown', 'brown.php11@gmail.com', '', '+8801934249549', 1, 'cfa87f078c6c12558c8238c1c663c484', 'Motijhil', 'Gulisthan', '', '2017-06-20 09:33:40', '', '2017-07-03 12:54:42', 'facebook', '116903472245039'),
(12, '122', '222', '1', '222', '2@e.dd', 'c4ca4238a0b923820dcc509a6f75849b', 'das', 0, '39cdaac0cd69e5b97b157c68a5987fa5', '    ', '    ', '', '2017-07-03 00:00:00', '', '0000-00-00 00:00:00', '', ''),
(13, '122', '222', '1', '444', '1@e.dd', 'c4ca4238a0b923820dcc509a6f75849b', 'das', 0, 'caa89384f1d3fe6a595798dcee16e11f', '    ', '    ', '', '2017-07-03 00:00:00', '', '0000-00-00 00:00:00', '', ''),
(14, 'a', 'df', '2', 'df', 'aaaa@gmail.com', 'c81e728d9d4c2f636f067f89cc14862c', '3', 0, '5a07fa66ecbcb63d1b26f5f3d85df32f', '    ', '    ', '', '2017-07-03 00:00:00', '', '0000-00-00 00:00:00', '', ''),
(15, 'a', 'df', '2', 'er', 'aaaaa@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '3', 1, '591bbf3a0465b6934c2aacd6813d1a92', '    ', '    ', '', '2017-07-03 00:00:00', '', '0000-00-00 00:00:00', '', ''),
(16, 'a', 'a', '1', 'sdfds', 'bbba@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'fd', 1, '16e34e26d8c115172e8bd27f5d7bc53f', '    ', '    ', '', '2017-07-03 00:00:00', '', '0000-00-00 00:00:00', '', ''),
(17, 'Barek', 'Rahaman', '2', 'fasdf', 'bbb@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '12345', 1, 'eb135e62e3fc81581069a5b656df3986', '', '', '', '2017-07-03 00:00:00', '', '0000-00-00 00:00:00', '', ''),
(18, 'Rahim', 'Kabir', '1', 'rkabir', 'admin@oisd.info', '81dc9bdb52d04dc20036dbd8313ed055', '123', 1, 'cf16ea6d533db087a8c4582639e5ec60', '', '', '', '2017-07-03 00:00:00', '', '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `componentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createDate` datetime NOT NULL,
  `updatedBy` varchar(255) NOT NULL,
  `updateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `cartproduct`
--
ALTER TABLE `cartproduct`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `productimages`
--
ALTER TABLE `productimages`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `productoptions`
--
ALTER TABLE `productoptions`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `promocontent`
--
ALTER TABLE `promocontent`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `specificcat`
--
ALTER TABLE `specificcat`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `trackorder`
--
ALTER TABLE `trackorder`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `tracksale`
--
ALTER TABLE `tracksale`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`componentId`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`componentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cartproduct`
--
ALTER TABLE `cartproduct`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orderproduct`
--
ALTER TABLE `orderproduct`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `productimages`
--
ALTER TABLE `productimages`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `productoptions`
--
ALTER TABLE `productoptions`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `promocontent`
--
ALTER TABLE `promocontent`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `specificcat`
--
ALTER TABLE `specificcat`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trackorder`
--
ALTER TABLE `trackorder`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tracksale`
--
ALTER TABLE `tracksale`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `componentId` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
