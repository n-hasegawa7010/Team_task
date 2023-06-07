-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2023-05-17 10:58:21
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `team3`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `mode`
--

CREATE TABLE `mode` (
  `id` int(11) NOT NULL,
  `mode_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `mode`
--

INSERT INTO `mode` (`id`, `mode_id`) VALUES
(1, 2),
(3, 39),
(4, 39),
(5, 39),
(6, 29),
(7, 4),
(8, 41),
(9, 79),
(10, 79),
(11, 76),
(12, 60),
(13, 65),
(14, 93),
(15, 95),
(16, 92),
(17, 91),
(18, 89),
(19, 88),
(20, 126),
(21, 130),
(22, 131),
(23, 132),
(24, 133),
(25, 134),
(26, 135),
(27, 136),
(28, 137),
(29, 138),
(30, 139),
(31, 140),
(32, 119),
(33, 86),
(34, 116),
(35, 142),
(36, 75),
(37, 143);

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `price` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `products`
--

INSERT INTO `products` (`id`, `name`, `stock`, `price`) VALUES
(38, '豆苗', 112266, 30),
(40, 'レタス', 344, 100),
(41, 'シイタケ', 54, 400),
(43, 'タマゴタケ', 0, 90),
(44, 'なす', 0, 90),
(45, 'ロマネスコ', 40, 100),
(46, 'ゴーヤ', 0, 100),
(47, 'いぶりがっこチーズ', 0, 250),
(48, 'ひろみ', 40, 20),
(50, 'せい', 0, 10000),
(51, 'コーヒー', 90, 120),
(55, 'おちゃ', 5, 100),
(56, 'ビール', 0, 190),
(57, 'チョコ', 100, 200),
(58, 'お餅', 0, 50),
(59, 'タラタラしてんじゃねーよ！', 0, 50),
(60, 'うまい棒', 600, 12),
(61, 'ヤッター麺', 0, 20),
(62, 'ビックカツ', 80, 100),
(67, 'からあげ', 0, 500),
(68, 'カレー', 0, 500),
(69, 'コロッケ', 1, 300),
(70, '寿司', 2, 1000),
(79, 'ちくわ', 0, 100),
(80, '季の美', 5, 5000),
(82, 'もやし', 0, 30),
(83, 'にら', 1, 300),
(84, 'とうふ', 2, 1000),
(85, 'こんにゃく', 5, 200),
(86, 'うどん', 2, 300),
(87, 'トマト', 0, 100),
(88, '米', 1, 2000),
(89, '醤油', 1, 800),
(90, 'ごま油', 1, 300),
(91, '豚バラ', 5, 300);

-- --------------------------------------------------------

--
-- テーブルの構造 `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `purchase`
--

INSERT INTO `purchase` (`id`, `product_id`, `quantity`, `date`, `note`) VALUES
(60, 39, 22, '2023-05-02', ''),
(63, 47, 10, '2023-05-25', 'add by あやか'),
(64, 38, 22, '2023-05-02', 'aaaaa'),
(68, 40, 20000, '2023-05-17', ''),
(71, 41, 50, '2023-05-23', 'add by hase'),
(72, 48, 2147483647, '2023-05-03', ''),
(75, 41, 4, '2023-05-03', ''),
(78, 43, 50, '2023-05-17', 'add by hase'),
(81, 45, 40, '2023-05-17', 'add by hase'),
(83, 39, 20, '2023-05-10', ''),
(85, 40, 10, '2023-05-03', ''),
(86, 48, 10, '2023-05-03', 'てんさい'),
(90, 52, 70, '2023-05-02', 'add by hase'),
(94, 63, 700, '2023-05-17', 'add by hase'),
(96, 0, 20, '2023-05-12', 'add by ひろみ'),
(97, 0, 5, '2023-05-11', 'add'),
(98, 0, 10, '2023-05-15', 'くそまずい'),
(99, 0, 100, '0000-00-00', '何本あってもいい'),
(100, 0, 15, '2023-05-15', '苦い'),
(101, 0, 1, '2023-04-11', 'なんじゃそれ'),
(102, 0, 10, '2023-05-12', 'かふぇいん'),
(103, 0, 1, '2023-04-01', 'オンリーワン'),
(104, 0, 1000, '2023-05-18', '飲みに行きたい'),
(105, 0, 1, '2023-01-01', 'お正月'),
(106, 0, 20, '2023-05-12', 'add by ひろみ'),
(107, 0, 5, '2023-05-11', 'add'),
(108, 0, 10, '2023-05-15', 'くそまずい'),
(109, 0, 100, '0000-00-00', '何本あってもいい'),
(110, 0, 15, '2023-05-15', '苦い'),
(111, 0, 1, '2023-04-11', 'なんじゃそれ'),
(112, 0, 10, '2023-05-12', 'かふぇいん'),
(113, 0, 1, '2023-04-01', 'オンリーワン'),
(114, 0, 1000, '2023-05-18', '飲みに行きたい'),
(115, 0, 1, '2023-01-01', 'お正月'),
(116, 48, 20, '2023-05-12', 'add by ひろみ'),
(117, 40, 5, '2023-05-11', 'add'),
(118, 41, 10, '2023-05-15', 'くそまずい'),
(119, 60, 100, '0000-00-00', '何本あってもいい'),
(120, 46, 15, '2023-05-15', '苦い'),
(121, 45, 1, '2023-04-11', 'なんじゃそれ'),
(122, 51, 10, '2023-05-12', 'かふぇいん'),
(123, 48, 1, '2023-04-01', 'オンリーワン'),
(124, 56, 1000, '2023-05-18', '飲みに行きたい'),
(125, 58, 1, '2023-01-01', 'お正月'),
(127, 75, 100, '2023-05-30', ''),
(128, 66, 0, '2023-05-17', 'テスト'),
(129, 41, 0, '2023-05-16', 'test'),
(131, 76, 100, '2023-05-31', ''),
(132, 76, 80, '2023-06-03', ''),
(133, 38, 1000, '2023-05-30', ''),
(134, 38, 1000, '2023-05-27', ''),
(135, 38, 1222, '2023-05-15', ''),
(136, 38, 1000, '2023-05-01', '1'),
(137, 38, 10000, '2023-05-16', '2'),
(138, 38, 100000, '2023-05-22', ''),
(139, 40, 10, '2023-05-18', 'add by hase\r\n'),
(140, 40, 334, '2023-05-18', 'add by hase'),
(141, 79, 555, '2023-05-16', 'あやかの大好物'),
(142, 80, 5, '2023-06-29', 'Japanese Gin'),
(143, 48, 10, '2023-05-17', 'test');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'sasaki', 'sasaki0017'),
(2, 'nakamura', 'nakamura0008'),
(3, 'hujiwara', 'hujiwara0001'),
(4, 'tomosugi', 'tomosug0010'),
(6, 'ojima', 'ojima0014'),
(7, 'polanco', 'polanco0022'),
(8, 'sasakikun', 's'),
(9, 'hiromi', 'hiromi0617'),
(10, 'user001', '54a29633c81054529dc24b7605008b25'),
(11, 'user0002', '36fff8d16de220b6122e675b1e72afc1'),
(12, 'user0003', '3d517fe6ebab7b8cfcf98db6259c8a59'),
(13, 'user0004', '7e58d63b60197ceb55a1c487989a3720'),
(14, 'user0005', '37693cfc748049e45d87b8c7d8b9aacd'),
(15, 'user0007', '1d77b4e912da0b2f36fc41201061b072'),
(16, 'user0008', '14f68955a26e6b6e061ff1ed9034d549'),
(17, 'user1010', '8501a8826e680bb2dc3a6f2c9d7f33ee'),
(18, 'user0011', '1138db2df5f43a67062df9222c05fd69'),
(19, 'testuser', 'eb6ad84f2269e949c4948b0f32d244fc'),
(20, 'hasegawa', '57946d35d87f28266e2caf88b33a3207');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `mode`
--
ALTER TABLE `mode`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `mode`
--
ALTER TABLE `mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- テーブルの AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- テーブルの AUTO_INCREMENT `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
