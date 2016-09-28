-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Сен 28 2016 г., 13:15
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `banzai`
--

-- --------------------------------------------------------

--
-- Структура таблицы `wp_topic_custom_quotes`
--

CREATE TABLE IF NOT EXISTS `wp_topic_custom_quotes` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `note` text NOT NULL,
  `author` int(11) NOT NULL,
  `authorName` text NOT NULL,
  `post` int(11) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `sentenceId` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `wp_topic_custom_quotes`
--

INSERT INTO `wp_topic_custom_quotes` (`id`, `note`, `author`, `authorName`, `post`, `state`, `sentenceId`) VALUES
(2, 'my note', 1, 'admin', 77, 0, 3936),
(3, 'мое мнение', 1, 'admin', 77, 0, 17393),
(4, '3345', 1, 'admin', 77, 0, 42272),
(5, '3345', 1, 'admin', 77, 0, 42272);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
