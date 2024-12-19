-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 19, 2024 at 01:59 PM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u846527182_spa_massage_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `contact` varchar(250) NOT NULL,
  `user_type` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `name`, `added_on`, `contact`, `user_type`, `username`, `password`, `status`) VALUES
(7, 'Paul Andrew B. Florendo', '2024-12-03 10:26:51', '+63 945 345 2342', 'admin', 'admin_paul', 'SlJxYUQ1b2Z6a0tRVHNaVk9lMnp2QT09', 'active'),
(8, 'Paul Andrew B. Florendo', '2024-12-03 10:30:27', '+63 912 343 3454', 'staff', 'paull', 'QzlKcnM0RkVDR0NqZ2lIVnpLOVgvUT09', 'deactive'),
(9, 'Juan Dela Cruz ', '2024-12-13 07:46:52', '+63 945 621 3213', 'staff', 'Juan', 'QzlKcnM0RkVDR0NqZ2lIVnpLOVgvUT09', 'active'),
(10, 'Fatima Andrei Gualvez', '2024-12-13 07:47:23', '+63 921 314 6487', 'staff', 'Fatima', 'TG9abkhKcG1LUDNxTGo1ekYveHpTUT09', 'active'),
(11, 'Zarah C. Dela Cruz', '2024-12-13 07:48:36', '+63 956 948 9842', 'staff', 'Juan', 'TG9abkhKcG1LUDNxTGo1ekYveHpTUT09', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `client_service`
--

CREATE TABLE `client_service` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `status` varchar(250) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_service`
--

INSERT INTO `client_service` (`id`, `client_id`, `service_id`, `status`) VALUES
(1, 1, 23, 'active'),
(2, 2, 29, 'active'),
(3, 3, 29, 'active'),
(4, 4, 29, 'active'),
(5, 5, 29, 'active'),
(6, 6, 32, 'active'),
(7, 7, 30, 'active'),
(8, 8, 30, 'active'),
(9, 9, 30, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `client_tbl`
--

CREATE TABLE `client_tbl` (
  `id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `contact_number` varchar(250) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `client_type` varchar(250) NOT NULL,
  `sched_date` date NOT NULL,
  `sched_time` varchar(250) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(250) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_tbl`
--

INSERT INTO `client_tbl` (`id`, `fullname`, `email`, `contact_number`, `staff_id`, `client_type`, `sched_date`, `sched_time`, `added_on`, `status`) VALUES
(1, 'Janine Florendo', 'jbflorendo@sei.dost.gov.ph', '+63 909 123 4567', 3, 'appointment', '2024-12-04', '7:00 PM - 8:00 PM', '2024-12-03 02:13:16', 'cancelled'),
(2, 'Paul Andrew Florendo', 'paulf5364@gmail.com', '+63 923 323 2323', 8, 'appointment', '2024-12-04', '12:00 PM - 1:00 PM', '2024-12-03 10:38:51', 'completed'),
(3, 'TEST', 'paulf5364@gmail.com', '+63 912 312 3231', 8, 'appointment', '2024-12-11', '12:00 PM - 1:00 PM', '2024-12-04 05:59:43', 'active'),
(4, 'asddsa', 'paulf5364@gmail.cpm', '+63 953 345 3645', 8, 'appointment', '2024-12-17', '12:00 PM - 1:00 PM', '2024-12-11 13:28:59', 'active'),
(5, 'asdsadad', 'paulf5364@gmail.com', '+63 912 345 6789', 8, 'appointment', '2024-12-18', '12:00 PM - 1:00 PM', '2024-12-11 13:30:54', 'completed'),
(6, 'paul Andrew B. Florendo', 'paulf5364@gmail.com', '+63 945 656 4645', 10, 'appointment', '2024-12-11', '12:00 PM - 1:00 PM', '2024-12-13 07:54:47', 'completed'),
(7, 'Alexandra L. Vosotros', 'alexandralaurora@gmail.com', '+63 954 667 7989', 10, 'appointment', '2024-12-11', '12:00 PM - 1:00 PM', '2024-12-13 07:56:08', 'completed'),
(8, 'Zarah C. Dela Cruz', 'zdelacruz@gmail.com', '+63 959 598 9566', 9, 'walkIn', '2024-12-19', '3:00 PM - 4:00 PM', '2024-12-13 08:00:08', 'cancelled'),
(9, 'Zarah Dela Cruz', 'zdelacruzbscs@gmail.com', '+63 954 654 655', 10, 'appointment', '2024-12-18', '9:00 AM - 10:00 AM', '2024-12-13 08:02:06', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_tbl`
--

CREATE TABLE `invoice_tbl` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `inv` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(250) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_tbl`
--

INSERT INTO `invoice_tbl` (`id`, `client_id`, `inv`, `price`, `added_on`, `status`) VALUES
(1, 2, '120324-0002', '100.00', '2024-12-03 10:40:02', 'active'),
(2, 5, '121324-0005', '100.00', '2024-12-12 17:30:38', 'active'),
(3, 2, '121324-0002', '100.00', '2024-12-12 17:32:57', 'active'),
(4, 2, '121324-0002', '100.00', '2024-12-12 17:33:01', 'active'),
(5, 2, '121324-0002', '100.00', '2024-12-12 17:33:02', 'active'),
(6, 7, '121324-0007', '199.00', '2024-12-13 07:58:31', 'active'),
(7, 6, '121324-0006', '200.00', '2024-12-13 07:58:49', 'active'),
(8, 9, '121324-0009', '199.00', '2024-12-13 08:02:50', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `services_tbl`
--

CREATE TABLE `services_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `added_by` varchar(250) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(250) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services_tbl`
--

INSERT INTO `services_tbl` (`id`, `name`, `price`, `added_by`, `added_on`, `status`) VALUES
(1, 'Full-Body Massage', '1200.00', '', '2024-11-29 17:43:50', 'deactive'),
(2, 'Deluxe Manicure', '800.00', '', '2024-11-29 17:43:50', 'deactive'),
(3, 'Basic Pedicure', '600.00', '', '2024-11-29 17:43:50', 'deactive'),
(4, 'Aromatherapy Massage', '1500.00', '', '2024-11-29 17:43:50', 'deactive'),
(5, 'Hot Stone Massage', '1800.00', '', '2024-11-29 17:43:50', 'deactive'),
(6, 'Swedish Massage', '1300.00', '', '2024-11-29 17:43:50', 'deactive'),
(7, 'Deep Tissue Massage', '1600.00', '', '2024-11-29 17:43:50', 'deactive'),
(8, 'Facial Treatment', '2000.00', '', '2024-11-29 17:43:50', 'deactive'),
(9, 'Back and Shoulder Massage', '900.00', '', '2024-11-29 17:43:50', 'deactive'),
(10, 'Foot Reflexology', '700.00', '', '2024-11-29 17:43:50', 'deactive'),
(11, 'Body Scrub', '1100.00', '', '2024-11-29 17:43:50', 'deactive'),
(12, 'Couples Massage', '2500.00', '', '2024-11-29 17:43:50', 'deactive'),
(13, 'Scalp Massage', '500.00', '', '2024-11-29 17:43:50', 'deactive'),
(14, 'Anti-Aging Facial', '2200.00', '', '2024-11-29 17:43:50', 'deactive'),
(15, 'Skin Rejuvenation Therapy', '2500.00', '', '2024-11-29 17:43:50', 'deactive'),
(16, 'Prenatal Massage', '1400.00', '', '2024-11-29 17:43:50', 'deactive'),
(17, 'Waxing (Full Legs)', '1000.00', '', '2024-11-29 17:43:50', 'deactive'),
(18, 'Hand Paraffin Treatment', '600.00', '', '2024-11-29 17:43:50', 'deactive'),
(19, 'Foot Paraffin Treatment', '700.00', '', '2024-11-29 17:43:50', 'deactive'),
(20, 'Lymphatic Drainage Massage', '1700.00', '', '2024-11-29 17:43:50', 'deactive'),
(21, 'Acne Treatment Facial', '1900.00', '', '2024-11-29 17:43:50', 'deactive'),
(22, 'Signature Spa Package', '3000.00', '', '2024-11-29 17:43:50', 'deactive'),
(23, 'Head-to-Toe Pampering', '3500.00', '', '2024-11-29 17:43:50', 'deactive'),
(24, 'Detoxifying Body Wrap', '2000.00', '', '2024-11-29 17:43:50', 'deactive'),
(25, 'Rejuvenating Eye Treatment', '500.00', '', '2024-11-29 17:43:50', 'deactive'),
(26, 'test', '1231.23', '', '2024-12-02 13:30:21', 'deactive'),
(27, 'test', '213', '', '2024-12-02 13:30:36', 'deactive'),
(28, 'Ear Candling', '200.00', '', '2024-12-03 09:11:32', 'deactive'),
(29, 'Ear Candling', '100.00', '', '2024-12-03 10:37:32', 'deactive'),
(30, 'Ear Candling', '199.00', '', '2024-12-13 07:49:42', 'active'),
(31, 'Ear Candling', '199.00', '', '2024-12-13 07:49:57', 'active'),
(32, 'Massage', '200.00', '', '2024-12-13 07:50:19', 'active'),
(33, 'Foot Massage', '300.00', '', '2024-12-13 07:50:47', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `staff_tbl`
--

CREATE TABLE `staff_tbl` (
  `id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(250) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff_tbl`
--

INSERT INTO `staff_tbl` (`id`, `fullname`, `added_on`, `status`) VALUES
(1, 'Lorenzo Santos', '2024-11-30 01:21:07', 'active'),
(2, 'Ana Mendoza', '2024-11-30 01:21:07', 'active'),
(3, 'Carlos Reyes', '2024-11-30 01:21:07', 'active'),
(4, 'Marites Garcia', '2024-11-30 01:21:07', 'active'),
(5, 'Daniela Cruz', '2024-11-30 01:21:07', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_service`
--
ALTER TABLE `client_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_tbl`
--
ALTER TABLE `client_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_tbl`
--
ALTER TABLE `invoice_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services_tbl`
--
ALTER TABLE `services_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `client_service`
--
ALTER TABLE `client_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client_tbl`
--
ALTER TABLE `client_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `invoice_tbl`
--
ALTER TABLE `invoice_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services_tbl`
--
ALTER TABLE `services_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `staff_tbl`
--
ALTER TABLE `staff_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
