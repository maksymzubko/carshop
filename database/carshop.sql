-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 24 2021 г., 19:37
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

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`adm_ID`, `adm_UNI`, `adm_LOG`, `adm_PASS`, `adm_ROLE`) VALUES
(1, 123123, 'hh', '/U2Xin1I', 'Main'),
(51, 451133, 'PV7vzR2Xw36tf0u', 'nI0iXGmvE8ClYeH', 'Moder'),
(53, 778786, 'b8fqt30dJEyM74e', 'kVYR5vhjxn6zIc8', 'Moder'),
(54, 756765, 'pkGWwsmFuHTxDBc', 'zUXqVRFQ2I0gtM8', 'Moder'),
(55, 131231, 'BNkEhOIDgMw5oS3', 'YmqOe8v2Bps6fn0', 'Moder'),
(56, 211111, 'jMdUrbXOmcJPzIS', 'yuIZtreoCn8k3pT', 'Moder'),
(57, 312333, 'K5ziL2vuWOXPnpT', 'cU9xJOMetHSCufZ', 'Moder'),
(58, 333333, '2aE1ZvWxf0CQukl', '0gAklQ6pYW53ELX', 'Moder'),
(59, 444444, 'zHh9mCcaNL8tW0Z', 'zAFOltpx482QJo1', 'Moder'),
(60, 666666, 'BosrEZXfC8JiTHu', 'uSazLfKAlB5pN7Q', 'Moder'),
(61, 677777, 'ZgnHPO1V5zrMA4N', 'ecnrypt(M4HLPvtVwd9q05N)', 'Moder'),
(62, 512512, 'lJHdbINEfycPVK7', 'ihnp6Bs6SGWk2o0sUIkT', 'Moder');

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

--
-- Дамп данных таблицы `auto`
--

INSERT INTO `auto` (`a_ID`, `a_color`, `c_ID`, `a_year`, `a_model`, `a_count`, `t_price`, `visible`) VALUES
(1, 'Белый', 1, 2020, 2, 222, 3213, 'Enabled'),
(3, 'Желтый', 1, 2019, 1, 222, 25, 'Enabled'),
(4, 'Красный', 1, 2019, 1, 222, 54, 'Enabled'),
(5, 'Cиний', 2, 2019, 3, 222, 773, 'Enabled'),
(8, 'Черный', 1, 2004, 3, 1, 0, 'Enabled'),
(9, 'Белый', 2, 2006, 3, 10, 3333, 'Enabled'),
(10, 'Черный', 1, 2006, 3, 2, 0, 'Enabled'),
(11, 'Черный', 1, 2002, 1, 1, 0, 'Enabled'),
(12, 'Черный', 2, 2004, 3, 3, 0, 'Enabled'),
(13, 'Черный', 2, 2005, 3, 3, 4444, 'Enabled'),
(14, 'Синий', 2, 2004, 3, 1, 0, 'Enabled'),
(15, 'Белый', 2, 2004, 3, 1, 0, 'Enabled'),
(16, 'Черный', 2, 2006, 3, 1, 0, 'Enabled');

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

--
-- Дамп данных таблицы `a_equipment`
--

INSERT INTO `a_equipment` (`e_ID`, `e_name`, `m_seat`, `m_steklopod`, `m_climatctrl`, `m_security`, `m_cruisctrl`, `m_esp`, `m_airbags`) VALUES
(1, 'Эконом', 'спереди', 'есть', 'нету', 'сигнализация', 'есть', 'нету', 'спереди'),
(2, 'Эконом+', 'спереди', 'есть', 'есть', 'сигнализация', 'есть', 'нету', 'комбинированое');

-- --------------------------------------------------------

--
-- Структура таблицы `blacklist`
--

CREATE TABLE `blacklist` (
  `b_ID` int(11) NOT NULL,
  `u_ID` int(11) NOT NULL,
  `d_DESC` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `blacklist`
--

INSERT INTO `blacklist` (`b_ID`, `u_ID`, `d_DESC`) VALUES
(8, 82, 'лох лоховской'),
(9, 83, 'авыаыааваыа'),
(19, 71, 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj'),
(21, 72, '13132ыфвфывфывф');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `cat_ID` int(11) NOT NULL,
  `cat_Caption` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`cat_ID`, `cat_Caption`) VALUES
(1, 'Для семьи'),
(2, 'Спорткар'),
(3, 'Внедорожник'),
(4, 'Кроссовер');

-- --------------------------------------------------------

--
-- Структура таблицы `favourite`
--

CREATE TABLE `favourite` (
  `client_ID` int(11) NOT NULL,
  `auto_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `favourite`
--

INSERT INTO `favourite` (`client_ID`, `auto_ID`) VALUES
(94, 3),
(67, 11),
(95, 3),
(95, 4),
(67, 4);

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

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`imgID`, `img_a_ID`, `img`, `isMain`) VALUES
(1, 1, 'images/imgt.jpg', 'True'),
(5, 3, 'images/car11.jpg', 'False'),
(6, 3, 'images/bnr-3.jpg', 'True'),
(7, 3, 'images/car11.jpg', 'False'),
(8, 3, 'images/bnr-3.jpg', 'False'),
(9, 3, 'images/car11.jpg', 'False'),
(10, 3, 'images/bnr-3.jpg', 'False'),
(11, 3, 'images/car11.jpg', 'False'),
(12, 5, 'images/bnr-3.jpg', 'False'),
(13, 3, 'images/car11.jpg', 'False'),
(14, 3, 'images/bnr-3.jpg', 'False'),
(16, 5, 'images/car22.jpg', 'True'),
(18, 4, 'images/car-2.jpg', 'True'),
(20, 10, 'images/car2.jpg', 'True'),
(21, 11, 'images/bnr-3.jpg', 'True'),
(22, 12, 'images/car22.jpg', 'True'),
(23, 13, 'images/bnr-3.jpg', 'True'),
(24, 14, 'images/car22.jpg', 'True'),
(25, 15, 'images/car-2.jpg', 'True'),
(26, 16, 'images/car-1.jpg', 'True'),
(28, 9, 'images/car-2.jpg', 'True'),
(34, 1, 'images/car3.jpg', 'False'),
(35, 1, 'images/car-2.jpg', 'False'),
(36, 1, 'images/car3.jpg', 'False');

-- --------------------------------------------------------

--
-- Структура таблицы `marks`
--

CREATE TABLE `marks` (
  `mark` varchar(30) NOT NULL,
  `mark_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `marks`
--

INSERT INTO `marks` (`mark`, `mark_ID`) VALUES
('Toyota', 1),
('Nissan', 2),
('Ford', 3),
('NewCar', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `models`
--

CREATE TABLE `models` (
  `m_id` int(10) NOT NULL,
  `m_mark_ID` int(10) NOT NULL,
  `m_model` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `m_description` varchar(150) NOT NULL,
  `m_capacity` decimal(2,1) NOT NULL,
  `m_mode` enum('седан','хетчбек','универсал') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `m_gb` enum('механика','автомат') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `m_privod` enum('передний','задний','полный') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `m_fuel` enum('дизель','бензин','газ','бензин-газ','электричество') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `m_equip` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `models`
--

INSERT INTO `models` (`m_id`, `m_mark_ID`, `m_model`, `m_description`, `m_capacity`, `m_mode`, `m_gb`, `m_privod`, `m_fuel`, `m_equip`) VALUES
(1, 2, 'Rogue', 'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала X', '3.0', 'хетчбек', 'механика', 'задний', 'газ', 2),
(2, 1, 'Camry', '\'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала ', '3.5', 'хетчбек', 'механика', 'задний', 'газ', 2),
(3, 3, 'Mondeo', '\'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала ', '3.5', 'хетчбек', 'автомат', 'задний', 'газ', 1),
(4, 1, 'CamryD', '\'Lorem Ipsum - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала ', '3.5', 'хетчбек', 'механика', 'задний', 'газ', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `s_ID` int(11) NOT NULL,
  `us_ID` int(11) NOT NULL
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

--
-- Дамп данных таблицы `testdrive`
--

INSERT INTO `testdrive` (`d_ID`, `uid`, `car_ID`, `status`, `date`, `isArrived`) VALUES
(24, 71, 4, 'Success', '2021-02-18 10:00:00', 'Yes'),
(25, 81, 4, 'Success', '2021-02-19 14:00:00', 'Yes'),
(26, 67, 12, 'Success', '2021-02-18 18:00:00', 'No'),
(27, 77, 5, 'Success', '2021-02-17 18:00:00', 'Yes'),
(28, 94, 1, 'Denied', '2021-02-17 18:00:00', NULL),
(29, 81, 1, 'Success', '2021-03-18 10:00:00', NULL),
(30, 67, 3, 'Success', '2021-03-18 10:00:00', NULL),
(31, 90, 11, 'Success', '2021-03-17 13:00:00', NULL),
(32, 89, 11, 'Success', '2021-03-26 14:00:00', NULL),
(33, 92, 12, 'Denied', '2021-03-25 09:00:00', NULL),
(34, 88, 13, 'Success', '2021-03-24 09:00:00', NULL),
(35, 85, 14, 'Success', '2021-03-18 09:00:00', NULL),
(36, 92, 15, 'Success', '2021-03-17 13:00:00', NULL),
(37, 90, 12, 'Success', '2021-03-18 13:00:00', NULL),
(38, 95, 4, 'Denied', '2021-03-18 13:00:00', NULL),
(39, 95, 3, 'Success', '2021-03-18 14:00:00', NULL),
(51, 67, 1, 'Success', '2021-03-25 13:00:00', NULL),
(52, 67, 11, 'Denied', '2021-03-25 09:00:00', NULL),
(53, 67, 14, 'Waiting', '2021-03-25 14:00:00', NULL),
(54, 67, 5, 'Waiting', '2021-04-01 18:00:00', NULL);

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
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`u_ID`, `u_login`, `u_pass`, `u_name`, `u_fname`, `u_sex`, `u_phone`) VALUES
(67, 'makzzubko66@gmail.com', '/U2Xin1I', 'Максим', 'ddd', 'Male', '+380333333333'),
(71, 'makzzubko626@gmail.com4', '/U2Xin1I', '123123', 'ddd', 'Male', '383333333333'),
(72, 'ddd@dddd22gghhhhff', '/U2X', 'fgff', 'fgff', 'Male', '+380222222222'),
(73, NULL, NULL, 'dd', 'dd', NULL, '+380333333333'),
(76, NULL, NULL, 'Вал', 'Вал', NULL, '+380333333333'),
(77, 'dsadasd@dasdads', '/U2X', 'Максим', 'Максим', 'Male', '+380222222222'),
(78, NULL, NULL, 'Мак', 'Мак', NULL, '+380222222222'),
(79, NULL, NULL, 'DASDA', 'DASDA', NULL, '+380222222222'),
(80, NULL, NULL, 'dsada', 'dsada', NULL, '+380333333333'),
(81, NULL, NULL, 'dsada', 'dsada', NULL, '+380444444444'),
(82, 'gggg@gaa.ru', '9E7B0yoWYHA=', 'Максим', 'Максим', 'Male', '+380222222222'),
(83, 'ddd@ddd', '/U2X', 'Максим', 'Максим', 'Male', '+380222222222'),
(84, 'ddd@xn--ddd-hdd', '/U2X', 'Максим', 'Максим', 'Male', '+380222222222'),
(85, 'ddd@dddd2', '/U2X', 'Максим', 'Максим', 'Male', '+380222222222'),
(86, 'ddd@dddd22', '/U2X', 'Максим', 'Максим', 'Male', '+380222222222'),
(87, 'ddd@dddd22g', '/U2X', 'Максим', 'Максим', 'Male', '+380222222222'),
(88, 'ddd@dddd22gg', '/U2X', 'Максим', 'Максим', 'Male', '+380222222222'),
(89, 'ddd@dddd22gghh', '/U2X', 'Максим', 'Максим', 'Male', '+380222222222'),
(90, 'sgdsg@dd', '/U2X', 'fgff2', 'fgff', 'Female', '+380222222222'),
(91, '123@gmail.com', '/U2X', 'Ура', '222', 'Male', '+380333333333'),
(92, 'ddd@gmail.com', '/U2X', '123', '123', 'Male', '+380333333333'),
(93, 'dda@dd', '/k0=', 'dsadd', 'dasd', 'Male', '+380222222222'),
(94, 'dsad@DDadad', '/U2X', 'Мак', 'ммВ', 'Male', '+380222222222'),
(95, 'ewrtry@gmail.com', '/U2Xj3pNNi6phg==', 'имИьтбю', 'ываолджэ.', 'Male', '+380645789045'),
(99, 'dasd@ddada', 'rQzA', 'dasd', 'dasd', 'Male', '+380222222222'),
(152, 'dasdsda@fasdas', '/U2X', '123', '123', 'Male', '+380222222222'),
(153, 'dasdsda@fasdas222', '/U2X', '123', '123', 'Male', '+380111111111'),
(154, 'dasdsda@fasdas22', '/U2X', '123', '123', 'Male', '+38011111111'),
(156, 'makzzubko55@gmail', '/g==', '2', '2', 'Male', '+380'),
(157, 'makzzubko55@gmail.c', '/U2X', '123', '123', 'Male', '+380 11 111 1111'),
(158, 'dasdasd', '/U2X', '123123', '123', 'Male', '+380 99 244 3242'),
(159, 'dddd@ggmai.com', '/U2X', '123123', '123', 'Male', '+380 99 244 324'),
(160, 'ddddd@ggmai.com', '/U2X', '123', '123', 'Male', '+380 22 222 222'),
(161, 'dasdasd@gmail.com', '/U2X', '123', '123', 'Male', '+380 22 222 2222'),
(162, 'dasadads@gmail.com', '/U2X', '123', '123', 'Male', '+38022222222'),
(163, 'dsadasad@gmail.com', '/U2X', '123', '123', 'Male', '+380111111'),
(164, 'dsadasdads@dasda.com', '/U2X', '123', '123', 'Male', '+380111111111'),
(165, 'dasdsa1213@gmail.com', '/U2X', '123', '123', 'Male', '+380111111111');

-- --------------------------------------------------------

--
-- Структура таблицы `videos`
--

CREATE TABLE `videos` (
  `link_ID` int(11) NOT NULL,
  `auto_ID` int(11) NOT NULL,
  `v_link` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `videos`
--

INSERT INTO `videos` (`link_ID`, `auto_ID`, `v_link`) VALUES
(1, 1, 'W7SR2LAGUBQ'),
(2, 1, 'qeQY9yFu6XI'),
(7, 4, '2'),
(8, 4, '551'),
(9, 4, 'ggggggggggggggggg'),
(10, 4, 'dfsg'),
(11, 4, 'asdj'),
(12, 5, '2'),
(13, 5, '5'),
(14, 4, 'dsad'),
(15, 4, '2'),
(16, 4, '511515'),
(17, 1, 'qeQY9yFu6XI'),
(18, 1, 'qeQY9yFu6XI'),
(19, 1, 'W7SR2LAGUBQ');

-- --------------------------------------------------------

--
-- Структура таблицы `view`
--

CREATE TABLE `view` (
  `v_ID` int(11) NOT NULL,
  `a_ID` int(11) NOT NULL,
  `view` enum('Enabled','Disabled') NOT NULL
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
-- Индексы таблицы `favourite`
--
ALTER TABLE `favourite`
  ADD KEY `carsid` (`auto_ID`),
  ADD KEY `usid` (`client_ID`);

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
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `s_ID` (`s_ID`),
  ADD KEY `user` (`us_ID`);

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
-- Индексы таблицы `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`link_ID`),
  ADD KEY `a` (`auto_ID`);

--
-- Индексы таблицы `view`
--
ALTER TABLE `view`
  ADD KEY `cars2` (`a_ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `adm_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `auto`
--
ALTER TABLE `auto`
  MODIFY `a_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `a_equipment`
--
ALTER TABLE `a_equipment`
  MODIFY `e_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `b_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `imgID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `marks`
--
ALTER TABLE `marks`
  MODIFY `mark_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `models`
--
ALTER TABLE `models`
  MODIFY `m_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `testdrive`
--
ALTER TABLE `testdrive`
  MODIFY `d_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `u_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT для таблицы `videos`
--
ALTER TABLE `videos`
  MODIFY `link_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- Ограничения внешнего ключа таблицы `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `carsid` FOREIGN KEY (`auto_ID`) REFERENCES `auto` (`a_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usid` FOREIGN KEY (`client_ID`) REFERENCES `users` (`u_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Ограничения внешнего ключа таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `user` FOREIGN KEY (`us_ID`) REFERENCES `auto` (`a_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `testdrive`
--
ALTER TABLE `testdrive`
  ADD CONSTRAINT `cars` FOREIGN KEY (`car_ID`) REFERENCES `auto` (`a_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ud` FOREIGN KEY (`uid`) REFERENCES `users` (`u_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `a` FOREIGN KEY (`auto_ID`) REFERENCES `auto` (`a_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `view`
--
ALTER TABLE `view`
  ADD CONSTRAINT `cars2` FOREIGN KEY (`a_ID`) REFERENCES `auto` (`a_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
