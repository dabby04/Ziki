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
  `DOB` DATETIME ,
  `dateJoined` DATE,
  `bio` varchar(100),
         
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

  CREATE TABLE FAVOURITES (
        userId INT, 
        postId INT,
    FOREIGN KEY (userId) REFERENCES User(id) ON DELETE NO ACTION ON UPDATE CASCADE 
    FOREIGN KEY (postId) REFERENCES User(id) ON DELETE NO ACTION ON UPDATE CASCADE 


  );

  CREATE TABLE LIKES (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  post_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES USERS(id),
  FOREIGN KEY (post_id) REFERENCES POSTS(id)
);


  CREATE TABLE CATEGORY (
    categoryId  INT IDENTITY,
    categoryName VARCHAR(50),
    PRIMARY KEY (categoryId)

  );




  INSERT INTO ADMIN ('password', 'username') VALUES('admin','test')
    
  



