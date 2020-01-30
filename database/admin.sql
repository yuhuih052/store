-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: store
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,0,1,'首页','fa-bar-chart','/',NULL,'2019-12-18 12:11:48'),(2,0,6,'系统管理','fa-tasks',NULL,NULL,'2020-01-22 15:00:06'),(3,2,7,'管理员','fa-users','auth/users',NULL,'2020-01-22 15:00:06'),(4,2,8,'角色','fa-user','auth/roles',NULL,'2020-01-22 15:00:06'),(5,2,9,'权限','fa-ban','auth/permissions',NULL,'2020-01-22 15:00:06'),(6,2,10,'菜单','fa-bars','auth/menu',NULL,'2020-01-22 15:00:06'),(7,2,11,'操作日志','fa-history','auth/logs',NULL,'2020-01-22 15:00:06'),(8,0,2,'用户管理','fa-users','/users','2019-12-19 06:04:52','2019-12-19 06:07:29'),(9,0,4,'商品管理','fa-cubes','/products','2019-12-19 08:15:15','2020-01-22 15:00:06'),(10,0,3,'订单列表','fa-list-ol','/orders','2020-01-14 11:24:14','2020-01-22 15:00:06'),(11,0,5,'优惠券管理','fa-cut','/coupon_codes','2020-01-22 14:59:49','2020-01-22 15:00:56');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_permissions`
--

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` VALUES (1,'所有权限','*','','*',NULL,'2019-12-18 13:49:46'),(2,'管理后台首页','dashboard','GET','/',NULL,'2019-12-20 11:08:04'),(3,'登录 退出','auth.login','','/auth/login\r\n/auth/logout',NULL,'2019-12-18 13:43:37'),(4,'修改个人信息','auth.setting','GET,PUT','/auth/setting',NULL,'2019-12-18 13:54:03'),(5,'系统设置','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,'2019-12-20 11:01:00'),(6,'用户管理','users','','/users*','2019-12-18 13:43:06','2019-12-18 14:32:33'),(7,'商品管理','products','','/products*','2020-01-29 03:35:37','2020-01-29 03:35:37'),(8,'订单管理','orders','','/orders*','2020-01-29 03:36:29','2020-01-29 03:36:29'),(9,'优惠券管理','coupon_codes','','/coupon_codes','2020-01-29 03:37:12','2020-01-29 03:37:12');
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,5,NULL,NULL),(1,4,NULL,NULL),(1,3,NULL,NULL),(1,2,NULL,NULL),(1,6,NULL,NULL),(1,7,NULL,NULL),(1,10,NULL,NULL),(3,10,NULL,NULL),(1,11,NULL,NULL),(3,11,NULL,NULL),(1,8,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_permissions`
--

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` VALUES (1,1,NULL,NULL),(3,2,NULL,NULL),(3,3,NULL,NULL),(3,4,NULL,NULL),(3,7,NULL,NULL),(3,8,NULL,NULL),(3,9,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_users`
--

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` VALUES (1,1,NULL,NULL),(3,3,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_roles`
--

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` VALUES (1,'Administrator','administrator','2019-12-18 11:22:00','2019-12-18 11:22:00'),(3,'运营人员','operator','2019-12-19 06:50:51','2019-12-19 06:50:51');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_user_permissions`
--

LOCK TABLES `admin_user_permissions` WRITE;
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
INSERT INTO `admin_user_permissions` VALUES (3,2,NULL,NULL),(3,3,NULL,NULL),(3,4,NULL,NULL),(3,7,NULL,NULL),(3,8,NULL,NULL),(3,9,NULL,NULL);
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','$2y$10$QWgK4XZgP/qtvVjdGqtTsuZj7wDg5pcVL0lzzbvZORCb.xHQd86gy','黄宇辉','images/yuhui.jpg','7uau7032zorkdImt8hhQNtcBOj9hsHp53tNaiVPvgAOvIc5DlOtbyE1aukKk','2019-12-18 11:22:00','2020-01-29 03:47:08'),(3,'admin2','$2y$10$//6Sm5j9/5JV3SL.IdxOueOqmbKzC.//7A/15VIqr2qlkDCeTpy62','运营',NULL,'a0dfADj24pWRVj9od1AqHuiK2BR1xOctTSQGMD52VYBqCizxkV621j4r3Lod','2019-12-19 06:51:23','2020-01-29 03:48:36');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-29  4:21:07
