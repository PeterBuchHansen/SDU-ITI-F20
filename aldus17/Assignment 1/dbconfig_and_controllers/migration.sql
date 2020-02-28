DROP DATABASE IF EXISTS `aldus17`;

CREATE DATABASE IF NOT EXISTS `aldus17`;

USE `aldus17`;

DROP TABLE IF EXISTS `users`;

DROP TABLE IF EXISTS `images`;

CREATE TABLE `users` (
	`userID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(100) UNIQUE NOT NULL,
	`fullname` VARCHAR(150) NULL,
	`email` VARCHAR(150) NOT NULL,
	`password` VARCHAR(150) NOT NULL,
	PRIMARY KEY (`userID`)
);

INSERT INTO
	users (fullname, username, email, password)
VALUES
	(
		'test',
		'test',
		'test@test.com',
		'$2y$12$syuFo.W56bAuWIMqGCjtDODOVoriPXdwmTWyNDo7K3b0V27LmtQXG'
	);

CREATE TABLE `images` (
	`imageID` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`userID` INT(10) UNSIGNED NOT NULL,
	`image` MEDIUMBLOB NOT NULL,
	`title` VARCHAR(150) NOT NULL,
	`description` TEXT NULL,
	`creationTime` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	PRIMARY KEY (`imageID`),
	FOREIGN KEY (userID) REFERENCES users(userID)
);