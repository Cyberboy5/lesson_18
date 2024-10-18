
CREATE DATABASE lesson_16_db;

USE lesson_16_db;


CREATE TABLE author(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE genre(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255)
);

CREATE TABLE book(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    description TEXT,
    text TEXT,
    genre_id INT, 
    author_id INT,
    image TEXT
);

DROP TABLE users;

CREATE TABLE users(
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email TEXT,
    password VARCHAR(64),
    role VARCHAR(64) DEFAULT 'user'
);

