-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2019 at 11:47 AM
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

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`budget_ID`, `user_ID`, `type`, `date`, `category`, `amount`) VALUES
(1, 21, 1, '2019-11-05 00:00:00', 6, '351.79'),
(3, 21, 2, '2019-10-30 14:50:00', 2, '24.50');

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
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `favourites_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `recipe_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`favourites_ID`, `user_ID`, `recipe_ID`) VALUES
(1, 7, 2),
(2, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredient_ID` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredient_ID`, `name`, `price`, `image_name`) VALUES
(2, 'carrot', '0.10', 'carrot.jpg'),
(3, 'onion', '0.10', 'onion.jpg'),
(4, 'celery_stick', '0.05', 'celery.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `recipeingredient`
--

CREATE TABLE `recipeingredient` (
  `recipeIngredient_ID` int(11) NOT NULL,
  `recipe_ID` int(11) NOT NULL,
  `ingredient_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipeingredient`
--

INSERT INTO `recipeingredient` (`recipeIngredient_ID`, `recipe_ID`, `ingredient_ID`) VALUES
(2, 3, 4),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `method` longtext NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `video` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `is_API` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_ID`, `name`, `method`, `image_name`, `video`, `rating`, `is_API`) VALUES
(2, 'Plain Omelette', 'Step 1. Beat eggs, milk, salt and pepper in small bowl until blended. Step 2. Heat butter over medium-high heat until hot. Pour in egg mixture. Mixture should set immediately at edges. Step 3. Push cooked portions from edges toward the center with inverte', 'omelette.jpg', NULL, 1, b'0'),
(3, 'Spaghetti Bolognese', 'Step 1. Put a large saucepan on a medium heat and add 1 tbsp olive oil. Step 2. Add 4 finely chopped bacon rashers and fry for 10 mins until golden and crisp. Step 3. Reduce the heat and add the 2 onions, 2 carrots, and 20g mushrooms. Stir the veg often until it softens. Step 4. Add minced meat to pan and cook for 5 mins or until all meat is cooked. Step 5. Pour the tomatoes, tomato paste, chopped rosemary and basil into mixture and simmer for 15 mins. Step 6. Cook spaghetti according to pack instructions with a splash of olive oil and a pinch of salt. Step 7. Reserve some of the cooking water, drain and pour the pasta into the pan along with the sauce. Step 8. Toss together, thinning with pasta water, if needed, and serve with the extra basil leaves with Parmesan shavings on top.', 'spag_bol.jpg', NULL, 3, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `u_email` varchar(30) NOT NULL,
  `u_password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `fname`, `lname`, `u_email`, `u_password`) VALUES
(1, 'Shauna', '', 'student@dkit.ie', 'Password1'),
(2, 'Jessica', '', 'jessica@student.dkit.ie', 'Password123'),
(4, 'Daniel', '', 'daniel@student.ucd.ie', 'Danny12'),
(7, 'Sarah', '', 'Sarah@student.dkit.ie', 'sarah123'),
(21, 'Archie', '', 'archie@archie.com', 'Archie1'),
(35, 'Shauna', 'Goodman', 'shaunagoodman@dkit.ie', 'Dundalk11');

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
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`favourites_ID`),
  ADD KEY `user_ID` (`user_ID`),
  ADD KEY `recipe_ID` (`recipe_ID`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_ID`);

--
-- Indexes for table `recipeingredient`
--
ALTER TABLE `recipeingredient`
  ADD PRIMARY KEY (`recipeIngredient_ID`),
  ADD KEY `recipe_ID` (`recipe_ID`),
  ADD KEY `ingredient_ID` (`ingredient_ID`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_ID`);

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
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `favourites_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recipeingredient`
--
ALTER TABLE `recipeingredient`
  MODIFY `recipeIngredient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `recipe_ID` FOREIGN KEY (`recipe_ID`) REFERENCES `recipes` (`recipe_ID`),
  ADD CONSTRAINT `user_ID` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

--
-- Constraints for table `recipeingredient`
--
ALTER TABLE `recipeingredient`
  ADD CONSTRAINT `recipeingredient_ibfk_1` FOREIGN KEY (`recipe_ID`) REFERENCES `recipes` (`recipe_ID`),
  ADD CONSTRAINT `recipeingredient_ibfk_2` FOREIGN KEY (`ingredient_ID`) REFERENCES `ingredients` (`ingredient_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
