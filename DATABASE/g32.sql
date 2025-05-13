-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.7.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for g32
CREATE DATABASE IF NOT EXISTS `g32` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `g32`;

-- Dumping structure for table g32.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `email` varchar(255) NOT NULL,
  `coins` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `type` enum('blacklisted','normal','manager','') NOT NULL DEFAULT 'normal',
  `ip` varchar(800) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `cooldown` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table g32.clients: ~1 rows (approximately)
INSERT INTO `clients` (`id`, `username`, `password`, `email`, `coins`, `paid`, `type`, `ip`, `level`, `cooldown`) VALUES
	(1, 'Admin_DG', '$2y$10$91O09crGyR.xqqQqPWDgge9.uOhksp3nxyD6V6LhPhMHMS9GIN5zC', 'Admin_DG@gmail.com', 2092.00, 0.00, 'manager', '::1', 2, '1744312011');

-- Dumping structure for table g32.key_topup
CREATE TABLE IF NOT EXISTS `key_topup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keytext` varchar(255) NOT NULL,
  `amount` decimal(10,2) DEFAULT 0.00,
  `date` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table g32.key_topup: ~0 rows (approximately)

-- Dumping structure for table g32.log_random
CREATE TABLE IF NOT EXISTS `log_random` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info` text NOT NULL,
  `date` text NOT NULL,
  `owner` text NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'mc',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table g32.log_random: ~0 rows (approximately)

-- Dumping structure for table g32.log_topup
CREATE TABLE IF NOT EXISTS `log_topup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction` varchar(255) NOT NULL,
  `point` decimal(10,2) NOT NULL,
  `username` varchar(255) NOT NULL,
  `time` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci;

-- Dumping data for table g32.log_topup: ~0 rows (approximately)

-- Dumping structure for table g32.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(1500) NOT NULL,
  `image` text NOT NULL,
  `description` mediumtext NOT NULL,
  `help` text NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pattern` enum('normaltext','code','eml:psw','usr:psw','usr:eml:psw') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table g32.products: ~10 rows (approximately)
INSERT INTO `products` (`id`, `name`, `image`, `description`, `help`, `price`, `pattern`) VALUES
	(1, 'Minecraft NFA', 'https://132185389.cdn6.editmysite.com/uploads/1/3/2/1/132185389/s152033754304157647_p1_i1_w699.jpeg', 'Minecraft NFA\r\n└ ไม่สามารถเปลี่ยนข้อมูลได้ทุกอย่าง\r\n└ สุ่มการโดนแบนจากเซิร์ฟเวอร์ <a href="">Hypixel</a>\r\n\r\nประกันการใช้งาน\r\n└ 1 วันหลังจากซื้อ', '► ดาวน์โหลดตัวเกมมายคราฟ<br>\r\n► กดล็อกอินด้วย Mojang<br>\r\n► Enjoy<br>', 2.00, 'eml:psw'),
	(2, 'Minecraft SFA', 'https://239575a368.cbaul-cdnwnd.com/967967943b93ba1f8d5eb9d227a3d178/200000004-ae6baae6bc/s-l400.jpg?ph=239575a368', 'Minecraft SFA\r\n└ สามารถเปลียนชื่อได้\r\n└ สามารถเปลียนรหัสได้\r\n└ สามารถเปลียนสกินได้\r\n└ ไม่สามารถเปลียน อีเมล กับ รหัสความปลอดภัยได้\r\n└ สุ่มการโดนแบนจากเซิร์ฟเวอร์ <a href="">Hypixel</a>\r\n\r\nประกันการใช้งาน\r\n└ 1 วันหลังจากซื้อ', '► ดาวน์โหลดตัวเกมมายคราฟ<br>\r\n► (สามารถเปลี่ยนข้อมูลได้ที่ <a href="https://minecraft.net/en-us/">Minecraft</a>)<br>\r\n► กดล็อกอินด้วย Mojang<br>\r\n► Enjoy<br>', 5.00, 'eml:psw'),
	(3, 'Minecraft MFA', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRta3sVXWBFmYUawUNFUax93UshqGgKnDLMNA&s', 'Minecraft MFA\r\n└ สามารถเปลียนชื่อได้\r\n└ สามารถเปลียนรหัสได้\r\n└ สามารถเปลียนสกินได้\r\n└ สามารถเปลียนอีเมลได้\r\n└ สามารถเปลียนรหัสรักษาความปลอดภัยได้\r\n└ สามารถเข้าถึงอีเมลของบัญชีได้\r\n└ สุ่มการโดนแบนจากเซิร์ฟเวอร์ <a href="">Hypixel</a>\r\n\r\nประกันการใช้งาน\r\n└ ตลอดอายุการใช้งาน', '► ดาวน์โหลดตัวเกมมายคราฟ<br>\r\n► (สามารถเปลี่ยนข้อมูลได้ที่ <a href="https://minecraft.net/en-us/">Minecraft</a>)<br>\r\n► กดล็อกอินด้วย Mojang<br>\r\n► Enjoy<br>', 350.00, 'normaltext'),
	(4, 'Discord Nitro Classic 1 Month', 'https://support.discord.com/hc/article_attachments/360013500032/nitro_gif.gif', 'Discord Nitro Classic 1 Month\r\n└ ไนโตร์ดิสคอด 1 เดือน\r\n└ ใช้ได้กับทุกประเภท\r\n\r\nประกันการใช้งาน\r\n└ ประกันตลอดการใช้งาน (1 เดือน)', '► กดที่ลิงก์<br>\r\n► เพิ่มที่อยู่การชำระเงิน<br>\r\n► Enjoy กับมัน!<br>', 99.00, 'normaltext'),
	(5, 'Discord Nitro 1 Month', 'https://gudstory.s3.us-east-2.amazonaws.com/wp-content/uploads/2021/02/08150513/Discord-Nitro.png', 'Discord Nitro 1 Month\r\n└ ไนโตร์ดิสคอด 1 เดือน\r\n└ ใช้ได้กับทุกประเภท\r\n\r\nประกันการใช้งาน\r\n└ ประกันตลอดการใช้งาน (1 เดือน)', '► กดที่ลิงก์<br>\r\n► เพิ่มที่อยู่การชำระเงิน<br>\r\n► Enjoy กับมัน!<br>', 219.00, 'normaltext'),
	(6, 'Netflix Premium สุ่มจอ', 'https://digitalagemag.com/wp-content/uploads/2021/01/netflix.png', 'Netflix Premium สุ่มจอ\r\n└ ไม่สามารถเปลี่ยนข้อมูลได้ทุกอย่าง\r\n└ ใช้สำหรับดูเท่านั้น\r\n└ 1 โปรไฟล์เท่านั้นห้ามสร้างเพิ่ม มิเช่นนั้นประกันขาด\r\n\r\nประกันการใช้งาน\r\n└ 1 วัน', '► เข้าไปที่เว็บไซต์ <a href="https://netflix.com">Netflix.com</a><br>\r\n► ล็อกอิน<br>\r\n► Enjoy<br>', 25.00, 'eml:psw'),
	(7, 'OnlyFans สุ่มจำนวนเงิน', 'https://static.thairath.co.th/media/4DQpjUtzLUwmJZZSC5CnRPh8mlUiVesST50OMJ3Vf3lw.jpg', 'OnlyFans สุ่มจำนวนเงิน\r\n└ ไม่สามารถเปลี่ยนข้อมูลได้ทุกอย่าง\r\n└ กดซับได้แค่ 1 ต่ออาทิยต์หรือ 1 - 3\r\n└ สุ่มซับ\r\n└ เงินในบัญชี 0 - 100$\r\n└ บางบัญชีอาจเป็นบัญชีปล่าว\r\n\r\nประกันการใช้งาน\r\n└ 1 วัน', '► เข้าไปที่เว็บไซต์ <a href="https://onlyfans.com">Onlyfans.com</a><br>\r\n► ล็อกอิน<br>\r\n► Enjoy<br>', 20.00, 'eml:psw'),
	(8, 'PornHub Premium', 'https://www.sopitas.com/wp-content/uploads/2020/03/pornhub-premium-gratis-coronavirus.jpg', 'PornHub Premium\r\n└ ไม่สามารถเปลี่ยนข้อมูลได้ทุกอย่าง\r\n\r\nประกันการใช้งาน\r\n└ 7 วัน', '► ใช้ VPN ของ <a href="https://nordvpn.com">NordVPN</a> หรืออื่นๆก็ได้ หรือซื้อจากร้านเราก็ได้นะ<br>\r\n► เข้าไปที่เว็บไซต์ <a href="https://pornhub.com">Pornhub.com</a><br>\r\n► ล็อกอิน<br>\r\n► Enjoy<br>', 70.00, 'eml:psw'),
	(9, 'NordVPN', 'https://www.globalwatchonline.com/wp-content/uploads/2019/11/nord.jpg', 'NordVPN\r\n└ ไม่สามารถเปลี่ยนข้อมูลได้ทุกอย่าง\r\n\r\nประกันการใช้งาน\r\n└ 1 วัน', '► เข้าไปที่เว็บไซต์ <a href="https://nordvpn.com">Nordvpn.com</a><br>\r\n► ดาวโหลดโปรแกรม><br>\r\n► ล็อกอิน<br>\r\n► Enjoy<br>', 25.00, 'eml:psw'),
	(10, 'Optifine Cape [สุ่มย้าย]', 'https://ph-test-11.slatic.net/p/e91c73f85ef7f3237c40b09102cf4b49.jpg', 'Optifine Cape [สุ่มย้าย]\r\n└ สุ่มการย้าย [ย้ายผ้าคลุม]\r\n└ สุ่มบัญชีแบบ NFA/SFA\r\n└ บางตัวอาจจะย้ายผ้าคลุมไม่ได้\r\n\r\nประกันการใช้งาน\r\n└ 1 ชม.\r\n└ หากมีปัญหาโปรดติดต่อแอดมินให้เร็วที่สุด', '► ดาวน์โหลดตัวเกมมายคราฟ<br>\r\n► กดล็อกอินด้วย Mojang<br>\r\n► Enjoy<br>', 20.00, 'eml:psw');

-- Dumping structure for table g32.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `truewallet` varchar(255) NOT NULL,
  `discord` varchar(255) NOT NULL,
  `page_id` varchar(255) NOT NULL,
  `theme_color` varchar(255) NOT NULL,
  `logged_in_greeting` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

-- Dumping data for table g32.settings: ~1 rows (approximately)
INSERT INTO `settings` (`id`, `title`, `description`, `image`, `keywords`, `truewallet`, `discord`, `page_id`, `theme_color`, `logged_in_greeting`) VALUES
	(1, 'DG Developer</>', 'ร้านขายไอดีเกมมายคราฟ และเกมอื่นๆ<br>ที่ถูกกว่าราคาตลาดทั่วไป', 'https://media.discordapp.net/attachments/1357561017088872582/1359778885805277346/DG96x96.png?ex=67f8b845&is=67f766c5&hm=03330aac5ab194a9b754096e541a40da981d76ee53b3557fe62828c88b5e9688&=&format=webp&quality=lossless', 'DG_Developer, ร้านขายไอดีแท้ราคาถูก', '0902211111', 'https://discord.gg/QBJZ7C2u', '111866090494315', '#03a9f4', 'ติดต่อสอบถามเกี่ยวกับสินค้า เติมเงิน หรือ รายงานระบบ');

-- Dumping structure for table g32.stock
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `type` int(255) NOT NULL,
  `contents` mediumtext NOT NULL,
  `owner` varchar(32) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table g32.stock: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
