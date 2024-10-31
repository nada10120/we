-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 08:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `we-tournament`
--

-- --------------------------------------------------------

--
-- Table structure for table `participates`
--

CREATE TABLE `participates` (
  `id` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `username` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created_at` date NOT NULL,
  `tournament_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participates`
--

INSERT INTO `participates` (`id`, `points`, `username`, `created_at`, `tournament_id`) VALUES
(10, 3, 'Ahmed Mohamed', '2024-09-17', 1),
(11, 3, 'Ahmed Mohamed', '2024-09-17', 2),
(12, 3, 'Ali Saad', '2024-09-17', 2),
(13, 3, 'Test', '2024-09-17', 2),
(14, 3, 'DDD', '2024-09-17', 2),
(15, 2, 'Ahmed', '2024-09-18', 2),
(16, 3, 'Ahmed Mohamed', '2024-09-18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `questions_list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`questions_list`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `tournament_id`, `questions_list`) VALUES
(1, 1, '[\n  {\n    \"question\": \"What does HTTP stand for?\",\n    \"options\": [\n      \"HyperText Transfer Protocol\",\n      \"HighText Transfer Protocol\",\n      \"HyperText Transmission Protocol\",\n      \"HighText Transmission Protocol\"\n    ],\n    \"answer\": \"HyperText Transfer Protocol\"\n  },\n  {\n    \"question\": \"Which programming language is known for its use in web development and is also used for server-side scripting?\",\n    \"options\": [\"Python\", \"JavaScript\", \"Java\", \"C#\"],\n    \"answer\": \"JavaScript\"\n  },\n  {\n    \"question\": \"What is the primary function of an operating system?\",\n    \"options\": [\n      \"Manage hardware resources\",\n      \"Run applications\",\n      \"Store data\",\n      \"Connect to the internet\"\n    ],\n    \"answer\": \"Manage hardware resources\"\n  },\n  {\n    \"question\": \"In the context of databases, what does SQL stand for?\",\n    \"options\": [\n      \"Structured Query Language\",\n      \"Structured Quick Language\",\n      \"Simple Query Language\",\n      \"Standard Query Language\"\n    ],\n    \"answer\": \"Structured Query Language\"\n  }\n]\n'),
(2, 2, '[\r\n  {\r\n    \"question\": \"What does FIFA stand for?\",\r\n    \"options\": [\r\n      \"Fédération Internationale de Football Association\",\r\n      \"Federation of International Football Associations\",\r\n      \"Football International Federation Association\",\r\n      \"Federal International Football Association\"\r\n    ],\r\n    \"answer\": \"Fédération Internationale de Football Association\"\r\n  },\r\n  {\r\n    \"question\": \"Which sport is known as the \'king of sports\'?\",\r\n    \"options\": [\"Basketball\", \"Football\", \"Tennis\", \"Cricket\"],\r\n    \"answer\": \"Football\"\r\n  },\r\n  {\r\n    \"question\": \"What is the main objective of a soccer game?\",\r\n    \"options\": [\r\n      \"To score more goals than the opponent\",\r\n      \"To control the most possession\",\r\n      \"To have the most shots on target\",\r\n      \"To have more corner kicks\"\r\n    ],\r\n    \"answer\": \"To score more goals than the opponent\"\r\n  },\r\n  {\r\n    \"question\": \"In which country did the Olympic Games originate?\",\r\n    \"options\": [\r\n      \"Greece\",\r\n      \"Italy\",\r\n      \"Egypt\",\r\n      \"China\"\r\n    ],\r\n    \"answer\": \"Greece\"\r\n  }\r\n]\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `spaces_left` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`id`, `title`, `spaces_left`) VALUES
(1, 'IT Tournament', 0),
(2, 'Sports Tournament', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `participates`
--
ALTER TABLE `participates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournament_participates` (`tournament_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tournamen_questions` (`tournament_id`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `participates`
--
ALTER TABLE `participates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `participates`
--
ALTER TABLE `participates`
  ADD CONSTRAINT `tournament_participates` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `tournamen_questions` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
