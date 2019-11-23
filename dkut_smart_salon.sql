-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2019 at 10:41 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dkut_smart_salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
(6, 'admin1', 'admin1@gmail.com', 'e00cf25ad42683b3df678c61f42c6bda');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `salonist` varchar(20) NOT NULL,
  `styleid` int(11) NOT NULL,
  `datebooked` date NOT NULL,
  `timeboked` time NOT NULL,
  `prefereddate` date NOT NULL,
  `preferdtime` time NOT NULL,
  `description` varchar(255) NOT NULL,
  `salonistreply` varchar(255) NOT NULL,
  `status` varchar(40) NOT NULL,
  `reasonforrejection` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `username`, `salonist`, `styleid`, `datebooked`, `timeboked`, `prefereddate`, `preferdtime`, `description`, `salonistreply`, `status`, `reasonforrejection`) VALUES
(1, 'user1', 'salonist1', 1, '0000-00-00', '03:08:00', '2019-11-15', '10:10:00', 'i need a quick makeover', '', 'REJECTED', 'incapable of identifying the date of your booking'),
(2, 'user1', 'salonist1', 2, '2019-07-11', '03:10:00', '2019-11-29', '10:10:00', 'i would like to have an afro', 'okay, kindly keep time since i have allocated you that slot ', 'APPROVED', ''),
(3, 'user1', 'salonist1', 1, '2019-07-11', '03:30:00', '2019-11-15', '12:12:00', 'a quick braids job', '', 'REJECTED', 'im busy that time try another time '),
(4, 'user1', 'salonist1', 5, '0000-00-00', '12:00:00', '2019-11-28', '10:20:00', 'i need a nice make over', 'have received your order. lets meet then', 'APPROVED', '');

-- --------------------------------------------------------

--
-- Table structure for table `haircategories`
--

CREATE TABLE `haircategories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `haircategories`
--

INSERT INTO `haircategories` (`id`, `name`) VALUES
(1, 'Braids'),
(2, 'Curls'),
(3, 'Blonde'),
(4, 'Short Cut');

-- --------------------------------------------------------

--
-- Table structure for table `salonist`
--

CREATE TABLE `salonist` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `salonname` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `tfrom` time NOT NULL,
  `tto` time NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `datecreated` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salonist`
--

INSERT INTO `salonist` (`id`, `username`, `email`, `password`, `fname`, `lastname`, `salonname`, `category`, `phone`, `location`, `tfrom`, `tto`, `lat`, `lng`, `datecreated`, `status`) VALUES
(1, 'salonist1', 'salonist1@gmail.com', '4faee54995cf230e56ef5940093be648', 'Mary', 'Njihia', 'MariNje Palor', 'Business', 718610463, 'kamakwa', '08:30:00', '21:30:00', -1.2841, 36.8155, ' 	2019-09-10', 'APPROVED'),
(2, 'salonist2', 'salonist2@gmail.com', '35374b3727336280d50137890456ac3a', 'Terry', 'Crews', 'TerryHairs', 'Freelance', 744567898, 'Langas', '08:10:00', '21:30:00', -1.27468, 36.8353, '2019-09-12', 'PENDING APPROVAL'),
(3, 'salonist3', 'salonist3@gmail.com', 'ba1db6fbd091a4f9ad9b770987f075a9', 'Jane', 'Nyambura ', 'SylishParlor ', 'Both', 744456790, 'Classic, Nyeri ', '07:20:00', '18:30:00', -1.27468, 36.8353, '2019-09-12', 'PENDING APPROVAL');

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE `styles` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `sname` varchar(40) NOT NULL,
  `scategory` varchar(40) NOT NULL,
  `sprice` double NOT NULL,
  `sdescription` varchar(255) NOT NULL,
  `salonistid` int(11) NOT NULL,
  `salonistname` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `image`, `sname`, `scategory`, `sprice`, `sdescription`, `salonistid`, `salonistname`) VALUES
(1, 'b5.jpg', 'Side Braids', 'Braids', 2500, 'the style braids are just the best,, so get one today at a negotiable price', 1, 'salonist1'),
(2, 'b12.jpg', 'curly afro braids', 'Curls', 2500, 'some simple braided afro mix of braids for blondes', 1, 'salonist1'),
(3, '7.jpg', 'Semi Blonde', 'Blonde', 4000, 'semi blonde hairstyle to suit all ladies in the wild', 1, 'salonist1'),
(4, 'b9.jpg', 'baby locks', 'Short Cut', 3000, 'this is an amazingly new style to enable you to get that new look that you have always wanted', 1, 'salonist1'),
(5, 'b1.jpg', 'smart braids', 'Braids', 3000, 'some description about the hairstyle ', 1, 'salonist1'),
(6, 'b10.jpg', 'bond', 'Curls', 2000, 'some some stuff', 1, 'salonist1'),
(7, 'maxresdefault.jpg', 'maajabu ', 'Blonde', 2000, 'some maajabu description', 1, 'salonist1');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `idnumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telno` varchar(255) NOT NULL,
  `datecreated` date NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `telno`, `datecreated`, `fname`, `lname`, `gender`, `lat`, `lng`) VALUES
(1, 'user1', 'user1@gmail.com', '24c9e15e52afc47c225b757e7bee1f9d', '0744454565', '2019-09-12', 'jannet', 'arika ', 'Male', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `haircategories`
--
ALTER TABLE `haircategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salonist`
--
ALTER TABLE `salonist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `haircategories`
--
ALTER TABLE `haircategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salonist`
--
ALTER TABLE `salonist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `styles`
--
ALTER TABLE `styles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
