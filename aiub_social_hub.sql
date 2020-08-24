-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2019 at 10:36 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aiub_social_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, '1733-673-1', 'P@$$w0rd');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(15) NOT NULL,
  `lastname` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `status` int(1) NOT NULL,
  `ban_status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `birthday`, `gender`, `status`, `ban_status`) VALUES
(1, 'Md', 'Hanif', '17-33673-1', 'hanif.hf.5@gmail.com', '1234567A', '1997-12-05', 'male', 0, 1),
(3, 'Rayen', 'Ronald', '17-11111-1', 'Rayen@gmail.com', '1234567A', '1994-06-16', 'male', 0, 0),
(4, 'Mead', 'Ahmed', '17-33679-1', 'mead@gmail.com', '1234567A', '1999-07-21', 'male', 0, 0),
(5, 'Hanif', 'Md', '17-33670-1', 'hanif.hf.5@gmail.com', '1234567A', '1997-12-05', 'male', 0, 0),
(6, 'Md.', 'Hanif', '17-33678-1', 'hanif.hf.5@gmail.com', '1234567A', '2019-08-20', 'male', 0, 0),
(7, 'Hanif', 'Md.', '17-33677-1', 'hanif.hf.5@gmail.com', '1234567A', '2019-08-12', 'male', 0, 0),
(8, 'Hasan', 'Ahammad', '19-33337-1', 'hasan.hn.429@gmail.com', '1234567A', '1999-07-08', 'male', 0, 1),
(9, 'Ratul', 'Hasan', '19-33333-1', 'ratul@gmail.com', '1234567A', '2002-06-07', 'male', 0, 0),
(10, 'Imtiaz', 'Ahmed Fahim', '17-33088-1', 'Imtaz@gamil.com', '1234567A', '2019-08-14', 'male', 0, 0),
(11, 'Kutub', 'Faisal', '17-33108-1', 'ridmikkutub@gmail.com', '1234567A', '1997-10-10', 'male', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
