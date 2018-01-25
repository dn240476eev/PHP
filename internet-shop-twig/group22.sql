-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 26 2018 г., 01:11
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
-- База данных: `group22`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL DEFAULT '''''',
  `url` varchar(255) NOT NULL DEFAULT '''''',
  `description` text,
  `visible` tinyint(4) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `url`, `description`, `visible`, `image`, `parent_id`, `updated_at`, `created_at`) VALUES
(1, 'Техника для дома', 'tehnika', '', 1, '15155589_1595666953.jpg', 0, '2018-01-03 21:08:27', '2018-01-03 21:08:27'),
(11, 'Гаджеты', 'gadzhety', '', 1, '712946_01d62d8042.jpg', 0, '2018-01-03 23:34:39', '2018-01-03 23:34:39'),
(12, 'Холодильники', 'holodilniki', 'Холоди́льник — устройство, поддерживающее низкую температуру в теплоизолированной камере. Применяется обычно для хранения пищи или предметов, требующих хранения в прохладном месте. ... Температура в морозильнике составляет обычно −18 °C.', 1, '13005b18aa5560_8f389f15c7.jpg', 1, '2018-01-03 23:39:35', '2018-01-03 23:39:35'),
(13, 'Холодильники No frost', 'holodilniki-no-frost', 'В холодильниках, оснащенных системой “No frost”, испаритель расположен над морозильной камерой или за задней стенкой холодильной камеры. Там есть вентиляторы, благодаря которым воздух внутри холодильника циркулирует. Низкую температуру задней стенки обеспечивает испаритель.', 0, '95808337_381dbaec42.png', 12, '2018-01-03 23:41:42', '2018-01-03 23:41:42'),
(14, 'Телефоны', 'telefon', '', 1, 'tato_d3eed387e2.jpg', 11, '2018-01-04 00:08:06', '2018-01-04 00:08:06'),
(15, 'Детские товары', 'detskie-tovary', 'аааааа ааааааа ааааааааааааааа', 1, '1471534062_17_0b83cd5e19.jpg', 0, '2018-01-05 00:34:00', '2018-01-05 00:34:00'),
(16, 'IPhone', 'iphone', '', 1, 's_dnem_rozhdeniya_d42026e491.jpg', 14, '2018-01-05 22:20:58', '2018-01-05 22:20:58'),
(17, 'Куклы', 'kukly', '', 1, 'mng-060_7fbf78bb2c.jpg', 15, '2018-01-05 22:25:43', '2018-01-05 22:25:43'),
(19, 'Коляски', 'kalyaski', '', 1, 'thumb300_462721b978.jpg', 15, '2018-01-05 22:35:43', '2018-01-05 22:35:43'),
(44, 'Мотоциклы', 'mototsikl-k255', 'Мото', 1, NULL, 17, '2018-01-24 20:23:17', '2018-01-24 20:23:17');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL DEFAULT '''''',
  `product_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `file_name`, `product_id`) VALUES
(41, '351837d345ed6ce0e439fd60f6bb1226_a9936db3fc.jpg', 88),
(40, '351837d345ed6ce0e439fd60f6bb1226_a8f0d4e8cc.jpg', 84),
(39, '54763784_5790a7addc.jpg', 75),
(38, '2380f8e63cecf01259871e0febfb6314_8fa55844cd.jpg', 74),
(36, '351837d345ed6ce0e439fd60f6bb1226_5ab00204e1.jpg', 49),
(37, 'blossom-plant-leaf-flower-petal-rose-green-botany-yellow-flora-flowers_21d540c545.jpg', 83),
(33, 'tato_d0111a1f8d.jpg', 47),
(32, '54763784_d9215e8493.jpg', 48),
(31, '13005b18aa5560_235033f963.jpg', 46),
(30, 'moukk0yvuqc_216284b280.jpg', 76),
(60, 'otkrytki-s-dnem-rozhdenia-roditelyam-morkovka_f58013d48f.jpg', 90);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_cost` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(50) NOT NULL DEFAULT '''''',
  `last_name` varchar(50) NOT NULL DEFAULT '''''',
  `email` varchar(128) NOT NULL DEFAULT '''''',
  `phone` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL DEFAULT '''''',
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '''''',
  `description` text,
  `visible` tinyint(4) NOT NULL DEFAULT '0',
  `apdated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `sort`, `url`, `description`, `visible`, `apdated_at`, `created_at`) VALUES
(1, 'Контакты', 4, '1', '1', 1, '2017-12-25 19:59:34', '2017-12-25 19:59:34'),
(2, 'Оплата', 2, 'oplata', 'Банковской картой\r\nК оплате принимаются карты Visa и Mastercard. \r\nВвод информации о картах безопасен — modnaKasta не доступны эти данные. Их хранение и обработка происходит на стороне нашего партнера — компании WayForPay, которая прошла аудит PCI DSS, получила соответствующий сертификат и гарантирует защищенность данных. \r\nЧасто задаваемые вопросы об оплате картой\r\nНаличными\r\nОплата наличными возможна:\r\n\r\nпри получении в любом из отделений modnaKasta через платежный терминал (обратите внимание, что терминал не выдает сдачи, а оплата товара стоимостью свыше 5 тысяч производится частями),\r\nпри получении товара в отделении сервиса доставки («Нова пошта» или «Міст Експрес»), а также при курьерской доставке.\r\nСредствами персонального счета\r\nПерсональный счет modnaKasta предназначен для зачисления денег при возврате товара. Средствами персонального счета можно оплатить заказ как полностью, так и частично, с доплатой банковской картой или наличными.\r\n\r\n\r\nПодробнее о персональном счете', 1, '2017-12-26 21:19:55', '2017-12-26 21:19:55'),
(3, 'Новости', 5, 'novosti', 'Samsung Galaxy Note8 начали обновляться до Android 8.0 Oreo\r\n\r\n Samsung Galaxy Note8 начали обновляться до Android 8.0 Oreo\r\nНекоторые владельцы Samsung Galaxy Note8 начали получать обновление Android 8.0 Oreo. Несмотря на отсутствие официальных комментариев, «счастливчики» установили прошивку R16NW.N950FXXU2CRA1.DM на свой страх и риск — и все прошло успешно.\r\n\r\nОчевидно, это лишь тестовый запуск. Поскольку обновление получили далеко не все владельцы Galaxy Note8, можно сделать вывод, что это проверка перед масштабным выпуском Android 8.0 Oreo.\r\n\r\nорео.jpg\r\nПочему это странно\r\nУдивительно, но Galaxy Note 8 даже не участвовал в бета-программе. Сейчас тестовую прошивку получила лишь небольшая группа владельцев Galaxy S8 и Galaxy S8 Plus, а завершится «проба» бета-версии 15 января. Да и в Samsung пока никак не комментируют обновление Galaxy Note8.\r\n\r\nЧто изменилось\r\nВладельцы устройств, которые получили прошивку, сообщают о некоторых нововведениях, среди которых:\r\n\r\nобновление клавиатуры;\r\nподдержка функции «картинка в картинке»;\r\nоткрытие специального меню приложения при долгом нажатии на иконку;\r\nсекретная папка может оставаться открытой до тех пор, пока экран не погаснет;\r\nподдержка API автозаполнения полей (в том числе с биометрией) для всех приложений и браузера;\r\nцветные мультимедийные уведомления;\r\nкатегории уведомлений;\r\nнастройка для значков уведомлений;\r\nклавиатура поддерживает поиск GIF-изображений;\r\nдополнительные опции подсветки краёв дисплея;\r\nвозможность резервного копирования секретной папки в облако Samsung;\r\nподдержка высококачественных аудиокодеков Bluetooth;\r\nуправление паролями стандартных и сторонних приложений с помощью Samsung Pass.\r\nКроме того, прошивка принесла и январский патч безопасности.\r\n\r\nИсточник: Reddit, The Android Soul', 1, '2018-01-07 09:35:13', '2018-01-07 09:35:13'),
(4, 'Доставка', 1, 'dostavka', '<h2>Курьерская доставка по Москве</h2>\r\nКурьерская доставка осуществляется на следующий день после оформления заказа, если товар есть в наличии. Курьерская доставка осуществляется в пределах Томска и Северска ежедневно с 10.00 до 21.00. Заказ на сумму свыше 300 рублей доставляется бесплатно. \r\n\r\nСтоимость бесплатной доставки раcсчитывается от суммы заказа с учтенной скидкой. В случае если сумма заказа после применения скидки менее 300р, осуществляется платная доставка. \r\n\r\nПри сумме заказа менее 300 рублей стоимость доставки составляет от 50 рублей.\r\n\r\nСамовывоз\r\nУдобный, бесплатный и быстрый способ получения заказа.\r\nАдрес офиса: Москва, ул. Арбат, 1/3, офис 419.\r\n\r\nДоставка с помощью предприятия «Автотрейдинг»\r\nУдобный и быстрый способ доставки в крупные города России. Посылка доставляется в офис «Автотрейдинг» в Вашем городе. Для получения необходимо предъявить паспорт и номер грузовой декларации (сообщит наш менеджер после отправки). Посылку желательно получить в течение 24 часов с момента прихода груза, иначе компания «Автотрейдинг» может взыскать с Вас дополнительную оплату за хранение. Срок доставки и стоимость Вы можете рассчитать на сайте компании.\r\n\r\nНаложенным платежом\r\nПри доставке заказа наложенным платежом с помощью «Почты России», вы сможете оплатить заказ непосредственно в момент получения товаров.', 1, '2018-01-07 10:09:43', '2018-01-07 10:09:43'),
(5, 'Бренды', 3, 'brendy', 'ТЕСТ', 0, '2018-01-07 20:11:51', '2018-01-07 20:11:51'),
(6, 'Тестовая', 6, 'testovaya', 'Ну почему не видно - по-моему все видно', 1, '2018-01-12 19:51:51', '2018-01-12 19:51:51'),
(8, '404', 0, '404', 'Страница не найдена', 0, '2018-01-14 23:05:20', '2018-01-14 23:05:20'),
(9, 'О нас', 8, 'o-nas', '', 1, '2018-01-15 20:41:46', '2018-01-15 20:41:46');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL DEFAULT '''''',
  `description` text,
  `price` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '''''',
  `visible` tinyint(4) NOT NULL DEFAULT '0',
  `hit` tinyint(4) NOT NULL DEFAULT '0',
  `apdated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `amount`, `url`, `visible`, `hit`, `apdated_at`, `created_at`) VALUES
(46, 'Посудомоечная машина', '', 1444, 1, 'yyy', 1, 1, '2017-12-27 23:07:23', '2017-12-27 23:07:23'),
(48, 'Пылесос', 'Сегодня на рынке существует так много разных пылесосов, с различными типами фильтрации и широкими возможностями использования, что покупатель часто путается в них. Одно из самых распространенных заблуждений это «пылесос с аквафильтром = моющий пылесос».', 3000, 3, '3', 0, 1, '2017-12-27 23:17:24', '2017-12-27 23:17:24'),
(49, 'Мобильный телефон', 'ывваапаыц ввыыы', 1, 1, 'yyyyy', 1, 0, '2017-12-29 20:50:27', '2017-12-29 20:50:27'),
(74, 'Миксер', 'Ми́ксер (англ. mixer — «мешалка» от др.-греч. μῖξις — «смешение, смесь») — устройство для приготовления пищи методом перемешивания её компонентов до создания однородной массы и обогащения взбиваемой жидкости воздухом. Миксером взбивают и замешивают яйца, сливки, коктейли, мусс, ...', 1000, 3, 'mikser', 1, 1, '2017-12-30 16:24:40', '2017-12-30 16:24:40'),
(75, 'Электромясорубка', 'укукукукуку укукукй укукукукукукк', 2000, 3, 'elektromyasorubka', 1, 0, '2018-01-01 17:31:13', '2018-01-01 17:31:13'),
(84, 'Соковыжималка', 'ввавава', 2102, 1, 'sokovyzhimalka', 1, 1, '2018-01-06 09:27:45', '2018-01-06 09:27:45'),
(76, 'Фен', 'hghghh hhgh hghghjty000', 439, 2, 'fen', 1, 1, '2018-01-01 19:45:40', '2018-01-01 19:45:40'),
(77, 'Кофеварка', 'уку укукуциуакуа укукк', 2500, 1, 'kofevarka', 1, 1, '2018-01-03 20:24:40', '2018-01-03 20:24:40'),
(85, 'Самсунг Галакси С7', '', 10222, 1, 'samsung-galaksi-s7', 1, 1, '2018-01-06 23:09:05', '2018-01-06 23:09:05'),
(83, 'Плойка', '', 0, 0, 'plojka', 1, 0, '2018-01-03 20:37:55', '2018-01-03 20:37:55'),
(89, 'Увлажнители воздуха2', '', 1334, 1, 'uvlazhniteli-vozduha2', 1, 0, '2018-01-06 23:39:51', '2018-01-06 23:39:51'),
(90, 'Увлажнители воздуха3', 'цуцкув', 0, 0, 'uvlazhniteli-vozduha3', 1, 0, '2018-01-06 23:40:48', '2018-01-06 23:40:48'),
(125, 'Холодильники No frost', 'Картинки по запросу холодильник ноу фрост єто\r\n«Ноу фрост» — это система охлаждения морозильной и холодильной камер, которая обеспечивает принудительную циркуляцию холодного воздуха и предотвращает образование наледи на стенках холодильника.', 13045, 1, 'holodilniki-no-frost', 1, 1, '2018-01-22 19:49:46', '2018-01-22 19:49:46'),
(126, 'Мотоцикл К255', 'МОТОЦИКЛ, оснащенное двигателем двухколесное транспортное средство. Создание первого действующего мотоцикла обычно приписывается Готлибу ДАЙМЛЕРУ. Он установил четырехтактный ДВИГАТЕЛЬ ВНУТРЕННЕГО СГОРАНИЯ на раму деревянного велосипеда. ', 123, 1, 'mototsikl-k255', 1, 0, '2018-01-24 21:34:24', '2018-01-24 21:34:24');

-- --------------------------------------------------------

--
-- Структура таблицы `products_categories`
--

CREATE TABLE `products_categories` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products_categories`
--

INSERT INTO `products_categories` (`id`, `product_id`, `category_id`, `position`) VALUES
(2, 89, 17, 0),
(3, 90, 17, 0),
(5, 76, 15, 0),
(6, 91, 12, 0),
(7, 84, 1, 0),
(8, 85, 14, 0),
(9, 77, 1, 0),
(10, 73, 12, 0),
(11, 49, 14, 0),
(12, 75, 1, 0),
(13, 74, 1, 0),
(14, 83, 1, 0),
(54, 126, 44, 0),
(17, 46, 1, 0),
(18, 92, 17, 0),
(53, 125, 12, 0),
(29, 103, 31, 0),
(30, 104, 30, 0),
(31, 105, 19, 0),
(32, 106, 31, 0),
(33, 107, 31, 0),
(52, 48, 1, 0),
(35, 109, 17, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_name` varchar(150) NOT NULL DEFAULT '''''',
  `prise` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '''''',
  `color` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL DEFAULT '''''',
  `last_name` varchar(50) NOT NULL DEFAULT '''''',
  `e-mail` varchar(128) NOT NULL DEFAULT '''''',
  `phone` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT для таблицы `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT для таблицы `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
