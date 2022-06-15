CREATE DATABASE IF NOT EXISTS `db_score`;
USE `db_score`;



CREATE TABLE `casse_brique` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `pseudo` varchar(255) NOT NULL,
    `score` int(11) NOT NULL,
    PRIMARY KEY (`id`)
);
