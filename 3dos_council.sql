-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2026 at 10:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `3dos_council`
--

-- --------------------------------------------------------

--
-- Table structure for table `councils`
--

CREATE TABLE `councils` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `councils`
--

INSERT INTO `councils` (`id`, `name`) VALUES
(1, 'backend'),
(2, 'frontend');

-- --------------------------------------------------------

--
-- Table structure for table `delegate_title`
--

CREATE TABLE `delegate_title` (
  `user_id` int(11) NOT NULL,
  `title_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `rating` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `session_date` datetime NOT NULL,
  `council_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `submission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `submission_time` datetime NOT NULL,
  `uploads` text DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`submission_id`, `user_id`, `task_id`, `submission_time`, `uploads`, `is_deleted`) VALUES
(1, 2, 1, '2026-06-23 14:30:00', 'https://github.com/sarajohn/workshop-nav-bar', 0),
(2, 3, 1, '2026-06-24 21:15:45', 'https://github.com/omersherif/navbar-css-solution', 0),
(3, 2, 2, '2026-06-29 10:05:00', 'https://github.com/sarajohn/php-form-handling', 0),
(4, 4, 2, '2026-07-01 23:45:12', 'https://github.com/malakhassan/php-validation-task', 0),
(5, 3, 3, '2026-07-05 16:20:00', 'https://github.com/omersherif/dynamic-filtering-api', 0),
(6, 4, 1, '2026-06-22 11:00:00', 'https://github.com/malakhassan/old-broken-navbar', 1),
(7, 2, 3, '2026-06-17 16:35:00', 'https://github.com/sarajohn/dynamic-filtering-api', 0),
(8, 2, 1, '2026-06-11 16:35:00', 'https://github.com/sarajohn/dynamic-filtering-api', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `deadline` datetime NOT NULL,
  `assignedby` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `title`, `description`, `deadline`, `assignedby`, `is_deleted`) VALUES
(1, 'Task 1: Build a Responsive Navigation Bar', 'Frontend Basics: Create a clean navigation bar using HTML and CSS. It must toggle into a hamburger menu on screens smaller than 768px. Do not use any external frameworks like Bootstrap.', '2026-06-24 23:59:59', 1, 0),
(2, 'Task 2: Handle Form Submission with PHP', 'Backend Basics: Create a simple contact form. Write a PHP script that validates the input data using $_POST, checks for valid email formats, and echoes a success message.', '2026-07-01 23:59:59', 1, 0),
(3, 'Task 3: Dynamic Task Filtering Logic', 'Intermediate Backend: Modify your GET endpoint to build a dynamic SQL query. Allow users to filter tasks by multiple optional query parameters like status or deadline without repeating code.', '2026-07-08 23:59:59', 1, 1),
(4, 'Task 4: Connect Frontend to an API via Fetch', 'Fullstack Integration: Use JavaScript Fetch API to send a GET request to your backend tasks endpoint. Dynamically render the returned JSON data into HTML cards on your page.', '2026-07-15 23:59:59', 1, 0),
(5, 'Old Practice: Static HTML Sandbox', 'Archived Exercise: This was an introductory practice file for basic HTML tags. It is no longer part of the main grading track, keeping it as a soft-deleted reference.', '2026-06-01 12:00:00', 5, 1),
(6, 'Task 6: Build a RESTful API Endpoint', 'Backend Basics: Create a POST endpoint using PHP to handle incoming JSON payloads. Validate the fields and return a 201 Created status code on success.', '2026-06-28 23:59:59', 1, 0),
(18, 'Updated Workshop Task Name', 'Backend Basics: Create a PATCH endpoint using PHP. Validate the fields and return a suitable status code.', '2026-07-20 18:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `title_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `council_id` int(11) NOT NULL,
  `role` enum('admin','delegates') NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `council_id`, `role`, `is_deleted`) VALUES
(1, 'Ahmed Ali', 'ahmed.admin@workshop.com', '$2y$10$e0MYzXyZ...hashedpassword...', 1, 'admin', 0),
(2, 'Sara John', 'sara.j@delegates.com', '$2y$10$f1NZaWzA...hashedpassword...', 1, 'delegates', 0),
(3, 'Omar Sherif', 'omar.s@delegates.com', '$2y$10$g2OAbXyB...hashedpassword...', 2, 'delegates', 0),
(4, 'Malak Hassan', 'malak.h@delegates.com', '$2y$10$h3PMbWzC...hashedpassword...', 2, 'delegates', 0),
(5, 'Old Instructor', 'old.user@workshop.com', '$2y$10$i4QNcXyD...hashedpassword...', 1, 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `councils`
--
ALTER TABLE `councils`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delegate_title`
--
ALTER TABLE `delegate_title`
  ADD PRIMARY KEY (`user_id`,`title_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `fk_feedback_submission` (`submission_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_materials_session` (`session_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sessions_council` (`council_id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `fk_submissions_user` (`user_id`),
  ADD KEY `fk_submissions_task` (`task_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `fk_instructor_id` (`assignedby`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_council_id` (`council_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `councils`
--
ALTER TABLE `councils`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_submission` FOREIGN KEY (`submission_id`) REFERENCES `submissions` (`submission_id`);

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `fk_materials_session` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`);

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `fk_sessions_council` FOREIGN KEY (`council_id`) REFERENCES `councils` (`id`);

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `fk_submissions_task` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`),
  ADD CONSTRAINT `fk_submissions_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_instructor_id` FOREIGN KEY (`assignedby`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_council_id` FOREIGN KEY (`council_id`) REFERENCES `councils` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
