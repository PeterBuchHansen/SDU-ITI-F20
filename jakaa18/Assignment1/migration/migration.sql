DROP DATABASE IF EXISTS my_database, jakaa18_jesha18;

CREATE DATABASE jakaa18_jesha18;
USE jakaa18_jesha18;
CREATE TABLE users
(
    user_id int auto_increment primary key,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
);

CREATE TABLE pictures
(
    pic_id int auto_increment primary key,
    header VARCHAR(100) NOT NULL,
    description VARCHAR(300) NOT NULL,
    user VARCHAR(100) NOT NULL,
    picture longblob NOT NULL,
);
