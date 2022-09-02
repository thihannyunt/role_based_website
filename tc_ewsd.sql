-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2022 at 08:57 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tc_ewsd`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `academic_id` int(5) NOT NULL,
  `start_date` date NOT NULL,
  `closure_date` date NOT NULL,
  `final_closure_date` date NOT NULL,
  `academic_year_name` varchar(30) NOT NULL,
  `action` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`academic_id`, `start_date`, `closure_date`, `final_closure_date`, `academic_year_name`, `action`) VALUES
(27, '2022-02-01', '2022-03-30', '2022-04-15', '2022 Academic Year', 'active'),
(28, '2022-01-01', '2022-01-15', '2022-01-30', 'Testing for final closure date', ''),
(29, '2022-01-01', '2022-02-15', '2022-03-15', 'Testing for closure date', ''),
(30, '2023-01-01', '2024-01-01', '2025-01-01', 'Testing for start date', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(13, 'Staff remove'),
(14, 'Annoying Staff'),
(15, 'Cleaning'),
(16, 'General Advice');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(5) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_checkbox` varchar(30) NOT NULL,
  `user_id` int(5) NOT NULL,
  `idea_id` int(5) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `comment_checkbox`, `user_id`, `idea_id`, `comment_date`) VALUES
(53, 'oh nice idea', 'anonymous', 6, 39, '2022-02-28'),
(54, 'but i dont like it xD\r\n', '', 6, 39, '2022-02-28'),
(55, 'Thanks you', 'anonymous', 1, 51, '2022-03-01'),
(56, 'I mark this in my memory', '', 1, 51, '2022-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(5) NOT NULL,
  `dept_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(1, 'HR Department'),
(2, 'Art Department'),
(3, 'Mechanical Department'),
(4, 'Medical Department'),
(5, 'Computing Department');

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE `ideas` (
  `idea_id` int(5) NOT NULL,
  `idea_checkbox` varchar(50) NOT NULL,
  `idea_content` text NOT NULL,
  `idea_attachment` varchar(255) NOT NULL,
  `user_id` int(5) NOT NULL,
  `category_id` int(5) NOT NULL,
  `academic_id` int(5) NOT NULL,
  `idea_date` date NOT NULL,
  `idea_likes` int(11) NOT NULL,
  `idea_dislikes` int(11) NOT NULL,
  `idea_comment_count` int(11) NOT NULL,
  `idea_view_count` int(11) NOT NULL,
  `dept_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`idea_id`, `idea_checkbox`, `idea_content`, `idea_attachment`, `user_id`, `category_id`, `academic_id`, `idea_date`, `idea_likes`, `idea_dislikes`, `idea_comment_count`, `idea_view_count`, `dept_id`) VALUES
(39, '', 'Cleaning every week will help avoid allergies or other breathing problems. Avoid spreading germs: Keeping your house clean will stop the spread of germs and help keep you healthy. Cleaning up spills, vacuuming your carpets, and keeping your kitchen and bathroom clean will kill germs.', 'a.jpg', 1, 15, 27, '2022-02-28', 1, 0, 3, 121, 1),
(40, 'anonymous', 'General advice\' is financial product advice that is prepared without considering a consumer\'s personal circumstances such as their objectives, financial situation and needs', 'gener-advice1.jpg', 1, 15, 27, '2022-02-28', 0, 1, 0, 4, 1),
(51, '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'testing.jpg', 1, 14, 27, '2022-02-28', 0, 1, 2, 3, 1),
(52, 'anonymous', 'Testing 123Testing 123Testing 123Testing 123Testing 123Testing 123Testing 123Testing 123Testing 123Testing 123Testing 123', 'testing.jpg', 1, 16, 27, '2022-02-28', 1, 0, 0, 5, 1),
(53, '', 'Financial advice must only be provided by qualified and licensed financial advisers or financial counsellors, not by individuals or corporations who neither hold an AFS licence, nor are authorised representatives of an AFS licensee.', 'image-asset.jpeg', 4, 16, 27, '2022-03-01', 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating_info`
--

CREATE TABLE `rating_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `idea_id` int(11) NOT NULL,
  `rating` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating_info`
--

INSERT INTO `rating_info` (`id`, `user_id`, `idea_id`, `rating`) VALUES
(144, 1, 52, 'Like'),
(145, 1, 51, 'Dislike'),
(146, 1, 40, 'Dislike'),
(147, 1, 39, 'Like'),
(148, 4, 53, 'Like');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_type`) VALUES
(1, 'admin'),
(2, 'qa_manager'),
(7, 'qa_coordinator'),
(8, 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_dob` date NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `role_id` int(5) NOT NULL,
  `dept_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_dob`, `user_gender`, `user_phone`, `user_address`, `user_email`, `user_password`, `role_id`, `dept_id`) VALUES
(1, 'Khin', '2000-08-14', 'female', '09123', 'Mawlamyine', 'khin@gmail.com', '123', 1, 1),
(3, 'Thiri', '2000-08-25', 'female', '09123', 'Yangon', 'thiri@gmail.com', '123', 7, 2),
(4, 'Thi', '2000-10-27', 'male', '09123', 'Myeik', 'thn@gmail.com', '123', 2, 1),
(6, 'Kyaw', '2000-08-14', 'male', '09123', 'Yangon', 'kyaw@gmail.com', '123', 8, 3),
(24, 'nsywk', '2001-02-06', 'female', '123', 'Yangon', 'nsywk@gmail.com', '123', 7, 4),
(25, 'nan', '2001-02-06', 'female', '123', '123', 'nan@gmail.com', '123', 7, 3),
(26, 'thn123', '0001-01-01', 'male', '123', '123', 'thihannyunt80@gmail.com', '123', 8, 4),
(39, 'Nyunt', '2000-02-27', 'male', '123', 'Yangon', 'nyunt@gmail.com', '123', 7, 5),
(40, 'Hanabi', '0123-12-03', 'female', '123', 'japan', 'hanabi@gmail.com', '123', 7, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`academic_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `ideas`
--
ALTER TABLE `ideas`
  ADD PRIMARY KEY (`idea_id`);

--
-- Indexes for table `rating_info`
--
ALTER TABLE `rating_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `academic_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ideas`
--
ALTER TABLE `ideas`
  MODIFY `idea_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `rating_info`
--
ALTER TABLE `rating_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
