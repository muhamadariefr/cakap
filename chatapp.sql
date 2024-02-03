-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Feb 2024 pada 05.51
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `file`, `timestamp`) VALUES
(1, 757328079, 1217883795, 'tes', NULL, '2024-01-12 01:18:00'),
(2, 1217883795, 757328079, 'Yo', NULL, '2024-01-12 01:18:00'),
(3, 757328079, 1217883795, 'mabar mes', NULL, '2024-01-12 01:22:00'),
(4, 1217883795, 757328079, 'mabar paan do', NULL, '2024-01-12 01:23:00'),
(5, 757328079, 1217883795, 'PES/FIFA lah gua bantai lu sini', NULL, '2024-01-12 01:23:00'),
(6, 757328079, 1217883795, 'gas laa kalo gua menang gua GOAT', NULL, '2024-01-12 02:14:00'),
(7, 1217883795, 757328079, 'Wkwk boleh do, tapi lu ga punya pildun yahaha', NULL, '2024-01-12 02:15:00'),
(8, 757328079, 1217883795, 'tai lu mes', NULL, '2024-01-12 02:19:00'),
(9, 757328079, 1217883795, 'bawa bawa pildun', NULL, '2024-01-12 02:20:00'),
(10, 757328079, 1217883795, 'minimal ke aceh', NULL, '2024-01-12 02:20:00'),
(11, 1217883795, 757328079, 'hooh', NULL, '2024-01-12 07:53:00'),
(12, 757328079, 1217883795, 'Woy mes gas mabar', NULL, '2024-01-12 07:54:00'),
(13, 1217883795, 757328079, 'penaldo', NULL, '2024-01-13 01:52:00'),
(14, 757328079, 1217883795, 'apaan lu mes', NULL, '2024-01-13 02:18:00'),
(15, 757328079, 1217883795, 'tiba tiba penaldo', NULL, '2024-01-13 02:37:00'),
(16, 1217883795, 757328079, 'wkwk', NULL, '2024-01-13 03:11:00'),
(17, 1217883795, 757328079, 'mabarin do login', NULL, '2024-01-13 09:25:00'),
(18, 1142207643, 552487546, 'tse', NULL, '2024-01-23 14:12:00'),
(19, 552487546, 1142207643, 'ouy', NULL, '2024-01-23 14:12:00'),
(20, 1142207643, 552487546, 'dmna?', NULL, '2024-01-23 14:12:00'),
(31, 1142207643, 552487546, 'ss', '', '2024-01-23 22:07:00'),
(34, 552487546, 1142207643, 'Send fie', '', '2024-01-23 22:42:00'),
(48, 552487546, 1142207643, 'send file', 'Dokumentasi penggunaan aplikasi chat.pdf', '2024-01-23 23:05:00'),
(49, 552487546, 1142207643, 'dsf', '1703071641businesswoman.png', '2024-01-28 01:32:00'),
(50, 552487546, 1142207643, 'dimana euy?', '1703071641businesswoman.png', '2024-01-28 01:34:00'),
(51, 552487546, 1142207643, 'd', '.', '2024-01-28 01:34:00'),
(52, 552487546, 1142207643, 'asdf', '.', '2024-01-28 01:34:00'),
(53, 552487546, 1142207643, 'rty', '1703071641businesswoman.png', '2024-01-28 01:35:00'),
(54, 552487546, 1142207643, 'asd', '1703071641businesswoman.png', '2024-01-28 01:35:00'),
(55, 1142207643, 552487546, 'ads', '.', '2024-01-28 01:36:00'),
(56, 1142207643, 552487546, 'aaaa', '1703071502man.png', '2024-01-28 01:36:00'),
(57, 1142207643, 552487546, 'ty', '1703071502man.png', '2024-01-28 01:37:00'),
(58, 1142207643, 552487546, 's', '', '2024-01-28 01:40:00'),
(59, 1142207643, 552487546, 'yyy', '1703125409leon.jpg', '2024-01-28 01:40:00'),
(60, 1142207643, 552487546, 'asd', '1703125409leon.jpg', '2024-01-28 01:40:00'),
(61, 1142207643, 552487546, 'ppp', '1703071502man.png', '2024-01-28 01:43:00'),
(62, 1142207643, 552487546, 'sss', '1703071502man.png', '2024-01-28 01:43:00'),
(63, 1142207643, 552487546, 'ddd', '', '2024-01-28 01:44:00'),
(64, 1142207643, 552487546, 'ss', '', '2024-01-28 01:45:00'),
(65, 1142207643, 552487546, 'ds', '', '2024-01-28 01:46:00'),
(66, 1142207643, 552487546, 'rrr', '', '2024-01-28 01:46:00'),
(67, 552487546, 1142207643, 'aaa', '', '2024-01-28 01:47:00'),
(68, 552487546, 1142207643, 'asd', '', '2024-01-28 01:50:00'),
(69, 552487546, 1142207643, 'asdss', '', '2024-01-28 01:50:00'),
(70, 552487546, 1142207643, 'poni', '', '2024-01-28 01:50:00'),
(71, 552487546, 1142207643, 'sss', '', '2024-01-28 01:51:00'),
(72, 552487546, 1142207643, 'bewok', '1703071502man.png', '2024-01-28 01:51:00'),
(73, 552487546, 1142207643, 'ddd', '1703071502man.png', '2024-01-28 01:51:00'),
(74, 552487546, 1142207643, 'no file', '', '2024-01-28 01:52:00'),
(75, 552487546, 1142207643, 'file on', '1703071641businesswoman.png', '2024-01-28 01:52:00'),
(76, 552487546, 1142207643, 'no', '1703071641businesswoman.png', '2024-01-28 01:52:00'),
(77, 552487546, 1142207643, 't', '1703125583ashley.jpg', '2024-01-28 01:54:00'),
(78, 552487546, 1142207643, 'q', '1703125583ashley.jpg', '2024-01-28 01:54:00'),
(79, 552487546, 1142207643, 'd', '1703125583ashley.jpg', '2024-01-28 01:55:00'),
(80, 552487546, 1142207643, 'dd', '', '2024-01-28 01:55:00'),
(81, 552487546, 1142207643, 'wq', '1703071478profile.png', '2024-01-28 01:55:00'),
(82, 552487546, 1142207643, 'gf', '1703071478profile.png', '2024-01-28 01:56:00'),
(83, 552487546, 1142207643, 'aaa', '', '2024-01-28 01:57:00'),
(84, 552487546, 1142207643, '12qw', '1703071641businesswoman.png', '2024-01-28 01:57:00'),
(85, 552487546, 1142207643, 'lkj', '1703071641businesswoman.png', '2024-01-28 01:57:00'),
(86, 552487546, 1142207643, 'as', '', '2024-01-28 01:59:00'),
(87, 552487546, 1142207643, 'as', '', '2024-01-28 02:01:00'),
(88, 552487546, 1142207643, 'd', '1703071502man.png', '2024-01-28 02:01:00'),
(89, 552487546, 1142207643, 'fff', '1703071502man.png', '2024-01-28 02:02:00'),
(90, 552487546, 1142207643, 'd', '1703125583ashley.jpg', '2024-01-28 02:04:00'),
(91, 552487546, 1142207643, 'd', '', '2024-01-28 02:06:00'),
(92, 552487546, 1142207643, 'a', '', '2024-01-28 02:06:00'),
(93, 552487546, 1142207643, 'j', '', '2024-01-28 02:07:00'),
(94, 552487546, 1142207643, 'gs', '', '2024-01-28 02:07:00'),
(95, 552487546, 1142207643, 'as', '', '2024-01-28 02:08:00'),
(96, 552487546, 1142207643, 'ff', '', '2024-01-28 02:08:00'),
(97, 552487546, 1142207643, 'f', '', '2024-01-28 02:08:00'),
(98, 552487546, 1142207643, 'we', '', '2024-01-28 02:09:00'),
(99, 552487546, 1142207643, 'aa', '', '2024-01-28 02:10:00'),
(100, 552487546, 1142207643, 'Go', '1703071641businesswoman.png', '2024-01-28 02:10:00'),
(101, 552487546, 1142207643, 's', '', '2024-01-28 02:10:00'),
(102, 552487546, 1142207643, 'goto', '1703071641businesswoman.png', '2024-01-28 02:10:00'),
(103, 552487546, 1142207643, 'x', '', '2024-01-28 02:10:00'),
(104, 1217883795, 757328079, 'do', 'cr7.jpg', '2024-01-28 14:34:00'),
(105, 757328079, 1217883795, 'ni mes', 'messi.jpg', '2024-01-28 14:37:00'),
(106, 757328079, 1217883795, 'woy mes', '', '2024-01-29 12:42:00'),
(107, 1217883795, 757328079, 'paan do', '', '2024-01-29 12:42:00'),
(108, 757328079, 1217883795, 'mabar lah', '', '2024-01-29 12:43:00'),
(109, 757328079, 1217883795, 'p', '', '2024-01-29 12:49:00'),
(110, 757328079, 1217883795, 'Wak haji menang balon jedor', 'benzema.jpg', '2024-01-29 12:56:00'),
(111, 757328079, 1217883795, 'woy mes', '', '2024-02-01 06:18:00'),
(112, 1217883795, 757328079, 'paan do', '', '2024-02-03 04:49:00'),
(113, 757328079, 1217883795, 'ajik baru dijawab', '', '2024-02-03 04:49:00'),
(114, 757328079, 1217883795, 'kalah lu 6-0 wkwk', '', '2024-02-03 04:49:00'),
(115, 757328079, 1217883795, 'liga arab better than mls', '', '2024-02-03 04:50:00'),
(116, 1217883795, 757328079, 'bacot do', '', '2024-02-03 04:50:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`) VALUES
(1, 1217883795, 'Cristiano', 'Ronaldo', 'cr7@gmail.com', 'a2ba59c6df1959fc949ceb69dcf16959', '1906-cr7.jpg', 'Offline'),
(2, 757328079, 'Lionel', 'Messi', 'lm10@gmail.com', 'a94aa000f9a94cc51775bd5eac97c926', '1729-messi.jpg', 'Offline'),
(3, 1142207643, 'Tukinem', 'Sulaesih', 'yono@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1017-1703125583ashley.jpg', 'Online'),
(4, 552487546, 'Rizkan', 'Ramdani', 'rizkan@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1627-1703071502man.png', 'Online'),
(5, 624973021, 'Arief', 'R', 'arief@gmail.com', '2fab7eefb328d669c8dde67a91528eb9', 'default.png', 'Offline');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
