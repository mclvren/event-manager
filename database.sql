-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 06 2018 г., 22:14
-- Версия сервера: 5.7.22-0ubuntu0.16.04.1
-- Версия PHP: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `c0events`
--

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` text NOT NULL,
  `creator` int(11) NOT NULL,
  `description` text NOT NULL,
  `finished` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `fl` int(11) DEFAULT NULL,
  `fl_type` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `date`, `name`, `creator`, `description`, `finished`, `address`, `fl`, `fl_type`) VALUES
(7, '2017-12-07', 'Региональный чемпионат Worldskills Russia в ЧР / Веб-дизайн', 8, 'Региональный (открытый) чемпионат Молодые профессионалы (Worldskills Russia) в Чувашской Республике', 1, 'проспект Ивана Яковлева, 20, Чебоксары', 1, 'rar'),
(8, '2018-04-27', 'Региональный этап VIII Всероссийского чемпионата по компьютерному многоборью среди пенсионеров', 8, 'Региональный этап VIII Всероссийского чемпионата по компьютерному многоборью среди пенсионеров', 1, '', 0, NULL),
(9, '2018-03-15', 'Всероссийская олимпиада профессионального мастерства по специальностям СПО в 2018 году по УГ специальностей 09.00.00 Информатика и вычислительная техника', 8, 'Региональный этап Всероссийской олимпиады профессионального мастерства обучающихся по специальностям среднего профессионального образования в 2018 году по УГ специальностей 09.00.00 Информатика и вычислительная техника', 1, '', 0, NULL),
(10, '2018-06-06', 'Тестовое мероприятие', 1, '', 0, '', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `usrid` int(11) NOT NULL,
  `evid` int(11) NOT NULL,
  `point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `members`
--

INSERT INTO `members` (`id`, `usrid`, `evid`, `point`) VALUES
(10, 9, 7, 1),
(11, 10, 7, 2),
(12, 1, 7, 3),
(13, 11, 7, 4),
(14, 12, 7, 5),
(15, 13, 8, 1),
(16, 14, 8, 2),
(17, 15, 8, 3),
(18, 16, 9, 1),
(19, 17, 9, 2),
(20, 18, 9, 3),
(21, 1, 10, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` mediumint(9) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `name` text NOT NULL,
  `surname` text NOT NULL,
  `patr` varchar(15) NOT NULL,
  `iscreator` int(11) NOT NULL,
  `img` int(11) NOT NULL,
  `img_type` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `email`, `name`, `surname`, `patr`, `iscreator`, `img`, `img_type`) VALUES
(1, 'mclvren', 'ee93fd70db1e06537f39494b2d6200b1', '5b143ccf7a91f', 'aiv-n@ya.ru', 'Андрей', 'Ильин', 'Владимирович', 1, 0, NULL),
(8, 'ignateva', '10d8a4bebfc027ca7ca3cd08076d49a1', '5b16ca81ec745', 'no-reply@event-manager.ga', 'Татьяна', 'Игнатьева', 'Александровна', 1, 0, NULL),
(9, 'd-denis', '', '', '', 'Денис', 'Димитриев', 'Андреевич', 0, 0, NULL),
(10, 'd-dima', '', '', '', 'Дмитрий', 'Димитриев', 'Андреевич', 0, 0, NULL),
(11, 'egorov-d', '', '', '', 'Даниил', 'Егоров', 'Валерьевич', 0, 0, NULL),
(12, 'a-roman', '', '', '', 'Роман', 'Андреев', 'Валерьевич', 0, 0, NULL),
(13, '45', '', '', '', 'Татьяна', 'Душенькина', 'Александровна', 0, 0, NULL),
(14, '02', '', '', '', 'Любовь', 'Тюрикова', 'Александровна', 0, 0, NULL),
(15, '63', '', '', '', 'Елена', 'Аникина', 'Юрьевна', 0, 0, NULL),
(16, '20', '', '', '', 'Артем', 'Якимов', 'Александрович', 0, 0, NULL),
(17, '11', '', '', '', 'Сергей', 'Тирейкин', 'Игоревич', 0, 0, NULL),
(18, '3', '', '', '', 'Дарья', 'Баринова', 'Александровна', 0, 0, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
