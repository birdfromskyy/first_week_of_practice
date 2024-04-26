-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 26 2024 г., 01:35
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
-- База данных: `shop_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `pid` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(4, 47, 'bob', 'bob@mail.ru', '666', 'hello');

-- --------------------------------------------------------

--
-- Структура таблицы `message_courier`
--

CREATE TABLE `message_courier` (
  `id` int NOT NULL,
  `courier_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `message_courier`
--

INSERT INTO `message_courier` (`id`, `courier_id`, `name`, `email`, `number`, `message`) VALUES
(3, 46, 'жека', 'jenya@mail.com', '96784849', 'помоги'),
(4, 46, 'жека', 'jenya@mail.com', '345678', 'привет'),
(5, 46, 'жека', 'jenya@mail.com', '999999', 'gtrbec'),
(6, 46, 'жека', 'jenya@mail.com', '555', '234'),
(7, 46, 'жека', 'jenya@mail.com', '345678', 'jmnhbg');

-- --------------------------------------------------------

--
-- Структура таблицы `message_kitchen`
--

CREATE TABLE `message_kitchen` (
  `id` int NOT NULL,
  `kitchen_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `message_kitchen`
--

INSERT INTO `message_kitchen` (`id`, `kitchen_id`, `name`, `email`, `number`, `message`) VALUES
(4, 49, 'шеф', 'shef@mail.com', '345678', 'bhgvf');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `method` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `flat` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `street` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pin` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_products` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `courier_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `courier_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payment_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'рассматривается'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `flat`, `street`, `city`, `pin`, `total_products`, `total_price`, `placed_on`, `courier_name`, `courier_email`, `payment_status`) VALUES
(15, 51, 'user', '999999', 'user@mail.com', 'cash on delivery', '56', '66', 'Khanty', 'грибы', ', Маргарита ( 1 ), Карбонара ( 1 ), Лимон-Лайм ( 1 ), Малина-Маракуйя ( 1 ), Ракета ( 1 )', 2455, '26-Apr-2024', NULL, NULL, 'рассматривается');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `details` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `details`, `price`, `image`) VALUES
(33, 'Пепперони', 'pizza', 'Пицца &quot;Пепперони&quot; - итальянская пицца с острой пепперони и сыром.', 899, '67639595.png'),
(34, 'Маргарита', 'pizza', 'Пицца &quot;Маргарита&quot; -  пицца с томатным соусом, моцареллой и базиликом.', 739, '74013530.png'),
(35, 'Карбонара', 'pizza', 'Пицца &quot;Карбонара&quot; - сытная итальянская пицца с кремовым соусом, беконом, сыром и яйцом.', 859, '29584641.png'),
(36, 'Гавайи', 'pizza', 'Пицца &quot;Гавайи&quot; - экзотическая итальянская пицца с ананасами, ветчиной и сыром моцарелла.', 819, '16520989.png'),
(37, 'Мохито', 'napitki', 'Лимонад &quot;Мохито&quot; - освежающий напиток с мятой, лаймом и газированной водой.', 159, 'l3.png'),
(38, 'Клубничный Дайкири', 'napitki', 'Лимонад &quot;Клубничный Дайкири&quot; - сочетание клубничного сиропа с лимоном и лаймом.\r\n\r\n', 179, 'l2.png'),
(40, 'Лимон-Лайм', 'napitki', 'Лимонад &quot;Лимон-Лайм&quot; - напиток с ярким сочетанием лимона и лайма.', 169, 'l1.png'),
(41, 'Малина-Маракуйя', 'napitki', 'Лимонад &quot;Малина-Маракуйя&quot; - освежающий напиток с ярким вкусом малины и маракуйи.', 189, 'l4.png'),
(42, 'Старый', 'burger', 'Бургер &quot;Старый&quot; - булочка с кунжутом, фирменный соус, лист салата, томат, котлета из говядины, сыр чеддер, яйцо.', 569, 'b1.png'),
(43, 'Большой Джони', 'burger', 'Бургер &quot;Большой Джони&quot; -  Булочка с кунжутом, фирменный соус, гриль соус, котлета из говядины, лист салата, бекон.', 479, 'b2.png'),
(44, 'Ракета', 'burger', 'Бургер &quot;Ракета&quot; - Булочка с кунжутом, фирменный соус, котлета из говядины, чеддер, халапенью, соус шрирача.', 499, 'b3.png'),
(45, 'Чиз-Борис', 'burger', 'Бургер &quot;Чиз-Борис&quot; - Булочка с кунжутом, фирменный соус, котлета из говядины, огурец, лист салата, чеддер.', 539, 'b4.png'),
(46, 'По-деревенски', 'zakuski', 'Картофель по-деревенски - картофель нарезается на кусочки и жарится до хрустящей золотистой корочки.', 239, 'у1.png'),
(47, 'Картофель Фри', 'zakuski', 'Картофель фри - нарезанные картофельные брусочки, жареные во фритюре до золотистой корочки.', 219, 'у2.png'),
(48, 'Наггетсы', 'zakuski', 'Наггетсы - кусочки свежего и вкусного куриного мяса, жаренные до хрустящей золотистой корочки. ', 279, 'у3.png'),
(49, 'Луковые Кольца', 'zakuski', 'Луковые Кольца - это свежие кольца лука,  жаренные до хрустящей золотистой корочки во фритюре. ', 259, 'у4.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `balance` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`, `balance`) VALUES
(52, 'user', 'user@mail.com', '202cb962ac59075b964b07152d234b70', 'user', 'user.png', 0),
(53, 'admin', 'admin@mail.com', '202cb962ac59075b964b07152d234b70', 'admin', 'admin.png', 0),
(54, 'kitchen', 'kitchen@mail.com', '202cb962ac59075b964b07152d234b70', 'kitchen', 'kitchen.png', 0),
(55, 'courier', 'courier@mail.com', '202cb962ac59075b964b07152d234b70', 'courier', 'curier.png', 0),
(56, 'courier2', 'courier2@mail.com', '202cb962ac59075b964b07152d234b70', 'courier', 'curier2.png', 0),
(57, 'user2', 'user2@mail.com', '202cb962ac59075b964b07152d234b70', 'user', 'user2.png', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `pid` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message_courier`
--
ALTER TABLE `message_courier`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message_kitchen`
--
ALTER TABLE `message_kitchen`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `message_courier`
--
ALTER TABLE `message_courier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `message_kitchen`
--
ALTER TABLE `message_kitchen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT для таблицы `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
