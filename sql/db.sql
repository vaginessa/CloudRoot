-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cloud
CREATE DATABASE IF NOT EXISTS `cloud` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cloud`;

-- Dumping structure for table cloud.breaks
CREATE TABLE IF NOT EXISTS `breaks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(50) NOT NULL COMMENT 'Data do pedido',
  `user` varchar(50) DEFAULT NULL COMMENT 'Username do pedido',
  `tempo_pedido` enum('10','15','20') DEFAULT NULL COMMENT 'Tempo que foi pedido pelo user',
  `inicio` varchar(50) DEFAULT NULL COMMENT 'Hora de inicio do break',
  `final` varchar(50) DEFAULT NULL COMMENT 'Hora de final do break',
  `tempo_utilizado` varchar(50) DEFAULT NULL COMMENT 'Tempo utilizado',
  `aceite` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Se foi aceite pelo user',
  `autorizado` varchar(50) NOT NULL COMMENT 'A que horas foi autorizado',
  `quem_autorizou` varchar(50) DEFAULT NULL COMMENT 'Quem autorizou o break',
  `status` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Fechado ou nao o registo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cloud.breaks: ~0 rows (approximately)
/*!40000 ALTER TABLE `breaks` DISABLE KEYS */;
/*!40000 ALTER TABLE `breaks` ENABLE KEYS */;

-- Dumping structure for table cloud.callbacks
CREATE TABLE IF NOT EXISTS `callbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `nome` longtext,
  `numero` varchar(50) DEFAULT NULL,
  `comentario` longtext,
  `hora` varchar(255) DEFAULT NULL,
  `callback_data` varchar(255) DEFAULT NULL,
  `tratado` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cloud.callbacks: ~0 rows (approximately)
/*!40000 ALTER TABLE `callbacks` DISABLE KEYS */;
/*!40000 ALTER TABLE `callbacks` ENABLE KEYS */;

-- Dumping structure for table cloud.campanhas_servicos
CREATE TABLE IF NOT EXISTS `campanhas_servicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `type` enum('campanha','servico') DEFAULT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table cloud.campanhas_servicos: ~29 rows (approximately)
/*!40000 ALTER TABLE `campanhas_servicos` DISABLE KEYS */;
REPLACE INTO `campanhas_servicos` (`id`, `name`, `value`, `type`, `status`) VALUES
	(1, 'TVNETVOZ', 'TVNETVOZ:10', 'servico', 'Y'),
	(2, 'TVNETVOZ Protocolos Refid', 'TVNETVOZ Protocolos Refid:0', 'servico', 'Y'),
	(3, 'NETVoZ Fibra', 'NETVoZ Fibra:10', 'servico', 'Y'),
	(4, 'NETVoZ Fixa', 'NETVoZ Fixa:2.5', 'servico', 'Y'),
	(5, 'ADSL', 'ADSL:10', 'servico', 'Y'),
	(6, 'FIT', 'FIT:2.5', 'servico', 'Y'),
	(7, 'Red', 'Red:3.5', 'servico', 'Y'),
	(8, 'Red Adicional', 'Red Adicional:2.5', 'servico', 'Y'),
	(9, 'Red Refidlização', 'Red Refidlização:2.5', 'servico', 'Y'),
	(10, 'Red Refidlização Adicional', 'Red Refidlização Adicional:1', 'servico', 'Y'),
	(11, 'Portin RED', 'Portin RED:6', 'servico', 'Y'),
	(12, 'Portin Vodafone', 'Portin Vodafone:2.5', 'servico', 'Y'),
	(13, 'Vodafone Açores', 'Vodafone Açores:2', 'servico', 'Y'),
	(14, 'GSM', 'GSM:0', 'servico', 'Y'),
	(15, 'BLM', 'BLM:2.5', 'servico', 'Y'),
	(16, '12720', '12720', 'campanha', 'Y'),
	(17, 'TLMK_ADSL', 'TLMK_ADSL', 'campanha', 'Y'),
	(18, 'TLMK_Projectos', 'TLMK_Projectos', 'campanha', 'Y'),
	(19, 'TLMK_Consumo', 'TLMK_Consumo', 'campanha', 'Y'),
	(20, 'TLMK RHMais', 'TLMK RHMais', 'campanha', 'Y'),
	(21, 'IPTV TLMK', 'IPTV TLMK', 'campanha', 'Y'),
	(22, 'OUT_C2C_BOTAO', 'OUT_C2C_BOTAO', 'campanha', 'Y'),
	(23, 'OUT_C2C_4P', 'OUT_C2C_4P', 'campanha', 'Y'),
	(24, 'OUT_C2C_BLM', 'OUT_C2C_BLM', 'campanha', 'Y'),
	(25, 'OUT_C2C_Cobertura', 'OUT_C2C_Cobertura', 'campanha', 'Y'),
	(26, 'OUT_C2C_CoberturaOW', 'OUT_C2C_CoberturaOW', 'campanha', 'Y'),
	(27, 'OUT_C2C_MGM', 'OUT_C2C_MGM', 'campanha', 'Y'),
	(28, 'Out_IdentNZonasFTTH', 'Out_IdentNZonasFTTH', 'campanha', 'Y'),
	(29, 'OUT_FTTHZonasRurais', 'OUT_FTTHZonasRurais', 'campanha', 'Y');
/*!40000 ALTER TABLE `campanhas_servicos` ENABLE KEYS */;

-- Dumping structure for table cloud.log
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_text` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cloud.log: ~0 rows (approximately)
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;

-- Dumping structure for table cloud.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `format` enum('TOP','MIDDLE','BOTTOM') NOT NULL,
  `new_page` enum('Y','N') DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table cloud.menu: ~7 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
REPLACE INTO `menu` (`id`, `title`, `icon`, `link`, `status`, `format`, `new_page`) VALUES
	(1, 'HOME', 'home', 'home.php', 'Y', 'TOP', 'N'),
	(2, 'NOVO REGISTO', 'agenda', 'novo.php', 'Y', 'MIDDLE', 'N'),
	(3, 'VENDAS DIARIAS', 'shopping2', 'vendasdiarias.php', 'Y', 'MIDDLE', 'N'),
	(4, 'VENDAS', 'shopping1', 'vendas.php', 'Y', 'MIDDLE', 'N'),
	(5, 'CALLBACK', 'calendar', 'callback.php', 'Y', 'MIDDLE', 'N'),
	(6, 'CLIENTES', 'profile', '', 'N', 'BOTTOM', 'N'),
	(7, 'BREAK\'S', 'break', 'break_panel.php', 'Y', 'BOTTOM', 'N');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Dumping structure for table cloud.menu_gestao
CREATE TABLE IF NOT EXISTS `menu_gestao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `permission` enum('1','2','3','4','5','6') NOT NULL DEFAULT '2',
  `new_page` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table cloud.menu_gestao: ~2 rows (approximately)
/*!40000 ALTER TABLE `menu_gestao` DISABLE KEYS */;
REPLACE INTO `menu_gestao` (`id`, `title`, `icon`, `link`, `status`, `permission`, `new_page`) VALUES
	(1, 'Painel de Breaks', 'break', 'break_bot.php', 'Y', '2', 'N'),
	(2, 'Painel de Equipa', 'agenda', 'team_panel.php', 'Y', '5', 'N');
/*!40000 ALTER TABLE `menu_gestao` ENABLE KEYS */;

-- Dumping structure for table cloud.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) DEFAULT NULL,
  `auto_break` enum('Y','N') NOT NULL DEFAULT 'N',
  `max_breaks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cloud.settings: ~0 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
REPLACE INTO `settings` (`id`, `auto_break`, `max_breaks`) VALUES
	(1, 'N', 4);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table cloud.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT '',
  `password` varchar(50) DEFAULT '',
  `email` longtext,
  `sfid` varchar(50) DEFAULT '',
  `objectivo_bruto` int(11) DEFAULT '0',
  `CH` int(11) NOT NULL,
  `permissions` enum('1','2','3','4','5','6') DEFAULT '1',
  `equipa` enum('High5','Incredible','Flash','Lambert','Outstar','Gestao') DEFAULT NULL,
  `d_ferias` int(11) DEFAULT '0',
  `on_off` enum('ON','OFF') DEFAULT 'ON',
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table cloud.users: ~21 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `user`, `password`, `email`, `sfid`, `objectivo_bruto`, `CH`, `permissions`, `equipa`, `d_ferias`, `on_off`, `last_update`) VALUES
	(1, 'JORGEA', 'f073ba30ed875215e8d577fa0d1ec431', 'antonio.jorge@vodafone.com', '60472001 | 60472003', 418, 4, '6', 'High5', 0, 'ON', '2017-03-06 14:16:53'),
	(2, 'RIBEIROJ01', '', 'joana.ribeiro@vodafone.com', '60472000', 418, 4, '1', 'High5', 0, 'ON', '2017-03-06 14:16:58'),
	(3, 'BAUTOST', '', NULL, '', 368, 6, '1', 'High5', 0, 'ON', '2017-02-26 20:08:20'),
	(4, 'CASTANVB', '', NULL, '', 184, 4, '1', 'High5', 0, 'ON', '2017-03-06 14:16:06'),
	(5, 'RAMOSCM4', '', NULL, '', 491, 8, '1', 'High5', 0, 'ON', '2017-02-26 20:08:20'),
	(6, 'SousaA4', '', NULL, '', 246, 4, '1', 'High5', 0, 'ON', '2017-02-26 20:08:20'),
	(7, 'GarridoC', '', NULL, '', 368, 6, '1', 'High5', 0, 'ON', '2017-02-26 20:08:20'),
	(8, 'TAVARESF', '', NULL, '', 246, 4, '1', 'High5', 0, 'ON', '2017-02-26 20:08:20'),
	(9, 'RIBEIVM2', '', NULL, '', 0, 6, '1', 'High5', 0, 'OFF', '2017-02-26 20:08:20'),
	(10, 'SILVPP2', '', NULL, '', 0, 8, '1', 'High5', 0, 'OFF', '2017-02-26 20:08:20'),
	(11, 'EncarnacaoS', '', NULL, '', 368, 6, '1', 'High5', 0, 'ON', '2017-02-26 20:08:20'),
	(12, 'LOUSADAD', '', NULL, '', 368, 6, '1', 'High5', 0, 'ON', '2017-02-26 20:08:20'),
	(13, 'GUILHEFJ', '', NULL, '', 491, 8, '2', 'High5', 0, 'ON', '2017-03-06 14:15:10'),
	(14, 'MarreirosR', '', NULL, '', 368, 6, '1', 'High5', 0, 'ON', '2017-02-26 20:08:20'),
	(15, 'LOUREIUD', '', NULL, '', 295, 6, '1', 'High5', 0, 'ON', '2017-03-06 14:16:08'),
	(16, 'MARTINRS', '', NULL, '', 203, 6, '1', 'High5', 0, 'ON', '2017-03-06 14:16:09'),
	(17, 'RUAR', '', NULL, '', 368, 6, '1', 'High5', 0, 'ON', '2017-02-26 20:08:20'),
	(18, 'BAPTISJF', '', NULL, '', 270, 8, '1', 'High5', 0, 'ON', '2017-03-06 14:16:10'),
	(19, 'GONCALSN', '', NULL, '', 368, 6, '1', 'High5', 0, 'ON', '2017-02-26 20:08:20'),
	(20, 'AGUACB', '', NULL, '', 0, 8, '5', 'High5', 0, 'OFF', '2017-03-06 14:15:16'),
	(21, 'REBELOJ', '', 'joao.rebelo@vodafone.pt', '60472000', 0, 8, '6', 'Gestao', 0, 'OFF', '2017-02-26 20:08:20');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table cloud.vendas
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL DEFAULT 'JORGEA',
  `equipa` varchar(255) DEFAULT NULL,
  `nome` longtext,
  `campanha` varchar(19) CHARACTER SET utf8 DEFAULT NULL,
  `servico` varchar(28) CHARACTER SET utf8 DEFAULT NULL,
  `data` varchar(50) DEFAULT NULL,
  `data_instalacao` varchar(10) DEFAULT NULL,
  `nif` varchar(50) DEFAULT NULL,
  `call_id` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `pontos` float DEFAULT NULL,
  `comentario` longtext,
  `registado` enum('Y','N') DEFAULT 'N',
  `status` enum('ACTIVO','CANCELADO','PENDENTE','AC_MES_SEGUINTE') DEFAULT 'PENDENTE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table cloud.vendas: ~0 rows (approximately)
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
