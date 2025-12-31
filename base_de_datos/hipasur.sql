-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-12-2025 a las 06:32:37
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
-- Base de datos: `hipasur`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacens`
--

CREATE TABLE `almacens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `categoria` varchar(255) NOT NULL,
  `unidad_medida` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `almacens`
--

INSERT INTO `almacens` (`id`, `codigo`, `nombre`, `descripcion`, `stock`, `stock_minimo`, `precio_unitario`, `categoria`, `unidad_medida`, `created_at`, `updated_at`) VALUES
(2, '20234', 'Tornillo', 'ñññdkac', 1, 1, 2.00, 'HERRAMIENTAS', 'UNIDADES', '2025-12-29 05:55:35', '2025-12-29 23:22:16'),
(4, '20233563', 'Martillo', 'zfnjkzn', 1, 6, 23.00, 'HERRAMIENTAS', 'UNIDADES', '2025-12-29 06:01:39', '2025-12-30 02:44:05'),
(5, '212102', 'Ladrillo', 'ladrillos para la construcción de un nuevo almacen', 1000, 9, 1.50, 'VÍVERES', 'UNIDADES', '2025-12-30 02:34:33', '2025-12-30 02:42:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fiscalizaciones`
--

CREATE TABLE `fiscalizaciones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `entidad` varchar(255) NOT NULL,
  `inspector` varchar(255) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `resultado` enum('APROBADO','CON OBSERVACIONES','MULTA/SANCIÓN') NOT NULL DEFAULT 'APROBADO',
  `observaciones` text DEFAULT NULL,
  `medidas_adoptadas` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fiscalizaciones`
--

INSERT INTO `fiscalizaciones` (`id`, `fecha`, `entidad`, `inspector`, `motivo`, `resultado`, `observaciones`, `medidas_adoptadas`, `created_at`, `updated_at`) VALUES
(1, '2025-12-18', 'sunat', 'renzo', 'Inspección rutinario', 'APROBADO', NULL, NULL, '2025-12-27 10:20:39', '2025-12-28 23:37:16'),
(2, '2025-12-18', 'sunat', 'renzo', 'Inspección rutinario', 'CON OBSERVACIONES', NULL, NULL, '2025-12-27 10:20:45', '2025-12-27 10:20:45'),
(3, '2025-12-26', 'sunat', 'renzo', 'Inspección rutinario', 'MULTA/SANCIÓN', NULL, NULL, '2025-12-27 10:23:00', '2025-12-27 10:23:00'),
(4, '2025-12-19', 'ANA', 'renzo', 'Inspección rutinario', 'MULTA/SANCIÓN', NULL, NULL, '2025-12-27 10:25:12', '2025-12-27 10:25:12'),
(5, '2025-12-19', 'ANA', 'renzo', 'Inspección rutinario', 'APROBADO', NULL, NULL, '2025-12-27 10:35:24', '2025-12-28 23:37:08'),
(6, '2025-12-23', 'ANA', 'ner', 'Auditoria anual', 'APROBADO', NULL, NULL, '2025-12-27 10:38:25', '2025-12-27 23:03:14'),
(7, '2025-12-23', 'ANA', 'ner', 'Auditoria anual', 'CON OBSERVACIONES', NULL, NULL, '2025-12-27 10:39:16', '2025-12-27 10:39:16'),
(8, '2025-12-11', 'sunat', 'renzo', 'Inspección rutinario', 'CON OBSERVACIONES', NULL, NULL, '2025-12-27 10:44:37', '2025-12-27 10:44:37'),
(9, '2025-12-19', 'sunat', 'renzo', 'Auditoria anual', 'MULTA/SANCIÓN', NULL, NULL, '2025-12-27 22:57:12', '2025-12-27 22:57:12'),
(10, '2025-12-10', 'ANA', 'Deysi', 'Inspección rutinario', 'CON OBSERVACIONES', 'javakj', 'jvksjbn', '2025-12-27 23:03:04', '2025-12-27 23:03:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recurso_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time DEFAULT NULL,
  `turno` varchar(50) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `recurso_id`, `fecha`, `hora_entrada`, `hora_salida`, `turno`, `observaciones`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-12-28', '12:34:00', '20:34:00', 'MAÑANA', 'trabajo en el taller', '2025-12-28 23:36:32', '2025-12-28 23:36:32'),
(2, 1, '2025-12-29', '15:19:00', '23:27:00', 'MAÑANA', NULL, '2025-12-30 01:16:20', '2025-12-30 01:16:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_13_031533_create_secretarias_table', 1),
(5, '2025_10_13_034307_create_recursos_table', 1),
(6, '2025_10_13_034344_create_horarios_table', 1),
(7, '2025_10_13_034403_create_produccions_table', 1),
(8, '2025_10_13_034419_create_almacens_table', 1),
(9, '2025_12_22_195705_create_vehiculos_table', 2),
(10, '2025_12_26_173824_create_vehiculos_table', 3),
(11, '2025_12_26_214738_create_pagos_table', 4),
(12, '2025_12_27_043944_create_seguridad_saluds_table', 5),
(13, '2025_12_27_051001_create_fiscalizacions_table', 6),
(14, '2025_12_27_181728_add_role_to_users_table', 7),
(15, '2025_12_29_011427_create_movimientos_table', 8),
(16, '2025_12_29_144633_add_cargo_and_vehiculo_to_recursos_table', 9),
(17, '2025_12_29_203708_create_proveedors_table', 10),
(18, '2025_12_29_203801_add_bank_fields_to_pagos_table', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `almacen_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `trabajador` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo` enum('ENTRADA','SALIDA') NOT NULL,
  `motivo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `almacen_id`, `user_id`, `trabajador`, `cantidad`, `tipo`, `motivo`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 'Johan', 1, 'ENTRADA', NULL, '2025-12-29 06:58:57', '2025-12-29 06:58:57'),
(2, 2, 3, 'Frida', 9, 'ENTRADA', NULL, '2025-12-29 07:06:07', '2025-12-29 07:06:07'),
(3, 4, 3, 'MARI', 2, 'SALIDA', NULL, '2025-12-29 18:32:18', '2025-12-29 18:32:18'),
(4, 4, 3, 'MARI', 4, 'SALIDA', NULL, '2025-12-29 18:32:34', '2025-12-29 18:32:34'),
(5, 4, 3, 'Junior', 10, 'ENTRADA', 'Sin motivo', '2025-12-29 18:50:03', '2025-12-29 18:50:03'),
(9, 4, 3, 'Frida', 2, 'SALIDA', 'Sin motivo', '2025-12-29 18:59:46', '2025-12-29 18:59:46'),
(10, 2, 3, 'Frida', 3, 'SALIDA', 'Sin motivo', '2025-12-29 19:04:44', '2025-12-29 19:04:44'),
(11, 4, 3, 'Frida', 2, 'SALIDA', 'Sin motivo', '2025-12-29 19:05:09', '2025-12-29 19:05:09'),
(12, 2, 3, 'Frida', 9, 'SALIDA', 'Sin motivo', '2025-12-29 23:22:16', '2025-12-29 23:22:16'),
(13, 4, 3, 'Brizaida Guiblia', 2, 'SALIDA', 'Sin motivo', '2025-12-30 02:43:08', '2025-12-30 02:43:08'),
(14, 4, 3, 'Junior', 2, 'SALIDA', 'Sin motivo', '2025-12-30 02:44:05', '2025-12-30 02:44:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recurso_id` bigint(20) UNSIGNED DEFAULT NULL,
  `proveedor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `nro_operacion` varchar(50) DEFAULT NULL,
  `metodo_pago` varchar(50) DEFAULT NULL,
  `egreso` decimal(10,2) NOT NULL DEFAULT 0.00,
  `ingreso` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `recurso_id`, `proveedor_id`, `fecha`, `estado`, `tipo`, `descripcion`, `monto`, `nro_operacion`, `metodo_pago`, `egreso`, `ingreso`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '2025-12-27', 'EFECTIVO', 'OTROS', 'fhoiajvoasvo', 23.00, NULL, NULL, 0.00, 0.00, '2025-12-27 04:25:27', '2025-12-27 05:16:51'),
(3, NULL, NULL, '2025-12-26', 'CHEQUE', 'COMBUSTIBLE', 'km', 56.07, NULL, NULL, 56.00, 0.00, '2025-12-27 04:31:35', '2025-12-29 02:39:27'),
(4, NULL, NULL, '2026-01-29', 'EFECTIVO', 'COMBUSTIBLE', 'lzgbzñl', 657.00, NULL, NULL, 0.00, 657.00, '2025-12-27 05:44:19', '2025-12-29 04:06:00'),
(5, NULL, NULL, '2025-12-28', 'TRANSFERENCIA', 'PAGO PERSONAL', 'Se pago a Juan', 3200.00, NULL, NULL, 3200.00, 0.00, '2025-12-29 02:17:21', '2025-12-29 02:17:21'),
(7, NULL, NULL, '2025-12-28', 'EFECTIVO', 'COMBUSTIBLE', 'km', 99.00, NULL, NULL, 99.00, 0.00, '2025-12-29 03:51:59', '2025-12-29 03:51:59'),
(8, NULL, NULL, '2025-12-28', 'EFECTIVO', 'COMBUSTIBLE', '<lvm<lkzbz<', 5363.00, NULL, NULL, 0.00, 5363.00, '2025-12-29 04:02:02', '2025-12-29 04:02:02'),
(9, NULL, NULL, '2025-01-08', 'TRANSFERENCIA', 'OTROS', 'VENTA', 3400.00, NULL, NULL, 0.00, 3400.00, '2025-12-29 05:10:54', '2025-12-29 05:17:43'),
(10, NULL, NULL, '2025-12-30', 'EFECTIVO', 'COMBUSTIBLE', 'VENTA', 2397.00, NULL, NULL, 0.00, 2397.00, '2025-12-29 05:17:29', '2025-12-29 05:18:12'),
(11, 2, NULL, '2025-12-29', 'EFECTIVO', 'COMBUSTIBLE', 'lk mskvpa<o', 3200.00, 'kmacl<', 'EFECTIVO', 3200.00, 0.00, '2025-12-30 01:56:49', '2025-12-30 01:56:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('ayemenis123@gmail.com', '$2y$12$XDFuejJQbjq2iUCVTGiSLeeHy04E3EGcREWgBxjIIbga05vZ5Nshm', '2025-12-28 08:26:57'),
('junior123@gmail.com', '$2y$12$m2GzfwMmg/A9UThyzRjMkeRajaHze6AgHrzI4vsvvLNHMt42TiBYO', '2025-12-30 02:57:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `produccions`
--

CREATE TABLE `produccions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `recurso_id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `zona` varchar(255) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `tipo_mineral` varchar(255) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `produccions`
--

INSERT INTO `produccions` (`id`, `recurso_id`, `fecha`, `zona`, `cantidad`, `tipo_mineral`, `observaciones`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-12-29', 'zon norte', 12.00, 'ORO', NULL, '2025-12-28 23:37:40', '2025-12-28 23:37:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ruc` varchar(20) NOT NULL,
  `razon_social` varchar(150) NOT NULL,
  `banco` varchar(50) NOT NULL,
  `nro_cuenta` varchar(30) NOT NULL,
  `tipo_cuenta` varchar(50) NOT NULL,
  `contacto_nombre` varchar(255) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `edad` varchar(100) NOT NULL,
  `DNI` varchar(20) NOT NULL,
  `celular` varchar(100) NOT NULL,
  `fecha_nacimiento` varchar(100) NOT NULL,
  `cuenta` varchar(30) NOT NULL,
  `stc` varchar(30) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `vehiculo_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`id`, `nombres`, `apellidos`, `edad`, `DNI`, `celular`, `fecha_nacimiento`, `cuenta`, `stc`, `departamento`, `provincia`, `cargo`, `vehiculo_id`, `email`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Junior', 'Huaray', '23', '75916655', '6575878', '2026-01-07', '37765195988', '12983572385', 'Puno', 'Puno', NULL, NULL, 'ayemenis123@gmail.com', 1, '2025-12-28 22:22:42', '2025-12-28 22:23:46'),
(2, 'Brizaida', 'Guiblia', '23', '7917561', '944643626', '2025-12-25', '37765195935', '12983572346', 'Puno', 'Puno', 'cocinera', 4, 'Brizaida@gmail.com', 5, '2025-12-30 00:27:51', '2025-12-30 00:27:51'),
(3, 'MARI', 'ccori', '23', '52985', '9434398891', '2025-12-25', '3776512549', '129835734384', 'Puno', 'Puno', 'cocinera', 4, 'melisa@gmail.com', 4, '2025-12-30 00:28:23', '2025-12-30 00:28:23'),
(4, 'Junior', 'mena', '25', '75916645', '952479478', '2025-12-18', '3776519594356', '1298357234233', 'Puno', 'Puno', 'coordinadora', 4, 'bolty@gmail.com', 6, '2025-12-30 00:33:32', '2025-12-30 00:33:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretarias`
--

CREATE TABLE `secretarias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `DNI` varchar(20) NOT NULL,
  `celular` varchar(100) NOT NULL,
  `fecha_nacimiento` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `secretarias`
--

INSERT INTO `secretarias` (`id`, `nombres`, `apellidos`, `DNI`, `celular`, `fecha_nacimiento`, `direccion`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Brizaida Guiblia', 'Ampuero Mena', '76586879', '95558788', '2025-12-17', 'AV. Sol', 5, '2025-12-28 22:06:11', '2025-12-28 22:08:58'),
(2, 'Frida Rosmelia', 'Mena Ccori', '75823375', '954672345', '2000-05-20', 'Jr. Independencia - 436', 2, '2025-12-28 22:11:21', '2025-12-28 22:11:21'),
(3, 'Junior', 'Huaray', '75916655', '944643628', '2025-12-25', 'AV. Sol', 9, '2025-12-29 05:19:29', '2025-12-29 05:19:29'),
(4, 'nayeli', 'mena', '75916645', '944643628', '2025-12-02', 'AV. Sol', 8, '2025-12-29 21:25:00', '2025-12-29 21:25:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguridad_salud`
--

CREATE TABLE `seguridad_salud` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `tipo_registro` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `nivel_riesgo` enum('BAJO','MEDIO','ALTO','CRÍTICO') NOT NULL DEFAULT 'BAJO',
  `descripcion` text NOT NULL,
  `accion_correctiva` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('KkfxUD8cR3p0q4arqVJhmdtHwzfd7DGYMEk6Tu6w', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoid3RUNkdSRllBdUUyQjFFQWw2SlBSaXo1dm1TcHcxSTFVU3dkYVlRZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi92ZWhpY3Vsb3MiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NjcwNTQwNDM7fX0=', 1767054126),
('pI3r0GyM0mlVeg1kepRd6YbetUYvMoPZVs71CxXY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHpVVmc1UWgxWE54UnRXSFpIQjZOWFZVWlhnOFFmekFRUEpTVUxzRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1767072559);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'personal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Junior', 'ayemenis123@gmail.com', NULL, '$2y$12$/phpRv7kLRL81wgXQEXsGO.kJY2y0lPqcx0gEmenRqpimUfJWpqbq', 'PjdNuwCsVeYHPhA9sm8FxDRtRmppob9H1O1yalNMISGsylC7y6WKtQgPZ8cj', '2025-12-23 00:50:45', '2025-12-28 22:23:46', 'personal'),
(2, 'Frida', 'frida@gmail.com', NULL, '$2y$12$hCyb4HvfmCZAofpMXT0j6O3URSfQSv1RfTyP5an3dpXlWkA3GO8Nu', NULL, '2025-12-28 07:37:01', '2025-12-28 07:37:01', 'secretaria'),
(3, 'Johan', 'johan@gmail.com', NULL, '$2y$12$eCKxAzIxJB5ygCF8o4IXi.f/PD0QUxhFVA51zXdLTaf7iaQ5LSHfS', NULL, '2025-12-28 08:06:51', '2025-12-28 08:06:51', 'administrador'),
(4, 'MARI', 'melisa@gmail.com', NULL, '$2y$12$qnoz/qgWRjI.gidXNnDSmOJCA4j935.qUDHun583AVZfpjanEPgyC', NULL, '2025-12-28 20:20:58', '2025-12-28 20:20:58', 'personal'),
(5, 'Brizaida Guiblia', 'Brizaida@gmail.com', NULL, '$2y$12$G0gEfNb4ljNtI7Q5xXAKo.TNZzfuDmo3iaMZwgRQ98hbAxTlYm80a', NULL, '2025-12-28 21:23:24', '2025-12-28 23:29:36', 'personal'),
(6, 'bolty', 'bolty@gmail.com', NULL, '$2y$12$AgYhD3i04D64dyXBXJ2YDOb8onG.3QRFVJJdOR2rnNrm7nQWzUsB6', NULL, '2025-12-28 22:59:13', '2025-12-28 23:21:12', 'personal'),
(7, 'MARI', 'junior123@gmail.com', NULL, '$2y$12$2M8ZHZ.D88G4pJPA6bLqdu7Ynv2N.xcmmaOyEkmnCNQPtzX4v/gxi', NULL, '2025-12-28 23:04:51', '2025-12-28 23:29:46', 'personal'),
(8, 'MENA', 'ayemenis12@gmail.com', NULL, '$2y$12$7438iT3E0PqPWflNkh2W8uTa9g0zuZSqHpKocriVlnfkTvQe2aisK', NULL, '2025-12-28 23:08:14', '2025-12-28 23:08:14', 'secretaria'),
(9, 'yemi', 'yemi@gmail.com', NULL, '$2y$12$sSfgToNb7Jxl4QVcDdPihOxhMnZWf93o1t3ujo837S1Rl9mJ2Br/2', NULL, '2025-12-28 23:14:53', '2025-12-28 23:21:03', 'encargado'),
(10, 'males', 'male@gmail.com', NULL, '$2y$12$JAkKjF6hz7MsS2cnAoRLxuHCWdt9aXy72jIImOuniwDMOwuJMtCY.', NULL, '2025-12-29 19:17:55', '2025-12-29 19:18:10', 'encargado'),
(11, 'Administrador', 'administrador@gmail.com', NULL, '$2y$12$QihEcrIptJd/zDeVWORF2.MYa4RIcgGCJmg16k71WVF.HVXb3fzQe', NULL, '2025-12-30 03:45:20', '2025-12-30 03:54:33', 'administrador'),
(12, 'Secretaria', 'secretaria@gmail.com', NULL, '$2y$12$Yq0Af.wDKvHAEKh0as5bs.UTZQx7K7F9r6dEoW1Nk.KaXxjwkdrqC', NULL, '2025-12-30 03:55:18', '2025-12-30 03:56:43', 'secretaria'),
(13, 'Encargado', 'encargado@gmail.com', NULL, '$2y$12$CyQ3VDP3kIRWmHjBlCJc8.xjqY.xSCPsQR9BXaxCvt6/fkxcgqEGK', NULL, '2025-12-30 03:58:31', '2025-12-30 03:58:48', 'encargado'),
(14, 'Personal', 'personal@gmail.com', NULL, '$2y$12$e2XzvOugO0kFxGf9SSfHm.N5TrzWZXFBIZKHWJ7kj3fT8CBTrPtgu', NULL, '2025-12-30 03:59:39', '2025-12-30 04:02:35', 'personal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo_interno` varchar(50) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `marca` varchar(100) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `placa` varchar(20) DEFAULT NULL,
  `horometro_actual` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado` enum('OPERATIVO','MANTENIMIENTO','FUERA_SERVICIO') NOT NULL DEFAULT 'OPERATIVO',
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `codigo_interno`, `tipo`, `marca`, `modelo`, `placa`, `horometro_actual`, `estado`, `observaciones`, `created_at`, `updated_at`) VALUES
(1, 'wdmoiw', 'CAMIONETA', 'Toyota', 'kzjcnak', 'klssdvak', 456.00, 'MANTENIMIENTO', 'lkmlkm', '2025-12-27 02:10:08', '2025-12-27 05:41:21'),
(2, '7649', 'CAMIONETA', 'linux', 'afr', 'kfw23', 230.00, 'FUERA_SERVICIO', 'kmvsglkvm', '2025-12-27 02:10:48', '2025-12-27 02:10:48'),
(4, 'kkjnkj', 'CARGADOR FRONTAL', 'linux', 'afr', 'klssdvaoj', 789.00, 'OPERATIVO', NULL, '2025-12-27 05:57:27', '2025-12-27 05:57:27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacens`
--
ALTER TABLE `almacens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `almacens_codigo_unique` (`codigo`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `fiscalizaciones`
--
ALTER TABLE `fiscalizaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horarios_recurso_id_foreign` (`recurso_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movimientos_almacen_id_foreign` (`almacen_id`),
  ADD KEY `movimientos_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagos_recurso_id_foreign` (`recurso_id`),
  ADD KEY `pagos_proveedor_id_foreign` (`proveedor_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `produccions`
--
ALTER TABLE `produccions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produccions_recurso_id_foreign` (`recurso_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `proveedores_ruc_unique` (`ruc`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `recursos_dni_unique` (`DNI`),
  ADD UNIQUE KEY `recursos_cuenta_unique` (`cuenta`),
  ADD UNIQUE KEY `recursos_stc_unique` (`stc`),
  ADD UNIQUE KEY `recursos_email_unique` (`email`),
  ADD KEY `recursos_user_id_foreign` (`user_id`),
  ADD KEY `recursos_vehiculo_id_foreign` (`vehiculo_id`);

--
-- Indices de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `secretarias_dni_unique` (`DNI`),
  ADD KEY `secretarias_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `seguridad_salud`
--
ALTER TABLE `seguridad_salud`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehiculos_codigo_interno_unique` (`codigo_interno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacens`
--
ALTER TABLE `almacens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fiscalizaciones`
--
ALTER TABLE `fiscalizaciones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `produccions`
--
ALTER TABLE `produccions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `seguridad_salud`
--
ALTER TABLE `seguridad_salud`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_recurso_id_foreign` FOREIGN KEY (`recurso_id`) REFERENCES `recursos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_almacen_id_foreign` FOREIGN KEY (`almacen_id`) REFERENCES `almacens` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movimientos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pagos_recurso_id_foreign` FOREIGN KEY (`recurso_id`) REFERENCES `recursos` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `produccions`
--
ALTER TABLE `produccions`
  ADD CONSTRAINT `produccions_recurso_id_foreign` FOREIGN KEY (`recurso_id`) REFERENCES `recursos` (`id`);

--
-- Filtros para la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD CONSTRAINT `recursos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `recursos_vehiculo_id_foreign` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `secretarias`
--
ALTER TABLE `secretarias`
  ADD CONSTRAINT `secretarias_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
