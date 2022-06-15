CREATE DATABASE IF NOT EXISTS `db_sono`;
USE `db_sono`;



CREATE TABLE `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nom` varchar(255) NOT NULL,
    `prenom` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `telephone` int(11) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `objet` (
    `id` int(11) NOT NULL AUTO_INCREMENT,  
    `nom` varchar(255) NOT NULL,
    `reference` varchar(255) NOT NULL,
    `prix` int(11) NOT NULL,
    `image` varchar(255) NOT NULL
    PRIMARY KEY (`id`)
);

