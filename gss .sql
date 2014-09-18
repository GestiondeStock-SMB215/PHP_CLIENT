-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2014 at 08:35 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gss`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `bra_id` int(11) NOT NULL AUTO_INCREMENT,
  `bra_name` varchar(45) DEFAULT NULL,
  `bra_cnt_id` int(11) DEFAULT NULL,
  `bra_city` varchar(45) DEFAULT NULL,
  `bra_add_str` varchar(45) DEFAULT NULL,
  `bra_add_1` text,
  `bra_tel_1` varchar(128) DEFAULT NULL,
  `bra_tel_2` varchar(128) DEFAULT NULL,
  `bra_fax` varchar(128) DEFAULT NULL,
  `bra_email` varchar(128) DEFAULT NULL,
  `bra_time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`bra_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`bra_id`, `bra_name`, `bra_cnt_id`, `bra_city`, `bra_add_str`, `bra_add_1`, `bra_tel_1`, `bra_tel_2`, `bra_fax`, `bra_email`, `bra_time_stamp`) VALUES
(2, 'Cnam Bekfaya', 118, 'Bekfaya', 'Main Road', 'ISAE - Cnam Bekfaya', '04986321', '04986321', '04986321', 'beckfaya@isae.edu.lb', '2014-09-09 11:29:00'),
(3, 'Dbaye', 118, 'Aokar', '123', '345', '981234', '098345', '1314', 'cnam@hotmail.com', '2014-09-18 18:37:16'),
(4, 'gfrdg', 5, 'v fdbv', 'bvfgdb', '5', 'bgfn ', 'bgf', 'bngf', 'bgfd', '2014-09-18 18:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(128) DEFAULT NULL,
  `cat_desc` text,
  `cat_time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_desc`, `cat_time_stamp`) VALUES
(1, 'Books', 'All books, memo...', '2014-09-11 00:00:00'),
(2, 'CD', 'All CDs and DVDs', '2014-09-11 00:00:00'),
(4, 'vfdr', 'vfsd', '2014-09-16 23:08:57'),
(5, 'Organza', 'Organza Silk ', '2014-09-17 13:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `col_id` int(11) NOT NULL AUTO_INCREMENT,
  `col_name` varchar(128) NOT NULL,
  `col_code` varchar(128) NOT NULL,
  `col_time_stamp` datetime NOT NULL,
  PRIMARY KEY (`col_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`col_id`, `col_name`, `col_code`, `col_time_stamp`) VALUES
(1, 'No specific color', '#ffffff', '2014-09-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `cnt_id` int(11) NOT NULL AUTO_INCREMENT,
  `cnt_iso` char(2) DEFAULT NULL,
  `cnt_name` varchar(80) DEFAULT NULL,
  `cnt_nicename` varchar(80) DEFAULT NULL,
  `cnt_iso3` char(3) DEFAULT NULL,
  `cnt_numcode` smallint(6) DEFAULT NULL,
  `cnt_phonecode` int(5) NOT NULL,
  `cnt_time_stamp` datetime NOT NULL,
  PRIMARY KEY (`cnt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=240 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`cnt_id`, `cnt_iso`, `cnt_name`, `cnt_nicename`, `cnt_iso3`, `cnt_numcode`, `cnt_phonecode`, `cnt_time_stamp`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93, '2014-07-04 07:15:55'),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355, '2014-07-04 07:15:55'),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213, '2014-07-04 07:15:55'),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684, '2014-07-04 07:15:55'),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376, '2014-07-04 07:15:55'),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244, '2014-07-04 07:15:55'),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264, '2014-07-04 07:15:55'),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0, '2014-07-04 07:15:55'),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268, '2014-07-04 07:15:55'),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54, '2014-07-04 07:15:55'),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374, '2014-07-04 07:15:55'),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297, '2014-07-04 07:15:55'),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61, '2014-07-04 07:15:55'),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43, '2014-07-04 07:15:55'),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994, '2014-07-04 07:15:55'),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242, '2014-07-04 07:15:55'),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973, '2014-07-04 07:15:55'),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880, '2014-07-04 07:15:55'),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246, '2014-07-04 07:15:55'),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375, '2014-07-04 07:15:55'),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32, '2014-07-04 07:15:55'),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501, '2014-07-04 07:15:55'),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229, '2014-07-04 07:15:55'),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441, '2014-07-04 07:15:55'),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975, '2014-07-04 07:15:55'),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591, '2014-07-04 07:15:55'),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387, '2014-07-04 07:15:55'),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267, '2014-07-04 07:15:55'),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0, '2014-07-04 07:15:55'),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55, '2014-07-04 07:15:55'),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246, '2014-07-04 07:15:55'),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673, '2014-07-04 07:15:55'),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359, '2014-07-04 07:15:55'),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226, '2014-07-04 07:15:55'),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257, '2014-07-04 07:15:55'),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855, '2014-07-04 07:15:55'),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237, '2014-07-04 07:15:55'),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1, '2014-07-04 07:15:55'),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238, '2014-07-04 07:15:55'),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345, '2014-07-04 07:15:55'),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236, '2014-07-04 07:15:55'),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235, '2014-07-04 07:15:55'),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56, '2014-07-04 07:15:55'),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86, '2014-07-04 07:15:55'),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61, '2014-07-04 07:15:55'),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672, '2014-07-04 07:15:55'),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57, '2014-07-04 07:15:55'),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269, '2014-07-04 07:15:55'),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242, '2014-07-04 07:15:55'),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242, '2014-07-04 07:15:55'),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682, '2014-07-04 07:15:55'),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506, '2014-07-04 07:15:55'),
(53, 'CI', 'COTE D''IVOIRE', 'Cote D''Ivoire', 'CIV', 384, 225, '2014-07-04 07:15:55'),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385, '2014-07-04 07:15:55'),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53, '2014-07-04 07:15:55'),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357, '2014-07-04 07:15:55'),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420, '2014-07-04 07:15:55'),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45, '2014-07-04 07:15:55'),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253, '2014-07-04 07:15:55'),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767, '2014-07-04 07:15:55'),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809, '2014-07-04 07:15:55'),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593, '2014-07-04 07:15:55'),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20, '2014-07-04 07:15:55'),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503, '2014-07-04 07:15:55'),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240, '2014-07-04 07:15:55'),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291, '2014-07-04 07:15:55'),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372, '2014-07-04 07:15:55'),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251, '2014-07-04 07:15:55'),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500, '2014-07-04 07:15:55'),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298, '2014-07-04 07:15:55'),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679, '2014-07-04 07:15:55'),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358, '2014-07-04 07:15:55'),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33, '2014-07-04 07:15:55'),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594, '2014-07-04 07:15:55'),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689, '2014-07-04 07:15:55'),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0, '2014-07-04 07:15:55'),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241, '2014-07-04 07:15:55'),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220, '2014-07-04 07:15:55'),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995, '2014-07-04 07:15:55'),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49, '2014-07-04 07:15:55'),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233, '2014-07-04 07:15:55'),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350, '2014-07-04 07:15:55'),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30, '2014-07-04 07:15:55'),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299, '2014-07-04 07:15:55'),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473, '2014-07-04 07:15:55'),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590, '2014-07-04 07:15:55'),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671, '2014-07-04 07:15:55'),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502, '2014-07-04 07:15:55'),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224, '2014-07-04 07:15:55'),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245, '2014-07-04 07:15:55'),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592, '2014-07-04 07:15:55'),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509, '2014-07-04 07:15:55'),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0, '2014-07-04 07:15:55'),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39, '2014-07-04 07:15:55'),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504, '2014-07-04 07:15:55'),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852, '2014-07-04 07:15:55'),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36, '2014-07-04 07:15:55'),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354, '2014-07-04 07:15:55'),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91, '2014-07-04 07:15:55'),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62, '2014-07-04 07:15:55'),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98, '2014-07-04 07:15:55'),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964, '2014-07-04 07:15:55'),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353, '2014-07-04 07:15:55'),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972, '2014-07-04 07:15:55'),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39, '2014-07-04 07:15:55'),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876, '2014-07-04 07:15:55'),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81, '2014-07-04 07:15:55'),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962, '2014-07-04 07:15:55'),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7, '2014-07-04 07:15:55'),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254, '2014-07-04 07:15:55'),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686, '2014-07-04 07:15:55'),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'Korea, Democratic People''s Republic of', 'PRK', 408, 850, '2014-07-04 07:15:55'),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82, '2014-07-04 07:15:55'),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965, '2014-07-04 07:15:55'),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996, '2014-07-04 07:15:55'),
(116, 'LA', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'Lao People''s Democratic Republic', 'LAO', 418, 856, '2014-07-04 07:15:55'),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371, '2014-07-04 07:15:55'),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961, '2014-07-04 07:15:55'),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266, '2014-07-04 07:15:55'),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231, '2014-07-04 07:15:55'),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218, '2014-07-04 07:15:55'),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423, '2014-07-04 07:15:55'),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370, '2014-07-04 07:15:55'),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352, '2014-07-04 07:15:55'),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853, '2014-07-04 07:15:55'),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389, '2014-07-04 07:15:55'),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261, '2014-07-04 07:15:55'),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265, '2014-07-04 07:15:55'),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60, '2014-07-04 07:15:55'),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960, '2014-07-04 07:15:55'),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223, '2014-07-04 07:15:55'),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356, '2014-07-04 07:15:55'),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692, '2014-07-04 07:15:55'),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596, '2014-07-04 07:15:55'),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222, '2014-07-04 07:15:55'),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230, '2014-07-04 07:15:55'),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269, '2014-07-04 07:15:55'),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52, '2014-07-04 07:15:55'),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691, '2014-07-04 07:15:55'),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373, '2014-07-04 07:15:55'),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377, '2014-07-04 07:15:55'),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976, '2014-07-04 07:15:55'),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664, '2014-07-04 07:15:55'),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212, '2014-07-04 07:15:55'),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258, '2014-07-04 07:15:55'),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95, '2014-07-04 07:15:55'),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264, '2014-07-04 07:15:55'),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674, '2014-07-04 07:15:55'),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977, '2014-07-04 07:15:55'),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31, '2014-07-04 07:15:55'),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599, '2014-07-04 07:15:55'),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687, '2014-07-04 07:15:55'),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64, '2014-07-04 07:15:55'),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505, '2014-07-04 07:15:55'),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227, '2014-07-04 07:15:55'),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234, '2014-07-04 07:15:55'),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683, '2014-07-04 07:15:55'),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672, '2014-07-04 07:15:55'),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670, '2014-07-04 07:15:55'),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47, '2014-07-04 07:15:55'),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968, '2014-07-04 07:15:55'),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92, '2014-07-04 07:15:55'),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680, '2014-07-04 07:15:55'),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970, '2014-07-04 07:15:55'),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507, '2014-07-04 07:15:55'),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675, '2014-07-04 07:15:55'),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595, '2014-07-04 07:15:55'),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51, '2014-07-04 07:15:55'),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63, '2014-07-04 07:15:55'),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0, '2014-07-04 07:15:55'),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48, '2014-07-04 07:15:55'),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351, '2014-07-04 07:15:55'),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787, '2014-07-04 07:15:55'),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974, '2014-07-04 07:15:55'),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262, '2014-07-04 07:15:55'),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40, '2014-07-04 07:15:55'),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70, '2014-07-04 07:15:55'),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250, '2014-07-04 07:15:55'),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290, '2014-07-04 07:15:55'),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869, '2014-07-04 07:15:55'),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758, '2014-07-04 07:15:55'),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508, '2014-07-04 07:15:55'),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784, '2014-07-04 07:15:55'),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684, '2014-07-04 07:15:55'),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378, '2014-07-04 07:15:55'),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239, '2014-07-04 07:15:55'),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966, '2014-07-04 07:15:55'),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221, '2014-07-04 07:15:55'),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381, '2014-07-04 07:15:55'),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248, '2014-07-04 07:15:55'),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232, '2014-07-04 07:15:55'),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65, '2014-07-04 07:15:55'),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421, '2014-07-04 07:15:55'),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386, '2014-07-04 07:15:55'),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677, '2014-07-04 07:15:55'),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252, '2014-07-04 07:15:55'),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27, '2014-07-04 07:15:55'),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0, '2014-07-04 07:15:55'),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34, '2014-07-04 07:15:55'),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94, '2014-07-04 07:15:55'),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249, '2014-07-04 07:15:55'),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597, '2014-07-04 07:15:55'),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47, '2014-07-04 07:15:55'),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268, '2014-07-04 07:15:55'),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46, '2014-07-04 07:15:55'),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41, '2014-07-04 07:15:55'),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963, '2014-07-04 07:15:55'),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886, '2014-07-04 07:15:55'),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992, '2014-07-04 07:15:55'),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255, '2014-07-04 07:15:55'),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66, '2014-07-04 07:15:55'),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670, '2014-07-04 07:15:55'),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228, '2014-07-04 07:15:55'),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690, '2014-07-04 07:15:55'),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676, '2014-07-04 07:15:55'),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868, '2014-07-04 07:15:55'),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216, '2014-07-04 07:15:55'),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90, '2014-07-04 07:15:55'),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370, '2014-07-04 07:15:55'),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649, '2014-07-04 07:15:55'),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688, '2014-07-04 07:15:55'),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256, '2014-07-04 07:15:55'),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380, '2014-07-04 07:15:55'),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971, '2014-07-04 07:15:55'),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44, '2014-07-04 07:15:55'),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1, '2014-07-04 07:15:55'),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1, '2014-07-04 07:15:55'),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598, '2014-07-04 07:15:55'),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998, '2014-07-04 07:15:55'),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678, '2014-07-04 07:15:55'),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58, '2014-07-04 07:15:55'),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84, '2014-07-04 07:15:55'),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284, '2014-07-04 07:15:55'),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340, '2014-07-04 07:15:55'),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681, '2014-07-04 07:15:55'),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212, '2014-07-04 07:15:55'),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967, '2014-07-04 07:15:55'),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260, '2014-07-04 07:15:55'),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263, '2014-07-04 07:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_comp` varchar(128) DEFAULT NULL,
  `cust_name` varchar(128) DEFAULT NULL,
  `cust_title` varchar(4) DEFAULT NULL,
  `cust_add_1` text,
  `cust_add_2` text,
  `cust_city` varchar(128) DEFAULT NULL,
  `cust_cnt_id` int(11) DEFAULT NULL,
  `cust_tel_1` varchar(128) DEFAULT NULL,
  `cust_tel_2` varchar(128) DEFAULT NULL,
  `cust_fax` varchar(128) DEFAULT NULL,
  `cust_email` varchar(256) DEFAULT NULL,
  `cust_site` varchar(256) DEFAULT NULL,
  `cust_logo` varchar(256) DEFAULT NULL,
  `cust_time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_comp`, `cust_name`, `cust_title`, `cust_add_1`, `cust_add_2`, `cust_city`, `cust_cnt_id`, `cust_tel_1`, `cust_tel_2`, `cust_fax`, `cust_email`, `cust_site`, `cust_logo`, `cust_time_stamp`) VALUES
(1, 'vdfsv', 'vfdvbfd', 'Mr.', 'vfdsvb', ' czx ', '123', 118, '5646', '456', '56', 'vdfs', 'vcds', 'none', '2014-09-15 20:13:05'),
(6, 'q', 'q', '', 'q', 'q', 'q', 118, 'q', 'q', 'q', 'q', 'q', 'none', '2014-09-18 20:27:40'),
(7, 'k', 'k', 'Mr.', 'k', 'k', 'k', 109, 'k', 'k', 'k', 'k', 'k', 'none', '2014-09-18 20:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_in`
--

CREATE TABLE IF NOT EXISTS `invoice_in` (
  `inv_in_id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_in_ord_in_id` int(11) DEFAULT NULL,
  `inv_in_cust_id` int(11) DEFAULT NULL,
  `inv_in_date` datetime DEFAULT NULL,
  `inv_in_num` varchar(45) DEFAULT NULL,
  `inv_in_total` double DEFAULT NULL,
  `inv_in_tax` double DEFAULT NULL,
  `inv_in_disc` double DEFAULT NULL,
  `inv_in_total_due` double DEFAULT NULL,
  `inv_in_status` int(11) DEFAULT NULL,
  `inv_in_att` varchar(256) NOT NULL,
  `inv_in_time_stamp` datetime NOT NULL,
  PRIMARY KEY (`inv_in_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_in_detail`
--

CREATE TABLE IF NOT EXISTS `invoice_in_detail` (
  `inv_in_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_in_det_inv_id` int(11) NOT NULL,
  `inv_in_det_prod_id` int(11) DEFAULT NULL,
  `inv_in_det_qty` int(11) DEFAULT NULL,
  `inv_in_det_up` double DEFAULT NULL,
  `inv_in_det_total` double DEFAULT NULL,
  `inv_in_det_disc` double DEFAULT NULL,
  `inv_in_det_total_due` double NOT NULL,
  `inv_in_det_time_stamp` datetime NOT NULL,
  PRIMARY KEY (`inv_in_det_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_out`
--

CREATE TABLE IF NOT EXISTS `invoice_out` (
  `inv_out_id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_out_ord_out_id` int(11) DEFAULT NULL,
  `inv_out_sup_id` int(11) DEFAULT NULL,
  `inv_out_date` datetime DEFAULT NULL,
  `inv_out_num` varchar(45) DEFAULT NULL,
  `inv_out_total` double DEFAULT NULL,
  `inv_out_tax` double DEFAULT NULL,
  `inv_out_disc` double DEFAULT NULL,
  `inv_out_total_due` double DEFAULT NULL,
  `inv_out_status` int(11) DEFAULT NULL,
  `inv_out_att` varchar(256) DEFAULT NULL,
  `inv_out_time_stamp` datetime NOT NULL,
  PRIMARY KEY (`inv_out_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_out_detail`
--

CREATE TABLE IF NOT EXISTS `invoice_out_detail` (
  `inv_out_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_out_det_inv_id` int(11) NOT NULL,
  `inv_out_det_prod_id` int(11) DEFAULT NULL,
  `inv_out_det_qty` int(11) DEFAULT NULL,
  `inv_out_det_up` double DEFAULT NULL,
  `inv_out_det_total` double NOT NULL,
  `inv_out_det_disc` double NOT NULL,
  `inv_out_det_tota_due` double NOT NULL,
  `inv_out_det_time_stamp` datetime NOT NULL,
  PRIMARY KEY (`inv_out_det_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_in`
--

CREATE TABLE IF NOT EXISTS `order_in` (
  `ord_in_id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_in_cust_id` int(11) DEFAULT NULL,
  `ord_in_date` datetime DEFAULT NULL,
  `ord_in_del_date` datetime DEFAULT NULL,
  `ord_in_status` int(11) DEFAULT NULL,
  `ord_in_time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`ord_in_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_in_detail`
--

CREATE TABLE IF NOT EXISTS `order_in_detail` (
  `ord_in_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_in_det_ord_in_id` int(11) DEFAULT NULL,
  `ord_in_det_prod_id` int(11) DEFAULT NULL,
  `ord_in_det_qty` int(11) DEFAULT NULL,
  `ord_in_det_time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`ord_in_det_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_out`
--

CREATE TABLE IF NOT EXISTS `order_out` (
  `ord_out_id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_out_sup_id` varchar(45) DEFAULT NULL,
  `ord_out_date` datetime DEFAULT NULL,
  `ord_out_del_date` datetime DEFAULT NULL,
  `ord_out_status` int(11) DEFAULT NULL,
  `ord_out_time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`ord_out_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_out_detail`
--

CREATE TABLE IF NOT EXISTS `order_out_detail` (
  `ord_out_det_id` int(11) NOT NULL AUTO_INCREMENT,
  `ord_out_det_ord_out_id` int(11) DEFAULT NULL,
  `ord_out_det_prod_id` int(11) DEFAULT NULL,
  `ord_out_det_qty` int(11) DEFAULT NULL,
  `ord_out_det_time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`ord_out_det_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_parent_id` int(11) NOT NULL,
  `page_name` varchar(64) NOT NULL,
  `page_url` varchar(256) NOT NULL,
  `page_acl` int(11) NOT NULL,
  `page_in_menu` tinyint(4) NOT NULL,
  `page_order` int(11) DEFAULT NULL,
  `page_time_stamp` datetime NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`page_id`, `page_parent_id`, `page_name`, `page_url`, `page_acl`, `page_in_menu`, `page_order`, `page_time_stamp`) VALUES
(1, 0, 'Administration', '', 1, 1, 1, '2014-09-08 13:59:48'),
(2, 1, 'Page Management', '/page/show.php', 1, 1, 1, '2014-09-08 13:59:48'),
(3, 1, 'User Management', '/user/show.php', 1, 1, 2, '2014-09-08 13:59:48'),
(4, 2, 'Add Page', '/page/add.php', 1, 0, 0, '2014-09-08 14:02:54'),
(5, 2, 'Edit Page', '/page/edit.php', 1, 0, 0, '2014-09-08 14:02:54'),
(6, 2, 'Delete Page', '/page/delete.php', 1, 0, 0, '2014-09-08 14:02:54'),
(7, 3, 'Add User', '/user/add.php', 1, 0, 0, '2014-09-08 14:02:54'),
(8, 3, 'Edit User', '/user/edit.php', 1, 0, 0, '2014-09-08 14:02:54'),
(9, 3, 'Delete User', '/user/delete.php', 1, 0, 0, '2014-09-08 14:02:54'),
(10, 1, 'Index', '/index.php', 5, 0, 0, '2014-09-08 14:02:54'),
(11, 0, 'Management', '', 2, 1, 2, '2014-09-09 10:47:27'),
(12, 11, 'Branch Management', '/bra/show.php', 2, 1, 1, '2014-09-09 10:54:55'),
(13, 12, 'Add Branch', '/bra/add.php', 2, 0, 1, '2014-09-11 12:34:35'),
(14, 12, 'Edit Branch', '/bra/edit.php', 2, 0, 1, '2014-09-11 12:35:28'),
(15, 12, 'Delete Branch', '/bra/delete.php', 2, 0, 1, '2014-09-11 12:35:39'),
(16, 11, 'Product Management', '/prod/show.php', 2, 1, 1, '2014-09-11 12:37:55'),
(17, 11, 'Category Management', '/cat/show.php', 2, 1, 1, '2014-09-11 12:38:11'),
(18, 17, 'Add Category', '/cat/add.php', 2, 0, 1, '2014-09-11 13:03:14'),
(19, 17, 'Edit Category', '/cat/edit.php', 2, 0, 1, '2014-09-11 13:03:25'),
(20, 17, 'Delete Category', '/cat/delete.php', 2, 0, 1, '2014-09-11 13:03:33'),
(21, 0, 'GSS', '', 3, 1, 3, '2014-09-12 09:20:27'),
(22, 11, 'Customer Management', '/cust/show.php', 2, 1, 0, '2014-09-12 20:19:40'),
(23, 22, 'Delete Customer', '/cust/delete.php', 2, 1, NULL, '2014-09-15 21:02:12'),
(24, 16, 'Add Product', '/prod/add.php', 2, 1, NULL, '2014-09-15 21:08:38'),
(25, 11, 'Supplier Management', '/sup/show.php', 1, 1, NULL, '2014-09-15 22:14:03'),
(26, 25, 'Delete Supplier', '/sup/delete.php', 2, 0, NULL, '2014-09-15 22:32:37'),
(27, 16, 'Delete Product', '/prod/delete.php', 2, 0, NULL, '2014-09-15 22:39:46'),
(28, 21, 'Transfert', '/trans/show.php', 3, 1, 1, '2014-09-16 00:00:00'),
(29, 22, 'Edit Customer', '/cust/edit.php', 2, 0, 1, '2014-09-18 20:07:23'),
(30, 16, 'Edit product', '/prod/edit.php', 2, 0, 1, '2014-09-18 21:16:16'),
(31, 25, 'Edit supplier', '/sup/edit.php', 2, 0, 1, '2014-09-18 21:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_cat_id` int(11) DEFAULT NULL COMMENT 'This is linked to the categories table (Electronics, Computers, Clothes...) it depends on the project purpose',
  `prod_sku` varchar(128) DEFAULT NULL COMMENT 'The Stock Keeping Unit is a unique identifier defined by your company. For example, your comapny may assign a gallon of Tropicana orange juice a SKU of TROPOJ100. Most times, the SKU is represented by the manufacturer''s UPC',
  `prod_upc` varchar(128) DEFAULT NULL COMMENT 'The Universal Product Code is a unique and standrad identifier typically shown under the bar code symbol on retail packaging in the United States (BARCODE)',
  `prod_name` varchar(128) DEFAULT NULL,
  `prod_desc` text,
  `prod_qty` int(11) DEFAULT NULL COMMENT 'the global quantity (this is the sum of all qty in all branches)',
  `prod_color` varchar(128) DEFAULT NULL,
  `prod_size` varchar(45) DEFAULT NULL,
  `prod_weight` double DEFAULT NULL,
  `prod_sup_id` int(11) DEFAULT NULL COMMENT 'Foreigh Key to the supplier table',
  `prod_status` tinyint(4) DEFAULT NULL COMMENT 'The status is to know if this product is available (1) or not (0)',
  `prod_pic` varchar(256) DEFAULT NULL COMMENT 'the product pic (if exist) this is the picture name (1a9b123d12312c12312.jpg)',
  `prod_vend_id` int(11) DEFAULT NULL COMMENT 'A link to the vendor (ex: band like nike, nokia, samsung...)',
  `prod_time_stamp` datetime DEFAULT NULL COMMENT 'creation date',
  PRIMARY KEY (`prod_id`),
  UNIQUE KEY `prod_sku_UNIQUE` (`prod_sku`),
  UNIQUE KEY `prod_idsku_UNIQUE` (`prod_upc`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_cat_id`, `prod_sku`, `prod_upc`, `prod_name`, `prod_desc`, `prod_qty`, `prod_color`, `prod_size`, `prod_weight`, `prod_sup_id`, `prod_status`, `prod_pic`, `prod_vend_id`, `prod_time_stamp`) VALUES
(1, 2, 'C2P1S1', '811138000202', 'Apprener Javascript', 'Des lecons électronique pour apprendre à coder en javascript.', 1, 'none', '700MB', 0.5, 0, 1, ' ', 0, '2014-09-11 00:00:00'),
(3, 1, 'C1P1S1', '211132748201', 'Java Bible', 'Java Bible Book', 1, 'none', '', 3000, 0, 1, '', 0, '2014-09-11 00:00:00'),
(13, 1, '12', '121', '121', '12', 12, '12', '12', 121, 1, 0, 'none', 0, '2014-09-18 21:09:22'),
(14, 1, 'aejhdf', 'esfhd', '7', '7', 7, '7', '7', 7, 1, 0, 'none', 0, '2014-09-18 21:10:24'),
(15, 4, 'vfds', 'vgfsrd', 'vgfd', 'bfgd', 0, 'bfd', 'vfdsv', 1, 1, 1, 'none', 0, '2014-09-18 21:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) DEFAULT NULL,
  `role_desc` text,
  `role_time_stamp` datetime NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_desc`, `role_time_stamp`) VALUES
(1, 'Admin', NULL, '2014-07-16 13:00:32'),
(2, 'Manager', NULL, '2014-07-16 13:00:32'),
(3, 'User', NULL, '2014-07-16 13:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `shipper`
--

CREATE TABLE IF NOT EXISTS `shipper` (
  `ship_id` int(11) NOT NULL AUTO_INCREMENT,
  `ship_name` varchar(128) DEFAULT NULL,
  `ship_type` int(11) DEFAULT NULL,
  `ship_add_1` text,
  `ship_add_2` text,
  `ship_tel_1` varchar(128) DEFAULT NULL,
  `ship_tel_2` varchar(128) DEFAULT NULL,
  `ship_fax` varchar(128) DEFAULT NULL,
  `ship_email` varchar(128) DEFAULT NULL,
  `ship_taxable` tinyint(4) DEFAULT '1',
  `ship_time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`ship_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_prod_id` int(11) DEFAULT NULL,
  `stock_bra_id` int(11) DEFAULT NULL,
  `stock_qty` int(11) DEFAULT NULL,
  `stock_time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `sup_id` int(11) NOT NULL AUTO_INCREMENT,
  `sup_comp` varchar(128) DEFAULT NULL,
  `sup_name` varchar(128) DEFAULT NULL,
  `sup_title` varchar(4) DEFAULT NULL,
  `sup_add_1` text,
  `sup_add_2` text,
  `sup_city` varchar(128) DEFAULT NULL,
  `sup_cnt_id` int(11) DEFAULT NULL,
  `sup_tel_1` varchar(128) DEFAULT NULL,
  `sup_tel_2` varchar(128) DEFAULT NULL,
  `sup_fax` varchar(128) DEFAULT NULL,
  `sup_email` varchar(256) DEFAULT NULL,
  `sup_site` varchar(256) DEFAULT NULL,
  `sup_logo` varchar(256) DEFAULT NULL,
  `sup_time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`sup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`sup_id`, `sup_comp`, `sup_name`, `sup_title`, `sup_add_1`, `sup_add_2`, `sup_city`, `sup_cnt_id`, `sup_tel_1`, `sup_tel_2`, `sup_fax`, `sup_email`, `sup_site`, `sup_logo`, `sup_time_stamp`) VALUES
(1, 'cds', 'vfsd', 'vfsd', 'vfds', 'vfsd', 'vfsd', 226, 'vfds', 'vfsd', 'vfsd', 'vfsd', 'vfds', '', '2014-09-15 22:11:54'),
(2, 'asd', 'asd', 'ad', 'asd', 'asd', 'asd', 118, '123', '123', '123', 'asd@sadf.com', 'asd', '', '2014-09-15 22:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE IF NOT EXISTS `tracking` (
  `track_id` int(11) NOT NULL AUTO_INCREMENT,
  `track_trans_id` int(11) DEFAULT NULL,
  `track_ship_id` int(11) NOT NULL,
  `track_time_stamp` datetime NOT NULL,
  PRIMARY KEY (`track_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transfert`
--

CREATE TABLE IF NOT EXISTS `transfert` (
  `trans_id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_src_bra_id` int(11) DEFAULT NULL,
  `trans_dest_bra_id` int(11) DEFAULT NULL,
  `trans_send_date` datetime DEFAULT NULL,
  `trans_del_date` datetime DEFAULT NULL,
  `trans_status` int(11) DEFAULT NULL,
  `trans_time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`trans_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trans_detail`
--

CREATE TABLE IF NOT EXISTS `trans_detail` (
  `trans_det_id` int(11) NOT NULL,
  `trans_det_trans_id` int(11) DEFAULT NULL,
  `trans_det_prod_id` int(11) DEFAULT NULL,
  `trans_det_qty` int(11) DEFAULT NULL,
  `trans_det_time_stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`trans_det_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) DEFAULT NULL,
  `user_name` varchar(128) DEFAULT NULL,
  `user_username` varchar(45) DEFAULT NULL,
  `user_password` varchar(256) DEFAULT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_last_login` datetime NOT NULL,
  `user_status` int(11) DEFAULT NULL,
  `user_time_stamp` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_role_id`, `user_name`, `user_username`, `user_password`, `user_email`, `user_last_login`, `user_status`, `user_time_stamp`) VALUES
(1, 1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gss.com', '2014-09-18 18:25:55', 1, '2014-07-27 11:07:00'),
(2, 1, 'Henry Kozhaya', 'henry', '027e4180beedb29744413a7ea6b84a42', 'henry.kozhaya@gmail.com', '2014-09-12 09:18:36', 1, '2014-09-08 13:46:25'),
(3, 2, 'Management User', 'manager', '1d0258c2440a8d19e716292b231e3190', 'manage@cnam.fr', '0000-00-00 00:00:00', 1, '2014-09-09 18:22:01'),
(4, 3, 'vfdes', 'v dsz', '202cb962ac59075b964b07152d234b70', 'wadih@hotmail.com', '2014-09-16 22:14:38', 1, '2014-09-16 22:14:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
