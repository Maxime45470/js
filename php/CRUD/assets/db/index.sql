CREATE TABLE `membre`(
    `id` int(30) NOT NULL AUTO_INCREMENT,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `f_name` varchar(255) NOT NULL,
    `l_name` varchar(255) NOT NULL,
    `admin` tinyint(1) NOT NULL, 
    `img` varchar(255) NOT NULL
    PRIMARY KEY(`id`)
);

CREATE TABLE `gararge`(
    `id` int(30) NOT NULL AUTO_INCREMENT,
    `marque` varchar(255) NOT NULL,
    `model` varchar(255) NOT NULL,
    `img` varchar(255) NOT NULL
    PRIMARY KEY(`id`)
);