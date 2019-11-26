-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2019 at 09:58 AM
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
-- Database: `dkut_coke`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `fname`, `lname`, `email`, `tel`, `password`) VALUES
(1, 'admin1', 'Jared', 'Karumba', 'admin1@gmail.com', '0718610463', 'e00cf25ad42683b3df678c61f42c6bda');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `sirname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateCreated` date NOT NULL,
  `timeCreated` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `admin` varchar(20) NOT NULL,
  `deactdate` date NOT NULL,
  `deactreason` varchar(255) NOT NULL,
  `reactdate` date NOT NULL,
  `reactreason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `username`, `firstname`, `lastname`, `sirname`, `email`, `tel`, `password`, `dateCreated`, `timeCreated`, `status`, `admin`, `deactdate`, `deactreason`, `reactdate`, `reactreason`) VALUES
(1, 'agent001', 'john ', 'doe', 'bond', 'johndoe@gmail.com', '0718610463', '213b8657a6eba94f55dccd6f669a3bb1', '2019-08-08', '07:29:56', 'ACTIVE', '', '0000-00-00', '', '0000-00-00', ''),
(2, 'agent002', 'raven', 'wanyama', 'kuria', 'raven@yahoo.com', '0712456456', 'e0d32b8565368e90074b51e567f6e4d3', '2019-08-08', '07:37:39', 'ACTIVE', '', '0000-00-00', '', '0000-00-00', ''),
(3, 'agent003', 'Keptler', '452b', 'rover', 'washiemugo@gmail.com', '0725114223', '88a8e5273c27ec4e6c4afd6b40041610', '2019-08-08', '07:54:05', 'DEACTIVATED', '', '2019-11-26', 'deaxc', '0000-00-00', ''),
(4, 'agent004', '', '', '', 'agent4@gmail.com', '0714563258', 'f2e92b5ac317c771d1cfacc6f283e940', '2019-11-18', '04:27:39', 'DEACTIVATED', 'admin1', '2019-11-18', 'have not filled your details completely', '0000-00-00', ''),
(5, 'agent0', '', '', '', 'kamande@yahoo.com', '0714524789', '71e6ab5988a0709da605aab8ab89e548', '2019-11-26', '08:51:40', 'ACTIVE', 'admin1', '0000-00-00', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `deptname` varchar(255) NOT NULL,
  `datecreated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `deptname`, `datecreated`) VALUES
(2, 'Softdrinks', '2019-08-10'),
(4, 'Merchandise', '2019-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `id` int(11) NOT NULL,
  `distname` varchar(255) NOT NULL,
  `distoname` varchar(255) NOT NULL,
  `distemail` varchar(255) NOT NULL,
  `distel` int(12) NOT NULL,
  `distlocation` varchar(255) NOT NULL,
  `dateadded` date NOT NULL,
  `timeadded` time NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `accountStatus` varchar(20) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `approvalremarks` varchar(255) NOT NULL,
  `manager` varchar(20) NOT NULL,
  `dapprovedrej` date NOT NULL,
  `reason4deact` varchar(255) NOT NULL,
  `actdeactdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`id`, `distname`, `distoname`, `distemail`, `distel`, `distlocation`, `dateadded`, `timeadded`, `description`, `status`, `accountStatus`, `lat`, `lng`, `username`, `password`, `approvalremarks`, `manager`, `dapprovedrej`, `reason4deact`, `actdeactdate`) VALUES
(1, 'Distributor001', 'Jannet Wambui ', 'jannet@dist001.co.ke', 712457896, 'Kangema ', '2019-08-09', '11:09:40', 'some sort of description about distributor 001 ', 'ACTIVE', 'APPROVED', -1.28696, 30.8353, 'distributor001', '35e13ca2632d9e48d7df3fcac75a34fb', 'account has been approved', '<br /><b>Notice</b>:', '2019-11-22', 'another one\r\n', '2019-11-22'),
(2, 'Distributor 002 ', 'Fredrick Mzito ', 'fredie@dist002.ac.ke', 789456123, 'Classic ', '2019-08-09', '11:11:31', 'some sort of description about distributor 002 ', 'ACTIVE', 'APPROVED', -1.4287, 33.8353, 'distributor002', '7a70b20a672038e84fdc4ccb28e7764e', 'we have identified your account as a valid distributor\r\n', '<br /><b>Notice</b>:', '2019-11-22', 'some activation is needed so that we can test it \r\n', '2019-11-22'),
(4, 'Distributor003', '', 'williamdist3@yahoo.com', 0, '', '2019-10-21', '02:00:30', '', 'INNACTIVE', 'REJECTED', -1.28696, 39.8353, 'distributor003', '5f4dcc3b5aa765d61d8327deb882cf99', 'we do not affirm your credentials', '<br /><b>Notice</b>:', '2019-11-22', '', '0000-00-00'),
(5, 'distributor004', 'Joffry Mbatia', 'jeffa.dist@coke.ac.ke', 744162147, 'Kingongo, Nyeri', '2019-11-20', '06:12:00', 'the distribution is located next to kingongo prisons. opposite a green gate.  \r\n', 'ACTIVE', 'APPROVED', -1.28696, 36.8353, 'distributor004', '5f4dcc3b5aa765d61d8327deb882cf99', 'you are qualified', '<br /><b>Notice</b>:', '2019-11-22', 'your account is now active\r\n', '2019-11-26'),
(6, 'distribution 5', 'james Karanja', 'wanjohi@gmail.com', 744162147, 'Kingongo, Nyeri', '2019-11-26', '09:31:56', 'im a distributor located in kingongo opp prisons gate ', 'ACTIVE', 'APPROVED', -0.423544, 36.9519, 'distributor005', 'ad7eccc7e4b47b6b25cd1f5856e62e99', 'tou account has been been validated, thank you for signing up', '<br /><b>Notice</b>:', '2019-11-26', 'your account is now active', '2019-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `distributor` int(20) NOT NULL,
  `maxdasani` double NOT NULL,
  `maxsoda` double NOT NULL,
  `reorderdasani` double NOT NULL,
  `reordersoda` double NOT NULL,
  `minsoda` double NOT NULL,
  `mindasani` double NOT NULL,
  `currentdasani` double NOT NULL,
  `currentsoda` double NOT NULL,
  `stocklevel` double NOT NULL,
  `ldate` date NOT NULL,
  `ltime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `distributor`, `maxdasani`, `maxsoda`, `reorderdasani`, `reordersoda`, `minsoda`, `mindasani`, `currentdasani`, `currentsoda`, `stocklevel`, `ldate`, `ltime`) VALUES
(1, 1, 12, 15, 60, 100, 10, 6, 50, 80, 130, '2019-11-26', '09:10:41'),
(2, 2, 5, 10, 50, 70, 5, 2, 30, 45, 75, '2019-11-26', '02:33:30'),
(3, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', '00:00:00'),
(4, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(35) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `dateadded` date NOT NULL,
  `admin` varchar(20) NOT NULL,
  `deactreason` varchar(255) NOT NULL,
  `deactdate` date NOT NULL,
  `reactreason` varchar(255) NOT NULL,
  `reactdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `username`, `fname`, `lname`, `email`, `tel`, `password`, `status`, `dateadded`, `admin`, `deactreason`, `deactdate`, `reactreason`, `reactdate`) VALUES
(1, 'manager1', 'Derrik', 'Kibuga', 'manager1@gmail.com', '0784555444', 'c240642ddef994358c96da82c0361a58', 'ACTIVE', '2019-11-18', 'admin1', '', '0000-00-00', 'fully filled the required details ', '2019-11-18'),
(2, 'manager2', '', '', 'manager2@gmail.com', '', '8df5127cd164b5bc2d2b78410a7eea0c', 'DEACTIVATED', '2019-11-18', 'admin1', 'on avacational leave \r\n', '2019-11-18', '', '0000-00-00'),
(3, 'manager3', 'Allan', 'warutumo', 'warutumo@gmail.com', '07114562013', '2d3a5db4a2a9717b43698520a8de57d0', 'ACTIVE', '2019-11-26', 'admin1', '', '0000-00-00', '', '0000-00-00'),
(5, 'manager4', '', '', 'manager4@gmail.com', '', 'e1ec6fc941af3ba79a4ac5242dd39735', 'ACTIVE', '2019-11-26', 'admin1', '', '0000-00-00', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `marchandise`
--

CREATE TABLE `marchandise` (
  `id` int(11) NOT NULL,
  `marname` varchar(20) NOT NULL,
  `amount` double NOT NULL,
  `distid` int(11) NOT NULL,
  `agentid` int(11) NOT NULL,
  `instructions` varchar(255) NOT NULL,
  `dateassigned` date NOT NULL,
  `agentremarks` varchar(255) NOT NULL,
  `distremarks` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `adminremarks` varchar(255) NOT NULL,
  `datefinished` date NOT NULL,
  `timefinished` time NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `marchandise`
--

INSERT INTO `marchandise` (`id`, `marname`, `amount`, `distid`, `agentid`, `instructions`, `dateassigned`, `agentremarks`, `distremarks`, `status`, `adminremarks`, `datefinished`, `timefinished`, `lat`, `lng`) VALUES
(1, 'T-shirts', 10, 2, 2, 'hand out the 10 pieces of t-shirts ', '2019-11-23', '', '', 'PENDING', '', '0000-00-00', '00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `agentid` int(11) NOT NULL,
  `agent` varchar(255) NOT NULL,
  `distributor` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `datecreated` date NOT NULL,
  `timecreated` time NOT NULL,
  `datecompleted` date NOT NULL,
  `timecompleted` time NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `distributorgrade` int(2) NOT NULL,
  `distributorremarks` varchar(255) NOT NULL,
  `manageremarks` varchar(255) NOT NULL,
  `managergrade` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `agentid`, `agent`, `distributor`, `description`, `datecreated`, `timecreated`, `datecompleted`, `timecompleted`, `remarks`, `status`, `lat`, `lng`, `distributorgrade`, `distributorremarks`, `manageremarks`, `managergrade`) VALUES
(8, 1, 'agent001', '2', 'gather the inventory levels. incase of  any enquiries contact one of the managers', '2019-11-23', '12:29:00', '0000-00-00', '00:00:00', '', 'APPROVED', 0, 0, 3, 'he was great', 'good work ', 4),
(9, 1, 'agent001', '2', 'ensure you collect the data completely ', '2019-11-25', '10:15:00', '2019-11-26', '02:29:59', 'the distributor cooperated well ', 'APPROVED', -1.2714, 36.8361, 2, 'agent was fine ', 'good work Agent', 4),
(10, 1, 'agent001', '2', 'report inventory levels', '2019-11-26', '12:47:00', '2019-11-26', '02:33:30', 'the distributor was okay ', 'AWAITING APPROVAL', -1.2714, 36.8361, 0, '', '', 0),
(11, 1, 'agent001', '2', 'make sure you do the work in time ', '2019-11-26', '06:15:00', '0000-00-00', '00:00:00', '', 'PENDING', 0, 0, 0, '', '', 0),
(12, 2, 'agent002', '1', 'collect all the data \r\n', '2019-11-26', '06:08:00', '2019-11-26', '09:10:41', 'he was compliant', 'AWAITING APPROVAL', -0.423522, 36.9519, 4, 'the agent was amazing or something', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'cokeadmin', 'cokeadmin@gmail.com', '2d28a1598b25a32d21b46b901b27a1ef');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marchandise`
--
ALTER TABLE `marchandise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `marchandise`
--
ALTER TABLE `marchandise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
