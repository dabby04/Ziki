-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 07:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ziki`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `password` varchar(20) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `postId` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `userId`, `postId`, `likes`, `dislikes`, `content`, `created_at`) VALUES
(1, 0, 1, 10, 0, 'This is comment 1', '2024-03-27 04:41:18'),
(2, 0, 2, 20, 1, 'This is comment 2', '2024-03-27 04:41:18'),
(3, 0, 3, 30, 2, 'This is comment 3', '2024-03-27 04:41:18'),
(4, 0, 4, 40, 3, 'This is comment 4', '2024-03-27 04:41:18'),
(5, 0, 5, 50, 4, 'This is comment 5', '2024-03-27 04:41:18'),
(6, 0, 6, 60, 5, 'This is comment 6', '2024-03-27 04:41:18'),
(7, 0, 7, 70, 6, 'This is comment 7', '2024-03-27 04:41:18'),
(8, 0, 8, 80, 7, 'This is comment 8', '2024-03-27 04:41:18'),
(9, 0, 9, 90, 8, 'This is comment 9', '2024-03-27 04:41:18'),
(10, 0, 10, 100, 9, 'This is comment 10', '2024-03-27 04:41:18'),
(11, 0, 1, 110, 10, 'This is comment 11', '2024-03-27 04:41:18'),
(12, 0, 2, 120, 11, 'This is comment 12', '2024-03-27 04:41:18'),
(13, 0, 3, 130, 12, 'This is comment 13', '2024-03-27 04:41:18'),
(14, 0, 4, 140, 13, 'This is comment 14', '2024-03-27 04:41:18'),
(15, 0, 5, 150, 14, 'This is comment 15', '2024-03-27 04:41:18'),
(16, 0, 6, 160, 15, 'This is comment 16', '2024-03-27 04:41:18'),
(17, 0, 7, 170, 16, 'This is comment 17', '2024-03-27 04:41:18'),
(18, 0, 8, 180, 17, 'This is comment 18', '2024-03-27 04:41:18'),
(19, 0, 9, 190, 18, 'This is comment 19', '2024-03-27 04:41:18'),
(20, 0, 10, 200, 19, 'This is comment 20', '2024-03-27 04:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(1000) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `creator` int(11) NOT NULL,
  `dislikes` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `img` blob DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `theme` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `creator`, `dislikes`, `views`, `img`, `created_at`, `theme`) VALUES
(1, 'Post Title 1', 'This is the content of post 1', 0, 0, 100, 0x696d67312e6a7067, '2024-03-27 04:41:18', 'art'),
(2, 'Post Title 2', 'This is the content of post 2', 0, 1, 200, 0x696d67322e6a7067, '2024-03-27 04:41:18', 'sports'),
(3, 'Post Title 3', 'This is the content of post 3', 0, 2, 300, 0x696d67332e6a7067, '2024-03-27 04:41:18', 'fashion'),
(4, 'Post Title 4', 'This is the content of post 4', 0, 3, 400, 0x696d67342e6a7067, '2024-03-27 04:41:18', 'tech'),
(5, 'Post Title 5', 'This is the content of post 5', 0, 4, 500, 0x696d67352e6a7067, '2024-03-27 04:41:18', 'music'),
(6, 'Post Title 6', 'This is the content of post 6', 0, 5, 600, 0x696d67362e6a7067, '2024-03-27 04:41:18', 'art'),
(7, 'Post Title 7', 'This is the content of post 7', 0, 6, 700, 0x696d67372e6a7067, '2024-03-27 04:41:18', 'sports'),
(8, 'Post Title 8', 'This is the content of post 8', 0, 7, 800, 0x696d67382e6a7067, '2024-03-27 04:41:18', 'fashion'),
(9, 'Post Title 9', 'This is the content of post 9', 0, 8, 900, 0x696d67392e6a7067, '2024-03-27 04:41:18', 'tech'),
(10, 'Post Title 10', 'This is the content of post 10', 0, 9, 1000, 0x696d6731302e6a7067, '2024-03-27 04:41:18', 'music');

-- --------------------------------------------------------

--
-- Table structure for table `reported`
--

CREATE TABLE `reported` (
  `reportId` int(11) DEFAULT NULL,
  `postId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(512) NOT NULL,
  `DOB` date DEFAULT NULL,
  `dateJoined` datetime DEFAULT NULL,
  `bio` varchar(100) DEFAULT NULL,
  `profilePhoto` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(512) NOT NULL,
  `DOB` date DEFAULT NULL,
  `dateJoined` datetime DEFAULT NULL,
  `bio` varchar(100) DEFAULT NULL,
  `profilePhoto` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `postId` (`postId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator` (`creator`);

--
-- Indexes for table `reported`
--
ALTER TABLE `reported`
  ADD KEY `userId` (`userId`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`postId`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`id`);

--
-- Constraints for table `reported`
--
ALTER TABLE `reported`
  ADD CONSTRAINT `reported_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `reported_ibfk_2` FOREIGN KEY (`postId`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
