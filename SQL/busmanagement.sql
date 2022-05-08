-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 04:46 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `busmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `br`
--

CREATE TABLE `br` (
  `BRID` int(11) NOT NULL,
  `BusStopID` int(11) NOT NULL,
  `BusTypeID` int(11) NOT NULL,
  `StopOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `br`
--

INSERT INTO `br` (`BRID`, `BusStopID`, `BusTypeID`, `StopOrder`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 2),
(3, 3, 1, 3),
(4, 4, 1, 4),
(5, 5, 2, 1),
(6, 4, 2, 2),
(7, 6, 2, 3),
(8, 7, 3, 1),
(9, 6, 3, 2),
(10, 8, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `BusID` int(11) NOT NULL,
  `DriverName` varchar(50) NOT NULL,
  `BusTypeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`BusID`, `DriverName`, `BusTypeID`) VALUES
(1, 'Kyaw Soe Naing', 1),
(2, 'Soe Moe', 3);

-- --------------------------------------------------------

--
-- Table structure for table `busstop`
--

CREATE TABLE `busstop` (
  `BusStopID` int(11) NOT NULL,
  `BusStop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `busstop`
--

INSERT INTO `busstop` (`BusStopID`, `BusStop`) VALUES
(1, 'BS1'),
(2, 'BS2'),
(3, 'BS3'),
(4, 'BS4'),
(5, 'BS5'),
(6, 'BS6'),
(7, 'BS7'),
(8, 'BS8'),
(15, '0000'),
(20, 'BS(Test)new');

-- --------------------------------------------------------

--
-- Table structure for table `bustype`
--

CREATE TABLE `bustype` (
  `BusTypeID` int(11) NOT NULL,
  `StartTime` time NOT NULL,
  `StopTime` time NOT NULL,
  `StartDestinationID` int(11) NOT NULL,
  `FinalDestinationID` int(11) NOT NULL,
  `NoofGates` int(11) NOT NULL,
  `BusNo` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `BusRouteUrl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bustype`
--

INSERT INTO `bustype` (`BusTypeID`, `StartTime`, `StopTime`, `StartDestinationID`, `FinalDestinationID`, `NoofGates`, `BusNo`, `Price`, `BusRouteUrl`) VALUES
(1, '17:30:00', '22:30:00', 1, 4, 4, 1, 100, 'http'),
(2, '17:30:00', '22:30:00', 5, 6, 3, 2, 200, 'https'),
(3, '17:30:00', '22:30:00', 7, 8, 3, 3, 200, 'httpl'),
(5, '15:25:00', '15:27:00', 1, 8, 8, 9, 200, 'https');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `DestinationID` int(11) NOT NULL,
  `Destination` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`DestinationID`, `Destination`) VALUES
(1, 'BS1'),
(2, 'BS2'),
(3, 'BS3'),
(4, 'BS4'),
(5, 'BS5'),
(6, 'BS6'),
(7, 'BS7'),
(8, 'BS8'),
(15, '0000'),
(20, 'BS(Test)new');

-- --------------------------------------------------------

--
-- Table structure for table `finaldestination`
--

CREATE TABLE `finaldestination` (
  `FinalDestinationID` int(11) NOT NULL,
  `FinalDestination` varchar(50) NOT NULL,
  `DestinationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finaldestination`
--

INSERT INTO `finaldestination` (`FinalDestinationID`, `FinalDestination`, `DestinationID`) VALUES
(1, 'BS1', 1),
(2, 'BS2', 2),
(3, 'BS3', 3),
(4, 'BS4', 4),
(5, 'BS5', 5),
(6, 'BS6', 6),
(7, 'BS7', 7),
(8, 'BS8', 8),
(15, '0000', 15),
(20, 'BS(Test)new', 20);

-- --------------------------------------------------------

--
-- Table structure for table `froute`
--

CREATE TABLE `froute` (
  `FRouteID` int(11) NOT NULL,
  `StartDestination` varchar(50) NOT NULL,
  `FinalDestination` varchar(50) NOT NULL,
  `FRoute` text NOT NULL,
  `FRouteUrl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `froute`
--

INSERT INTO `froute` (`FRouteID`, `StartDestination`, `FinalDestination`, `FRoute`, `FRouteUrl`) VALUES
(1, 'BS1', 'BS2', 'Ride BusNo 1 from BS1 to BS2', 'https'),
(2, 'BS1', 'BS3', 'Ride BusNo 1 from BS1 to BS3', 'https://www.youtube.com/'),
(3, 'BS1', 'BS6', 'Ride BusNo 1 From BS1 To BS4 And Then Change Into BusNo 2 To Reach BS6', 'h'),
(4, 'BS1', 'BS5', 'Ride BusNo 1 From BS1 To BS4 And Then Change Into BusNo 2 To Reach BS5', 'h'),
(5, 'BS1', 'BS7', 'Ride BusNo 1 From BS1 To BS4 And Then Change Into BusNo 2 And Stop at BS6. Then Ride BusNo 3 From BS6 To BS7', 'h'),
(7, 'BS6', 'BS1', 'Ride BusNo 2 From BS6 To BS4 And Then Change Into BusNo 1 To Reach BS1', 'https://toonily.com/');

-- --------------------------------------------------------

--
-- Table structure for table `interroute`
--

CREATE TABLE `interroute` (
  `IRID` int(11) NOT NULL,
  `FRouteID` int(11) NOT NULL,
  `BRID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interroute`
--

INSERT INTO `interroute` (`IRID`, `FRouteID`, `BRID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 3),
(5, 3, 1),
(6, 3, 4),
(7, 3, 7),
(8, 4, 1),
(9, 4, 4),
(10, 4, 5),
(11, 5, 1),
(12, 5, 4),
(13, 5, 7),
(14, 5, 8),
(17, 7, 7),
(18, 7, 4),
(19, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE `ride` (
  `RideID` int(11) NOT NULL,
  `BusID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Feedback` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ride`
--

INSERT INTO `ride` (`RideID`, `BusID`, `UserID`, `Feedback`) VALUES
(1, 1, 1, 'Yes and No'),
(2, 1, 1, ''),
(3, 1, 1, ''),
(4, 1, 1, ''),
(5, 1, 1, ''),
(6, 1, 1, ''),
(7, 1, 1, 'No way'),
(13, 1, 1, ''),
(14, 1, 1, ''),
(15, 1, 1, 'Good'),
(16, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `startdestination`
--

CREATE TABLE `startdestination` (
  `StartDestinationID` int(11) NOT NULL,
  `StartDestination` varchar(50) NOT NULL,
  `DestinationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `startdestination`
--

INSERT INTO `startdestination` (`StartDestinationID`, `StartDestination`, `DestinationID`) VALUES
(1, 'BS1', 1),
(2, 'BS2', 2),
(3, 'BS3', 3),
(4, 'BS4', 4),
(5, 'BS5', 5),
(6, 'BS6', 6),
(7, 'BS7', 7),
(8, 'BS8', 8),
(15, '0000', 15),
(20, 'BS(Test)new', 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNumber` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Balance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Email`, `PhoneNumber`, `Password`, `Balance`) VALUES
(1, 'SwamUpdate', 'test@gmail.com', '09693483946', '11111', 9200),
(2, 'Bruh', 'syph@gmail.com', '09693567946', '11111', 0),
(3, 'Noice', 'No@gmail.com', '09699867946', '11111', 0),
(10, 'Love', 'love@gmail.com', '09699867946', '11111', 0),
(12, 'OKPAR', 'OKPAR@gmail.com', '09632587414', '11111', 0),
(13, 'Nice', 'nice@gmail.com', '096541239878', '1111', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `br`
--
ALTER TABLE `br`
  ADD PRIMARY KEY (`BRID`);

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`BusID`);

--
-- Indexes for table `busstop`
--
ALTER TABLE `busstop`
  ADD PRIMARY KEY (`BusStopID`);

--
-- Indexes for table `bustype`
--
ALTER TABLE `bustype`
  ADD PRIMARY KEY (`BusTypeID`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`DestinationID`);

--
-- Indexes for table `finaldestination`
--
ALTER TABLE `finaldestination`
  ADD PRIMARY KEY (`FinalDestinationID`);

--
-- Indexes for table `froute`
--
ALTER TABLE `froute`
  ADD PRIMARY KEY (`FRouteID`);

--
-- Indexes for table `interroute`
--
ALTER TABLE `interroute`
  ADD PRIMARY KEY (`IRID`);

--
-- Indexes for table `ride`
--
ALTER TABLE `ride`
  ADD PRIMARY KEY (`RideID`);

--
-- Indexes for table `startdestination`
--
ALTER TABLE `startdestination`
  ADD PRIMARY KEY (`StartDestinationID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `br`
--
ALTER TABLE `br`
  MODIFY `BRID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `BusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `busstop`
--
ALTER TABLE `busstop`
  MODIFY `BusStopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bustype`
--
ALTER TABLE `bustype`
  MODIFY `BusTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `DestinationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `finaldestination`
--
ALTER TABLE `finaldestination`
  MODIFY `FinalDestinationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `froute`
--
ALTER TABLE `froute`
  MODIFY `FRouteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `interroute`
--
ALTER TABLE `interroute`
  MODIFY `IRID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `RideID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `startdestination`
--
ALTER TABLE `startdestination`
  MODIFY `StartDestinationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
