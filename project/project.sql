-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 05 2023 г., 13:23
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `title` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `authornames` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imagespost` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `create_at`, `update_at`, `user_id`, `authornames`, `imagespost`) VALUES
(27, 'asdd', 'asd', '2023-07-05 09:58:46', NULL, 9, 'Armen', '1688551126Screenshot 2023-06-17 155036.png'),
(28, 'asdas', 'dasdas', '2023-07-05 10:00:33', NULL, 6, 'Armen', '1688551233Screenshot 2023-06-19 202944.png'),
(29, 'asdasd', 'dasdasdas', '2023-07-05 10:04:02', NULL, 6, 'Armen', '1688551442Screenshot 2023-06-24 111959.png'),
(30, 'dasdasd', 'asdasd', '2023-07-05 10:18:09', NULL, 6, 'Armen', '1688552289Screenshot 2023-06-19 202953.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `age`, `gender`, `address`, `email`, `password`, `avatar`) VALUES
(6, 'Armen', 21, 'male', 'yerevan', 'armen_khachatryan_02@mail.ru', '81dc9bdb52d04dc20036dbd8313ed055', '1520011697093.jpg'),
(7, 'gexam', 21, 'male', 'asdasdasd', 'gexam@mail.ru', '81dc9bdb52d04dc20036dbd8313ed055', 'html.png'),
(8, 'Armen Khacahtryan', 21, 'male', 'Yerenav', 'armen@mail.ru', '81dc9bdb52d04dc20036dbd8313ed055', 'Screenshot 2023-06-24 111959.png'),
(9, 'Armen', 21, 'male', 'yerevan', 'aser@mail.ru', '81dc9bdb52d04dc20036dbd8313ed055', 'Screenshot 2023-06-19 194007.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
