CREATE TABLE `migrations` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`migration` varchar(255) NOT NULL,
`batch` int(11) NOT NULL,
PRIMARY KEY (`id`)
);