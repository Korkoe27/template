CREATE DATABASE authsys;

USE AuthSys;

CREATE TABLE user  (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    userEmail VARCHAR(255) NOT NULL,
    telephone VARCHAR(255) NOT NULL,
    userPassword VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;