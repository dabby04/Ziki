-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS Ziki;

-- Switch to the newly created database
USE Ziki;

CREATE TABLE USER (

   `id` int PRIMARY KEY,
   `name` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(512) NOT NULL,
    `DOB` DATETIME 
)

CREATE TABLE ADMIN (
  `password` int,
  `username` varchar(10)
)

CREATE TABLE POSTS (
  id int PRIMARY KEY,
  content varchar(250),
  creator varchar(10) NOT NULL,
  likes int,
  views int,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)