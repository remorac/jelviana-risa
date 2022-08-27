-- Adminer 4.8.1 MySQL 5.5.5-10.8.3-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `gap`;
CREATE TABLE `gap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selisih` int(11) NOT NULL,
  `bobot` double NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `gap` (`id`, `selisih`, `bobot`, `keterangan`) VALUES
(1,	0,	5,	'Tidak ada selisih (kriteria sesuai dengan yang ketentuan)'),
(2,	1,	4.5,	'Kriteria individu kelebihan 1 tingkat/level'),
(3,	-1,	4,	'Kriteria individu kekurangan 1 tingkat/level'),
(4,	2,	3.5,	'Kriteria individu kelebihan 2 tingkat/level'),
(5,	-2,	3,	'Kriteria individu kekurangan 2 tingkat/level'),
(6,	3,	2.5,	'Kriteria individu kelebihan 3 tingkat/level'),
(7,	-3,	2,	'Kriteria individu kekurangan 3 tingkat/level'),
(8,	4,	1.5,	'Kriteria individu kelebihan 4 tingkat/level');

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jenis` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `kriteria` (`id`, `nama`, `jenis`) VALUES
(1,	'Demam',	1),
(3,	'Batuk',	2),
(4,	'Test 2',	1);

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base',	1661062005),
('m130524_201442_init',	1661062808),
('m190124_110200_add_verification_token_column_to_user_table',	1661062809);

DROP TABLE IF EXISTS `pasien`;
CREATE TABLE `pasien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `umur` int(11) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pasien` (`id`, `nama`, `umur`, `alamat`) VALUES
(1,	'Isaac Newton',	34,	'asdfghjkl'),
(2,	'Nikola Tesla',	44,	'qwertyuioplkjhgfdsazxcvbnm');

DROP TABLE IF EXISTS `pemeriksaan`;
CREATE TABLE `pemeriksaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasien_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pasien_id` (`pasien_id`),
  CONSTRAINT `pemeriksaan_ibfk_2` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pemeriksaan` (`id`, `pasien_id`, `tanggal`) VALUES
(2,	1,	'2022-08-30'),
(3,	1,	'2022-08-24'),
(4,	2,	'2022-08-30');

DROP TABLE IF EXISTS `pemeriksaan_kriteria`;
CREATE TABLE `pemeriksaan_kriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pemeriksaan_id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `subkriteria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subkriteria_id` (`subkriteria_id`),
  KEY `pemeriksaan_id` (`pemeriksaan_id`),
  KEY `kriteria_id` (`kriteria_id`),
  CONSTRAINT `pemeriksaan_kriteria_ibfk_2` FOREIGN KEY (`subkriteria_id`) REFERENCES `subkriteria` (`id`),
  CONSTRAINT `pemeriksaan_kriteria_ibfk_3` FOREIGN KEY (`pemeriksaan_id`) REFERENCES `pemeriksaan` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pemeriksaan_kriteria_ibfk_4` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pemeriksaan_kriteria` (`id`, `pemeriksaan_id`, `kriteria_id`, `subkriteria_id`) VALUES
(4,	2,	1,	6),
(5,	2,	4,	2),
(6,	2,	3,	9),
(7,	3,	1,	4),
(8,	3,	4,	1),
(9,	3,	3,	8),
(10,	4,	1,	5),
(11,	4,	4,	2),
(12,	4,	3,	9);

DROP TABLE IF EXISTS `subkriteria`;
CREATE TABLE `subkriteria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nilai` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kriteria_id` (`kriteria_id`),
  CONSTRAINT `subkriteria_ibfk_2` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `subkriteria` (`id`, `kriteria_id`, `nama`, `nilai`, `target`) VALUES
(1,	4,	'skjfhgjkdf',	3,	1),
(2,	4,	'sdfd',	2,	0),
(3,	4,	'sdfsdfds',	1,	0),
(4,	1,	'jdahfgsjdh',	3,	1),
(5,	1,	'sdmnfdkj',	2,	0),
(6,	1,	'sjhrgkjd',	1,	0),
(8,	3,	'skjhgkf',	2,	1),
(9,	3,	'cnkjrdghke',	1,	0);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1,	'user',	'fNZPhUb_jfJonh46xkcckgF9__UHW-xo',	'$2y$13$Ce//.4NmLtAcwRrX6Yutu.1orUWtlxMIU8I9LNJD.n.VWfbCqaFvC',	NULL,	'user@email.com',	10,	1661062822,	1661062822,	'st59FFJZxqRoL8q3t2cRf60uHxDuF6kA_1661062822');

-- 2022-08-27 03:52:08
