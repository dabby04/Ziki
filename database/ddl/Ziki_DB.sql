-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS Ziki;

-- Switch to the newly created database
USE Ziki;

CREATE TABLE USER (

  `id` int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(512) NOT NULL,
  `DOB` DATE ,
  `dateJoined` DATETIME,
  `bio` varchar(100),
  `profilePhoto` LONGBLOB
)

CREATE TABLE ADMIN (
  'password' varchar(20),
  'username' varchar(10)
)

CREATE TABLE REPORTED (
  reportId INT,
  postId INT,
  userId INT,
  count INT  ,
    FOREIGN KEY (userId) REFERENCES User(id) ON DELETE NO ACTION ON UPDATE CASCADE ,
    FOREIGN KEY (postId) REFERENCES User(id) ON DELETE NO ACTION ON UPDATE CASCADE 
   
)

CREATE TABLE POSTS (
  id INT IDENTITY PRIMARY KEY,
  title varchar,
  content varchar(1000),
  creator varchar(10) NOT NULL,
  creatorId INT NOT NULL,
  dislikes int,
  views int,
  img LONGBLOB,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (creatorId) REFERENCES USER(username)

)

CREATE TABLE COMMENTS (
    commentId           INT IDENTITY,
    userId              INT,
    postId              INT,
    likes               INT,
    dislikes            INT,
    content             varchar,
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

INSERT INTO ADMIN  VALUES ("test","whitney");

INSERT INTO USER (`name`, `username`, `email`, `password`, `DOB`, `dateJoined`, `bio`, `profilePhoto`)
VALUES 
  ('John Doe', 'johndoe', 'johndoe@example.com', 'password123', '1990-01-01', NOW(), 'Hello, I am John Doe.', NULL),
  ('Alice Smith', 'alicesmith', 'alice@example.com', 'alicepassword', '1995-05-15', NOW(), 'Nice to meet you!', NULL),
  ('Bob Johnson', 'bobjohnson', 'bob@example.com', 'bobpassword', '1988-07-20', NOW(), 'I love coding!', NULL),
  ('Emma Watson', 'emmawatson', 'emma@example.com', 'emmapassword', '1989-11-10', NOW(), 'Actress and activist.', NULL),
  ('Michael Brown', 'michaelbrown', 'michael@example.com', 'michaelpassword', '1993-03-25', NOW(), 'Tech enthusiast.', NULL);

INSERT INTO POSTS (`title`, `content`, `creator`, `creatorId`, `dislikes`, `views`, `img`, `created_at`)
VALUES 
  ('First Post', 'This is the content of the first post.', 'johndoe', 1, 0, 0, NULL, NOW()),
  ('Second Post', 'This is the content of the second post.', 'alicesmith', 2, 0, 0, NULL, NOW()),
  ('Third Post', 'This is the content of the third post.', 'bobjohnson', 3, 0, 0, NULL, NOW()),
  ('Fourth Post', 'This is the content of the fourth post.', 'emmawatson', 4, 0, 0, NULL, NOW()),
  ('Fifth Post', 'This is the content of the fifth post.', 'michaelbrown', 5, 0, 0, NULL, NOW());


INSERT INTO COMMENTS (`userId`, `postId`, `likes`, `dislikes`, `content`, `created_at`)
VALUES 
  (1, 1, 5, 2, 'Nice post!', NOW()),
  (2, 1, 3, 1, 'Great content!', NOW()),
  (3, 2, 7, 0, 'I enjoyed reading this!', NOW()),
  (4, 3, 2, 0, 'Interesting topic!', NOW()),
  (5, 4, 4, 1, 'Well written!', NOW());


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
