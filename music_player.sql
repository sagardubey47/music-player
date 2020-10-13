-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2020 at 01:24 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id14795013_music_player`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `artist` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `artworkPath` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `artist`, `genre`, `artworkPath`) VALUES
(1, 'baaghi', 8, 5, 'includes\\Assets\\albumImg\\baaghi.jpg'),
(2, 'downtown', 2, 2, 'includes\\Assets\\albumImg\\Downtown - Guru Randhawa.jpg'),
(3, 'dj sanke', 6, 1, 'includes\\Assets\\albumImg\\let me love u.jpg'),
(4, 'made in india', 2, 2, 'includes\\Assets\\albumImg\\made in india.jpg'),
(5, 'ramaiya-vastavaiya', 7, 3, 'includes\\Assets\\albumImg\\16971-Ramaiya Vastavaiya (2013).jpg'),
(6, 'senorita', 3, 5, 'includes\\Assets\\albumImg\\senorita.jpg'),
(7, 'dil bechara', 5, 6, 'includes\\Assets\\albumImg\\dil bechara.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `name`) VALUES
(2, 'guru randhawa'),
(3, 'shawn mendes'),
(4, 'arijit singh'),
(5, 'mohit chauhan'),
(6, 'justin bieber'),
(7, 'atif aslam'),
(8, 'arman malik'),
(9, 'monali thakur'),
(10, 'meet bros');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'pop'),
(2, 'rock'),
(3, 'sad '),
(4, 'edm'),
(5, 'love'),
(6, 'jazz');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `owner`, `dateCreated`) VALUES
(11, 'playlist1', 'sagar47', '2020-09-04 00:00:00'),
(14, 'playlist2', 'sagar47', '2020-09-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `playlistsongs`
--

CREATE TABLE `playlistsongs` (
  `id` int(11) NOT NULL,
  `songId` int(11) NOT NULL,
  `playlistId` int(11) NOT NULL,
  `playlistOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playlistsongs`
--

INSERT INTO `playlistsongs` (`id`, `songId`, `playlistId`, `playlistOrder`) VALUES
(1, 1, 11, 1),
(6, 6, 14, 0),
(9, 9, 11, 2),
(10, 3, 11, 3),
(11, 4, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `artist` int(11) NOT NULL,
  `album` int(11) NOT NULL,
  `genre` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(300) NOT NULL,
  `albumOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `title`, `artist`, `album`, `genre`, `duration`, `path`, `albumOrder`, `plays`) VALUES
(1, 'sab tera', 8, 1, 5, '3:48', 'includes/Assets/songs/01 Sab Tera (Baaghi).mp3', 1, 89),
(2, 'downtown', 2, 2, 2, '3:36', 'includes/Assets/songs/Downtown.mp3', 1, 47),
(3, 'let me love you', 6, 3, 1, '3:25', 'includes/Assets/songs/Let_Me_Love.mp3', 1, 62),
(4, 'made in india', 2, 4, 2, '3:22', 'includes/Assets/songs/Made In India.mp3', 1, 102),
(5, 'rang jo lagyo', 7, 5, 3, '4:56', 'includes/Assets/songs/Rang-Jo-Lagyo (SongsMp3.Com).mp3', 1, 51),
(6, 'senorita', 3, 6, 5, '3:25', 'includes/Assets/songs/Señorita.mp3', 1, 40),
(7, 'taare ginn', 5, 7, 6, '4:17', 'includes/Assets/songs/Taare Ginn - Dil Bechara.mp3', 1, 41),
(8, 'agar tu hota toh', 8, 1, 5, '5:28', 'includes/Assets/songs/04 Agar Tu Hota.mp3', 2, 21),
(9, 'cham cham', 9, 1, 2, '4:44', 'includes/Assets/songs/03 Cham Cham.mp3', 3, 15);

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `id` int(11) NOT NULL,
  `user_name` varchar(25) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signup_date` datetime NOT NULL,
  `profile_pic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`id`, `user_name`, `first_name`, `last_name`, `email`, `password`, `signup_date`, `profile_pic`) VALUES
(1, 'sagar47', 'Sagar', 'Dubey', 'Sagardubey47@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2020-08-21 00:00:00', ''),
(4, 'jhdcv', 'Sagar', 'Dubey', 'Ashirwadsingh48@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '2020-08-21 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
