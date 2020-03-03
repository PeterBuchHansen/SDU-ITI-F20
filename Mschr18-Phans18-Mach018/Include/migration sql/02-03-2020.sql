DROP DATABASE IF EXISTS iti;
CREATE DATABASE iti;
USE iti;

CREATE TABLE users (
	userid INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(10) NOT NULL UNIQUE,
    passw VARCHAR(30) NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    phone VARCHAR(25) NOT NULL,
    email VARCHAR(320) NOT NULL,
    PRIMARY KEY (userid)
);



