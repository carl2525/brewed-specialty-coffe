-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2023 at 12:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `best`
--

CREATE TABLE `best` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `best`
--

INSERT INTO `best` (`id`, `name`, `image`) VALUES
(17, 'Sample', 'B_oreo_ssalt_latte.png'),
(21, 'Sample', 'B_Beef Tapa.png'),
(22, 'Sample', 'B_Spam Kimchi fried rice.PNG'),
(23, 'Sample', 'B_Spam Kimchi fried rice.PNG'),
(24, 'Sample2', 'B_Sausage Stroganoff.PNG'),
(25, 'Sample3', 'B_Creamy Truffle Mushroom.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `employee_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `admin_id`, `employee_id`, `name`, `price`, `quantity`, `image`) VALUES
(113, 4, 0, 0, 'sana', 123, 1, 'Spam Kimchi fried rice.PNG'),
(114, 0, 1, 0, 'sana', 123, 1, ''),
(115, 2, 0, 0, 'four', 123, 1, 'beeftapa.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL,
  `feedback` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`, `feedback`) VALUES
(14, 2, 'per', 'njmirador31@gmail.com', '1234', 'try2', 'okay'),
(15, 4, 'Userperr', 'miradorneiljasper@gmail.com', '567', 'asd', 'qwe132');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `employee_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `admin_id`, `employee_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(18, 2, 0, 0, 'per', '123', 'njmirador31@gmail.com', 'Cash on delivery', '  asd, asd  , Cainta Rizal, asd', ' ewan (1)', 12, '04-May-2023', 'completed'),
(19, 2, 0, 0, 'per', '123', 'njmirador31@gmail.com', 'Cash on delivery', '  asd, asd  , Cainta Rizal, asd', ' try (2)', 24, '05-May-2023', 'completed'),
(20, 2, 0, 0, 'per', '43', 'njmirador31@gmail.com', 'Cash on delivery', '  asd, qwe  , Cainta Rizal, qwe', ' try (1)', 12, '05-May-2023', 'cancelled'),
(21, 2, 0, 0, 'per', '123', 'njmirador31@gmail.com', 'Cash on delivery', '  qwe, qwe  , Cainta Rizal, qwe', ' tryy (1)', 12, '05-May-2023', 'preparing'),
(23, 2, 0, 0, 'per', '123', 'njmirador31@gmail.com', 'Cash on delivery', '  asd, asd  , Cainta Rizal, asd', ' sana (1)', 163, '23-May-2023', 'completed'),
(24, 2, 0, 0, 'per', '123', 'njmirador31@gmail.com', 'Cash on delivery', '  asd, asd  , Cainta Rizal, asd', ' four (1)', 163, '23-May-2023', 'completed'),
(25, 2, 0, 0, 'per', '123', 'njmirador31@gmail.com', 'Cash on delivery', '  asd, asd  , Cainta Rizal, now', ' four (1)', 163, '23-May-2023', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `quantity`) VALUES
(2, 'tryy', 12, 'Sausage.PNG', 9),
(3, 'ewan', 12, 'Grilled Cheese.PNG', 0),
(4, 'sana', 123, 'Spam Kimchi fried rice.PNG', 114),
(5, 'four', 123, 'beeftapa.PNG', 120),
(7, 'itlog', 123, 'Mushroom omelette.PNG', 123);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `status` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `status`) VALUES
(1, 'per', 'njmirador@gmail.com', '$2y$10$FZTneZNIbdGTCehoqquk.ue4CSx6eQPxpv2kJHfscTXpwWb2lTVu6', 'admin', 1),
(2, 'per', 'njmirador31@gmail.com', '$2y$10$ajAuw3dw3pGN1rk.LhgS1uHoFyykcUQyUw2Q9tRfMgU53uaku7NAa', 'user', 1),
(3, 'per', 'ojtneiljaspermirador.itworks@gmail.com', '$2y$10$E.pGheJeGRffJAHBh.Qgbu/9N6whg6eU9W2zK8/NEUAahqimpVlla', 'employee', 1),
(4, 'Userperr', 'miradorneiljasper@gmail.com', '$2y$10$bFSwB7aUhYfmO.uRfpUmWO0w5nUyKAFZoRVG.268iI0vOg25o2MqW', 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `walkin`
--

CREATE TABLE `walkin` (
  `id` int(100) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `employee_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cname` varchar(100) NOT NULL,
  `onumber` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `walkin`
--

INSERT INTO `walkin` (`id`, `admin_id`, `employee_id`, `name`, `cname`, `onumber`, `email`, `method`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(16, 0, 3, 'per', 'pogi', '1', 'ojtneiljaspermirador.itworks@gmail.com', 'dine in', ' ewan (1) try (1)', 24, '04-May-2023', 'pending'),
(17, 1, 0, 'per', 'gwapo', '2', 'njmirador@gmail.com', 'take out', ' sana (1)', 123, '04-May-2023', 'pending'),
(18, 1, 0, 'per', 'owl', '2', 'njmirador@gmail.com', 'dine in', ' sana (1)', 123, '05-May-2023', 'completed'),
(19, 1, 0, 'per', 'taylor', '12', 'njmirador@gmail.com', 'dine in', ' tryy (10)', 120, '09-May-2023', 'pending'),
(20, 1, 0, 'per', 'ash', '12', 'njmirador@gmail.com', 'dine in', ' sana (1)', 123, '23-May-2023', 'completed'),
(21, 1, 0, 'per', 'janry', '23', 'njmirador@gmail.com', 'take out', ' four (1)', 123, '23-May-2023', 'completed'),
(22, 0, 3, 'per', 'emp', '45', 'ojtneiljaspermirador.itworks@gmail.com', 'take out', ' sana (1)', 123, '23-May-2023', 'completed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `best`
--
ALTER TABLE `best`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `walkin`
--
ALTER TABLE `walkin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `best`
--
ALTER TABLE `best`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `walkin`
--
ALTER TABLE `walkin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
