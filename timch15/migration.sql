DROP DATABASE IF EXISTS timch15;
CREATE DATABASE timch15;
USE timch15;

CREATE TABLE user (
	username VARCHAR(255) PRIMARY KEY,
	user_password VARCHAR(255) NOT NULL
);

CREATE TABLE picture (
	picture_id INT AUTO_INCREMENT PRIMARY KEY,
	picture MEDIUMTEXT NOT NULL,
	header VARCHAR(255) NOT NULL,
	description VARCHAR(255) NOT NULL,
	uploader VARCHAR(255) NOT NULL,
	FOREIGN KEY (uploader) REFERENCES USER(username) 
);