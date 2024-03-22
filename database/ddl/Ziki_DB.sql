-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS Ziki;

-- Switch to the newly created database
USE Ziki;

-- Create USER table
CREATE TABLE `USER` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(30) NOT NULL,
  `username` VARCHAR(10) NOT NULL,
  `email` VARCHAR(25) NOT NULL,
  `password` VARCHAR(512) NOT NULL,
  `DOB` DATETIME,
  `dateJoined` DATE
);

-- Create ADMIN table
CREATE TABLE `ADMIN` (
  `password` INT,
  `username` VARCHAR(10)
);

-- Create POSTS table
CREATE TABLE `POSTS` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255),
  `content` VARCHAR(1000),
  `creator` VARCHAR(10) NOT NULL,
  `likes` INT,
  `dislikes` INT,
  `views` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create REPORTED table
CREATE TABLE `REPORTED` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `reportId` INT,
  `postId` INT,
  `userId` INT,
  `count` INT,
  FOREIGN KEY (`userId`) REFERENCES `USER`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (`postId`) REFERENCES `POSTS`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE
);

-- Create COMMENTS table
CREATE TABLE `COMMENTS` (
  `commentId` INT AUTO_INCREMENT PRIMARY KEY,
  `userId` INT,
  `postId` INT,
  `likes` INT,
  `dislikes` INT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`postId`) REFERENCES `POSTS`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`userId`) REFERENCES `USER`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create FAVOURITES table
CREATE TABLE `FAVOURITES` (
  `userId` INT,
  `postId` INT,
  PRIMARY KEY(`userId`, `postId`),
  FOREIGN KEY (`userId`) REFERENCES `USER`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (`postId`) REFERENCES `POSTS`(`id`) ON DELETE NO ACTION ON UPDATE CASCADE
);

-- Create CATEGORY table
CREATE TABLE `CATEGORY` (
  `categoryId` INT AUTO_INCREMENT PRIMARY KEY,
  `categoryName` VARCHAR(50)
);
