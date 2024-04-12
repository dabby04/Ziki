CREATE DATABASE IF NOT EXISTS Ziki;

-- Switch to the newly created database
USE Ziki;

CREATE TABLE USER (
  `id` int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(512) NOT NULL,
  `DOB` DATE,
  `dateJoined` DATETIME,
  `bio` varchar(100),
  `profilePhoto` LONGBLOB
);

CREATE TABLE ADMIN (
  username varchar(10),
  password varchar(512)
);

CREATE TABLE POSTS (
  id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  title varchar(255),
  content varchar(1000),
  creator varchar(15) NOT NULL,
  creatorId INT NOT NULL,
  dislikes int,
  views int,
  img LONGBLOB DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  theme varchar(255) DEFAULT NULL,
  FOREIGN KEY (creatorId) REFERENCES USER(id)
);

CREATE TABLE REPORTED (
  postId INT,
  userId INT,
  count INT,
  PRIMARY KEY(userId, postId),
  FOREIGN KEY (userId) REFERENCES USER(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (postId) REFERENCES POSTS(id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE COMMENTS (
  commentId INT AUTO_INCREMENT,
  userId INT,
  postId INT,
  likes INT,
  dislikes INT,
  content varchar(1000),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (commentId),
  FOREIGN KEY (postId) REFERENCES POSTS(id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (userId) REFERENCES USER(id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- Create FAVOURITES table
CREATE TABLE `FAVOURITES` (
  `userId` INT,
  `postId` INT,
  PRIMARY KEY(`userId`, `postId`),
  FOREIGN KEY (`userId`) REFERENCES `USER`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`postId`) REFERENCES `POSTS`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create CATEGORY table
CREATE TABLE `CATEGORY` (
  `categoryId` INT AUTO_INCREMENT PRIMARY KEY,
  `categoryName` VARCHAR(50)

);

CREATE TABLE `REPORTEDUSERS`(
  `userId` INT,
  `username` VARCHAR(15),
  `reportCount` INT,
  FOREIGN KEY (`userId`) REFERENCES `USER`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO ADMIN (password, username) VALUES (MD5('test'), 'whitney');


INSERT INTO `USER` (`name`, `username`, `email`, `password`, `DOB`, `dateJoined`, `bio`, `profilePhoto`) 
VALUES
   ('John Doe', 'johndoe', 'johndoe@example.com', MD5('password123'), '1990-01-01', NOW(), 'Hello, I am John Doe.', NULL),
   ('Alice Smith', 'alicesmith', 'alice@example.com', MD5('alicepassword'), '1995-05-15', NOW(), 'Nice to meet you!', NULL),
   ('Bob Johnson', 'bobjohnson', 'bob@example.com', MD5('bobpassword'), '1988-07-20', NOW(), 'I love coding!', NULL),
   ('Emma Watson', 'emmawatson', 'emma@example.com', MD5('emmapassword'), '1989-11-10', NOW(), 'Actress and activist.', NULL),
   ('Michael Brown', 'michaelbrown', 'michael@example.com', MD5('michaelpassword'), '1993-03-25', NOW(), 'Tech enthusiast.', NULL),
    ('Johnny Cash', 'cashjohnny', 'cash@example.com', MD5('cash'), '2003-07-20', NOW(), "That wasn't very cash money of you", NULL),
   ('tye', 'thfde', 'tye@example.com', MD5('test'), '2001-11-10', NOW(), 'Tie', NULL),
   ('Charlie Mac', 'vfcxd', 'charli@example.com', MD5('mac'), '1993-03-27', NOW(), 'Return of the Mac', NULL);


 INSERT INTO POSTS (`title`, `content`, `creator`, `creatorId`, `dislikes`, `views`, `img`, `created_at`,`theme`)
 VALUES 
   ('First Post', 'This is the content of the first post.', 'johndoe', 1, 0, 0, NULL, NOW(),'art'),
   ('Second Post', 'This is the content of the second post.', 'alicesmith', 2, 0, 0, NULL, NOW(),'sports'),
   ('Third Post', 'This is the content of the third post.', 'bobjohnson', 3, 0, 0, NULL, NOW(),'fashion'),
   ('Fourth Post', 'This is the content of the fourth post.', 'emmawatson', 4, 0, 0, NULL, NOW(),'tech'),
   ('Fifth Post', 'This is the content of the fifth post.', 'michaelbrown', 5, 0, 0, NULL, NOW(),'music');


 INSERT INTO COMMENTS (`userId`, `postId`, `likes`, `dislikes`, `content`, `created_at`)
 VALUES 
   (1, 1, 5, 2, 'Nice post!', NOW()),
   (2, 1, 3, 1, 'Great content!', NOW()),
   (3, 2, 7, 0, 'I enjoyed reading this!', NOW()),
   (4, 3, 2, 0, 'Interesting topic!', NOW()),
   (5, 4, 4, 1, 'Well written!', NOW()),
   ( 2, 1, 110, 10, 'This is comment 11', '2024-03-27 04:41:18'),
 ( 3, 2, 120, 11, 'This is comment 12', '2024-03-27 04:41:18'),
 ( 2, 3, 130, 12, 'This is comment 13', '2024-03-27 04:41:18'),
 ( 5, 4, 140, 13, 'This is comment 14', '2024-03-27 04:41:18'),
 ( 4, 5, 150, 14, 'This is comment 15', '2024-03-27 04:41:18'),
 ( 1, 3, 160, 15, 'This is comment 16', '2024-03-27 04:41:18'),
 ( 3, 4, 170, 16, 'This is comment 17', '2024-03-27 04:41:18'),
 ( 4, 5, 180, 17, 'This is comment 18', '2024-03-27 04:41:18'),
 ( 4, 1, 190, 18, 'This is comment 19', '2024-03-27 04:41:18'),
 ( 2, 2, 200, 19, 'This is comment 20', '2024-03-27 04:41:18');


 INSERT INTO FAVOURITES (`userId`, `postId`)
 VALUES 
   (1, 2),
   (2, 1),
   (3, 3),
   (4, 4),
   (5, 5);


 INSERT INTO CATEGORY (`categoryName`)
 VALUES 
   ('Technology'),
   ('Sports'),
   ('Food'),
   ('Travel'),
   ('Music');

INSERT INTO REPORTEDUSERS (`userId`,`username`, `reportCount`)
VALUES (6,'cashjohnny', 24),
       (7,'thfde', 15),
       (8,'vfcxd', 10);