-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 14 2015 г., 16:31
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `lucfactory`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_auth_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_auth_assignment`
--

INSERT INTO `tbl_auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('administrator', '36', 1421232520),
('administrator', '9', 1421224917),
('user', '10', 1407865295),
('user', '11', 1409471426),
('user', '12', 1409119619),
('user', '14', 1409474125),
('user', '15', 1409474339),
('user', '16', 1409476259),
('user', '17', 1412855495),
('user', '18', 1412174251),
('user', '19', 1412175350),
('user', '20', 1412870734),
('user', '21', 1412347484),
('user', '22', 1416838911),
('user', '23', 1413203793),
('user', '24', 1415180203),
('user', '25', 1415208092),
('user', '26', 1416501681),
('user', '27', 1416838867),
('user', '28', 1416574930),
('user', '29', 1417002404),
('user', '30', 1417028825),
('user', '31', 1417028901),
('user', '32', 1417028960),
('user', '33', 1417029087),
('user', '34', 1417040347),
('user', '35', 1417040625),
('user', '37', 1421224917);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_auth_item`
--

CREATE TABLE IF NOT EXISTS `tbl_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_auth_item`
--

INSERT INTO `tbl_auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('administrator', 1, NULL, 'Administrator', NULL, 1407484556, 1407484556),
('user', 1, NULL, 'User', NULL, 1407484556, 1407484556);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_auth_item_child`
--

CREATE TABLE IF NOT EXISTS `tbl_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_auth_item_child`
--

INSERT INTO `tbl_auth_item_child` (`parent`, `child`) VALUES
('administrator', 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_auth_rule`
--

CREATE TABLE IF NOT EXISTS `tbl_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_auth_rule`
--

INSERT INTO `tbl_auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('Administrator', 'O:29:"common\\rbac\\AdministratorRule":3:{s:4:"name";s:13:"Administrator";s:9:"createdAt";i:1407484556;s:9:"updatedAt";i:1407484556;}', 1407484556, 1407484556),
('User', 'O:20:"common\\rbac\\UserRule":3:{s:4:"name";s:4:"User";s:9:"createdAt";i:1407484556;s:9:"updatedAt";i:1407484556;}', 1407484556, 1407484556);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_bonus`
--

CREATE TABLE IF NOT EXISTS `tbl_bonus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `money` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_bonus` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_bonus`
--

INSERT INTO `tbl_bonus` (`id`, `user_id`, `money`, `date`) VALUES
(1, 36, 69, '2014-11-27 06:08:01');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_factory`
--

CREATE TABLE IF NOT EXISTS `tbl_factory` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count_pumped` int(11) DEFAULT '0',
  `lytz_received` int(11) DEFAULT '0',
  `count_stantion_categoru_1` int(11) DEFAULT '0',
  `count_stantion_categoru_2` int(11) DEFAULT '0',
  `count_stantion_categoru_3` int(11) DEFAULT '0',
  `count_stantion_categoru_4` int(11) DEFAULT '0',
  `count_stantion_categoru_5` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_feedback`
--

CREATE TABLE IF NOT EXISTS `tbl_feedback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`id`, `username`, `email`, `description`) VALUES
(1, 'дима', 'zaithev@gmail.com', '2'),
(2, 'дима', 'zaithev@gmail.com', '3');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_invoice`
--

CREATE TABLE IF NOT EXISTS `tbl_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sum` decimal(10,0) NOT NULL,
  `date` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` decimal(10,0) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `balance` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`id`, `sum`, `date`, `status`, `user_id`, `type`, `description`, `balance`) VALUES
(22, '1000', 1417068023, 1, 36, '1', '', NULL),
(23, '1000', 1417068472, 1, 37, '1', '', NULL),
(24, '1000', 1417068556, 1, 37, '1', '', NULL),
(25, '1000', 1417068619, 1, 37, '1', '', NULL),
(26, '1000', 1417068666, 1, 37, '1', '', NULL),
(27, '1000', 1417068803, 1, 37, '1', '', NULL),
(28, '1000', 1417068916, 1, 37, '1', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_lottery`
--

CREATE TABLE IF NOT EXISTS `tbl_lottery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `number` int(11) NOT NULL,
  `winer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tbl_lottery` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_lucfactorypayments`
--

CREATE TABLE IF NOT EXISTS `tbl_lucfactorypayments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `sum` decimal(20,0) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1406573433),
('m140728_185104_activateToken', 1406573593),
('m140806_132449_add_columns_for_user_table', 1407392769),
('m140807_062244_language', 1407392770),
('m140807_062632_language_data', 1407393099),
('m140807_161004_add_column_for_social_field_user_table', 1407483056),
('m140808_072259_add_admin', 1407484316),
('m140808_193748_update_user_column', 1407869518),
('m140813_065308_Position', 1407913783),
('m140826_125145_create_invoce_table', 1409119458),
('m140827_101041_create_pages_table', 1409221430),
('m140829_075208_create_messages_table', 1409550021),
('m140831_081725_expireDate', 1409473089),
('m140909_081146_update_column_s_status_title', 1410277649),
('m140909_120912_add_column_profession_for_User', 1410277649),
('m140919_084105_add_column_name_for_Partfolio', NULL),
('m141006_092434_add_column_to_pages', 1412604121),
('m141015_213949_dublicate_invoice', 1413576794),
('m141017_103004_add_tickets', 1413895793),
('m141023_093614_create_user_invoice_order', 1414129249),
('m141027_140425_add_new_table_UserBonus', 1414419060),
('m141033_140525_add_new_table_lottery', 1415180047),
('m141053_140825_add_new_column_User', 1415215254),
('m141112_193455_add_new_column_online_to_user', 1416998296),
('m141117_085505_update_img', 1416998296),
('m141126_103625_add_new_records_in_tbl_pages', 1416998296),
('m141126_121507_add_forigen_key_bonus_user', 1417004313),
('m141127_065859_add_new_teble_feedback', 1417071916),
('m142033_140325_add_new_table_payment', 1416998296),
('m142053_141025_add_new_column_Payments', 1416998296);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_pages`
--

CREATE TABLE IF NOT EXISTS `tbl_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) DEFAULT NULL,
  `is_public` smallint(6) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `content` text,
  `meta_k` varchar(255) DEFAULT NULL,
  `meta_d` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `tbl_pages`
--

INSERT INTO `tbl_pages` (`id`, `created_at`, `is_public`, `slug`, `title`, `description`, `content`, `meta_k`, `meta_d`) VALUES
(2, 1409471781, 0, 'about', 'О проекте', NULL, '<p class="site-about">\r\n</p>\r\n<p>\r\n	Luc Factory – это новая игра с выводом денег, которая позволяет с легкостью зарабатывать, причем, не проводя много времени за компьютером. Здесь все достаточно просто. Инвестор регистрируется, пополняет игровой счет удобным ему способом и уже через несколько минут начинает получать прибыль, которую легко вывести из игры на реальный счет электронных денег или на банковский счет.\r\n</p>\r\n<center><img src="/img/business-process.png" alt="Схема бизнесс-процесса для заработка в игре Luc Factory" width="920" height="1000" border="0"></center>\r\n<p>\r\n	Курс: \r\n	<strong>100 галлонов воды = 100 грамм луца = 1 чатл -&gt; 100 чатлов = 1 рубль</strong>\r\n</p>\r\n<p>\r\n	<strong>Насос 5 кат.</strong><br>\r\n	 Стоимость: 18000 чатлов / 180 рублей\r\n	<br>\r\n	 Производительность: 834 галлонов в час / 20000 галлонов в день / 600000 галлонов в месяц\r\n	<br>\r\n	 Доход при пересчете производительности в чатлы и затем в рубли: 2 рубля в день / 60 рублей в месяц\r\n	<br>\r\n	 Окупаемость ~ 90 дней\r\n</p>\r\n<p>\r\n	<strong>Насос 4 кат.</strong><br>\r\n	 Стоимость: 32000 чатлов / 320 рублей\r\n	<br>\r\n	 Производительность: 1779 галлонов в час / 42700 галлонов в день / 1281000 галлонов в месяц\r\n	<br>\r\n	 Доход при пересчете производительности в чатлы и затем в рубли: 4.27 рубля в день / 128.1 рублей в месяц\r\n	<br>\r\n	 Окупаемость ~ 75 дней\r\n</p>\r\n<p>\r\n	<strong>Насос 3 кат.</strong><br>\r\n	 Стоимость: 120000 чатлов / 1200 рублей\r\n	<br>\r\n	 Производительность: 8334 галлонов в час / 200000 галлонов в день / 6000000 галлонов в месяц\r\n	<br>\r\n	 Доход при пересчете производительности в чатлы и затем в рубли: 20 рублей в день / 600 рублей в месяц\r\n	<br>\r\n	 Окупаемость ~ 60 дней\r\n</p>\r\n<p>\r\n	<strong>Насос 2 кат.</strong><br>\r\n	 Стоимость: 450000 чатлов / 4500 рублей\r\n	<br>\r\n	 Производительность: 41667 галлонов в час / 1000000 галлонов в день / 30000000 галлонов в месяц\r\n	<br>\r\n	 Доход при пересчете производительности в чатлы и затем в рубли: 100 рублей в день / 3000 рублей в месяц\r\n	<br>\r\n	 Окупаемость ~ 45 дней\r\n</p>\r\n<p>\r\n	<strong>Насос 1 кат.</strong><br>\r\n	 Стоимость: 960000 чатлов / 9600 рублей\r\n	<br>\r\n	 Производительность: 133334 галлонов в час / 3200000 галлонов в день / 96000000 галлонов в месяц\r\n	<br>\r\n	 Доход при пересчете производительности в чатлы и затем в рубли: 320 рублей в день / 9600 рублей в месяц\r\n	<br>\r\n	 Окупаемость ~ 30 дней\r\n</p>\r\n<p>\r\n	При расчетах следует учитывать, что прибыль и окупаемость посчитана без разделения по счетам. В игре имеется два счета - счет для покупок и счет с которого можно выводить деньги. При пополнении средства зачисляются на счет для покупок и эти деньги можно инвестировать. Все что добывают насосы распределяется по двум счетам в соотношении: 30% поступает на счет для покупок и 70% на счет для вывода. При этом есть возможность сделать перевод средств со счета предназначенного на вывод, на счет для покупок, получив при этом бонус реинвестирования 30%.\r\n</p>\r\n<p>\r\n	<strong>Платежных баллов в игре нет</strong>, все что накопилось можно выводить без ограничений. Минималка на вывод - 3 рубля.\r\n</p>\r\n<p>\r\n	Учитывая все вышеперечисленное, можно разрабатывать различные эффективные стратегии. Также не забывайте про реферальную систему, вы будете получать 20% от сумм пополнений всех пользователей зарегистрировавшихся по вашей реферальной ссылке (эти бонусные 20% берутся из средств резервного фонда игры).\r\n</p>\r\n<p style="clear:both;">\r\n</p>', NULL, NULL),
(3, 1412604129, NULL, 'news', 'Новости', NULL, '<p class="site-about">\r\n</p>\r\n<table width="100%" align="center" cellpadding="5" cellspacing="5" border="0">\r\n<tbody>\r\n<tr>\r\n	<td align="left">\r\n		<strong>Открытие сайта!</strong>\r\n	</td>\r\n	<td align="right">\r\n		<strong>10.08.2014</strong>\r\n	</td>\r\n</tr>\r\n<tr>\r\n	<td colspan="2">\r\n		<p>\r\n			Поздравляю с открытием проекта, желаю высоких заработков всем! Не забывайте о существовании 20% реферальной системы, приглашайте знакомых, чтобы существенно увеличить свои доходы и помочь заработать другим.\r\n		</p>\r\n	</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="clear:both;">\r\n</p>', NULL, NULL),
(4, 1412604272, NULL, 'index', 'Главная', NULL, '<h2>Это не Земля и не Африка, родной. Это планета Плюк, 215 в Тентуре.</h2>\r\n<p style="min-height: 138px;">\r\n	<img src="/img/ImgIndex.jpg" width="262" height="213" alt="Экономическая игра с выводом денег" style="float: right; padding-left: 20px;"><br>\r\n	<em>Земля в антитентуре, родной. И мы до неё никак долететь не можем, понимаешь? Поэтому зарабатывать будем, здесь, на Плюке. И зарабатывать будем не игрой на бандуре, а установкой насосных станций и выкачиванием остатков воды из недр Плюка. Воду будем перерабатывать в луц (топливо для пепелаца) и продавать его на луцеколонке за чатлы, которые можно в последствии вывести на реальный счет.</em>\r\n</p>\r\n<p>\r\n	        Luc Factory - быстро развивающаяся, уникальная экономическая онлайн игра - Ваш стабильный и надежный доход! Игра подходит как для новичков, так и для опытных игроков. Luc Factory доступна для игры онлайн в любом современном браузере. Вкладывая небольшие суммы, игрокам предстоит строить собственную экономическую стратегию и извлекать прибыль. Возможен моментальный вывод, \r\n	<strong>без платёжных балов</strong>.\r\n</p>\r\n<p align="center" style="font-weight: bold;">\r\n	Не пропусти, проводится акция "<span style="font-size: 16px; color: red;">Зарегистрируйся сейчас и получи насос 5 категории в подарок!</span>", в рамках которой каждый новый пользователь проекта получает насосную станцию начального уровня, совершенно бесплатно.\r\n</p>\r\n<p>\r\n	<strong>Немного об игровом процессе.</strong> Как вы уже наверное поняли, игра базируется на интереснейшей вселенной Кин-дза-дза! Действия происходят в то время, когда из Плюка еще не выкачали всю воду. Вода, как известно, основная составляющая для производства луца. Игроку, выступающему в роли чатланена, предстоит приобретать насосные станции и выкачивать, с их помощью, воду из Плюка. Воду можно переработать в луц и продать на луцеколонке за местную валюту - чатлы, которые впоследствии можно вывести через платёжную систему, конвертировав по внутриигровому курсу и/или использовать для покупки новых насосных станций. Насосные станции бывают 5-и категорий и их производительность зависит от категории. Вы можете покупать любое количество насосных станций.\r\n</p>\r\n<p>\r\n	    Насосные станции не ломаются, не имеют срока годности и будут всегда приносить доход (в том числе, когда вы находитесь вне игры). Вам не нужно беспокоиться о частом посещении игры. Вы всегда сможете переработать накопленную воду в луц, луц продать за чатлы, а чатлы перевести в реальные деньги. Посещайте игру с любой, удобной для вас, периодичностью.\r\n</p>\r\n<p>\r\n	    Плюк - планета № 215 в галактике Кин–дза-дза.\r\n	<br>\r\n    Луц - это топливо использующееся для полётов пепелаца внутри атмосферы.\r\n	<br>\r\n    Пепелац – межзвездный корабль.\r\n	<br>\r\n    Чатлане – жители планеты Плюк (высшая каста).\r\n	<br>\r\n    Луцеколонка - станция, где можно продать луц.\r\n	<br>\r\n    Чатл - денежная единица, используемая на планетах Плюк и Хануд.\r\n</p>\r\n<p>\r\n	<strong>Наши преимущества.</strong> Вы всегда в курсе размера резервного фонда и общей суммы выплаченной участникам проекта. Возможность многократно приумножать свой капитал. Реферальная система с высокими отчислениями за привлечение новых участников (вы будете получать 20% от суммы каждого пополнения баланса вашими рефералами). Автоматический ввод в игру и вывод денег на ваш счет. Низкая минималка на вывод, всего 3 рубля. Оперативная поддержка.\r\n</p>\r\n<p>\r\n	<strong>Начни игру.</strong> Начать играть можно без затрат. Ежедневные бонусы, лотерея, конкурсы. Напоминаем, о наличии партнерской программы. Приглашайте в игру своих друзей и знакомых, зарабатывайте.\r\n</p>', NULL, NULL),
(7, 1412604272, NULL, 'contact', 'Контакты', NULL, '<table><tbody><tr><td><h1>Контакты</h1></td><td></td></tr></tbody></table><p>По вопросам, связанным с технической поддержкой (проблемы, ошибки), можете сообщить через  форму обратной связи расположенную ниже. Если у вас есть вопросы по несправедливой, по вашему мнению, блокировке, ознакомьтесь еще раз с <a href="file:///E:/OpenServer/domains/lucfactory/html/rules.html">правилами проекта</a>.</p><p>Приблизительное время ответа технической поддержки – 24 часа. Тем не менее, мы всегда стараемся ответить как можно быстрее. Наша техническая поддержка работает с 12:00 до 20:00 в будние дни (по московскому времени).</p>', NULL, NULL),
(8, 1412604272, NULL, 'rules', 'Правила', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_payments`
--

CREATE TABLE IF NOT EXISTS `tbl_payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `sum` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `purse` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_payment_history`
--

CREATE TABLE IF NOT EXISTS `tbl_payment_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `signature` varchar(200) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_station`
--

CREATE TABLE IF NOT EXISTS `tbl_station` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `performance` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `tbl_station`
--

INSERT INTO `tbl_station` (`id`, `category`, `name`, `performance`, `price`, `img`) VALUES
(1, '5 категории', '(слабая насосная станция)', '834.00', '18000.00', '001.png'),
(2, '4 категории', '(улучшеная насосная станция)', '4.00', '4.00', '002.png'),
(3, '3 категории', '(насосная станция средней мощности)', '3.00', '3.00', '003.png'),
(4, '2 категории', '(мощная насосная станция)', '2.00', '2.00', '004.png'),
(5, '1 категории', '(сверхмощная насосная станция)', '133334.00', '960000.00', '005.png');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_tickets`
--

CREATE TABLE IF NOT EXISTS `tbl_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `message` text,
  `created_at` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT '',
  `activate_key` varchar(255) DEFAULT NULL,
  `out_balance` decimal(20,2) DEFAULT '0.00',
  `in_balance` decimal(20,2) DEFAULT '0.00',
  `referrals` int(11) DEFAULT NULL,
  `online` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `email`, `auth_key`, `password_hash`, `password_reset_token`, `created_at`, `updated_at`, `role`, `activate_key`, `out_balance`, `in_balance`, `referrals`, `online`) VALUES
(9, 'admin', 'admin@admin.com', '', '$2y$13$Zc646EmE4UKzUM0cDWTnm.OA633KUYThvzgHdkotdKpA2zqiAB1R6', '', '2014-08-08 07:57:16', '2015-01-14 08:41:57', 'administrator', NULL, '0.00', '0.00', 37, NULL),
(36, 'Дмитрий', 'zaithev@gmail.com', '2', '$2y$13$/8HnC9NlvesYwMAl/x0BLuh5dpHs7r6X.0PsNDpKvu2mMbsk8kSRu', '', '2014-11-27 06:00:09', '2015-01-14 10:48:40', 'administrator', NULL, '0.00', '120069.00', NULL, '2014-11-27 08:42:56'),
(37, 'Тестер', 'referral@gmail.com', '', '$2y$13$2p5lIGfto0QX/YYGFNeGKeNTHPgj6QVJQP4hiByizsex/ZyJtGmGy', NULL, '2014-11-27 06:07:28', '2015-01-14 08:41:57', 'user', NULL, '0.00', '600000.00', 36, '2014-11-27 07:11:58');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_userstantion`
--

CREATE TABLE IF NOT EXISTS `tbl_userstantion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `stantion_id` int(11) unsigned NOT NULL,
  `count_stations_purchased` int(11) DEFAULT '0',
  `woter` decimal(20,2) DEFAULT '0.00',
  `lutz` decimal(20,2) DEFAULT '0.00',
  `update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_userstantion_ibfk_3` (`stantion_id`),
  KEY `tbl_userstantion_ibfk_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Дамп данных таблицы `tbl_userstantion`
--

INSERT INTO `tbl_userstantion` (`id`, `user_id`, `stantion_id`, `count_stations_purchased`, `woter`, `lutz`, `update`) VALUES
(40, 36, 1, 1, '0.00', '0.00', NULL),
(41, 37, 1, 1, '0.00', '0.00', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user_invoice`
--

CREATE TABLE IF NOT EXISTS `tbl_user_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sum` text,
  `created_at` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tbl_auth_assignment`
--
ALTER TABLE `tbl_auth_assignment`
  ADD CONSTRAINT `tbl_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tbl_auth_item`
--
ALTER TABLE `tbl_auth_item`
  ADD CONSTRAINT `tbl_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `tbl_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tbl_auth_item_child`
--
ALTER TABLE `tbl_auth_item_child`
  ADD CONSTRAINT `tbl_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `tbl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tbl_bonus`
--
ALTER TABLE `tbl_bonus`
  ADD CONSTRAINT `fk_bonus_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tbl_lottery`
--
ALTER TABLE `tbl_lottery`
  ADD CONSTRAINT `FK_tbl_lottery` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tbl_payment_history`
--
ALTER TABLE `tbl_payment_history`
  ADD CONSTRAINT `fk_history_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tbl_userstantion`
--
ALTER TABLE `tbl_userstantion`
  ADD CONSTRAINT `tbl_userstantion_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_userstantion_ibfk_3` FOREIGN KEY (`stantion_id`) REFERENCES `tbl_station` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
