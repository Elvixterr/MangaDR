-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2024 at 02:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mangadr`
--

-- --------------------------------------------------------

--
-- Table structure for table `cuenta`
--

CREATE TABLE `cuenta` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `avatar` LONGBLOB NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mangas`
--

CREATE TABLE `mangas` (
  `id` TEXT NOT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `descripcion` TEXT NULL,
  `imagen_url` TEXT NULL,
  PRIMARY KEY (`id`(36)) -- Se usa `TEXT`, pero MySQL necesita definir un prefijo de índice en claves primarias.
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comentarios`
--

CREATE TABLE `comentarios` (
  `id_row` INT(11) NOT NULL AUTO_INCREMENT,
  `comentario` TEXT NOT NULL,
  `manga_id` TEXT NOT NULL,
  `user_id` INT(11) NOT NULL,
  `likes` INT(11) DEFAULT 0,
  `chapter` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_row`),
  FOREIGN KEY (`manga_id`) REFERENCES `mangas`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `cuenta`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `comment_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `cuenta`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`comment_id`) REFERENCES `comentarios`(`id_row`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mangalistuser`
--

CREATE TABLE `mangalistuser` (
  `id_row` INT(11) NOT NULL AUTO_INCREMENT,
  `id_user` INT(11) NOT NULL,
  `id` TEXT NOT NULL,
  `estado` ENUM('Leido', 'Leyendo', 'Favorito', 'Pendiente') NOT NULL,
  PRIMARY KEY (`id_row`),
  FOREIGN KEY (`id_user`) REFERENCES `cuenta`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`id`) REFERENCES `mangas`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mangalistuser`
--

INSERT INTO `mangalistuser` (`id_row`, `id_user`, `id`, `estado`) VALUES
(1, 1, '65a28f47f64a55128b462187', 'Leido'),
(2, 1, '659fcd34f64a55128b4495cd', 'Leyendo'),
(3, 1, '65a36872f64a55128b46f89a', 'Leido'),
(4, 1, '65a6cb94f64a55128b4945c6', 'Pendiente'),
(5, 1, '65a1b615f64a55128b4527eb', 'Pendiente'),
(6, 1, '6595fe7cf64a55128b426abb', 'Favorito'),
(7, 1, '65a1cc06f64a55128b454189', 'Pendiente'),
(8, 1, '65a4e14ef64a55128b482acd', 'Pendiente'),
(9, 1, '65a72deaf64a55128b49a9a8', 'Leido'),
(10, 3, '65a30e8af64a55128b469450', 'Leyendo'),
(11, 1, '65a77dfef64a55128b49f928', 'Pendiente'),
(12, 1, '65a1bfd1f64a55128b453b99', 'Pendiente'),
(13, 1, '6596b08ef64a55128b433fd6', 'Pendiente'),
(14, 7, '65a4e547f64a55128b482de2', 'Favorito'),
(15, 1, '65a30e8af64a55128b469450', 'Leyendo');

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

ALTER TABLE `mangalistuser`
  MODIFY `id_row` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
