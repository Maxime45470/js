CREATE TABLE `users` (
    `id` int(70) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `mdp` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO `users` (`id`, `name`, `mdp`) VALUES (NULL, 'max', 'max');
