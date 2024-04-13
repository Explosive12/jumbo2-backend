-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 13, 2024 at 09:52 PM
-- Server version: 11.2.3-MariaDB-1:11.2.3+maria~ubu2204
-- PHP Version: 8.2.15



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

CREATE DATABASE IF NOT EXISTS jumbo2;
USE jumbo2;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'bread'),
(3, 'vegetables'),
(5, 'Organic Products'),
(6, 'Beverages'),
(7, 'Snacks');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `userid`, `order_date`, `total`, `status`) VALUES
(1, 8, '2024-04-13 19:41:33', 0.00, 2),
(2, 8, '2024-04-13 19:41:44', 0.00, 2),
(3, 8, '2024-04-13 19:43:25', 0.00, 2),
(4, 8, '2024-04-13 19:43:40', 0.00, 2),
(5, 8, '2024-04-13 19:44:37', 0.00, 2),
(6, 8, '2024-04-13 19:47:03', 0.00, 2),
(7, 8, '2024-04-13 19:47:37', 0.00, 2),
(8, 8, '2024-04-13 19:50:07', 0.00, 2),
(9, 8, '2024-04-13 19:50:19', 0.00, 2),
(10, 8, '2024-04-13 19:50:55', 0.00, 2),
(11, 8, '2024-04-13 19:52:54', 0.00, 2),
(12, 8, '2024-04-13 19:53:01', 0.00, 2),
(13, 8, '2024-04-13 19:54:00', 0.00, 2),
(14, 8, '2024-04-13 19:54:47', 0.00, 2),
(15, 8, '2024-04-13 19:56:34', 9.00, 2),
(16, 8, '2024-04-13 21:20:32', 2.50, 2),
(17, 8, '2024-04-13 21:47:33', 7.50, 2),
(18, 8, '2024-04-13 21:49:27', 7.50, 2),
(19, 8, '2024-04-13 21:51:22', 7.50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `orderid`, `productid`, `quantity`, `price`) VALUES
(1, 10, 1, 2, 2.50),
(2, 11, 1, 2, 2.50),
(3, 13, 4, 1, 3.00),
(4, 13, 3, 1, 1.50),
(5, 14, 1, 1, 2.50),
(6, 14, 2, 1, 5.00),
(7, 14, 3, 1, 1.50),
(8, 15, 1, 1, 2.50),
(9, 15, 2, 1, 5.00),
(10, 15, 3, 1, 1.50),
(11, 16, 1, 1, 2.50),
(12, 17, 1, 1, 2.50),
(13, 17, 2, 1, 5.00),
(14, 18, 1, 1, 2.50),
(15, 18, 2, 1, 5.00),
(16, 19, 1, 1, 2.50),
(17, 19, 2, 1, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `description` varchar(8000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `stock`, `description`, `image`, `category_id`) VALUES
(1, 'Tosti', 2.50, 968, 'Heerlijke Tosti!', 'https://www.bakkerijkalkdijk.nl/wp-content/uploads/2020/03/tosti.jpg', 1),
(2, 'Whole Wheat Bread', 5.00, 232, 'Unlike white bread, whole-wheat bread is made from flour that uses almost the entire wheat grain—with the bran and germ in tact. This means more nutrients and fiber per slice! ', 'https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/whole-wheat-bread-horizontal-1-jpg-1590195849.jpg?crop=0.735xw:0.735xh;0.187xw,0.128xh&resize=980:*', 1),
(3, 'Brocolli', 1.50, 1234, 'Artichokes contain an unusual organic acid called cynarin which affects taste and may be the reason why water appears to taste sweet after eating artichokes. The flavour of wine is similarly altered and many wine experts believe that wine shouldn’t accompany artichokes.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Broccoli_and_cross_section_edit.jpg/220px-Broccoli_and_cross_section_edit.jpg', 3),
(4, 'Tomato', 3.00, 431, 'Your favorite Fruit', 'https://www.veggipedia.nl/assets/Uploads/Products/5dfffccddf/tomaat-groente-Veggipedia.png', 3),
(7, 'Paprika', 24.00, 31, 'Maar welke kleur isdie', 'https://degroentezaak.nl/wp-content/uploads/2020/10/Paprika-mix_1493482298-scaled.jpg', 3),
(8, 'Wit brood', 21.00, 432, 'Lekker brood for sure', 'https://rutgerbakt.nl/wp-content/uploads/2023/05/wit_brood_recept_broodbakbol-scaled.jpg', 3),
(17, 'Carrot', 0.99, 100, 'Fresh organic carrots', 'https://www.alimentarium.org/sites/default/files/media/image/2016-10/AL012-02%20carotte_0.jpg', 3),
(18, 'Bloemkool', 1.49, 80, 'Fresh organic bloemkool', 'https://groentegroente.nl/wp-content/uploads/Bloemkool-17-S-D-v-som21-698.jpg', 3),
(19, 'Baguette', 1.99, 50, 'Freshly baked baguette', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSE86XGUHgoynK-9aifvFJMm-4MUM0eIKqDBoLaY7QZzA&s', 1),
(20, 'Kaas ui brood', 2.49, 60, 'Kaas ui brood!!', 'https://uitpaulineskeuken.nl/wp-content/uploads/2017/06/Kaasui-brood-2-2.jpg', 1),
(21, 'Organic Apple', 1.99, 100, 'Freshly picked organic apples.', 'https://media.designrush.com/inspiration_images/134802/conversions/_1511456315_653_apple-mobile.jpg', 5),
(23, 'Organic Milk', 3.49, 50, 'Organic milk from grass-fed cows.', 'https://www.campina.nl/sites/rfc/files/styles/content_image_md/public/media/images/7d9581a2-9a69-49da-ab42-45bebf03ec96.jpg?itok=I0R2MzML', 5),
(24, 'Craft Beer', 2.99, 200, 'Locally brewed craft beer.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/Bintang_003.jpg/640px-Bintang_003.jpg', 6),
(25, 'Coca Cola', 1.49, 500, 'Classic Coca Cola.', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/15-09-26-RalfR-WLC-0098_-_Coca-Cola_glass_bottle_%28Germany%29.jpg/800px-15-09-26-RalfR-WLC-0098_-_Coca-Cola_glass_bottle_%28Germany%29.jpg', 6),
(26, 'Potato Chips', 1.99, 300, 'Crunchy and salty potato chips.', 'https://i.ebayimg.com/images/g/pOMAAOSwRCBgyRo0/s-l1200.webp', 7),
(27, 'Chocolate Bar', 2.49, 200, 'Rich and creamy chocolate bar.', 'https://www.merci.nl/fileadmin/DAM/_processed_/f/a/csm_merci-tafelschokolade-edel-rahm-2x_f06bed09ce.png', 7);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'username', '$2y$10$DQlV0u9mFmtOWsOdxXX9H.4kgzEB3E8o97s.S.Pdy4klUAdBvtVh.', 'username@password.com', 2),
(2, 'w', '$2y$10$k9VU87B55bIiGVVIzduVE.znrh3ZesBtQb12/u/t1i7Jz8dZeCOWC', 'w', 1),
(3, 'dwa', '$2y$10$3ECPMsDfUPGWQY1v4hG7UeZji4rO/zZTZNNhC/rQ2cJfhJT9PXARm', 'dwa', 2),
(4, 'wa', '$2y$10$oM.bcWIL9eHh7DGxtrrCF.8J.m0A.7myXGioY/3C/C5Dv313X5/Xa', 'wa', 1),
(5, 'wat', '$2y$10$SSCftmOknURvgVA/n63CA.SRspVpxLgLLHLrgkQ1QCNKZ7Q3KEA8e', 'wat', 2),
(6, 'wate', '$2y$10$2P270x3vKfBAArqLiiuDh.vbzXO1hOGrTEpLANXB.ApIrIgwinFhS', 'wate', 2),
(7, 'drac', '$2y$10$/hWLGdla3xcEdKdr2./IS.jj6Py67aY457WUldtm4vPDmeBguaq7y', 'drac', 2),
(8, 'st', '$2y$10$zFEC33.iHN9Ugdy3bKrJPuXTbt.ZnRCKQrVwXg/KUqiL5aHhrU.E6', 'st', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_FK` (`userid`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_FK` (`orderid`),
  ADD KEY `product_FK` (`productid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `user_id_FK` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_FK` FOREIGN KEY (`orderid`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_FK` FOREIGN KEY (`productid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
