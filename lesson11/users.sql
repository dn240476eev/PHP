-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 30 2017 г., 12:03
-- Версия сервера: 5.6.37
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lesson11`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '''''',
  `email` varchar(255) NOT NULL DEFAULT '''''',
  `pass` varchar(255) NOT NULL DEFAULT ''''''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`) VALUES
(5, 'a', 'aaa.ss1@g.cc.com', '$2y$10$uEpZohgGKfazmyX4Yxuuzu/Ggw5qo9d4vw72JVTtTHKRpvfPn.xNC'),
(4, 'q', 'aaa.ss@g.cc.com', '$2y$10$uBVFa8GTGZJSkmiMLs9w/eb4aCSzO5a.FoDh4K1/z77xrm.rQhxY.'),
(15, 'серг', 'serg@gmail.com', '$2y$10$xMKdm6OGdiulpNC8tBtwYupOOhTdCwaI0/2GhYp9O0qxNk0iazdHC'),
(13, 'а', 's@gmail.com', '$2y$10$/HwpRRKjgxr5cNYQt4//.OsdzwZIRFwRMuhTBK69Uu9DOgZ4idMKi'),
(9, 'Елена', 'ee@gmil.com', '$2y$10$ybyJPvL5RLcr1FPO/a633e720IB9d3pq4GyY.cJzKcrpLhspHiPqi'),
(16, 'ев', 'ev@g.cc.com', '$2y$10$XgfDlVkdM9T.ZrBkPomSdOFPAcarSJy/ck/D5EtQYlhgFs3iGa7Aq');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
