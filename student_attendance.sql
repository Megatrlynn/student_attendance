-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2024 at 05:36 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `institution_id` int(11) DEFAULT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `course_code` varchar(50) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `institution_id`, `course_name`, `course_code`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'MEDIA TECHNOLOGY', 'IRC2000MT', 'Admin', '2024-03-04 13:48:03', '2024-03-04 13:48:03'),
(2, 4, 'DIGITAL MARKETING', 'IRC2000DM', 'Admin', '2024-03-04 13:48:21', '2024-03-04 13:48:21'),
(3, 3, 'TOURISM MANAGEMENT', 'IRC2000TM', 'Admin', '2024-03-04 13:48:33', '2024-03-04 13:48:33'),
(4, 2, 'DATA STRUCTURES AND ALGORITHMS', 'IRC2000DSA', 'Admin', '2024-03-04 13:49:08', '2024-03-04 13:49:08'),
(5, 1, 'SYSTEM ANALYSIS', 'IRC2000SYS-A', 'Admin', '2024-03-05 06:08:05', '2024-03-05 06:08:05'),
(6, 4, 'DATABASE MANAGEMENT', 'IRC2000DTM', 'Admin', '2024-03-05 06:08:31', '2024-03-05 06:08:31');

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `physical_codes` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`id`, `name`, `physical_codes`, `email`, `phone`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'IPRC Kigali', 'Kigali, H25KKL', 'info@iprckigali.rp.ac.rw', '0782582857', 'Admin', '2024-03-04 13:39:22', '2024-03-04 13:39:22'),
(2, 'IPRC Tumba', 'KK 14 Rd, Tumba', 'info@iprctumba.rp.ac.rw', '0782582858', 'Admin', '2024-03-04 13:40:40', '2024-03-04 13:40:40'),
(3, 'IPRC Kitabi', 'KK 16 Rd, Kitabi', 'info@iprckitabi.rp.ac.rw', '0782582859', 'Admin', '2024-03-04 13:41:13', '2024-03-04 13:41:13'),
(4, 'IPRC Musanze', 'KK 12 Rd, Musanze', 'info@iprcmusanze.rp.ac.rw', '0782582860', 'Admin', '2024-03-04 13:41:55', '2024-03-07 09:37:09');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `institution_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `institution_id`, `name`, `phone`, `email`, `users_id`, `role_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'MIHIGO Leandre', '0782582861', 'leandre@iprckigali.rp.ac.rw', 2, 2, 'Admin', '2024-03-04 13:42:39', '2024-03-04 13:42:39'),
(2, 3, 'IZERE Adam', '0782582862', 'adam@iprckitabi.rp.ac.rw', 3, 2, 'Admin', '2024-03-04 13:44:12', '2024-03-04 13:44:12'),
(3, 4, 'KAINERUGABA Ajall', '0782582863', 'ajall@iprcmusanze.rp.ac.rw', 4, 2, 'Admin', '2024-03-04 13:44:50', '2024-03-04 13:44:50'),
(4, 2, 'BUGINGO Nashim', '0782582864', 'nashim@iprctumba.rp.ac.rw', 5, 2, 'Admin', '2024-03-04 13:45:23', '2024-03-04 13:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_course`
--

CREATE TABLE `lecturer_course` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `lecturer_id` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_course`
--

INSERT INTO `lecturer_course` (`id`, `course_id`, `lecturer_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Admin', '2024-03-04 13:50:02', '2024-03-04 13:50:02'),
(2, 2, 3, 'Admin', '2024-03-04 13:50:26', '2024-03-04 13:50:26'),
(3, 3, 2, 'Admin', '2024-03-04 13:50:42', '2024-03-04 13:50:42'),
(4, 4, 4, 'Admin', '2024-03-04 13:50:55', '2024-03-04 13:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'student', 'Admin', '2024-02-24 11:31:20', '2024-02-24 11:31:20'),
(2, 'lecturer', 'Admin', '2024-02-24 11:39:00', '2024-02-24 11:39:00'),
(3, 'admin', 'Self', '2024-02-24 11:39:00', '2024-02-24 11:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `institution_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `reg_no` varchar(50) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `institution_id`, `name`, `users_id`, `reg_no`, `role_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'UMUTONIWASE Florence', 6, '21RP06925', 1, 'Admin', '2024-03-04 13:45:52', '2024-03-04 13:45:52'),
(2, 3, 'UWASE Bhem', 7, '21RP06926', 1, 'Admin', '2024-03-04 13:46:15', '2024-03-04 13:46:15'),
(3, 4, 'KWIBUKA Jean Paul', 8, '21RP06927', 1, 'Admin', '2024-03-04 13:46:47', '2024-03-04 13:46:47'),
(4, 2, 'BUKURU Janvier', 9, '21RP06928', 1, 'Admin', '2024-03-04 13:47:45', '2024-03-04 13:47:45'),
(5, 1, 'HABIMANA Daniel', 10, '21RP033112', 1, 'Admin', '2024-03-05 10:26:04', '2024-03-05 10:26:04'),
(6, 1, 'GABRIOLA Kashmir', 11, '21RP03425', 1, 'Self', '2024-03-06 16:04:40', '2024-03-08 11:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `attendance` varchar(50) DEFAULT NULL,
  `lecturer_id` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`id`, `course_id`, `student_id`, `date`, `attendance`, `lecturer_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-03-04', 'attended', 1, 'MIHIGO Leandre', '2024-03-04 13:52:56', '2024-03-04 13:52:56'),
(2, 1, 1, '2024-03-05', 'not attended', 1, 'MIHIGO Leandre', '2024-03-05 05:39:40', '2024-03-05 05:39:40'),
(4, 4, 4, '2024-03-05', 'attended', 4, 'BUGINGO Nashim', '2024-03-05 10:28:38', '2024-03-05 10:28:38'),
(5, 4, 5, '2024-03-05', 'not attended', 4, 'BUGINGO Nashim', '2024-03-05 10:28:58', '2024-03-05 10:28:58'),
(6, 1, 5, '2024-03-05', 'not attended', 1, 'MIHIGO Leandre', '2024-03-05 18:52:32', '2024-03-05 18:52:32'),
(7, 1, 1, '2024-03-06', 'attended', 1, 'MIHIGO Leandre', '2024-03-06 08:47:09', '2024-03-06 08:47:09'),
(8, 1, 5, '2024-03-06', 'not attended', 1, 'MIHIGO Leandre', '2024-03-06 08:47:09', '2024-03-06 08:47:09'),
(9, 1, 1, '2024-03-07', 'attended', 1, 'MIHIGO Leandre', '2024-03-07 09:39:00', '2024-03-07 09:39:00'),
(11, 3, 2, '2024-03-07', 'attended', 2, 'IZERE Adam', '2024-03-07 15:19:14', '2024-03-07 15:19:14'),
(12, 1, 5, '2024-03-08', 'attended', 1, 'MIHIGO Leandre', '2024-03-08 09:05:16', '2024-03-08 09:05:16'),
(13, 1, 1, '2024-03-08', 'not attended', 1, 'MIHIGO Leandre', '2024-03-08 09:05:30', '2024-03-08 09:05:30'),
(14, 1, 5, '2024-03-04', 'attended', 1, 'MIHIGO Leandre', '2024-03-08 10:22:27', '2024-03-08 10:22:27'),
(15, 1, 5, '2024-03-07', 'not attended', 1, 'MIHIGO Leandre', '2024-03-08 10:23:35', '2024-03-08 10:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`id`, `course_id`, `student_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Admin', '2024-03-04 13:51:14', '2024-03-04 13:51:14'),
(2, 3, 2, 'Admin', '2024-03-04 13:51:21', '2024-03-04 13:51:21'),
(3, 2, 3, 'Admin', '2024-03-04 13:51:27', '2024-03-04 13:51:27'),
(4, 4, 4, 'Admin', '2024-03-04 13:51:34', '2024-03-04 13:51:34'),
(5, 1, 5, 'Admin', '2024-03-05 10:26:48', '2024-03-05 10:26:48'),
(6, 4, 5, 'Admin', '2024-03-05 10:27:28', '2024-03-05 10:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `username`, `password`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 3, 'megatrlynn', '$2y$10$.XLrbbMMcKJNsVTVY6/zkezt0mhYSlvfaqp8JSpm32TsvlYGzV/ti', 'Self', '2024-02-22 14:14:05', '2024-03-06 16:09:13'),
(2, 2, 'leandre', '$2y$10$/dO5xGV.07cBGcD0rft0S.kRXZ1RLeayCgPBbWv/TxWblCPmfhlUu', 'Admin', '2024-03-04 13:42:39', '2024-03-06 16:17:28'),
(3, 2, 'adam', '$2y$10$cPTdMIU7zpCosyMN8FyNo.ff9IB5hMTI8aNjCNNcoTSNwQshsLhOe', 'Admin', '2024-03-04 13:44:12', '2024-03-06 16:17:36'),
(4, 2, 'ajall', '$2y$10$t05S9OiyHlrbSdnfIMTvU.cfKqy6tm6e0rV8oLXFM/dlVYaBJahHW', 'Admin', '2024-03-04 13:44:50', '2024-03-06 16:17:47'),
(5, 2, 'nashim', '$2y$10$kqG/2uNCbVyCKn.Y3qWcoOTNLfE5GMHelu99PWucn7H3coX7hff22', 'Admin', '2024-03-04 13:45:23', '2024-03-06 16:17:58'),
(6, 1, 'fofo', '$2y$10$D/ZaJVrS4BHtdy/5a1vJierYvuEYjaqHQk6P4fVl7PFcWkP8418Ji', 'Admin', '2024-03-04 13:45:52', '2024-03-06 16:16:08'),
(7, 1, 'bhem', '$2y$10$fPAbDLYOlt4iA7YGIfEYLuG1UgOgR.RMun6xSMn9iecuz4qtKbq7a', 'Admin', '2024-03-04 13:46:15', '2024-03-06 16:16:25'),
(8, 1, 'paul', '$2y$10$RswaUQqRhblLOLkIchLDS.GgsoTutFkMhataeDS/suoNFu/yA8N5u', 'Admin', '2024-03-04 13:46:47', '2024-03-06 16:16:35'),
(9, 1, 'bukuru', '$2y$10$bBe/q9EmWtVEHheIYHwgQuTOai5hCE0NJ9ZwIjeO3ykawwxNVdVT2', 'Admin', '2024-03-04 13:47:45', '2024-03-06 16:16:43'),
(10, 1, 'dany', '$2y$10$CIhQdJmR.tz5N.ZFb3m2MOJHD6UBNX/fVDokl88CPhIHKJ81MA5Wu', 'Admin', '2024-03-05 10:26:04', '2024-03-06 16:16:59'),
(11, 1, 'kashmir', '$2y$10$QGpDdMf.XIJ4YRatPf/jVeJGu3cmx8bq6CRn3N0HocvtH5Y2f1p7S', 'Self', '2024-03-06 16:04:40', '2024-03-08 11:58:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_course_name` (`course_name`),
  ADD UNIQUE KEY `unique_course_code` (`course_code`),
  ADD KEY `institution_id` (`institution_id`);

--
-- Indexes for table `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_name` (`name`),
  ADD UNIQUE KEY `unique_physical_codes` (`physical_codes`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `unique_phone` (`phone`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_phone` (`phone`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD KEY `institution_id` (`institution_id`),
  ADD KEY `users_id` (`users_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `lecturer_course`
--
ALTER TABLE `lecturer_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_reg_no` (`reg_no`),
  ADD KEY `institution_id` (`institution_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `username` (`users_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_name` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lecturer_course`
--
ALTER TABLE `lecturer_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student_course`
--
ALTER TABLE `student_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`id`),
  ADD CONSTRAINT `fk_institution_id` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD CONSTRAINT `fk_institution_id_2` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lecturers_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`id`),
  ADD CONSTRAINT `lecturers_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `lecturers_ibfk_3` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `lecturer_course`
--
ALTER TABLE `lecturer_course`
  ADD CONSTRAINT `fk_course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_lecturer_id` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lecturer_course_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `lecturer_course_ibfk_2` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_institution_id_3` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD CONSTRAINT `fk_course_id_3` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_attendance_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `student_attendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `student_attendance_ibfk_3` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`);

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `fk_course_id_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_course_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `student_course_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
