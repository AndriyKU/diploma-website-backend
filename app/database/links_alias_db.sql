/*
NOTA. Utilizza questo file in PHPMyAdmin nella scheda "Importa" solo se il database MySQL non ha già un database chiamato links_alias_db con le seguenti tabelle: users, links. Questa operazione è necessaria per il corretto funzionamento dell'intero progetto.
*/

-- Codifica per la comunicazione phpmyadmin(client)/mysql(server)
SET NAMES utf8mb4;

-- Database: `links_alias_db`
CREATE DATABASE `links_alias_db`
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE `links_alias_db`;

-- Struttura della tabella `users`
CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `login` varchar(70) NOT NULL UNIQUE,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_token` VARCHAR(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dati nella tabella `users`
INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES
(1, 'Codi', 'admin@mail.com', '$2y$10$1n0yAWrYn14yw/x5wVRxluJWUCBdhh.nag2sOuG8lOCapWXYmfh3K'),
(2, 'John', 'help@mail.com', '$2y$10$1n0yAWrYn14yw/x5wVRxluJWUCBdhh.nag2sOuG8lOCapWXYmfh3K');

-- Struttura della tabella `links`
CREATE TABLE `links` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `link` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dati nella tabella `links`
INSERT INTO `links` (`id`, `link`, `alias`, `user_id`) VALUES
(1, 'https://google.com', 'searcher', 1),
(2, 'https://youtube.com', 'videos', 2);
