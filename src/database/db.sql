CREATE TABLE `migrations` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`migration` varchar(255) NOT NULL,
`batch` int(11) NOT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `game_players` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`username` varchar(50) NOT NULL,
`phone` varchar(24) DEFAULT NULL,
`uri` varchar(42) NOT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `game_players_username_unique` (`username`),
UNIQUE KEY `game_players_phone_unique` (`phone`),
UNIQUE KEY `game_players_uri_unique` (`uri`)
);

INSERT INTO `game_players` VALUES (1,'tester','0123456789423','31e60e01-ce22-4188-9114-04436ef4173a','2022-11-30 10:53:20','2022-12-01 06:04:54');

CREATE TABLE `bids` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(11) DEFAULT NULL,
`value` int(11) DEFAULT NULL,
`prize` double(8,2) DEFAULT NULL,
`win` tinyint(1) DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`)
);

INSERT INTO `bids` VALUES (1,1,114,11.40,1,'2022-12-01 01:56:26');

CREATE TABLE `users` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`email_verified_at` timestamp NULL DEFAULT NULL,
`password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` VALUES (1,'Admin','admin@localhost',NULL,'$2y$10$gNaJUC20SRGOTsh5hyuOhusbfdzJ7MmJvmg4w1qqI7zX5YyRxsIVm',2,'WxQYpZbwxHLvXsqt1nRDMIyX8JgTYfW9nIbLoL3v7geXVGL2aqER1zyirxqo','2022-11-30 10:38:21','2022-11-30 10:38:21');

CREATE TABLE `personal_access_tokens` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`tokenable_id` bigint(20) unsigned NOT NULL,
`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
`abilities` text COLLATE utf8mb4_unicode_ci,
`last_used_at` timestamp NULL DEFAULT NULL,
`expires_at` timestamp NULL DEFAULT NULL,
`created_at` timestamp NULL DEFAULT NULL,
`updated_at` timestamp NULL DEFAULT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
`email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`created_at` timestamp NULL DEFAULT NULL,
KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `failed_jobs` (
`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
`uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
`connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
`queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
`payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
`exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
`failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
