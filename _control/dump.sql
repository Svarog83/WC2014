-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2010 at 07:35 PM
-- Server version: 5.0.18
-- PHP Version: 5.2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `bets`
--

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
CREATE TABLE IF NOT EXISTS `email` (
  `em_id` int(10) unsigned NOT NULL auto_increment COMMENT 'Auto increment ID',
  `em_game` int(10) unsigned NOT NULL COMMENT 'Game ID',
  `em_user` int(10) unsigned NOT NULL COMMENT 'User id',
  PRIMARY KEY  (`em_id`),
  KEY `em_game` (`em_game`,`em_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Хранит инфу, кому были отправлен�' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `email`
--


-- --------------------------------------------------------

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `g_id` int(10) unsigned NOT NULL auto_increment COMMENT 'Auto increment ID',
  `g_tour` tinyint(3) unsigned NOT NULL COMMENT 'Tour number',
  `g_team1` int(10) unsigned NOT NULL COMMENT 'Home team',
  `g_team2` int(10) unsigned NOT NULL COMMENT 'Team ID',
  `g_date_time` date NOT NULL,
  `g_remarks` text NOT NULL,
  `g_result` varchar(10) NOT NULL COMMENT 'Результат',
  PRIMARY KEY  (`g_id`),
  KEY `m_team` (`g_team2`),
  KEY `g_team1` (`g_team1`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Matches schedule' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`g_id`, `g_tour`, `g_team1`, `g_team2`, `g_date_time`, `g_remarks`, `g_result`) VALUES
(1, 1, 5, 12, '2010-03-12', '', ''),
(2, 2, 12, 3, '2010-03-05', '', ''),
(3, 1, 2, 7, '2010-03-13', '', ''),
(4, 1, 9, 3, '2010-03-13', '', ''),
(5, 1, 1, 4, '2010-03-13', '', ''),
(6, 1, 13, 8, '2010-03-13', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `game_user_link`
--

DROP TABLE IF EXISTS `game_user_link`;
CREATE TABLE IF NOT EXISTS `game_user_link` (
  `gul_id` int(10) unsigned NOT NULL auto_increment COMMENT 'Auto increment ID',
  `gul_user` int(10) unsigned NOT NULL COMMENT 'User id',
  `gul_game` int(10) unsigned NOT NULL COMMENT 'Game ID',
  `gul_go` tinyint(3) unsigned NOT NULL COMMENT 'Флаг, показывает, что человек идет',
  `gul_remarks` varchar(255) NOT NULL COMMENT 'Комментарии от пользователя',
  PRIMARY KEY  (`gul_id`),
  KEY `gul_user` (`gul_user`,`gul_game`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Связь игроков с играми' AUTO_INCREMENT=1 ;

--
-- Dumping data for table `game_user_link`
--


-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(10) unsigned NOT NULL auto_increment COMMENT 'Auto increment ID',
  `news_date` datetime NOT NULL COMMENT 'Дата новости',
  `news_text` text NOT NULL COMMENT 'Текст новости',
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `news`
--


-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_name` varchar(10) NOT NULL COMMENT 'Имя роли',
  `role_description` varchar(255) NOT NULL COMMENT 'Описание роли',
  PRIMARY KEY  (`role_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Хранит информацию о возможных ур';

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_name`, `role_description`) VALUES
('adm', 'admin'),
('user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `set_id` mediumint(8) unsigned NOT NULL auto_increment COMMENT 'Setting ID',
  `sett_name` varchar(20) NOT NULL COMMENT 'Name of the option',
  `sett_value` varchar(255) NOT NULL COMMENT 'Option Value',
  PRIMARY KEY  (`set_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Different options' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`set_id`, `sett_name`, `sett_value`) VALUES
(1, 'S_TOUR', '1');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `t_id` int(10) unsigned NOT NULL auto_increment COMMENT 'Auto increment ID',
  `t_name` varchar(255) NOT NULL COMMENT 'Team name',
  PRIMARY KEY  (`t_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`t_id`, `t_name`) VALUES
(1, 'Рубин'),
(2, 'Спартак'),
(3, 'Зенит'),
(4, 'Локомотив'),
(5, 'ЦСКА'),
(6, 'Сатурн'),
(7, 'Динамо'),
(8, 'Томь'),
(9, 'Крылья Советов'),
(10, 'Спартак Нч'),
(11, 'Терек'),
(12, 'Амкар'),
(13, 'Ростов'),
(14, 'Анжи'),
(15, 'Сибирь'),
(16, 'Алания');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL auto_increment COMMENT 'User''s autoincrement ID',
  `user_fam` varchar(255) NOT NULL COMMENT 'User''s family',
  `user_name` varchar(255) NOT NULL COMMENT 'User''s name',
  `user_email` varchar(255) NOT NULL COMMENT 'User''s email',
  `user_login` varchar(32) NOT NULL COMMENT 'Логин',
  `user_pwd` varchar(32) NOT NULL COMMENT 'Пароль Хранится в зашифрованном виде',
  `user_create_dtm` datetime NOT NULL COMMENT 'Дата-время заведения в системе',
  `user_state` char(1) NOT NULL COMMENT 'Статус (A – активен, B- заблокирован)',
  `user_state_dtm` datetime NOT NULL COMMENT 'Дата-время изменения статуса',
  `user_role` varchar(10) NOT NULL COMMENT 'Роль юзера (adm-админ, svisor - супервайзер, user -пользователь), [role->role_name]',
  `user_supervisor` int(10) unsigned NOT NULL COMMENT 'Проставляется id супервайзера',
  `user_login_dtm` datetime NOT NULL COMMENT 'Время последнего входа. ',
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_login` (`user_login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fam`, `user_name`, `user_email`, `user_login`, `user_pwd`, `user_create_dtm`, `user_state`, `user_state_dtm`, `user_role`, `user_supervisor`, `user_login_dtm`) VALUES
(1, 'Ветко', 'Сергей', 'sergey@vetko.net', 'Svarog', 'a518307d11516c8d2163b52946357c5f', '2009-09-01 18:21:17', 'a', '2009-09-01 18:21:17', 'adm', 0, '2010-03-05 17:47:14'),
(18, 'Томаров', 'Кирилл', 'k.tomarov@itgr.ru', 'kirill', '9e3669d19b675bd57058fd4664205d2a', '2010-03-05 15:00:59', 'a', '2010-03-05 15:00:59', 'user', 0, '0000-00-00 00:00:00'),
(17, 'Жданов', 'Антон', 'A.Zhdanov@itgr.ru', 'Anton', '9e3669d19b675bd57058fd4664205d2a', '2010-03-05 15:00:39', 'a', '2010-03-05 15:00:39', 'user', 0, '0000-00-00 00:00:00'),
(16, 'Андриянов', 'Илья', 'aist@pochta.ru', 'andriyanov', '9e3669d19b675bd57058fd4664205d2a', '2010-03-05 17:46:47', 'a', '2010-03-05 17:46:47', 'adm', 0, '2010-03-05 15:02:37');
