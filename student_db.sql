-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2020 at 02:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_ID` int(11) NOT NULL,
  `contact_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dietrestriction`
--

CREATE TABLE `dietrestriction` (
  `restriction_ID` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dietrestriction`
--

INSERT INTO `dietrestriction` (`restriction_ID`, `name`) VALUES
(1, 'Gluten Free'),
(2, 'Ketogenic'),
(3, 'Paleo'),
(4, 'Pescetarian'),
(5, 'Primal'),
(6, 'Vegan'),
(7, 'Vegetarian'),
(8, 'Whole30'),
(9, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `difficulties`
--

CREATE TABLE `difficulties` (
  `difficultyID` int(11) NOT NULL,
  `diffName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `difficulties`
--

INSERT INTO `difficulties` (`difficultyID`, `diffName`) VALUES
(1, 'Easy'),
(2, 'Medium'),
(3, 'Hard');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredient_ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `unit` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredient_ID`, `name`, `amount`, `unit`) VALUES
(22, 'Plain flour', 100, 'g'),
(23, 'Egg', 100, 'g'),
(24, 'milk', 300, 'ml'),
(25, 'Sunflower oil', 1, 'tsp'),
(26, 'Chicken', 455, 'g'),
(27, 'Broccoli', 150, 'g'),
(28, 'Green Pepper', 100, 'g'),
(29, 'Soy Sauce', 120, 'ml'),
(30, 'Garlic', 20, 'g'),
(31, 'Ginger', 1, 'tsp'),
(32, 'Sesame Seed', 1, 'tsp'),
(33, 'Extra-virgin olive o', 2, 'tbsp'),
(34, 'Onion', 120, 'g'),
(35, 'Chicken Breast', 800, 'g'),
(36, 'Cajun Seasoning', 2, 'tbsp');

-- --------------------------------------------------------

--
-- Table structure for table `intolerance`
--

CREATE TABLE `intolerance` (
  `intolerance_ID` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `intolerance`
--

INSERT INTO `intolerance` (`intolerance_ID`, `name`) VALUES
(1, 'Dairy'),
(2, 'Egg'),
(3, 'Gluten'),
(4, 'Grain'),
(5, 'Peanut'),
(6, 'Seafood'),
(7, 'Sesame'),
(8, 'Shellfish'),
(9, 'Soy'),
(10, 'Sulfite'),
(11, 'Tree Nut'),
(12, 'Wheat'),
(13, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `recipeingredient`
--

CREATE TABLE `recipeingredient` (
  `recipe_ID` int(11) NOT NULL,
  `ingredient_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipeingredient`
--

INSERT INTO `recipeingredient` (`recipe_ID`, `ingredient_ID`) VALUES
(24, 22),
(24, 23),
(24, 24),
(24, 25),
(25, 26),
(25, 27),
(25, 31),
(25, 30),
(25, 32),
(26, 35),
(26, 33),
(26, 34),
(26, 36),
(25, 29);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_name` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `servings` int(11) NOT NULL,
  `maxTime` time NOT NULL,
  `difficultyID` int(11) NOT NULL,
  `date_created` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `isFavourite` tinyint(1) NOT NULL,
  `favourited_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_ID`, `user_ID`, `name`, `image`, `video_name`, `rating`, `servings`, `maxTime`, `difficultyID`, `date_created`, `isFavourite`, `favourited_by`) VALUES
(24, 102, 'Pancakes', 'pancakes.jpg', NULL, NULL, 12, '00:20:00', 1, '2020-02-24 11:27:06.182677', 0, 0),
(25, 102, 'Chicken and Broccoli Stir Fry', 'chicken-and-broccoli-stir-fry.jpg', NULL, NULL, 2, '00:35:00', 2, '2020-02-24 11:27:14.118948', 0, 0),
(26, 102, 'Cajun Stuffed Chicken', 'cajun-stuffed-chicken.jpg', NULL, NULL, 4, '00:45:00', 3, '2020-02-24 11:27:22.300507', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `recipesteps`
--

CREATE TABLE `recipesteps` (
  `recipe_ID` int(11) NOT NULL,
  `steps_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipesteps`
--

INSERT INTO `recipesteps` (`recipe_ID`, `steps_ID`) VALUES
(26, 12),
(25, 11),
(24, 10);

-- --------------------------------------------------------

--
-- Table structure for table `steps`
--

CREATE TABLE `steps` (
  `steps_ID` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `steps`
--

INSERT INTO `steps` (`steps_ID`, `description`) VALUES
(10, '1. Add flour, eggs, milk and oil to a large bowl and whisk until a smooth batter is created. 2. Heat a medium sized frying pan or crêpe pan over a medium heat and add a drop off oil to it 3. Cook each pancake on each side for 1 min. 4. Serve.'),
(11, '1. Mix together all sauce ingredients in a bowl. 2. Heat oil over a nonstick pan and add chicken, stirring until cooked. 3. Pour sauce in a pan and stir to coat meat. 4. Once the sauce is bubbling, add the vegetables to the pan and stir again to coat. 5. Cook until meat is cooked through and vegetables are soft. 6. Serve over rice or alone.'),
(12, '1. Preheat oven to 350 degrees. Using a frying pan over a medium heat, add onions and peppers and cook until soft for 5 minutes. Season with salt and pepper and remove from heat to let it cool slightly. 2. With a sharp paring knife, create a pocket in each chicken breast. Stuff each with the vegetable mixture and then top with cheddar. Season the chicken all over with Cajun seasoning, salt and pepper. 3. Add chicken to the pan and bake until cooked through for about 25 minutes.  ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `u_type` tinyint(1) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `u_email` varchar(30) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `intolerance_ID` int(11) NOT NULL,
  `dietRestriction_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `u_type`, `fname`, `lname`, `u_email`, `u_password`, `intolerance_ID`, `dietRestriction_ID`) VALUES
(102, 0, 'Shauna', 'Goodman', 'shauna@dkit.ie', '$2y$10$ZHP2tg/08x1qqmUjbU4ZU.MdupaNng0.Hr1atPh0N7Bwi8iEm0mxm', 0, 0),
(105, 0, 'Simon', 'Smith', 'simonsmith@gmail.com', '$2y$10$V3mG0lP0.ohlCZVTRNlkJeZsszhIJKes3KvvxeWz8ePAX81EB2cmu', 0, 0),
(114, 0, 'Mary', 'Finnegan', 'maryfinnegan@iol.ie', '$2y$10$d7Znl8yogoPuTELlOk88W.f36/ThUqX4DgpCnwZNdfGV//KikDKwy', 0, 0),
(117, 0, 'Admin', '', 'adminstudentlife@gmail.com', 'StudentLife2020@', 0, 0),
(118, 0, 'Mateusz', 'Kowalski', 'matiorex5@gmail.com', 'Student123', 0, 0),
(122, 1, 'Mateusz', 'Kowalski', 'matiorex15@gmail.com', '$2y$10$S9.tZHzH4Jnyr4hrDhnx7ORhVrGCOWPDqxedfJFYWLeRyxmi9Lffa', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userintolerance`
--

CREATE TABLE `userintolerance` (
  `user_ID` int(11) NOT NULL,
  `intolerance_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userrestriction`
--

CREATE TABLE `userrestriction` (
  `user_ID` int(11) NOT NULL,
  `restriction_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_ID`);

--
-- Indexes for table `dietrestriction`
--
ALTER TABLE `dietrestriction`
  ADD PRIMARY KEY (`restriction_ID`);

--
-- Indexes for table `difficulties`
--
ALTER TABLE `difficulties`
  ADD PRIMARY KEY (`difficultyID`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_ID`);

--
-- Indexes for table `intolerance`
--
ALTER TABLE `intolerance`
  ADD PRIMARY KEY (`intolerance_ID`);

--
-- Indexes for table `recipeingredient`
--
ALTER TABLE `recipeingredient`
  ADD KEY `recipe_ID` (`recipe_ID`),
  ADD KEY `ingredient_ID` (`ingredient_ID`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `difficultyID` (`difficultyID`);

--
-- Indexes for table `recipesteps`
--
ALTER TABLE `recipesteps`
  ADD KEY `recipe_ID` (`recipe_ID`),
  ADD KEY `steps_ID` (`steps_ID`);

--
-- Indexes for table `steps`
--
ALTER TABLE `steps`
  ADD PRIMARY KEY (`steps_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `userintolerance`
--
ALTER TABLE `userintolerance`
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `intolerance_ID` (`intolerance_ID`);

--
-- Indexes for table `userrestriction`
--
ALTER TABLE `userrestriction`
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `restriction_ID` (`restriction_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dietrestriction`
--
ALTER TABLE `dietrestriction`
  MODIFY `restriction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `intolerance`
--
ALTER TABLE `intolerance`
  MODIFY `intolerance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `steps`
--
ALTER TABLE `steps`
  MODIFY `steps_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipeingredient`
--
ALTER TABLE `recipeingredient`
  ADD CONSTRAINT `recipeingredient_ibfk_1` FOREIGN KEY (`recipe_ID`) REFERENCES `recipes` (`recipe_ID`),
  ADD CONSTRAINT `recipeingredient_ibfk_2` FOREIGN KEY (`ingredient_ID`) REFERENCES `ingredients` (`ingredient_ID`);

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `recipes_ibfk_2` FOREIGN KEY (`difficultyID`) REFERENCES `difficulties` (`difficultyID`);

--
-- Constraints for table `recipesteps`
--
ALTER TABLE `recipesteps`
  ADD CONSTRAINT `recipesteps_ibfk_1` FOREIGN KEY (`recipe_ID`) REFERENCES `recipes` (`recipe_ID`),
  ADD CONSTRAINT `recipesteps_ibfk_2` FOREIGN KEY (`steps_ID`) REFERENCES `steps` (`steps_ID`);

--
-- Constraints for table `userintolerance`
--
ALTER TABLE `userintolerance`
  ADD CONSTRAINT `userintolerance_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `userintolerance_ibfk_2` FOREIGN KEY (`intolerance_ID`) REFERENCES `intolerance` (`intolerance_ID`);

--
-- Constraints for table `userrestriction`
--
ALTER TABLE `userrestriction`
  ADD CONSTRAINT `userrestriction_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `userrestriction_ibfk_2` FOREIGN KEY (`restriction_ID`) REFERENCES `dietrestriction` (`restriction_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
