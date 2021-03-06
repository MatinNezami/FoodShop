CREATE TABLE `users` (
    `username` VARCHAR(30) PRIMARY KEY,
    `email` VARCHAR(255) UNIQUE NOT NULL,
    `accept` TINYINT(1) NOT NULL DEFAULT(0),
    `password` VARCHAR(30) NOT NULL,
    `firstName` VARCHAR(30) NOT NULL,
    `token` VARCHAR(255) UNIQUE NOT NULL,
    `profile` MEDIUMBLOB NOT NULL,
    `acceptCode` VARCHAR(6),
    `oppertunity` VARCHAR(20)
);