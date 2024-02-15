-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 15 2024 г., 16:22
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `happycar`
--
CREATE DATABASE IF NOT EXISTS `happycar` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `happycar`;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int NOT NULL,
  `category` varchar(256) NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category`, `status`) VALUES
(1, 'Двигатель', 'Normal');

-- --------------------------------------------------------

--
-- Структура таблицы `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id` int NOT NULL,
  `position` varchar(64) NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `positions`
--

INSERT INTO `positions` (`id`, `position`, `status`) VALUES
(1, 'Владелец', 'Normal'),
(2, 'Механик', 'Normal');

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests` (
  `id` int NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `phoneNumber` varchar(16) NOT NULL,
  `email` varchar(128) NOT NULL,
  `carMark` varchar(64) NOT NULL,
  `carYear` year NOT NULL,
  `status` varchar(64) NOT NULL,
  `repairDate` datetime DEFAULT NULL,
  `problem` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id`, `firstName`, `lastName`, `phoneNumber`, `email`, `carMark`, `carYear`, `status`, `repairDate`, `problem`) VALUES
(1, 'Фома', 'Кактам', '238675978', '', 'Nissan', 2015, 'Pending', NULL, 'Не заводится');

-- --------------------------------------------------------

--
-- Структура таблицы `requests_services`
--

DROP TABLE IF EXISTS `requests_services`;
CREATE TABLE `requests_services` (
  `requestId` int NOT NULL,
  `serviceId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `requests_services`
--

INSERT INTO `requests_services` (`requestId`, `serviceId`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `requests_users`
--

DROP TABLE IF EXISTS `requests_users`;
CREATE TABLE `requests_users` (
  `requestId` int NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `requests_users`
--

INSERT INTO `requests_users` (`requestId`, `userId`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int NOT NULL,
  `service` varchar(128) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `categoryId` int NOT NULL,
  `status` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `service`, `price`, `categoryId`, `status`) VALUES
(1, 'Ремонт двигателя', '5000', 1, 'Normal');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstName` varchar(64) NOT NULL,
  `lastName` varchar(64) NOT NULL,
  `phoneNumber` varchar(16) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `positionId` int NOT NULL,
  `status` varchar(64) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `phoneNumber`, `login`, `password`, `email`, `positionId`, `status`, `isAdmin`) VALUES
(1, 'Антон', 'Галахов', '123456', 'admin', '$2y$10$/Cv2ApfVGrCvCk1I1n8tFOqDguAhEHZIqkqhyMC1jvIpVYzO/E2Ee', '', 1, 'Normal', 1),
(2, 'Иван', 'Иванов', '789012345', 'mechanic', '$2y$10$5zYzwygToDsb2m0NtuchU.y4dHIH7K8t40PZ3VpgZsqsz0QdNbx.S', NULL, 2, 'Normal', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `requests_services`
--
ALTER TABLE `requests_services`
  ADD KEY `requestId` (`requestId`),
  ADD KEY `serviceId` (`serviceId`);

--
-- Индексы таблицы `requests_users`
--
ALTER TABLE `requests_users`
  ADD KEY `requestId` (`requestId`),
  ADD KEY `userId` (`userId`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `positionId` (`positionId`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `requests_services`
--
ALTER TABLE `requests_services`
  ADD CONSTRAINT `requests_services_ibfk_1` FOREIGN KEY (`requestId`) REFERENCES `requests` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `requests_services_ibfk_2` FOREIGN KEY (`serviceId`) REFERENCES `services` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `requests_users`
--
ALTER TABLE `requests_users`
  ADD CONSTRAINT `requests_users_ibfk_1` FOREIGN KEY (`requestId`) REFERENCES `requests` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `requests_users_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`positionId`) REFERENCES `positions` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
