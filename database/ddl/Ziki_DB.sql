-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS Ziki;

-- Switch to the newly created database
USE Ziki;

CREATE TABLE USERS (

  `id` int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(512) NOT NULL,
  `DOB` DATE ,
  `dateJoined` DATETIME,
  `bio` varchar(100),
  `profilePhoto` BLOB
)

CREATE TABLE ADMIN (
  'password' int,
  'username' varchar(10)
)

CREATE TABLE REPORTED (
  reportId INT
  postId INT
  userId INT
  count INT  
    FOREIGN KEY (userId) REFERENCES User(id) ON DELETE NO ACTION ON UPDATE CASCADE 
    FOREIGN KEY (postId) REFERENCES User(id) ON DELETE NO ACTION ON UPDATE CASCADE 
   
)

CREATE TABLE POSTS (
  id INT IDENTITY PRIMARY KEY,
  title varchar,
  content varchar(1000),
  creator varchar(10) NOT NULL,
  dislikes int,
  views int,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   FOREIGN KEY (creator) REFERENCES USERS(username)
)

CREATE TABLE COMMENTS (
    commentId           INT IDENTITY,
    userId              INT,
    postId              INT,
    likes               INT,
    dislikes            INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP       
    PRIMARY KEY (commentId),
    FOREIGN KEY (postId) REFERENCES POSTS(id)
    ON UPDATE CASCADE ON DELETE CASCADE
    FOREIGN KEY (userId) REFERENCES USER(id)
    ON UPDATE CASCADE ON DELETE CASCADE
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
