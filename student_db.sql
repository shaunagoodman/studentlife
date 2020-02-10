-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2020 at 11:40 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

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
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `budget_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `category` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `budget_type`
--

CREATE TABLE `budget_type` (
  `budget_type_ID` int(11) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budget_type`
--

INSERT INTO `budget_type` (`budget_type_ID`, `type`) VALUES
(1, 'income'),
(2, 'expense');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_ID` int(11) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_ID`, `category`) VALUES
(1, 'Transport'),
(2, 'Groceries'),
(3, 'Entertainment'),
(4, 'Bills'),
(5, 'Savings'),
(6, 'Wages'),
(7, 'Shopping');

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

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_ID`, `contact_name`, `email`, `phone_no`, `message`) VALUES
(1, 'Shauna', 'shsuna@dkit.ie', '0897656473', 'Hi there, I can\'t access my account. Can you send me my password please or reset it for me? Thanks, Shauna');

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
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `user_ID` int(11) NOT NULL,
  `recipe_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredient_ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `unit` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredient_ID`, `name`, `price`, `amount`, `unit`) VALUES
(22, 'Plain flour', '0.10', 100, 'g'),
(23, 'Egg', '0.20', 100, 'g'),
(24, 'milk', '0.05', 300, 'ml'),
(25, 'Sunflower oil', '0.20', 1, 'tsp'),
(26, 'Chicken', '1.00', 455, 'g'),
(27, 'Broccoli', '0.30', 150, 'g'),
(28, 'Green Pepper', '0.45', 100, 'g'),
(29, 'Soy Sauce', '0.65', 120, 'ml'),
(30, 'Garlic', '0.05', 20, 'g'),
(31, 'Ginger', '0.50', 1, 'tsp'),
(32, 'Sesame Seed', '0.02', 1, 'tsp'),
(33, 'Extra-virgin olive o', '0.25', 2, 'tbsp'),
(34, 'Onion', '0.20', 120, 'g'),
(35, 'Chicken Breast', '1.00', 800, 'g'),
(36, 'Cajun Seasoning', '0.50', 2, 'tbsp');

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
(25, 29),
(25, 29),
(25, 31),
(25, 30),
(25, 32),
(26, 35),
(26, 33),
(26, 34),
(26, 36);

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
  `difficulty-text` varchar(10) NOT NULL,
  `maxTime` time NOT NULL,
  `difficultyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_ID`, `user_ID`, `name`, `image`, `video_name`, `rating`, `servings`, `difficulty-text`, `maxTime`, `difficultyID`) VALUES
(24, 117, 'Pancakes', 'pancakes.jpg', NULL, NULL, 12, 'Easy', '00:20:00', 1),
(25, 117, 'Chicken and Broccoli Stir Fry', 'chicken-and-broccoli-stir-fry.jpg', NULL, NULL, 2, 'Medium', '00:35:00', 2),
(26, 117, 'Cajun Stuffed Chicken', 'cajun-stuffed-chicken.jpg', NULL, NULL, 4, 'Medium', '00:45:00', 3);

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
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `u_email` varchar(30) NOT NULL,
  `u_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `fname`, `lname`, `u_email`, `u_password`) VALUES
(102, 'Shauna', 'Goodman', 'shauna@dkit.ie', '$2y$10$ZHP2tg/08x1qqmUjbU4ZU.MdupaNng0.Hr1atPh0N7Bwi8iEm0mxm'),
(105, 'Simon', 'Smith', 'simonsmith@gmail.com', '$2y$10$V3mG0lP0.ohlCZVTRNlkJeZsszhIJKes3KvvxeWz8ePAX81EB2cmu'),
(114, 'Mary', 'Finnegan', 'maryfinnegan@iol.ie', '$2y$10$d7Znl8yogoPuTELlOk88W.f36/ThUqX4DgpCnwZNdfGV//KikDKwy'),
(117, 'Admin', '', 'adminstudentlife@gmail.com', 'StudentLife2020@');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`budget_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `type` (`type`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `budget_type`
--
ALTER TABLE `budget_type`
  ADD PRIMARY KEY (`budget_type_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_ID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_ID`);

--
-- Indexes for table `difficulties`
--
ALTER TABLE `difficulties`
  ADD PRIMARY KEY (`difficultyID`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`user_ID`,`recipe_ID`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_ID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `budget_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `budget_type`
--
ALTER TABLE `budget_type`
  MODIFY `budget_type_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `steps`
--
ALTER TABLE `steps`
  MODIFY `steps_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`),
  ADD CONSTRAINT `budget_ibfk_2` FOREIGN KEY (`type`) REFERENCES `budget_type` (`budget_type_ID`),
  ADD CONSTRAINT `budget_ibfk_3` FOREIGN KEY (`category`) REFERENCES `category` (`category_ID`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
