-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 24-03-2026 a las 09:54:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `entregable1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cabello', '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(2, 'Rostro', '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(3, 'Cuerpo', '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(4, 'Uñas', '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(5, 'Cejas y pestañas', '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(6, 'Maquillaje', '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(7, 'Fragancias', '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(8, 'Accesorios', '2026-03-24 13:50:19', '2026-03-24 13:50:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `quantity`, `price`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 3, 55000, 1, 6, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(2, 1, 95000, 1, 31, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(3, 4, 120000, 1, 34, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(4, 3, 35000, 2, 12, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(5, 1, 85000, 2, 35, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(6, 3, 220000, 2, 38, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(7, 2, 48000, 3, 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(8, 3, 28000, 3, 29, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(9, 2, 45000, 3, 40, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(10, 2, 35000, 4, 12, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(11, 4, 18000, 4, 16, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(12, 4, 55000, 4, 18, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(13, 2, 32000, 4, 25, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(14, 4, 88000, 4, 36, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(15, 3, 35000, 5, 1, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(16, 1, 68000, 5, 26, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(17, 4, 195000, 5, 37, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(18, 1, 75000, 5, 39, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(19, 3, 120000, 6, 13, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(20, 1, 85000, 6, 24, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(21, 4, 68000, 6, 26, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(22, 2, 220000, 6, 38, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(23, 2, 45000, 6, 40, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(24, 4, 42000, 7, 30, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(25, 1, 95000, 8, 31, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(26, 3, 180000, 9, 4, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(27, 4, 90000, 9, 8, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(28, 3, 55000, 9, 18, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(29, 4, 75000, 9, 27, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(30, 3, 65000, 9, 32, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(31, 4, 48000, 10, 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(32, 4, 90000, 10, 8, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(33, 3, 35000, 10, 12, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(34, 3, 18000, 10, 16, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(35, 2, 32000, 10, 25, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(36, 3, 55000, 11, 6, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(37, 3, 68000, 11, 26, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(38, 4, 75000, 11, 27, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(39, 3, 120000, 11, 34, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(40, 1, 45000, 11, 40, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(41, 1, 180000, 12, 4, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(42, 2, 55000, 12, 6, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(43, 1, 18000, 12, 16, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(44, 2, 35000, 13, 1, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(45, 1, 42000, 13, 11, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(46, 3, 22000, 13, 17, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(47, 4, 220000, 13, 38, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(48, 4, 120000, 14, 13, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(49, 3, 25000, 15, 3, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(50, 4, 29000, 15, 5, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(51, 2, 22000, 15, 17, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(52, 4, 28000, 15, 29, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(53, 3, 35000, 16, 1, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(54, 2, 90000, 16, 8, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(55, 2, 28000, 16, 29, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(56, 2, 42000, 16, 30, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(57, 4, 120000, 16, 34, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(58, 1, 55000, 17, 6, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(59, 2, 150000, 17, 28, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(60, 2, 95000, 17, 31, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(61, 4, 75000, 17, 39, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(62, 4, 25000, 18, 3, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(63, 1, 48000, 18, 15, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(64, 4, 22000, 18, 17, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(65, 4, 35000, 19, 12, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(66, 3, 55000, 19, 18, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(67, 2, 25000, 19, 23, '2026-03-24 13:50:20', '2026-03-24 13:50:20'),
(68, 4, 48000, 20, 15, '2026-03-24 13:50:20', '2026-03-24 13:50:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `shipped` tinyint(1) NOT NULL DEFAULT 0,
  `method_of_payment` enum('card','cash','bank') NOT NULL DEFAULT 'cash',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `total`, `date`, `paid`, `shipped`, `method_of_payment`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 740000.00, '2007-08-13', 0, 1, 'cash', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(2, 850000.00, '1984-02-01', 1, 0, 'bank', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(3, 270000.00, '1992-05-04', 1, 0, 'cash', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(4, 778000.00, '2008-08-15', 0, 1, 'cash', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(5, 1028000.00, '2016-09-03', 0, 1, 'bank', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(6, 1247000.00, '2001-11-16', 1, 1, 'card', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(7, 168000.00, '1975-05-07', 0, 1, 'bank', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(8, 95000.00, '1996-04-23', 1, 1, 'card', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(9, 1560000.00, '1976-01-11', 1, 1, 'card', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(10, 775000.00, '1998-03-20', 1, 1, 'cash', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(11, 1074000.00, '2017-02-10', 1, 1, 'card', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(12, 308000.00, '1987-05-01', 0, 1, 'bank', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(13, 1058000.00, '1977-10-28', 0, 1, 'card', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(14, 480000.00, '1995-08-01', 0, 0, 'cash', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(15, 347000.00, '1980-03-04', 1, 0, 'bank', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(16, 905000.00, '2009-05-17', 1, 0, 'cash', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:20'),
(17, 845000.00, '1972-12-17', 0, 1, 'bank', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:20'),
(18, 236000.00, '1990-11-03', 1, 0, 'card', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:20'),
(19, 355000.00, '2004-11-16', 1, 0, 'card', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:20'),
(20, 192000.00, '1978-07-31', 0, 0, 'cash', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `available` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `keyword` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`keyword`)),
  `type` enum('article','service') NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `available`, `price`, `brand`, `keyword`, `type`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Champú Hidratante Argan', 'products/default.png', 'Champú con aceite de argán para cabello seco y dañado.', 1, 35000, 'VeneKa Beauty', '[\"Cabello\",\"belleza\",\"cuidado\"]', 'article', 1, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(2, 'Mascarilla Nutritiva Keratina', 'products/default.png', 'Tratamiento profundo con keratina para cabello liso y brillante.', 1, 48000, 'VeneKa Beauty', '[\"Cabello\",\"belleza\",\"cuidado\"]', 'article', 1, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(3, 'Tinte Castaño Oscuro N°3', 'products/default.png', 'Tinte permanente con cobertura total de canas.', 1, 25000, 'VeneKa Beauty', '[\"Cabello\",\"belleza\",\"cuidado\"]', 'article', 1, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(4, 'Alisado Brasileño', 'products/default.png', 'Servicio de alisado progresivo con keratina brasileña.', 1, 180000, 'VeneKa Beauty', '[\"Cabello\",\"belleza\",\"cuidado\"]', 'service', 1, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(5, 'Serum Reparador Puntas', 'products/default.png', 'Serum sin enjuague para reparar puntas abiertas.', 1, 29000, 'VeneKa Beauty', '[\"Cabello\",\"belleza\",\"cuidado\"]', 'article', 1, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(6, 'Crema Hidratante SPF 50', 'products/default.png', 'Crema facial con protección solar para uso diario.', 1, 55000, 'VeneKa Beauty', '[\"Rostro\",\"belleza\",\"cuidado\"]', 'article', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(7, 'Sérum Vitamina C', 'products/default.png', 'Sérum iluminador con vitamina C para piel opaca.', 1, 72000, 'VeneKa Beauty', '[\"Rostro\",\"belleza\",\"cuidado\"]', 'article', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(8, 'Limpieza Facial Profunda', 'products/default.png', 'Servicio de limpieza facial con vapor y extracción.', 1, 90000, 'VeneKa Beauty', '[\"Rostro\",\"belleza\",\"cuidado\"]', 'service', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(9, 'Exfoliante Facial Papaya', 'products/default.png', 'Exfoliante suave con enzimas de papaya para piel luminosa.', 1, 38000, 'VeneKa Beauty', '[\"Rostro\",\"belleza\",\"cuidado\"]', 'article', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(10, 'Contorno de Ojos Retinol', 'products/default.png', 'Crema contorno de ojos con retinol para reducir ojeras.', 1, 65000, 'VeneKa Beauty', '[\"Rostro\",\"belleza\",\"cuidado\"]', 'article', 2, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(11, 'Crema Corporal Manteca Karité', 'products/default.png', 'Hidratante corporal con manteca de karité para piel seca.', 1, 42000, 'VeneKa Beauty', '[\"Cuerpo\",\"belleza\",\"cuidado\"]', 'article', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(12, 'Exfoliante Corporal Café', 'products/default.png', 'Exfoliante natural con café y aceite de coco.', 1, 35000, 'VeneKa Beauty', '[\"Cuerpo\",\"belleza\",\"cuidado\"]', 'article', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(13, 'Masaje Relajante', 'products/default.png', 'Servicio de masaje corporal con aceites esenciales.', 1, 120000, 'VeneKa Beauty', '[\"Cuerpo\",\"belleza\",\"cuidado\"]', 'service', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(14, 'Aceite Corporal Rosa Mosqueta', 'products/default.png', 'Aceite seco de rosa mosqueta para piel radiante.', 1, 58000, 'VeneKa Beauty', '[\"Cuerpo\",\"belleza\",\"cuidado\"]', 'article', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(15, 'Loción Reafirmante Colágeno', 'products/default.png', 'Loción corporal reafirmante con colágeno y elastina.', 1, 48000, 'VeneKa Beauty', '[\"Cuerpo\",\"belleza\",\"cuidado\"]', 'article', 3, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(16, 'Esmalte Gel Rojo Pasión', 'products/default.png', 'Esmalte semipermanente de larga duración color rojo.', 1, 18000, 'VeneKa Beauty', '[\"U\\u00f1as\",\"belleza\",\"cuidado\"]', 'article', 4, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(17, 'Kit Lima y Pulidora', 'products/default.png', 'Set de limas profesionales para manicura en casa.', 1, 22000, 'VeneKa Beauty', '[\"U\\u00f1as\",\"belleza\",\"cuidado\"]', 'article', 4, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(18, 'Manicura Spa', 'products/default.png', 'Servicio completo de manicura con exfoliación e hidratación.', 1, 55000, 'VeneKa Beauty', '[\"U\\u00f1as\",\"belleza\",\"cuidado\"]', 'service', 4, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(19, 'Pedicura Completa', 'products/default.png', 'Servicio de pedicura con esmaltado y masaje de pies.', 1, 65000, 'VeneKa Beauty', '[\"U\\u00f1as\",\"belleza\",\"cuidado\"]', 'service', 4, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(20, 'Aceite Cutículas Lavanda', 'products/default.png', 'Aceite nutritivo para cutículas con aroma a lavanda.', 1, 15000, 'VeneKa Beauty', '[\"U\\u00f1as\",\"belleza\",\"cuidado\"]', 'article', 4, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(21, 'Tinte Cejas Marrón', 'products/default.png', 'Tinte semipermanente para cejas color marrón natural.', 1, 12000, 'VeneKa Beauty', '[\"Cejas y pesta\\u00f1as\",\"belleza\",\"cuidado\"]', 'article', 5, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(22, 'Lifting Pestañas', 'products/default.png', 'Servicio de lifting y tinte de pestañas.', 1, 80000, 'VeneKa Beauty', '[\"Cejas y pesta\\u00f1as\",\"belleza\",\"cuidado\"]', 'service', 5, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(23, 'Depilación Cejas Hilo', 'products/default.png', 'Servicio de depilación de cejas con hilo.', 1, 25000, 'VeneKa Beauty', '[\"Cejas y pesta\\u00f1as\",\"belleza\",\"cuidado\"]', 'service', 5, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(24, 'Sérum Crecimiento Pestañas', 'products/default.png', 'Sérum para estimular el crecimiento y densidad de pestañas.', 1, 85000, 'VeneKa Beauty', '[\"Cejas y pesta\\u00f1as\",\"belleza\",\"cuidado\"]', 'article', 5, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(25, 'Kit Modelado Cejas', 'products/default.png', 'Kit completo para modelar y definir cejas en casa.', 1, 32000, 'VeneKa Beauty', '[\"Cejas y pesta\\u00f1as\",\"belleza\",\"cuidado\"]', 'article', 5, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(26, 'Base Fluida Cobertura Total', 'products/default.png', 'Base de maquillaje de larga duración con cobertura total.', 1, 68000, 'VeneKa Beauty', '[\"Maquillaje\",\"belleza\",\"cuidado\"]', 'article', 6, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(27, 'Paleta Sombras Nude', 'products/default.png', 'Paleta de 12 sombras en tonos nude y tierra.', 1, 75000, 'VeneKa Beauty', '[\"Maquillaje\",\"belleza\",\"cuidado\"]', 'article', 6, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(28, 'Maquillaje Profesional Evento', 'products/default.png', 'Servicio de maquillaje profesional para eventos especiales.', 1, 150000, 'VeneKa Beauty', '[\"Maquillaje\",\"belleza\",\"cuidado\"]', 'service', 6, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(29, 'Labial Mate Terciopelo', 'products/default.png', 'Labial líquido de larga duración acabado mate.', 1, 28000, 'VeneKa Beauty', '[\"Maquillaje\",\"belleza\",\"cuidado\"]', 'article', 6, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(30, 'Corrector Iluminador', 'products/default.png', 'Corrector de ojeras con efecto iluminador natural.', 1, 42000, 'VeneKa Beauty', '[\"Maquillaje\",\"belleza\",\"cuidado\"]', 'article', 6, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(31, 'Perfume Rosa & Jazmín 50ml', 'products/default.png', 'Eau de parfum floral con notas de rosa y jazmín.', 1, 95000, 'VeneKa Beauty', '[\"Fragancias\",\"belleza\",\"cuidado\"]', 'article', 7, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(32, 'Colonia Fresca Citrus 100ml', 'products/default.png', 'Colonia unisex con notas cítricas y frescas.', 1, 65000, 'VeneKa Beauty', '[\"Fragancias\",\"belleza\",\"cuidado\"]', 'article', 7, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(33, 'Body Splash Coco & Vainilla', 'products/default.png', 'Splash corporal dulce con notas de coco y vainilla.', 1, 32000, 'VeneKa Beauty', '[\"Fragancias\",\"belleza\",\"cuidado\"]', 'article', 7, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(34, 'Perfume Oud Noir 30ml', 'products/default.png', 'Eau de parfum oriental intenso con notas de oud.', 1, 120000, 'VeneKa Beauty', '[\"Fragancias\",\"belleza\",\"cuidado\"]', 'article', 7, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(35, 'Set Fragancias Miniatura', 'products/default.png', 'Set de 5 miniaturas de los perfumes más vendidos.', 1, 85000, 'VeneKa Beauty', '[\"Fragancias\",\"belleza\",\"cuidado\"]', 'article', 7, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(36, 'Set Brochas Maquillaje x12', 'products/default.png', 'Set profesional de 12 brochas para maquillaje completo.', 1, 88000, 'VeneKa Beauty', '[\"Accesorios\",\"belleza\",\"cuidado\"]', 'article', 8, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(37, 'Rizador Automático Cerámico', 'products/default.png', 'Rizador automático con placa cerámica para todo tipo de cabello.', 1, 195000, 'VeneKa Beauty', '[\"Accesorios\",\"belleza\",\"cuidado\"]', 'article', 8, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(38, 'Plancha Cabello Titanio', 'products/default.png', 'Plancha profesional con placas de titanio y control de temperatura.', 1, 220000, 'VeneKa Beauty', '[\"Accesorios\",\"belleza\",\"cuidado\"]', 'article', 8, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(39, 'Kit Cuidado Facial Hombre', 'products/default.png', 'Kit completo de limpieza e hidratación facial para hombres.', 1, 75000, 'VeneKa Beauty', '[\"Accesorios\",\"belleza\",\"cuidado\"]', 'article', 8, '2026-03-24 13:50:19', '2026-03-24 13:50:19'),
(40, 'Neceser Organizador Maquillaje', 'products/default.png', 'Neceser transparente con compartimentos para organizar maquillaje.', 1, 45000, 'VeneKa Beauty', '[\"Accesorios\",\"belleza\",\"cuidado\"]', 'article', 8, '2026-03-24 13:50:19', '2026-03-24 13:50:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL,
  `comment` text NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`id`, `score`, `comment`, `product_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 4, 'Excelente producto, lo recomiendo totalmente.', 1, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(2, 1, 'Buen producto pero el envío tardó un poco.', 2, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(3, 2, 'Relación calidad-precio muy buena.', 5, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(4, 2, 'No me convenció del todo, esperaba más.', 7, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(5, 1, 'El resultado superó mis expectativas.', 9, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(6, 3, 'Relación calidad-precio muy buena.', 20, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(7, 3, 'Buen producto pero el envío tardó un poco.', 25, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(8, 3, 'Relación calidad-precio muy buena.', 26, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(9, 2, 'Relación calidad-precio muy buena.', 27, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(10, 1, 'Relación calidad-precio muy buena.', 29, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(11, 1, 'Buen producto pero el envío tardó un poco.', 32, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(12, 1, 'Increíble resultado desde la primera aplicación.', 33, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(13, 1, 'Increíble resultado desde la primera aplicación.', 34, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(14, 1, 'El resultado superó mis expectativas.', 37, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(15, 5, 'El resultado superó mis expectativas.', 38, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 2),
(16, 1, 'Increíble resultado desde la primera aplicación.', 2, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(17, 1, 'Muy buena calidad, quedé satisfecha.', 5, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(18, 5, 'Funciona muy bien para mi tipo de piel.', 7, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(19, 2, 'Buen producto pero el envío tardó un poco.', 8, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(20, 5, 'No me convenció del todo, esperaba más.', 9, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(21, 4, 'No me convenció del todo, esperaba más.', 11, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(22, 2, 'No me convenció del todo, esperaba más.', 12, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(23, 4, 'Lo uso diariamente y mi piel ha mejorado mucho.', 14, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(24, 5, 'Buen producto pero el envío tardó un poco.', 15, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(25, 5, 'Buen producto pero el envío tardó un poco.', 23, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(26, 5, 'No me convenció del todo, esperaba más.', 26, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(27, 5, 'Excelente producto, lo recomiendo totalmente.', 30, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(28, 1, 'Increíble resultado desde la primera aplicación.', 35, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(29, 5, 'Relación calidad-precio muy buena.', 36, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3),
(30, 4, 'Increíble resultado desde la primera aplicación.', 37, '2026-03-24 13:50:20', '2026-03-24 13:50:20', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `address`, `phoneNumber`, `role`) VALUES
(1, 'Admin VeneKa', 'admin@veneka.com', '2026-03-24 13:50:18', '$2y$12$X3uaVB2sRGIzUmSgxMPTG.kxi28OAwC5oo4DNJKr/vQFZWw2kt0ti', 'WSoOc19D2q', '2026-03-24 13:50:19', '2026-03-24 13:50:19', 'Calle 1 # 2-3, Bogotá', '3001234567', 'admin'),
(2, 'María López', 'maria@veneka.com', '2026-03-24 13:50:19', '$2y$12$X3uaVB2sRGIzUmSgxMPTG.kxi28OAwC5oo4DNJKr/vQFZWw2kt0ti', 'zKxRhj9JSl', '2026-03-24 13:50:19', '2026-03-24 13:50:19', 'Carrera 5 # 10-20, Medellín', '3109876543', 'client'),
(3, 'Laura Martínez', 'laura@veneka.com', '2026-03-24 13:50:19', '$2y$12$X3uaVB2sRGIzUmSgxMPTG.kxi28OAwC5oo4DNJKr/vQFZWw2kt0ti', 'RUFbxCKZMX', '2026-03-24 13:50:19', '2026-03-24 13:50:19', 'Calle 80 # 45-12, Cali', '3205551234', 'client');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_order_id_foreign` (`order_id`),
  ADD KEY `items_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
