-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS Ziki;

-- Switch to the newly created database
USE Ziki;

CREATE TABLE USER (

   `id` int NOT NULL,
   `name` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(512) NOT NULL,
    `DOB` DATETIME 
)

