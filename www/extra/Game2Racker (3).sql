-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2023 at 10:50 AM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Game2Racker`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `madeBy` int NOT NULL,
  `madeOn` int NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` varchar(6000) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `madeBy`, `madeOn`, `type`, `date`, `text`) VALUES
(2, 13, 202171, 'game', '2023-03-27 08:13:46', 'Nagyon jó játék 10/10'),
(10, 9, 18564, 'game', '2023-03-27 10:25:11', 'jo jatek'),
(12, 9, 18564, 'game', '2023-03-27 10:27:51', 'ganaj'),
(13, 13, 18564, 'game', '2023-03-27 13:10:22', 'aadadadada'),
(24, 19, 21, 'user', '2023-03-27 13:38:49', 'jo kep'),
(25, 19, 21, 'user', '2023-03-27 13:38:59', 'kopasz giliszta'),
(48, 13, 114879, 'game', '2023-03-29 08:53:08', 'adada'),
(56, 13, 114879, 'game', '2023-03-29 10:00:24', 'sdsdfsdfsdfsdfs'),
(77, 13, 81129, 'game', '2023-03-29 13:39:01', 'nem jo 10/-3'),
(78, 9, 168635, 'game', '2023-03-29 13:41:16', '????????????????????????????????????????????????'),
(79, 13, 81129, 'game', '2023-03-29 13:51:34', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(82, 29, 29, 'user', '2023-03-29 21:22:05', 'nav gazs razS'),
(91, 40, 39, 'user', '2023-03-31 08:47:45', 'noob vagy'),
(92, 40, 39, 'user', '2023-03-31 08:48:01', 'programozás feladat: kapd el öcsit'),
(93, 13, 40, 'user', '2023-03-31 08:48:51', '+rep'),
(97, 19, 8, 'user', '2023-03-31 10:55:25', 'szia\r\n'),
(100, 19, 8, 'user', '2023-03-31 10:57:47', 'ooooh haver tele vagyok pénzzel  yeah'),
(102, 13, 225747, 'game', '2023-03-31 13:14:48', 'nem jo'),
(104, 9, 42, 'user', '2023-04-03 08:19:12', 'te ki vagy more'),
(105, 9, 40, 'user', '2023-04-03 13:25:25', 'He is a very good teacher and a god'),
(107, 9, 114879, 'game', '2023-04-04 09:46:21', 'kaklanaf'),
(108, 9, 114879, 'game', '2023-04-04 09:46:55', 'kaklanaf2'),
(109, 9, 114879, 'game', '2023-04-04 09:55:56', 'gggggggg'),
(110, 9, 114879, 'game', '2023-04-04 11:41:36', 'kukuku'),
(114, 9, 119468, 'game', '2023-04-05 09:02:43', '<img src=\"https://2.bp.blogspot.com/-5ziVfqxoXSY/Wh3KSyQ8igI/AAAAAAAAVvk/YSdqDA6GX2Ql037Y9WF-9e1BzDnTyU5KACLcBGAs/s1600/shiny-smile.png\">'),
(156, 13, 18564, 'game', '2023-04-18 09:59:45', 'dksdksdsdks'),
(176, 9, 9, 'user', '2023-04-18 11:15:55', '🏀🏀🏀🏀🏀🏀🏀🏀🏀🏀🏀🏀🏀🏀'),
(178, 9, 9, 'user', '2023-04-18 12:17:43', 'GANTZ'),
(179, 9, 9, 'user', '2023-04-18 12:17:52', 'echo'),
(201, 9, 9, 'user', '2023-04-18 13:55:46', 'Oj Alija Alija ljiljanima babo\r\nI tebi će leđa okrenuti švabo\r\nOj Alija Aljo primi hladan tuš\r\nU brk ti se smije tvoj prijatelj Buš\r\nOj Alija Alija muslimanski izrode\r\nPrevešće te Tuđman žednog preko vode\r\nOj Alija Aljo male su ti međe\r\nDa si ost\'o sa nama bile bi još veće'),
(202, 9, 114879, 'game', '2023-04-18 14:04:52', '🏀🏀🏀🏀🏀🏀🏀🏀🏀🏀🏀🏀'),
(204, 9, 56, 'user', '2023-04-19 07:55:50', 'bobby muskle is here'),
(205, 9, 56, 'user', '2023-04-19 07:56:06', 'ain zwei drei fir'),
(215, 13, 125245, 'game', '2023-04-20 09:52:45', 'asdsad'),
(217, 64, 64, 'user', '2023-04-20 14:20:08', 'boing'),
(218, 64, 64, 'user', '2023-04-20 14:20:27', 'boing'),
(219, 64, 64, 'user', '2023-04-20 14:20:35', 'boing'),
(221, 81, 81, 'user', '2023-04-21 11:29:49', 'Ez egy komment'),
(222, 81, 81, 'user', '2023-04-21 11:30:07', 'Haló'),
(223, 81, 81, 'user', '2023-04-21 11:30:51', 'Szevasz'),
(224, 81, 81, 'user', '2023-04-21 11:30:58', 'Szia'),
(225, 81, 81, 'user', '2023-04-21 11:31:02', 'Heló'),
(226, 81, 81, 'user', '2023-04-21 11:31:16', 'bazdmeg'),
(227, 81, 81, 'user', '2023-04-21 11:31:21', 'Szia'),
(229, 81, 81, 'user', '2023-04-21 11:33:54', 'valami'),
(230, 23, 82, 'user', '2023-04-21 11:36:36', 'Üdv'),
(231, 82, 76359, 'game', '2023-04-21 11:37:12', 'Ez egy jó játék ;) 😎'),
(232, 82, 23, 'user', '2023-04-21 11:38:00', 'Üdv.!'),
(233, 13, 114879, 'game', '2023-04-22 18:45:24', 'akwkdadk'),
(235, 13, 14012, 'game', '2023-04-24 08:24:22', 'One of the best game ever!'),
(236, 85, 14012, 'game', '2023-04-24 08:28:40', 'Most relaxing game to ever exist.');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int NOT NULL,
  `gameID` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `picture` varchar(400) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `gameID`, `name`, `picture`) VALUES
(2, 14012, 'Stardew Valley', 'https:////images.igdb.com/igdb/image/upload/t_1080p/xrpmydnu9rpxvxfjkiu7.jpg'),
(3, 202171, 'Vampire Survivors', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co4bzv.jpg'),
(4, 274396, 'Vampire Survivors Legacy of the Moonspell', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co5vq4.jpg'),
(5, 297839, 'Vampire Survivors Tides of the Foscari', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co6dtb.jpg'),
(6, 125245, 'Crysis', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2on1.jpg'),
(7, 125246, 'Crysis 2', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2on2.jpg'),
(8, 125247, 'Crysis 3', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2on3.jpg'),
(9, 125248, 'Crysis Warhead', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2on4.jpg'),
(10, 205376, 'Crysis 4', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co4egw.jpg'),
(11, 87727, 'Crysis Wars', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1vov.jpg'),
(12, 125249, 'Crysis Remastered', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2on5.jpg'),
(13, 186795, 'Crysis 2 Remastered', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co404r.jpg'),
(14, 186794, 'Crysis 3 Remastered', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co404q.jpg'),
(15, 166255, 'Assassin\'s Creed Bundle Assassin\'s Creed Valhalla Assassin\'s Creed Odyssey and Assassin\'s Creed Origins', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co3ka7.jpg'),
(16, 111927, 'Assassin\'s Creed Valhalla', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2ed3.jpg'),
(17, 140203, 'Dinosaur Assassin Evolution', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co306j.jpg'),
(18, 90094, 'Assassin\'s Creed 3 Liberation', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1xim.jpg'),
(19, 178749, 'Assassin\'s Creed 4 Black Flag + Assassin\'s Creed Rogue Double Pack', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co3tx9.jpg'),
(20, 90098, 'Assassin\'s Creed Unity', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1xiq.jpg'),
(21, 114766, 'Assassin\'s Creed Freedom Cry', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2gjy.jpg'),
(22, 90100, 'Assassin\'s Creed Syndicate', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1xis.jpg'),
(23, 114764, 'Assassin\'s Creed 3 Remastered', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2gjw.jpg'),
(25, 18564, 'Titanfall 2', 'https:////images.igdb.com/igdb/image/upload/t_1080p/fhbeilnghyhhmjqhinqa.jpg'),
(26, 291912, 'Fortnite: Chapter 4 - Season 2: Mega', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co698o.jpg'),
(27, 11115, 'Gone Home', 'https:////images.igdb.com/igdb/image/upload/t_1080p/qwhxxrcxzw7inwfrfkbq.jpg'),
(28, 259305, 'Samurai Pussy', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co5k2x.jpg'),
(29, 292630, 'Diablo 4', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co69sm.jpg'),
(30, 286737, 'Vampire Survivors Chaos Update', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co658x.jpg'),
(31, 273040, 'LEGO 600 Super-Villains 600 TV Series Super-Villains Character Pack', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co5uog.jpg'),
(32, 208442, 'Hentai Climbing', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co4gu2.jpg'),
(33, 14125, 'The Black Bass', 'https://images.igdb.com/igdb/image/upload/t_cover_big/ubhplcepfprklyw68zzi.jpg'),
(34, 161890, 'Bass Class', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co3gwy.jpg'),
(35, 25274, 'Get Bass Sega Bass Fishing', 'https://images.igdb.com/igdb/image/upload/t_cover_big/nuclv9ggofjiyyxntte1.jpg'),
(36, 71083, 'Metro Exodus', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co1iuj.jpg'),
(37, 48533, 'Bass Pro Shops Trophy Bass 2007', 'https://images.igdb.com/igdb/image/upload/t_cover_big/a6tbx8u5mqvproakjefu.jpg'),
(38, 198807, 'Bassin\'s Black Bass', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co49ef.jpg'),
(39, 54551, 'Fisherman\'s Bass Club', 'https://images.igdb.com/igdb/image/upload/t_cover_big/j5pokucgli8c6vc2k3pe.jpg'),
(40, 22304, 'Rapala Pro Bass Fishing', 'https://images.igdb.com/igdb/image/upload/t_cover_big/pupqynv1s64egceabati.jpg'),
(41, 57282, 'Fisherman\'s Bait 2 Big Ol\' Bass', 'https://images.igdb.com/igdb/image/upload/t_cover_big/u0qnewurwv5rspzblccf.jpg'),
(42, 191385, 'Itoi Shigesato no Bass Tsuri No 1', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co43o9.jpg'),
(43, 49186, 'TNN Bass Tournament of Champions', 'https://images.igdb.com/igdb/image/upload/t_cover_big/ukmivahwddrm8z3ogd2n.jpg'),
(44, 198883, 'Fisherman\'s Bait A Bass Challenge', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co49gj.jpg'),
(45, 49489, 'ESPN Great Outdoor Games Bass 2002', 'https://images.igdb.com/igdb/image/upload/t_cover_big/cjveevftm2hhznrz3da0.jpg'),
(46, 112932, 'Bass Rush Ecogear PowerWorm Championship', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2f50.jpg'),
(47, 191387, 'Itoi Shigesato no Bass Tsuri No 1 Definitive Edition!', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co43ob.jpg'),
(48, 128403, 'Halo Combat Evolved', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2r2r.jpg'),
(49, 90047, 'Halo Combat Evolved Anniversary', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1xhb.jpg'),
(50, 84569, 'Halo The Master Chief Collection', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1t95.jpg'),
(51, 168417, 'Halo 4 Limited Edition', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co3ly9.jpg'),
(52, 164724, 'Halo 3 + Halo Wars', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co3j3o.jpg'),
(53, 90053, 'Halo 3 ODST', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1xhh.jpg'),
(54, 89700, 'Mass Effect', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1x7o.jpg'),
(55, 119429, 'Mass Effect Legendary Edition', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2k5h.jpg'),
(56, 152768, 'Mass Effect Andromeda', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co39vk.jpg'),
(57, 89702, 'Mass Effect 3', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1x7q.jpg'),
(58, 297730, 'Mass Effect 2', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co6dqa.jpg'),
(59, 90051, 'Halo 4', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co1xhf.jpg'),
(65, 41111, 'Rats!', 'https://images.igdb.com/igdb/image/upload/t_cover_big/wyrdoyh2sayxid0wlssb.jpg'),
(66, 224339, 'Space Rat', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co4t3n.jpg'),
(79, 297729, 'Mass Effect', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co6dq9.jpg'),
(80, 196852, 'Rat Attack!', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co47w4.jpg'),
(81, 89805, 'Occupy Mars: The Game', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co1xal.jpg'),
(82, 24083, 'Bless', 'https:////images.igdb.com/igdb/image/upload/t_1080p/kou1zn389ymh0n5yqp9f.jpg'),
(83, 261734, 'Rat Memory', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co5lye.jpg'),
(84, 23063, 'Schrödinger\'s Rat', 'https://images.igdb.com/igdb/image/upload/t_cover_big/mumd6jcnoxopilqvzk2c.jpg'),
(85, 297428, 'CyberCum: Pussy Attack!', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co6dhw.jpg'),
(86, 264091, 'City Bus Simulator Munich', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co5nrv.jpg'),
(87, 104831, 'Bus Simulator 18', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co28vz.jpg'),
(88, 152685, 'Bus Simulator 21', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co39t9.jpg'),
(89, 169347, 'Bus Driver Simulator 2019', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co3mo3.jpg'),
(90, 136988, 'The Bus', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2xp8.jpg'),
(91, 169346, 'Bus Driver', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co3mo2.jpg'),
(92, 291622, 'Cum on Bus', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co690m.jpg'),
(93, 83558, 'Hearthstone', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1sh2.jpg'),
(94, 68261, 'Assetto Corsa Competizione', 'https:////images.igdb.com/igdb/image/upload/t_1080p/t1cvrrqkk8hyiyrvlhkl.jpg'),
(95, 114879, 'Hogwarts Legacy', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co2gn3.jpg'),
(96, 199481, 'Minecraft', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co49x5.jpg'),
(97, 76359, 'Cities: Skylines', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co1mx3.jpg'),
(98, 273440, 'Star Wars Jedi Survivor', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co5uzk.jpg'),
(99, 81463, 'Xenonauts 2', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co1quv.jpg'),
(100, 104671, '8-Bit Adventures 2', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co28rj.jpg'),
(101, 182305, 'Titanfall', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co3wo1.jpg'),
(102, 134616, 'Super Mario All-Stars: Limited Edition', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co2vvc.jpg'),
(103, 105856, 'The Outlast Trials', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co29og.jpg'),
(104, 89271, 'Mario &amp; Sonic at the Olympic Winter Games', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1wvr.jpg'),
(105, 73663, 'Tom Clancy\'s Ghost Recon: Wildlands', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co1ku7.jpg'),
(106, 76712, 'Path of Exile', 'https:////images.igdb.com/igdb/image/upload/t_1080p/co1n6w.jpg'),
(107, 62905, 'Tractor Farmer', 'https:////images.igdb.com/igdb/image/upload/t_1080p/jobnuvyotq7pyp2ijyzt.jpg'),
(109, 138779, 'FiveM', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2z2z.jpg'),
(110, 199459, 'League of Legends', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co49wj.jpg'),
(111, 90090, 'Assassin\'s Creed 3', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1xii.jpg'),
(112, 220883, 'Assassin\'s Creed 4 Black Flag', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co4qfn.jpg'),
(113, 82095, 'Assassin\'s Creed 2', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rcf.jpg'),
(114, 90099, 'Assassin\'s Creed Rogue', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1xir.jpg'),
(115, 82652, 'Assassin\'s Creed', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rrw.jpg'),
(116, 124221, 'Assassin\'s Creed Odyssey', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2nul.jpg'),
(117, 82058, 'Assassin\'s Creed Origins', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rbe.jpg'),
(118, 90089, 'Assassin\'s Creed Revelations', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1xih.jpg'),
(119, 122403, 'Mass Effect', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2mg3.jpg'),
(120, 120932, 'Grand Theft Auto 3', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2lb8.jpg'),
(121, 120935, 'Grand Theft Auto Vice City', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2lbb.jpg'),
(122, 120933, 'Grand Theft Auto San Andreas', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2lb9.jpg'),
(123, 120955, 'Grand Theft Auto 4', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2lbv.jpg'),
(124, 120937, 'Grand Theft Auto 5', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2lbd.jpg'),
(125, 82062, 'Star Wars Jedi Fallen Order', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co1rbi.jpg'),
(126, 112205, 'Fortnite', 'https://images.igdb.com/igdb/image/upload/t_cover_big/co2ekt.jpg'),
(127, 46887, 'Rocky Memphis and the Temple of Ophuxoff', 'https://images.igdb.com/igdb/image/upload/t_cover_big/u1mk57uyjgybzwuqz6d8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `listGames`
--

CREATE TABLE `listGames` (
  `id` int NOT NULL,
  `listID` int NOT NULL,
  `gameID` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `listGames`
--

INSERT INTO `listGames` (`id`, `listID`, `gameID`, `date`) VALUES
(76, 176, 18564, '2023-04-19 10:31:58'),
(87, 160, 125245, '2023-04-19 10:58:00'),
(88, 160, 125246, '2023-04-19 10:58:09'),
(89, 160, 125247, '2023-04-19 10:58:12'),
(90, 160, 125248, '2023-04-19 10:58:15'),
(100, 158, 166255, '2023-04-19 11:10:23'),
(101, 158, 111927, '2023-04-19 11:10:25'),
(102, 158, 140203, '2023-04-19 11:10:28'),
(103, 158, 90094, '2023-04-19 11:10:31'),
(104, 158, 178749, '2023-04-19 11:10:34'),
(105, 158, 90098, '2023-04-19 11:10:41'),
(106, 158, 114766, '2023-04-19 11:10:44'),
(107, 158, 90100, '2023-04-19 11:10:47'),
(108, 158, 114764, '2023-04-19 11:10:53'),
(120, 157, 11115, '2023-04-19 12:28:51'),
(122, 185, 259305, '2023-04-19 12:30:34'),
(127, 158, 286737, '2023-04-19 20:56:32'),
(128, 158, 297839, '2023-04-19 20:56:46'),
(129, 158, 274396, '2023-04-19 20:56:50'),
(135, 185, 208442, '2023-04-19 22:20:14'),
(189, 209, 128403, '2023-04-20 09:38:28'),
(193, 209, 90047, '2023-04-20 09:38:45'),
(194, 209, 84569, '2023-04-20 09:38:54'),
(195, 209, 168417, '2023-04-20 09:38:59'),
(198, 210, 297839, '2023-04-20 09:39:25'),
(203, 210, 202171, '2023-04-20 09:44:51'),
(204, 209, 164724, '2023-04-20 09:45:34'),
(205, 209, 90053, '2023-04-20 09:45:40'),
(212, 209, 90051, '2023-04-20 09:53:26'),
(273, 219, 196852, '2023-04-20 11:00:09'),
(282, 219, 41111, '2023-04-20 11:14:35'),
(283, 219, 261734, '2023-04-20 11:14:52'),
(284, 219, 23063, '2023-04-20 11:17:06'),
(291, 210, 274396, '2023-04-20 12:42:18'),
(295, 227, 264091, '2023-04-20 13:59:33'),
(296, 227, 104831, '2023-04-20 13:59:41'),
(297, 227, 152685, '2023-04-20 13:59:43'),
(298, 227, 169347, '2023-04-20 13:59:47'),
(299, 227, 136988, '2023-04-20 13:59:51'),
(300, 227, 169346, '2023-04-20 13:59:55'),
(301, 228, 291622, '2023-04-20 14:00:35'),
(302, 229, 83558, '2023-04-20 14:03:47'),
(303, 246, 68261, '2023-04-20 14:41:15'),
(304, 247, 68261, '2023-04-20 14:41:15'),
(305, 248, 68261, '2023-04-20 14:41:16'),
(306, 249, 68261, '2023-04-20 14:41:16'),
(322, 250, 199481, '2023-04-21 11:29:30'),
(329, 251, 202171, '2023-04-21 11:44:41'),
(330, 251, 274396, '2023-04-21 11:45:26'),
(331, 251, 297839, '2023-04-21 11:45:27'),
(333, 253, 76359, '2023-04-21 11:46:54'),
(334, 253, 89805, '2023-04-21 11:48:44'),
(349, 157, 89271, '2023-04-22 20:07:28'),
(350, 158, 89271, '2023-04-22 20:07:29'),
(351, 160, 89271, '2023-04-22 20:07:29'),
(353, 219, 89271, '2023-04-22 20:07:32'),
(362, 157, 68261, '2023-04-22 20:10:55'),
(369, 157, 62905, '2023-04-22 20:21:55'),
(370, 158, 62905, '2023-04-22 20:22:17'),
(371, 160, 62905, '2023-04-22 20:22:19'),
(372, 166, 62905, '2023-04-22 20:22:19'),
(373, 167, 62905, '2023-04-22 20:22:20'),
(374, 246, 62905, '2023-04-22 20:22:45'),
(375, 247, 62905, '2023-04-22 20:22:45'),
(376, 248, 62905, '2023-04-22 20:22:45'),
(377, 249, 62905, '2023-04-22 20:22:46'),
(379, 295, 62905, '2023-04-22 20:25:01'),
(381, 219, 62905, '2023-04-22 20:27:20'),
(382, 166, 114879, '2023-04-22 21:47:10'),
(383, 167, 114879, '2023-04-22 21:47:18'),
(384, 185, 114879, '2023-04-22 21:47:25'),
(385, 295, 114879, '2023-04-22 21:47:32'),
(389, 299, 199459, '2023-04-23 13:25:38'),
(390, 300, 111927, '2023-04-23 17:34:03'),
(391, 300, 90098, '2023-04-23 17:34:07'),
(392, 300, 90100, '2023-04-23 17:34:12'),
(393, 300, 90090, '2023-04-23 17:34:15'),
(394, 300, 220883, '2023-04-23 17:34:20'),
(395, 300, 82095, '2023-04-23 17:34:23'),
(396, 300, 90099, '2023-04-23 17:34:28'),
(397, 300, 82652, '2023-04-23 17:34:33'),
(398, 300, 124221, '2023-04-23 17:35:30'),
(399, 300, 82058, '2023-04-23 17:35:33'),
(400, 300, 90089, '2023-04-23 17:35:42'),
(401, 301, 119429, '2023-04-23 17:36:12'),
(402, 301, 152768, '2023-04-23 17:36:23'),
(403, 301, 122403, '2023-04-23 17:36:28'),
(404, 302, 120932, '2023-04-23 17:38:00'),
(405, 302, 120935, '2023-04-23 17:38:08'),
(406, 302, 120933, '2023-04-23 17:38:13'),
(407, 302, 120955, '2023-04-23 17:38:17'),
(408, 302, 120937, '2023-04-23 17:38:19'),
(409, 303, 273440, '2023-04-23 17:44:07'),
(410, 303, 82062, '2023-04-23 17:44:34'),
(413, 299, 81463, '2023-04-23 19:20:48'),
(418, 295, 81463, '2023-04-23 20:00:19'),
(419, 219, 104671, '2023-04-23 20:07:02'),
(420, 295, 104671, '2023-04-23 20:07:07'),
(421, 299, 104671, '2023-04-23 20:07:07'),
(422, 176, 104671, '2023-04-23 20:13:48'),
(423, 168, 104671, '2023-04-23 20:13:52'),
(424, 157, 104671, '2023-04-23 20:14:00'),
(425, 158, 104671, '2023-04-23 20:14:01'),
(426, 160, 104671, '2023-04-23 20:14:02'),
(427, 310, 104671, '2023-04-23 20:16:34'),
(429, 167, 104671, '2023-04-23 20:21:00'),
(435, 313, 46887, '2023-04-23 20:21:27'),
(436, 299, 46887, '2023-04-23 20:21:29'),
(440, 209, 46887, '2023-04-23 20:22:43'),
(441, 168, 46887, '2023-04-23 20:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `id` int NOT NULL,
  `userID` int NOT NULL,
  `nev` varchar(200) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `type` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT 'custom',
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`id`, `userID`, `nev`, `type`, `visibility`, `order`, `updated`) VALUES
(157, 9, '[object HTMLInputElement]', 'custom', 1, 0, '2023-04-04 08:58:54'),
(158, 9, 'bob gag 8', 'custom', 1, 0, '2023-04-04 08:59:24'),
(160, 9, 'crysis', 'custom', 1, 0, '2023-04-04 09:02:49'),
(166, 9, 'Statikus weboldal készítése', 'custom', 1, 0, '2023-04-04 09:40:31'),
(167, 9, 'roppongi', 'custom', 1, 0, '2023-04-04 11:49:07'),
(168, 9, 'korghomát korghotti', 'custom', 1, 0, '2023-04-04 12:00:56'),
(172, 19, 'játszott', 'custom', 1, 0, '2023-04-13 08:00:54'),
(176, 9, 'pökhöndi', 'custom', 1, 0, '2023-04-13 12:57:41'),
(185, 9, 'my super private list', 'custom', 0, 0, '2023-04-19 11:25:03'),
(209, 9, 'halo', 'custom', 1, 0, '2023-04-20 09:38:21'),
(210, 13, 'vampire', 'custom', 1, 0, '2023-04-20 09:39:04'),
(219, 9, 'rats!', 'custom', 1, 0, '2023-04-20 10:28:20'),
(227, 57, 'busz', 'custom', 1, 0, '2023-04-20 13:59:28'),
(228, 57, 'zseb', 'custom', 0, 0, '2023-04-20 14:00:31'),
(229, 59, 'muky vagyok', 'custom', 1, 0, '2023-04-20 14:03:43'),
(230, 62, 'favorite', 'favorite', 1, 5, '2023-04-20 14:13:27'),
(231, 62, 'wishlist', 'wishlist', 1, 4, '2023-04-20 14:13:27'),
(232, 62, 'completed', 'completed', 1, 3, '2023-04-20 14:13:27'),
(233, 62, 'playing', 'playing', 1, 2, '2023-04-20 14:13:27'),
(234, 63, 'favorite', 'favorite', 1, 5, '2023-04-20 14:14:42'),
(235, 63, 'wishlist', 'wishlist', 1, 4, '2023-04-20 14:14:42'),
(236, 63, 'completed', 'completed', 1, 3, '2023-04-20 14:14:42'),
(237, 63, 'playing', 'playing', 1, 2, '2023-04-20 14:14:42'),
(238, 65, 'favorite', 'favorite', 1, 5, '2023-04-20 14:23:00'),
(239, 65, 'wishlist', 'wishlist', 1, 4, '2023-04-20 14:23:00'),
(240, 65, 'completed', 'completed', 1, 3, '2023-04-20 14:23:01'),
(241, 65, 'playing', 'playing', 1, 2, '2023-04-20 14:23:01'),
(242, 64, 'favorite', 'favorite', 1, 5, '2023-04-20 14:35:13'),
(243, 64, 'wishlist', 'wishlist', 1, 4, '2023-04-20 14:35:13'),
(244, 64, 'completed', 'completed', 1, 3, '2023-04-20 14:35:13'),
(245, 64, 'playing', 'playing', 1, 2, '2023-04-20 14:35:13'),
(246, 9, 'favorite', 'favorite', 1, 5, '2023-04-20 14:35:32'),
(247, 9, 'wishlist', 'wishlist', 1, 4, '2023-04-20 14:35:32'),
(248, 9, 'completed', 'completed', 1, 3, '2023-04-20 14:35:32'),
(249, 9, 'playing', 'playing', 1, 2, '2023-04-20 14:35:32'),
(250, 81, 'Kedvenc játékom takarítás közben', 'custom', 1, 0, '2023-04-21 11:28:56'),
(251, 23, 'Vampire Survivors', 'custom', 1, 0, '2023-04-21 11:42:35'),
(253, 82, 'Games', 'custom', 1, 0, '2023-04-21 11:46:43'),
(295, 9, 'ropogós csirkecomb', 'custom', 1, 0, '2023-04-22 20:25:01'),
(299, 9, 'mindig ropogós kistraktor', 'custom', 1, 0, '2023-04-23 13:25:38'),
(300, 13, 'AC', 'custom', 1, 0, '2023-04-23 17:34:03'),
(301, 13, 'Mass effect', 'custom', 1, 0, '2023-04-23 17:36:12'),
(302, 13, 'GTA', 'custom', 1, 0, '2023-04-23 17:38:00'),
(303, 13, 'Jedi', 'custom', 1, 0, '2023-04-23 17:44:07'),
(310, 9, 'Goggágán 2', 'custom', 1, 0, '2023-04-23 20:16:34'),
(313, 9, 'kkkkkkkkk', 'custom', 1, 0, '2023-04-23 20:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `ratingTable`
--

CREATE TABLE `ratingTable` (
  `id` int NOT NULL,
  `ratedThing` int NOT NULL,
  `ratedBy` int NOT NULL,
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL COMMENT '0 = user 1 = game',
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `ratingTable`
--

INSERT INTO `ratingTable` (`id`, `ratedThing`, `ratedBy`, `type`, `rating`) VALUES
(16, 13, 9, 'user', 10),
(18, 9, 13, 'user', 1),
(19, 9, 21, 'user', 1),
(20, 21, 13, 'user', 1),
(21, 21, 23, 'user', 10),
(22, 9, 23, 'user', 1),
(23, 1, 23, 'user', 10),
(24, 1, 9, 'user', 10),
(31, 23, 9, 'user', 10),
(32, 1, 13, 'user', 7),
(33, 4, 13, 'user', 9),
(34, 4, 9, 'user', 10),
(37, 9, 25, 'user', 1),
(38, 9, 26, 'user', 1),
(41, 27, 13, 'user', 1),
(42, 27, 19, 'user', 7),
(43, 9, 28, 'user', 1),
(44, 9, 29, 'user', 1),
(45, 28, 13, 'user', 10),
(46, 9, 30, 'user', 1),
(47, 28, 30, 'user', 10),
(48, 13, 30, 'user', 10),
(53, 9, 35, 'user', 10),
(55, 35, 9, 'user', 1),
(56, 31, 9, 'user', 1),
(57, 9, 19, 'user', 10),
(58, 34, 9, 'user', 1),
(59, 34, 13, 'user', 10),
(60, 21, 19, 'user', 10),
(61, 18564, 9, 'game', 10),
(62, 18564, 13, 'game', 10),
(64, 23, 13, 'user', 1),
(65, 29, 9, 'user', 1),
(66, 38, 9, 'user', 1),
(67, 114879, 13, 'game', 7),
(68, 40, 13, 'user', 10),
(69, 9, 40, 'user', 10),
(74, 8, 19, 'user', 3),
(75, 225747, 13, 'game', 1),
(76, 40, 9, 'user', 10),
(77, 114879, 9, 'game', 10),
(78, 14012, 13, 'game', 9),
(79, 39, 9, 'user', 10),
(80, 119468, 13, 'game', 10),
(81, 43, 13, 'user', 10),
(84, 44, 9, 'user', 10),
(85, 13, 23, 'user', 10),
(86, 32, 23, 'user', 10),
(87, 33, 23, 'user', 10),
(88, 34, 23, 'user', 10),
(89, 120937, 13, 'game', 10),
(90, 202171, 13, 'game', 10),
(91, 14012, 9, 'game', 1),
(92, 9, 9, 'user', 9),
(97, 130416, 13, 'game', 1),
(106, 241247, 9, 'game', 10),
(107, 125245, 9, 'game', 10),
(108, 125248, 9, 'game', 10),
(109, 125246, 9, 'game', 10),
(110, 125247, 9, 'game', 10),
(111, 274396, 13, 'game', 8),
(112, 297839, 13, 'game', 9),
(113, 64, 9, 'user', 10),
(114, 64, 13, 'user', 1),
(115, 199481, 81, 'game', 10),
(116, 13, 81, 'user', 10),
(117, 81, 23, 'user', 10),
(118, 82, 23, 'user', 10),
(119, 76359, 82, 'game', 10),
(120, 9, 82, 'user', 1),
(121, 202171, 23, 'game', 10),
(122, 274396, 23, 'game', 10),
(123, 297839, 23, 'game', 10),
(124, 4, 82, 'user', 10),
(125, 27, 82, 'user', 1),
(127, 119429, 13, 'game', 10),
(128, 104671, 13, 'game', 5),
(129, 83, 13, 'user', 8),
(130, 82062, 13, 'game', 10),
(131, 82, 13, 'user', 6),
(132, 120933, 13, 'game', 8);

-- --------------------------------------------------------

--
-- Table structure for table `ratios`
--

CREATE TABLE `ratios` (
  `id` int NOT NULL,
  `commentID` int NOT NULL,
  `userID` int NOT NULL,
  `ratio` tinyint(1) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `ratios`
--

INSERT INTO `ratios` (`id`, `commentID`, `userID`, `ratio`, `date`) VALUES
(80, 48, 13, 1, '2023-03-30 12:02:28'),
(104, 13, 9, 1, '2023-03-30 11:40:50'),
(106, 12, 9, -1, '2023-04-13 12:54:48'),
(107, 56, 9, -1, '2023-03-29 13:38:18'),
(108, 48, 9, -1, '2023-03-29 13:38:19'),
(110, 77, 13, 0, '2023-03-29 13:46:13'),
(118, 56, 13, 1, '2023-04-02 14:28:15'),
(120, 92, 40, 1, '2023-03-31 08:48:33'),
(121, 91, 40, 1, '2023-03-31 08:48:33'),
(122, 93, 13, 1, '2023-03-31 08:48:55'),
(123, 93, 40, 1, '2023-03-31 08:48:59'),
(138, 102, 13, 1, '2023-03-31 13:14:56'),
(139, 107, 9, 1, '2023-04-04 09:46:37'),
(141, 110, 9, -1, '2023-04-04 11:43:07'),
(142, 109, 9, 1, '2023-04-04 11:44:44'),
(143, 108, 9, 1, '2023-04-04 11:44:47'),
(162, 176, 13, 1, '2023-04-18 13:59:58'),
(163, 176, 9, 1, '2023-04-18 11:19:48'),
(168, 201, 13, -1, '2023-04-18 14:00:06'),
(172, 2, 13, 1, '2023-04-19 11:03:23'),
(173, 201, 9, 1, '2023-04-19 12:49:34'),
(174, 178, 9, 1, '2023-04-19 18:56:07'),
(175, 230, 82, 1, '2023-04-21 11:37:36'),
(176, 230, 23, 1, '2023-04-21 11:38:20'),
(177, 232, 23, 1, '2023-04-21 11:38:29'),
(178, 232, 82, 1, '2023-04-21 11:38:36'),
(180, 176, 23, -1, '2023-04-21 11:41:24'),
(181, 178, 23, -1, '2023-04-21 11:41:24'),
(182, 179, 23, -1, '2023-04-21 11:41:25'),
(183, 201, 23, -1, '2023-04-21 11:41:26'),
(185, 236, 13, 1, '2023-04-25 08:53:22'),
(186, 235, 13, -1, '2023-04-25 08:53:14'),
(187, 156, 9, 1, '2023-04-26 08:26:26');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int NOT NULL,
  `userID` int NOT NULL,
  `active` tinyint(1) NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci NOT NULL,
  `acquired` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `userID`, `active`, `token`, `acquired`, `expires`) VALUES
(255, 9, 0, '737c5b4ededb70b8f4e04b3feb0a3742c2f74a1a', '2023-04-12 11:39:33', '2023-04-12 11:49:33'),
(256, 9, 0, 'fbb9130134e81e4fe2c36630d9fc2cc3a3dbf8c5', '2023-04-12 11:42:05', '2023-04-22 11:42:05'),
(257, 13, 0, '46c68c887457302aedcd0eae1c9b1e126ead53a7', '2023-04-12 11:45:39', '2023-04-15 11:45:39'),
(259, 23, 0, '055c403923c03e2d097caaa31a595306645aa35a', '2023-04-12 13:56:44', '2023-04-15 13:56:44'),
(260, 19, 0, '8eccb5fdcadc95a67a4c5bac4cc90a6e47441087', '2023-04-13 07:57:56', '2023-04-16 07:57:56'),
(263, 13, 0, 'f459ad8ef463b6e2aa9aa16d7082934e01018586', '2023-04-13 08:11:22', '2023-04-16 08:11:22'),
(264, 9, 0, '95c9c72ba43fcfc06f14684033d1e9a0a8347f1d', '2023-04-13 08:18:39', '2023-04-16 08:18:39'),
(265, 9, 0, 'ea9c6fe516811d2f49d3883c6b5d9ebc7e35bc37', '2023-04-13 08:21:55', '2023-04-16 08:21:55'),
(271, 13, 0, '70f53048e51134e7b2a9ef7a1a5d8d6d0cbe0542', '2023-04-13 08:59:16', '2023-04-16 08:59:16'),
(272, 9, 0, 'e04410436605691d3fc9c4a0d22b17ee5d0e9e21', '2023-04-13 09:46:28', '2023-04-16 09:46:28'),
(275, 9, 0, 'f9035ea2a21913a7311c53f8cdc19443c3b00c45', '2023-04-13 12:51:59', '2023-04-16 12:51:59'),
(276, 13, 0, '4a4340e9dd2a3a5c409ab608c555058e2cb4d461', '2023-04-14 20:21:44', '2023-04-17 20:21:44'),
(277, 13, 0, 'd989c1a455bf1335ba01a8265e2a72a10835b3f5', '2023-04-17 08:28:50', '2023-04-20 08:28:50'),
(278, 9, 0, '13995c715a9b505f3effd8dce526eccc1647e05d', '2023-04-17 08:58:29', '2023-04-20 08:58:29'),
(279, 9, 0, '23b1eadc97520e97f01fd6e20e5a46288fa6f023', '2023-04-17 09:00:08', '2023-04-20 09:00:08'),
(292, 9, 0, '5f347e532a372dab98a1b88abe61fcca3cbc5ad7', '2023-04-18 15:24:48', '2023-04-21 15:24:48'),
(294, 13, 0, 'c3e2b522f3fa3bec507db8b9f716f05412534ff0', '2023-04-18 18:55:38', '2023-04-21 18:55:38'),
(295, 9, 0, '398ea6cd340f32d27e043a8bda62575df4e74488', '2023-04-19 08:26:41', '2023-04-22 08:26:41'),
(296, 13, 0, 'b0c631cd8a4752c806d84a59bae046403adf021e', '2023-04-19 09:00:40', '2023-04-22 09:00:40'),
(297, 13, 0, 'e88890b05a7c73fc1d58e58d59b55462b38f306c', '2023-04-19 09:00:41', '2023-04-22 09:00:41'),
(299, 9, 0, '55477c146a4cf7b9486818c7b40d84523cde8639', '2023-04-19 13:44:50', '2023-04-22 13:44:50'),
(301, 13, 0, '28b426a84734dc7a047ed702f8a5076abc518865', '2023-04-20 08:35:16', '2023-04-23 08:35:16'),
(303, 13, 0, 'c439f871e5ce9902164df7ab038ab93ec31beb8b', '2023-04-20 11:22:08', '2023-04-23 11:22:08'),
(304, 57, 0, 'f58094f195e4bd223bd680f3609d429a2f0c9917', '2023-04-20 13:57:28', '2023-04-23 13:57:28'),
(305, 59, 0, 'd887b829aba2bf027504b4c37841ceb1f8b21761', '2023-04-20 14:02:52', '2023-04-23 14:02:52'),
(306, 58, 0, '58e1591188760427b675ec511b1c58f762fade1d', '2023-04-20 14:04:46', '2023-04-23 14:04:46'),
(307, 13, 0, 'c341c764e17cd679fd6f3afcbcfd22af29591ba8', '2023-04-20 14:06:25', '2023-04-23 14:06:25'),
(308, 64, 0, '85daeac7b7720fd6b8cc025e06dbecbafd22ea32', '2023-04-20 14:19:32', '2023-04-23 14:19:32'),
(309, 64, 0, '3d3772fefcea155adc6feaefa8f2613c7cb42acd', '2023-04-20 14:35:13', '2023-04-23 14:35:13'),
(310, 9, 0, '903fc345301116583a599ae22983c587fb2c8617', '2023-04-20 14:35:30', '2023-04-23 14:35:30'),
(311, 9, 0, '673b0942f913af38408762938b2c01a96bbcb442', '2023-04-20 20:47:21', '2023-04-23 20:47:21'),
(312, 13, 0, 'a500aab7562d1383ce1d18f415953c42cd10c57f', '2023-04-21 09:06:48', '2023-04-24 09:06:48'),
(313, 13, 0, 'db36ff4011a06de3c9c0576b0f65f5017f6c337d', '2023-04-21 09:08:57', '2023-04-24 09:08:57'),
(314, 13, 0, '834d5c63739b0122bebd13f0e7f0b4efb9254d8f', '2023-04-21 09:13:22', '2023-04-24 09:13:22'),
(315, 13, 0, '4561712e47d8f18e9e3f5635a4d8dad911a2385f', '2023-04-21 09:16:08', '2023-04-24 09:16:08'),
(316, 9, 0, '830d3e2e3d4118ac5e5081fe582e24b70547493a', '2023-04-21 09:45:41', '2023-04-24 09:45:41'),
(317, 13, 0, 'e43fab8d09b8bf3b67a370044eb3a706be1e9066', '2023-04-21 09:49:08', '2023-04-24 09:49:08'),
(318, 13, 0, '4db1e7656576719190d75d0004a2b0cc1c9f5171', '2023-04-21 09:49:13', '2023-04-24 09:49:13'),
(319, 13, 0, '40eb1117eba45839135d87c3dc30895c77cdda01', '2023-04-21 09:49:24', '2023-04-24 09:49:24'),
(320, 13, 0, '2da75947b4fd67a89de5c11dacc614f33c07f4fe', '2023-04-21 09:50:29', '2023-04-24 09:50:29'),
(321, 13, 0, '5f2304004611f291c729f1861ab951d0c89972bc', '2023-04-21 09:50:33', '2023-04-24 09:50:33'),
(322, 13, 0, 'd131a7824ae0fc6f8d44406f69dd29e1e8bfa8af', '2023-04-21 09:50:38', '2023-04-24 09:50:38'),
(323, 9, 0, '7aa21bedda148280c2b13ec034d8d794a3c1b9a7', '2023-04-21 09:50:58', '2023-04-24 09:50:58'),
(324, 13, 0, '47352b013dfcab24f1cca4f2fa54a22380abbc23', '2023-04-21 09:51:23', '2023-04-24 09:51:23'),
(325, 13, 0, '10e6afd0254ee7639a8631d2c9b718d7dcee9736', '2023-04-21 09:52:14', '2023-04-24 09:52:14'),
(327, 13, 0, '18583117ff1607b19edb97459f48601968b28851', '2023-04-21 10:01:34', '2023-04-24 10:01:34'),
(328, 81, 0, 'f87776a1eb9097499397a135376ff0911461684a', '2023-04-21 11:27:38', '2023-04-24 11:27:38'),
(329, 23, 0, '570a30926dc52945f99e93de3a45d8cc2a1a302d', '2023-04-21 11:34:02', '2023-04-24 11:34:02'),
(330, 82, 0, '5ee6b1ea90a8b785c132f2b0a4072d1aea4d8a39', '2023-04-21 11:35:11', '2023-04-24 11:35:11'),
(331, 83, 0, '41b84f23ca22671560760d2735bcb659d275220a', '2023-04-21 11:41:58', '2023-04-24 11:41:58'),
(333, 13, 0, 'b681ce12ba6b9f40198366af084f9c55e49e6041', '2023-04-22 10:30:53', '2023-04-25 10:30:53'),
(334, 9, 0, '7443f2984b0259bf32fc35697df4bd990b981f6d', '2023-04-22 21:46:11', '2023-04-25 21:46:11'),
(335, 9, 0, '57928cf2b5554916c1ae08bb673e3701588caec2', '2023-04-22 21:56:38', '2023-04-25 21:56:38'),
(336, 9, 0, '846e5a5217c7399393458d974145b7e959d9600a', '2023-04-22 22:48:32', '2023-04-25 22:48:32'),
(337, 9, 0, '1e570f4ae23d2e6d5326d3d71fbe07040ce4f2cd', '2023-04-22 22:48:46', '2023-04-25 22:48:46'),
(338, 9, 0, '2768dd36cc14d2e67d33d912c394bb1eb16e6b88', '2023-04-22 22:49:11', '2023-04-25 22:49:11'),
(339, 13, 1, '2941c969ef33dcb0e658164d6a2f89a7b3658a83', '2023-04-23 17:42:55', '2023-04-26 17:42:55'),
(340, 13, 1, '0f2ab5712d381b6b3907ff7782bced0d0a3a4918', '2023-04-23 17:42:55', '2023-04-26 17:42:55'),
(341, 9, 1, 'ec24498970f7e6ef57a1ac67b92b499eed45000c', '2023-04-23 23:18:33', '2023-04-26 23:18:33'),
(342, 13, 1, '53045a0f3bba1871b91253ddcefffa9d2996b29b', '2023-04-24 08:07:05', '2023-04-27 08:07:05'),
(343, 85, 1, 'f9940edd30a9d5e376426c9174698e6f1f67c010', '2023-04-24 08:25:05', '2023-04-27 08:25:05'),
(344, 85, 1, 'd79b5597dccc2ae1058d61a8c32022910a21cd36', '2023-04-24 09:40:09', '2023-04-27 09:40:09'),
(345, 85, 1, '19d0d81ee767290d01db70a7096d6414eebd499b', '2023-04-24 09:40:13', '2023-04-27 09:40:13'),
(346, 83, 1, '9364e7a7e98820ab043eada70986f7d139c66394', '2023-04-24 11:46:58', '2023-04-27 11:46:58'),
(347, 23, 1, 'f71826bdc51fce1ec83eaac88194053e6177b69a', '2023-04-24 12:30:54', '2023-04-27 12:30:54'),
(348, 9, 1, '77e96b5883176e1e2f61d7d73b7ebcf900710a8a', '2023-04-25 09:01:55', '2023-04-28 09:01:55'),
(349, 9, 1, 'b28302cd3df08f877d2b5d9848bac58a7b12c04a', '2023-04-25 09:02:00', '2023-04-28 09:02:00'),
(350, 13, 1, '59c729fcefed56d39ec5054339a17a008e30cb3b', '2023-04-25 09:03:10', '2023-04-28 09:03:10'),
(351, 9, 1, '827749239c3ab625880e5fc2defc72f20d9c0d8a', '2023-04-25 09:03:23', '2023-04-28 09:03:23'),
(352, 9, 1, '2679ef403c0401aa61c6938b9798201c4f8e9444', '2023-04-25 09:03:48', '2023-04-28 09:03:48'),
(353, 9, 1, 'c52d30fdb78809471395dd37a6ece3b299a1d465', '2023-04-25 09:04:17', '2023-04-28 09:04:17'),
(354, 86, 1, '9371d53ea0ab071f963f31bd28523ac369ec4246', '2023-04-25 09:04:59', '2023-04-28 09:04:59'),
(355, 13, 1, '6fd1935f715d28bc9b277aa4744918a05e0c2e24', '2023-04-25 09:05:57', '2023-04-28 09:05:57'),
(356, 13, 1, '2ae8a1f4555dd7029cc382df4914d6ab13612c06', '2023-04-25 18:51:31', '2023-04-28 18:51:31'),
(357, 85, 1, 'c6606235c127415a85edc1d7ba3078808381043d', '2023-04-26 09:55:27', '2023-04-29 09:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nev` varchar(255) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png',
  `email` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `jelszo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
  `steam` varchar(200) COLLATE utf8mb4_hungarian_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nev`, `avatar`, `email`, `jelszo`, `steam`) VALUES
(9, 'Kakranaf', 'https://cdn.discordapp.com/attachments/547842702679474225/1097619583306825829/bro_qhar.gif', 'kaklanaf@gmail.com', '32cf6da134a8b268cf4ab6b79a9a5ad9', ''),
(13, 'Mark', 'https://media.discordapp.net/attachments/893566462105641010/1096500250186883144/profile.png?width=523&amp;height=570', 'dsa@gmail.com', '7815696ecbf1c96e6894b779456d330e', 'https://steamcommunity.com/id/markimrc22/'),
(19, 'Jajajaj', 'https://media.tenor.com/LHSg8DcWt5YAAAAS/artur-dance-stupid-dance.gif', 'jajaja@gmail.com', 'dcebc5031d719357fc939746d9467a27', ''),
(21, 'ZortTheZord', 'https://cdn.discordapp.com/attachments/563034696724906005/1087718705443635291/image.png', 'lzrmarci2@gmail.com', '7b0ceef058244fc5d3403baa45a2f2c4', ''),
(22, 'NiceNorby', 'https://media.tenor.com/LHSg8DcWt5YAAAAM/artur-dance-stupid-dance.gif', 'nice@gmail.com', '7c6483ddcd99eb112c060ecbe0543e86', ''),
(23, 'ADRIAN30', 'img/logo.png', 'medveadrian@felx.hu', 'f4ef02d836221725b3621f2f7ad118a1', 'https://steamcommunity.com/id/ADRIAN30003'),
(25, 'Kukamér', 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png', 'kukamer@kukamer.kukamer', '0d507cb98e921d1f6bc6c6792d16905e', ''),
(26, 'kakamar', 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png', 'kakamar@kakamar.kakamar', '2a245704f87d15037e9360704d153411', ''),
(28, 'grufafon', 'https://cdn.discordapp.com/attachments/547842702679474225/1088442285093556244/image.png', 'grufafon@grufafon.grufafon', '9b8bfbd0482176e8020cb5eceed22ff3', ''),
(29, 'lopongi', 'https://cdn.discordapp.com/attachments/547842702679474225/1088442864536670339/image.png', 'lopongi@lopongi.lopongi', 'fc3907727b37c86452cbfd39b1c61a14', ''),
(30, 'asdkukamer', 'https://cdn.discordapp.com/attachments/547842702679474225/1088442901710774333/image.png', 'asdkukamer@asdkukamer.asdkukamer', 'f13b419a5ae7834bf80c2d27ae4b332b', ''),
(35, 'fanarkaK', 'https://cdn.discordapp.com/attachments/517004929236336641/1088445974537584680/image.png', 'fanarkaK@fanarkaK.fanarkaK', '6e5732ed92f38bc50060b07075797b41', ''),
(39, 'göpghöndi', 'https://cdn.tasteatlas.com//images/toplistarticles/6fe36b3f20c44444971f5136bf1bf9dc.jpg?w=375&h=280', 'gopghondi@gopghondi.gopghondi', '703f14122ff0519e5c8ad32f4ea18c52', ''),
(40, 'God Erik', 'https://cdn.discordapp.com/attachments/547842702679474225/1091252201382490132/goderik2.png', 'goderik@goderik.goderik', 'd898eae5711fd9091d9d6001f5fd64af', ''),
(57, 'busz', 'https://kep.cdn.index.hu/1/0/4727/47272/472725/47272573_3604159_3860e1046b45b60f713ff4ca1140f042_wm.jpg', 'busz@busz.busz', '2372fa2d895ed4921d13a6110b0a7d3d', ''),
(58, 'lupi', 'https://staging.cohostcdn.org/attachment/f2d72c31-c3bf-4e32-8dfb-3b5cb3f3b870/IMG_41873.jpg?dpr=2.625&amp;width=412&amp;height=232&amp;fit=cover', 'lupi@lupi.lupi', '6dd0e57350be63c0486b8a9769696fcb', ''),
(59, 'muky', 'https://yt3.googleusercontent.com/i_ECM7gG3BhQ8sgeRbXBSmRCTR7YXwIX-aMN7KZ-ytI3CAwxNN87t1JhpZCEy-9TLVQHOsQ10g=s900-c-k-c0x00ffffff-no-rj', 'muky@muky.muky', 'df7c056ced24ea940ed93f8de5024272', ''),
(60, 'csiga', 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png', 'csiga@csiga.csiga', 'facca0cfef4633750a20382574b4422b', ''),
(61, 'kakoma', 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png', 'kakoma@kakoma.kakoma', '301a323530477f0471b6bff4495d9782', ''),
(62, '🏀🏀🏀🏀🏀🏀🏀🏀🏀🏀', 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png', 'kobe@kobe.kobe', '2357e8fb9945f0a2039a7093422a3dee', ''),
(63, 'noobie.dookie', 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png', 'dookie@noobie.poopie', '0a9174af1ad200e8a09616c731db2e88', ''),
(64, 'rugo', 'https://tr.rbxcdn.com/24015a9661077b7226a059ac8ff385c8/420/420/Image/Png', 'rugo@rugo.rugo', 'e410a050b926b3da0b4672e91dc090ce', ''),
(65, 'golyo', 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png', 'golyo@golyo.golyo', '965d529ea8c8793c9f72bd507df084b6', ''),
(80, 'kordicska', 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png', 'kordics.b@gmail.com', '7815696ecbf1c96e6894b779456d330e', ''),
(81, 'Takarító néni', 'https://irodatakaritas.hu/wp-content/uploads/2021/03/irdtk_p083.jpg', 'takaritoneni@domestos.net', 'be0e4db0ee90b5e942d7be6f3ec828c1', ''),
(82, 'varso01', 'https://images2.alphacoders.com/941/941898.jpg', 'varsanyib@felx.hu', 'e51e6238376c135c90ccbea45e2e3d26', ''),
(83, 'Aldynenn', 'https://avatars.cloudflare.steamstatic.com/bbd3bd6f14ee401551d7e1ea14cfda7860f00448_full.jpg', 'aldynenn@gmail.com', '2bf806bf502910a13007ac2607d7c998', 'https://steamcommunity.com/id/Aldynenn/'),
(85, 'Mate', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTYnI5akgtdjxUi09CgyWl-vFrdnVMRVtekB-PzGIN5&amp;s', 'kiskelegen@gmail.com', '7815696ecbf1c96e6894b779456d330e', ''),
(86, 'rambert', 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png', 'rambert@rambert.rambert', '1f872ce6285b94f4e13392798c99f1f0', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `madeBy` (`madeBy`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gameID` (`gameID`);

--
-- Indexes for table `listGames`
--
ALTER TABLE `listGames`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listID` (`listID`),
  ADD KEY `gameID` (`gameID`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `ratingTable`
--
ALTER TABLE `ratingTable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratedUser` (`ratedThing`),
  ADD KEY `ratedBy` (`ratedBy`);

--
-- Indexes for table `ratios`
--
ALTER TABLE `ratios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentID` (`commentID`,`userID`),
  ADD KEY `ratios_ibfk_2` (`userID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `listGames`
--
ALTER TABLE `listGames`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=442;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;

--
-- AUTO_INCREMENT for table `ratingTable`
--
ALTER TABLE `ratingTable`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `ratios`
--
ALTER TABLE `ratios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`madeBy`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `listGames`
--
ALTER TABLE `listGames`
  ADD CONSTRAINT `listGames_ibfk_1` FOREIGN KEY (`listID`) REFERENCES `lists` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `listGames_ibfk_2` FOREIGN KEY (`gameID`) REFERENCES `games` (`gameID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `ratingTable`
--
ALTER TABLE `ratingTable`
  ADD CONSTRAINT `ratingTable_ibfk_1` FOREIGN KEY (`ratedBy`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `ratios`
--
ALTER TABLE `ratios`
  ADD CONSTRAINT `ratios_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `ratios_ibfk_3` FOREIGN KEY (`commentID`) REFERENCES `comment` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
