SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `attractiepagina`
--
DROP DATABASE IF EXISTS `attractiepagina`;
CREATE DATABASE IF NOT EXISTS `attractiepagina` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `attractiepagina`;

--
-- Tabel: `rides`
--

DROP TABLE IF EXISTS `rides`;
CREATE TABLE IF NOT EXISTS `rides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `themeland` varchar(255) NOT NULL,
  `img_file` text NOT NULL,
  `description` text NOT NULL,
  `min_length` int default NULL,
  `fast_pass` int(1) default 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Reuzenrad',   'familyland', 'adger-kang-oiyzr-SgjBY-unsplash.jpg', 'Bekijk het park van grote hoogte met het hele gezin.', NULL, 0);
INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Thunderbolt', 'adventureland', 'david-murcia-HbYniDwjbVE-unsplash.jpg', 'Echte thrillseekers komen aan hun trekken.', 120, 1);
INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Caroussel',   'familyland', 'alex-kalinin-6gYjwD4s9xk-unsplash.jpg', 'Voor de allerkleinsten: maak een rondje in de antieke draaimolen.', NULL, 0);
INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Reuzeglijbaan', 'waterland', 'brandon-hoogenboom-P0MX2XCqbFc-unsplash.jpg', 'Afkoelen in het waterparadijs (alleen open op warme dagen).', 80, 0);
INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Kinderachtbaan', 'familyland', 'chris-slupski-QLqIqIhMiNs-unsplash.jpg', 'Spanning en sensatie speciaal voor de kleintjes.', 50, 0);

INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Turbo Turn 2000', 'adventureland', 'frenjamin-benklin-fiDVCWI9IUI-unsplash.jpg', 'Sterke maag? Laat je centrifugeren in de turboturn.', 100, 0);
INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Boardwalk', 'adventureland', 'jason-leung-5ueIeoysAm8-unsplash.jpg', "Let's walk the board!", 90, 1);
INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Houten achtbaan', 'adventureland', 'jeriden-villegas-XrDVROYUTOs-unsplash.jpg', 'De houten achtbaan is gesloten voor renovatie.', 90, 0);
INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Turbo',    'adventureland', 'laurie-byrne-EtKSaG-PRbY-unsplash.jpg', 'Turbo-turbo, gas op die lollie! Een niet-zo-spannend achtbaan voor iedereen.', 75, 0);
INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ("Irvin's Present", 'familyland', 'mahesh-patel-2Qyn5AqktyE-unsplash.jpg', 'Win de mooiste prijzen bij Irvin (en betaal direct 85% kansspelbelasting).', NULL, 0);

INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Speedy XL', 'adventureland', 'matt-bowden-GZc4fnQsaWQ-unsplash.jpg', 'Sneller dan speedy wordt het niet. Houd je vast!', 140, 1);
INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Zweefmolen',  'familyland', 'parker-johnson-2Zxd7eYd1VA-unsplash.jpg', 'Draaimolen on steroids.', 100, 0);
INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Vliegende Fanten', 'familyland', 'philipp-potocnik-nmVzQqgl-pc-unsplash.jpg', 'Vlieg een rondje op jouw favoriete olifant.', 70, 0);
INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Goudvissen',   'waterland', 'remy-gieling--RwJveqoRrg-unsplash.jpg', 'Alleen open bij mooi weer. U kunt nat worden (of gebeten door een goudvis).', 90, 0);
INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Top Gun',  'adventureland', 'rusty-watson-jlWKDeU83nw-unsplash.jpg', 'Toppers wagen hun leven in Top Gun, misselijkheid gegarandeerd.', 120, 1);

INSERT INTO `rides` (`title`, `themeland`, `img_file`, `description`, `min_length`, `fast_pass`) VALUES ('Nitro',    'adventureland', 'steve-doig-Pm8PTvvEU1w-unsplash.jpg', 'Nitro is tijdelijk gesloten op last van de politie wegens een ongeval. ', 100, 0);

--
-- Tabel: `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`username`, `password`) VALUES ('user1', '$2y$10$E1RRrlkzSBf9gUJrJZgYl.sXnqLBcWbEm.bBX30TcKS.NCEYaoo7q');
INSERT INTO `users` (`username`, `password`) VALUES ('user2', '$2y$10$5c9ztGrjrt/iFtTWfyq1p.KVxzEQd/C8YKkesSMy3NVbmHnaRRrrO');
INSERT INTO `users` (`username`, `password`) VALUES ('user3', '$2y$10$2H8uaI4z/sGH.fIlAsCxquUVLB4f9nLhad..NnfjDE4eemi3ufMUO');
