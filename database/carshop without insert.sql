-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 25 2021 г., 02:09
-- Версия сервера: 10.4.14-MariaDB
-- Версия PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `carshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `adm_ID` int(6) NOT NULL,
  `adm_UNI` int(6) NOT NULL,
  `adm_LOG` varchar(35) NOT NULL,
  `adm_PASS` varchar(35) NOT NULL,
  `adm_ROLE` enum('Main','Moder') NOT NULL DEFAULT 'Moder'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `auto`
--

CREATE TABLE `auto` (
  `a_ID` int(10) NOT NULL,
  `a_color` varchar(45) NOT NULL,
  `c_ID` int(11) NOT NULL,
  `a_year` year(4) NOT NULL,
  `a_model` int(10) NOT NULL,
  `a_count` int(5) DEFAULT NULL,
  `t_price` int(10) DEFAULT NULL,
  `visible` enum('Enabled','Disabled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `a_equipment`
--

CREATE TABLE `a_equipment` (
  `e_ID` int(10) NOT NULL,
  `e_name` varchar(20) NOT NULL,
  `m_seat` enum('нету','спереди','сзади','комбинированое') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'нету',
  `m_steklopod` enum('нету','есть') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'нету',
  `m_climatctrl` enum('нету','есть') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'нету',
  `m_security` enum('сигнализация','gsm-сигнализация') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'сигнализация',
  `m_cruisctrl` enum('нету','есть') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'нету',
  `m_esp` enum('нету','есть') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'нету',
  `m_airbags` enum('нету','спереди','комбинированое') CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'нету'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `blacklist`
--

CREATE TABLE `blacklist` (
  `b_ID` int(11) NOT NULL,
  `u_ID` int(11) NOT NULL,
  `d_DESC` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `cat_ID` int(11) NOT NULL,
  `cat_Caption` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `imgID` int(10) NOT NULL,
  `img_a_ID` int(11) NOT NULL,
  `img` varchar(150) NOT NULL,
  `isMain` enum('False','True') NOT NULL DEFAULT 'False'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `marks`
--

CREATE TABLE `marks` (
  `mark` varchar(30) NOT NULL,
  `mark_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `models`
--

CREATE TABLE `models` (
  `m_id` int(10) NOT NULL,
  `m_mark_ID` int(10) NOT NULL,
  `m_model` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `m_capacity` decimal(2,1) NOT NULL,
  `m_mode` enum('седан','хетчбек','универсал') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `m_gb` enum('механика','автомат') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `m_privod` enum('передний','задний','полный') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `m_fuel` enum('дизель','бензин','газ','бензин-газ','электричество') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `m_equip` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `testdrive`
--

CREATE TABLE `testdrive` (
  `d_ID` int(11) NOT NULL,
  `uid` int(10) NOT NULL,
  `car_ID` int(11) NOT NULL,
  `status` enum('Waiting','Success','Denied') NOT NULL,
  `date` datetime NOT NULL,
  `isArrived` enum('Yes','No') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `u_ID` int(10) NOT NULL,
  `u_login` varchar(38) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_pass` varchar(125) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `u_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `u_fname` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `u_sex` enum('Male','Female') DEFAULT NULL,
  `u_phone` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adm_ID`);

--
-- Индексы таблицы `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`a_ID`),
  ADD KEY `cmakee` (`a_model`),
  ADD KEY `cat` (`c_ID`);

--
-- Индексы таблицы `a_equipment`
--
ALTER TABLE `a_equipment`
  ADD PRIMARY KEY (`e_ID`);

--
-- Индексы таблицы `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`b_ID`),
  ADD KEY `u_ID` (`u_ID`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_ID`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgID`),
  ADD KEY `car` (`img_a_ID`);

--
-- Индексы таблицы `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`mark_ID`);

--
-- Индексы таблицы `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `make_idx` (`m_mark_ID`),
  ADD KEY `m_equip_idx` (`m_equip`);

--
-- Индексы таблицы `testdrive`
--
ALTER TABLE `testdrive`
  ADD PRIMARY KEY (`d_ID`),
  ADD KEY `cars` (`car_ID`),
  ADD KEY `ud` (`uid`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_ID`),
  ADD UNIQUE KEY `u_login_UNIQUE` (`u_login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `adm_ID` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `auto`
--
ALTER TABLE `auto`
  MODIFY `a_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `a_equipment`
--
ALTER TABLE `a_equipment`
  MODIFY `e_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `b_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `imgID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `marks`
--
ALTER TABLE `marks`
  MODIFY `mark_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `models`
--
ALTER TABLE `models`
  MODIFY `m_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `testdrive`
--
ALTER TABLE `testdrive`
  MODIFY `d_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `u_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auto`
--
ALTER TABLE `auto`
  ADD CONSTRAINT `a_cmake` FOREIGN KEY (`a_model`) REFERENCES `models` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cat` FOREIGN KEY (`c_ID`) REFERENCES `categories` (`cat_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `blacklist`
--
ALTER TABLE `blacklist`
  ADD CONSTRAINT `blacklist_ibfk_1` FOREIGN KEY (`u_ID`) REFERENCES `users` (`u_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `car` FOREIGN KEY (`img_a_ID`) REFERENCES `auto` (`a_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `equip` FOREIGN KEY (`m_equip`) REFERENCES `a_equipment` (`e_ID`),
  ADD CONSTRAINT `m_mark_ID` FOREIGN KEY (`m_mark_ID`) REFERENCES `marks` (`mark_ID`);

--
-- Ограничения внешнего ключа таблицы `testdrive`
--
ALTER TABLE `testdrive`
  ADD CONSTRAINT `cars` FOREIGN KEY (`car_ID`) REFERENCES `auto` (`a_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ud` FOREIGN KEY (`uid`) REFERENCES `users` (`u_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
