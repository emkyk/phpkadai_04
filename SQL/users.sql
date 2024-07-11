-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2024 年 7 月 11 日 16:40
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
-- データベース: `task_manager`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'emkyk', '$2y$10$MNPAqKNh2URwD6OXTKoWuu0MpfGPbNfMOtbNB5irLK4GoG11/t/De', '2024-07-10 13:37:45'),
(2, 'emkyk', '$2y$10$rBwIE8ZsXHXyOAANW6mBTezEFgG6ABgObzaGm8Xn0KGfeHeFZRbTu', '2024-07-10 13:38:07'),
(3, 'hikaru', '$2y$10$eniZ4om8Zba.4iMWaiylS.DO4ezZWAx21CVWVT0caKrYlvl9E/fyi', '2024-07-10 13:38:50'),
(4, 'mitsu', '$2y$10$OTZBsbkInr4Gmo5maWbxXuQ5mJgUq8UxLJFqd.DtZK0xNrOFG9YGC', '2024-07-10 13:39:14'),
(5, 'mitsu', '$2y$10$GXK4jqs4ImCtYltEkIP4TeACuebrdVECsAFj32sPkX3lbizDFlhzO', '2024-07-10 13:41:10'),
(6, 'hikaru', '$2y$10$hget7NJO08nZtoDOM3GCyu0yMihvtTgEH7UKARzcmlcXcLvuctJZq', '2024-07-10 19:05:28'),
(7, 'emkyk', '$2y$10$rjZARFxDgKq8IiwD.0iaUOEUSDm4Ax3zl3sCDWSoUZaLKJ6y3ZQlC', '2024-07-10 19:06:55'),
(8, 'noel', '$2y$10$ZeLDQ7Mn4ok7FzbVUrMm3eOQvmb4XOAM8Z6gYIA06VJrSPVRcoXG.', '2024-07-10 19:20:34'),
(9, 'sakura', '$2y$10$FnAORgH7JURxX.m9VTzsxOptpn9lqH.gzgAaPjRNorHStxtiU9T4a', '2024-07-11 11:37:51'),
(10, 'noel', '$2y$10$WSSJID.RZplCoFDxR7iXR.U7zAPusUxP.ulIMU7gC3Z5tHpRzGQJy', '2024-07-11 12:43:47'),
(11, 'gsacademy', '$2y$10$yZpwayXPutCDOu9CQr5qy.x/4HakupwxoxkBfrGnl9plJTjniL1hO', '2024-07-11 13:42:30'),
(12, 'mitsu', '$2y$10$yfKW05Pu56CvM9sT4ULKA.UguADJtwVpG12SWgqufcnrtzUAoWZYS', '2024-07-11 13:49:21');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
