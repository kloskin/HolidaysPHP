-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 16, 2023 at 08:43 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DbHolidays`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accepted_vacation`
--

CREATE TABLE `accepted_vacation` (
  `accepted_id` int(11) NOT NULL,
  `accepted_start_event_date` date DEFAULT NULL,
  `accepted_end_event_date` date DEFAULT NULL,
  `accepted_description` longtext DEFAULT NULL,
  `accepted_users_id` int(11) NOT NULL,
  `accepted_users_email` tinytext DEFAULT NULL,
  `accepted_users_fullname` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accepted_vacation`
--

INSERT INTO `accepted_vacation` (`accepted_id`, `accepted_start_event_date`, `accepted_end_event_date`, `accepted_description`, `accepted_users_id`, `accepted_users_email`, `accepted_users_fullname`) VALUES
(1, '2023-06-14', '2023-06-16', 'asdas', 0, 'admin@admin.com', 'Jacek Wielki'),
(3, '2023-06-15', '2023-06-17', 'dfasaas asrarsa', 1, 'admin@admin.com', 'admin admin'),
(4, '2023-06-15', '2023-06-16', 'asda', 1, 'admin@admin.com', 'admin admin'),
(5, '2023-06-17', '2023-06-21', 'bardzo bym chciał :)', 2, 'filip@filip.com', 'Filip Essacz'),
(6, '2023-06-17', '2023-06-26', 'lol', 7, 'admin@admin.com', 'admin admin'),
(7, '2023-06-14', '2023-06-15', '', 7, 'admin@admin.com', 'admin admin'),
(8, '2023-06-27', '0000-00-00', '', 7, 'admin@admin.com', 'admin admin'),
(9, '2023-06-17', '2023-06-28', '', 7, 'admin@admin.com', 'admin admin'),
(10, '2023-07-08', '2023-07-18', 'plis', 7, 'admin@admin.com', 'admin admin'),
(11, '2023-06-15', '2023-06-29', 'Pozdro', 2, 'filip@filip.com', 'Filip Essacz'),
(12, '2023-06-16', '2023-06-19', 'asdas', 7, 'admin@admin.com', 'admin admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `request_vacation`
--

CREATE TABLE `request_vacation` (
  `request_id` int(11) NOT NULL,
  `request_start_event_date` date DEFAULT NULL,
  `request_end_event_date` date DEFAULT NULL,
  `request_description` longtext DEFAULT NULL,
  `request_users_id` int(11) NOT NULL,
  `request_users_email` tinytext DEFAULT NULL,
  `request_users_fullname` text DEFAULT NULL,
  `request_status` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_vacation`
--

INSERT INTO `request_vacation` (`request_id`, `request_start_event_date`, `request_end_event_date`, `request_description`, `request_users_id`, `request_users_email`, `request_users_fullname`, `request_status`) VALUES
(0, '2023-06-15', '2023-06-30', 'ws', 1, 'admin@admin.com', 'adminss1 admin', 'reject'),
(1, '2023-06-14', '2023-06-16', 'asdas', 1, 'admin@admin.com', 'admin admin', 'accept'),
(2, '2023-06-15', '2023-06-17', 'dfasaas asrarsa', 1, 'admin@admin.com', 'admin admin', 'accept'),
(3, '2023-06-15', '2023-06-16', 'asda', 1, 'admin@admin.com', 'admin admin', 'accept'),
(4, '2023-06-17', '2023-06-21', 'bardzo bym chciał :)', 2, 'filip@filip.com', 'Filip Essacz', 'accept'),
(6, '2023-06-15', '2023-06-27', 'sss', 2, 'filip@filip.com', 'Filip Essacz', 'reject'),
(7, '2023-06-15', '2023-06-21', 'asdsa', 1, 'admin@admin.com', 'adminss1 admin', 'reject'),
(8, '2023-06-17', '2023-06-26', 'lol', 7, 'admin@admin.com', 'admin admin', 'accept'),
(9, '2023-06-14', '2023-06-15', '', 7, 'admin@admin.com', 'admin admin', 'accept'),
(10, '2023-06-27', '2023-06-29', '', 7, 'admin@admin.com', 'admin admin', 'accept'),
(11, '2023-06-17', '2023-06-27', '', 7, 'admin@admin.com', 'admin admin', 'accept'),
(12, '2023-07-08', '2023-07-17', 'plis', 7, 'admin@admin.com', 'admin admin', 'accept'),
(14, '2023-06-15', '2023-06-28', 'Pozdro', 2, 'filip@filip.com', 'Filip Essacz', 'accept'),
(15, '2023-06-16', '2023-06-18', 'asdas', 7, 'admin@admin.com', 'admin admin', 'accept'),
(16, '2023-06-17', '2023-06-30', 'jj', 7, 'admin@admin.com', 'admin admin', 'reject');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_name` tinytext NOT NULL,
  `users_surename` tinytext NOT NULL,
  `users_pwd` longtext NOT NULL,
  `users_email` tinytext NOT NULL,
  `users_role` text NOT NULL,
  `users_pesel` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_name`, `users_surename`, `users_pwd`, `users_email`, `users_role`, `users_pesel`) VALUES
(2, 'Filipss', 'Essacz', '$2y$10$0WcDhr6jCKlqgsD1Qh/i1OwTeDc8DuVhpxrXFhvDpHY.Q331gLnQ2', 'filip@filip.com', 'pracownik', 12345678901),
(7, 'admin', 'admin', '$2y$10$oHUey7WpA7Bjewxc4eMJv.1A8XtfV6qpYg4yiVLkPgL4rfX59ehdu', 'admin@admin.com', 'admin', 2147483647),
(8, 'Filip', 'Kloska', '$2y$10$w5FHlezLufplXrQhOzQMrOClDULu6.iYEyCDQw5hSYjFCFqvd7OEy', 'fkloska1@gmail.com', 'pracownik', 2147483647),
(9, 'giga', 'gigus', '$2y$10$pxc4aDSFzsKL8Qe6ugl3PepCuEbswKE/ZwhikUiQg5OzAUoRDcEoy', 'giga@giga.com', 'pracownik', 12345678901);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accepted_vacation`
--
ALTER TABLE `accepted_vacation`
  ADD PRIMARY KEY (`accepted_id`);

--
-- Indeksy dla tabeli `request_vacation`
--
ALTER TABLE `request_vacation`
  ADD PRIMARY KEY (`request_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accepted_vacation`
--
ALTER TABLE `accepted_vacation`
  MODIFY `accepted_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `request_vacation`
--
ALTER TABLE `request_vacation`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
