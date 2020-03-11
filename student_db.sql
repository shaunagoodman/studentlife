-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2020 at 03:48 PM
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
-- Database: `student_db_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blogId` int(11) NOT NULL,
  `blogTitle` varchar(100) NOT NULL,
  `blogContent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blogId`, `blogTitle`, `blogContent`) VALUES
(1, 'Title', 'Example blog');

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
-- Table structure for table `cuisine`
--

CREATE TABLE `cuisine` (
  `cuisine_ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cuisine`
--

INSERT INTO `cuisine` (`cuisine_ID`, `name`) VALUES
(1, 'African'),
(2, 'America'),
(3, 'British'),
(4, 'Cajun'),
(5, 'Caribbean'),
(6, 'Chinese'),
(7, 'Eastern European'),
(8, 'European'),
(9, 'French'),
(10, 'German'),
(11, 'Greek'),
(12, 'Indian'),
(13, 'Irish'),
(14, 'Italian'),
(15, 'Japanese'),
(16, 'Jewish'),
(17, 'Korean'),
(18, 'Latin American'),
(19, 'Mediterranean'),
(20, 'Mexican'),
(21, 'Middle Eastern'),
(22, 'Nordic'),
(23, 'Southern'),
(24, 'Spanish'),
(25, 'Thai'),
(26, 'Vietnamese'),
(27, 'Asian');

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
(36, 'Cajun Seasoning', 2, 'tbsp'),
(197, 'One', 5, 'g'),
(198, 'Two', 5, 'g'),
(199, '1 large chicken fill', 1, '1 lar'),
(200, '1 banana 100 grams o', 1, '1 ban'),
(201, '2 smoked rashers 2 s', 2, '2 smo'),
(202, '100 grams of flour 1', 100, '100 g');

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
-- Table structure for table `recipecuisine`
--

CREATE TABLE `recipecuisine` (
  `recipe_ID` int(11) NOT NULL,
  `cuisine_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(25, 29),
(82, 198),
(85, 199),
(86, 200),
(87, 201),
(88, 202);

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
  `difficultyID` int(11) DEFAULT NULL,
  `date_created` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `isFavourite` tinyint(1) NOT NULL,
  `favourited_by` int(11) DEFAULT NULL,
  `isAPI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_ID`, `user_ID`, `name`, `image`, `video_name`, `rating`, `servings`, `maxTime`, `difficultyID`, `date_created`, `isFavourite`, `favourited_by`, `isAPI`) VALUES
(24, 117, 'Pancakes', 'pancakes.jpg', NULL, NULL, 12, '00:20:00', 1, '2020-02-29 00:01:18.570850', 0, 0, 0),
(25, 117, 'Chicken and Broccoli Stir Fry', 'chicken-and-broccoli-stir-fry.jpg', NULL, NULL, 2, '00:35:00', 2, '2020-02-29 00:01:27.317474', 0, 0, 0),
(26, 117, 'Cajun Stuffed Chicken', 'cajun-stuffed-chicken.jpg', NULL, NULL, 4, '00:45:00', 3, '2020-02-29 00:26:32.107275', 0, NULL, 0),
(81, 102, 'Easiest Belgian Waffle Recipe', 'https://spoonacular.com/recipeImages/1103015-556x370.jpg', NULL, NULL, 5, '00:10:00', NULL, '2020-02-29 13:13:41.727811', 1, 102, 1),
(82, 102, 'Example', '487012.jpg', '', 1, 34, '00:00:04', 1, '2020-02-29 14:03:17.153498', 0, NULL, 0),
(83, 123, 'Prawn Stirfry', 'prawn-stirfry.jpg', 'AsMNso8yy_8', 3, 2, '00:00:30', 2, '2020-03-04 21:56:00.958370', 0, NULL, 0),
(84, 123, 'Cheese and Bacon Omelette', 'omelette1.jpg', '5b_OKpnJAZk&t', 1, 1, '00:00:10', 1, '2020-03-04 21:54:10.047675', 0, NULL, 0),
(85, 123, 'Chicken Broccoli Pasta Bake', 'chicken-bake.jpg', 'BSaGMEmwufY', 3, 2, '00:00:45', 2, '2020-03-04 21:54:57.509762', 0, NULL, 0),
(86, 123, 'Breakfast Smoothie', 'breakfast-smoothie.jpg', '_JePWIoAxgs&t', 1, 1, '00:00:10', 1, '2020-03-04 21:55:17.791859', 0, NULL, 0),
(87, 123, 'Oven Baked Risotto', 'risotto.jpg', 'GmWf58YcSig', 3, 2, '00:00:40', 2, '2020-03-04 21:55:39.209056', 0, NULL, 0),
(88, 123, 'Pancakes', 'pancakes1.JPG', 'ksTuOtxA4C0', 1, 1, '00:00:10', 1, '2020-03-04 21:56:16.771667', 0, NULL, 0);

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
(24, 10),
(82, 60),
(83, 61),
(84, 62),
(85, 63),
(86, 64),
(87, 65),
(88, 66);

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
(12, '1. Preheat oven to 350 degrees. Using a frying pan over a medium heat, add onions and peppers and cook until soft for 5 minutes. Season with salt and pepper and remove from heat to let it cool slightly. 2. With a sharp paring knife, create a pocket in each chicken breast. Stuff each with the vegetable mixture and then top with cheddar. Season the chicken all over with Cajun seasoning, salt and pepper. 3. Add chicken to the pan and bake until cooked through for about 25 minutes.  '),
(60, '1. Oneoneoneone 2. Twotwotwo '),
(61, 'In a large pan over medium heat, heat olive oil. Add prawns cook until pink, 5 minutes, then remove from pan.\r\nAdd broccoli, peas, and pepper and cook until soft, 7 minutes. \r\nAdd soy sauce and simmer until cooked.'),
(62, '1. Crack egg into a bowl and whisk until fully beaten. Leave to one side\r\n2. Heat pan and add oil. Fry bacon until browned. Leave to one side.\r\n3. Add beaten egg to pan and add the cooked bacon and cheese. Once cooked flip over and serve.'),
(63, '1. Chop broccoli and chicken into bite sized pieces.\r\n2. Heat pan, add oil and then fry chicken until golden.\r\n3. Boil pasta and broccoli in water and then drain. Remove from saucepan and leave to one side.\r\n4. Melt butter in a saucepan and add flour and milk, whisk until thickens and then add half of the cheese.\r\n5. Add chicken, broccoli and pasta to the cheese sauce.\r\n6. Transfer mixture into an oven proof dish, add the remaining cheese on top and bake for 15 minutes.'),
(64, '1. Chop banana into slices. \r\n2. Put banana, mixed berries, milk, porridge oats and honey into blender.\r\n3. Blend for 3-5 minutes until smooth.\r\n4. Serve in a chilled glass and garnish with extra berries.'),
(65, '1. Chop onion and rashers. Heat pan, add oil and fry.\r\n2. Add the butter to the pan. When melted then add the rice and stir.\r\n3. Add the wine and leave to simmer for 15 minutes.\r\n4. When the rice has absorbed the liquid, transfer to an oven proof dish, sprinkle with parmesan and bake for 20 minutes.'),
(66, '1. Add flour, eggs and milk to a jug and mix until smooth batter is formed.\r\n2. Heat pan and add oil. The pour some batter to fill the pan.\r\n3. Flip onto the other side once bubbles form on top.\r\n4. Serve when golden and garnish with maple syrup, fresh berries and sprinkle with icing sugar.');

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
  `isActive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `u_type`, `fname`, `lname`, `u_email`, `u_password`, `isActive`) VALUES
(102, 0, 'Shauna', 'Goodman', 'shauna@dkit.ie', '$2y$10$ZHP2tg/08x1qqmUjbU4ZU.MdupaNng0.Hr1atPh0N7Bwi8iEm0mxm', 0),
(105, 0, 'Simon', 'Smith', 'simonsmith@gmail.com', '$2y$10$V3mG0lP0.ohlCZVTRNlkJeZsszhIJKes3KvvxeWz8ePAX81EB2cmu', 0),
(114, 0, 'Mary', 'Finnegan', 'maryfinnegan@iol.ie', '$2y$10$d7Znl8yogoPuTELlOk88W.f36/ThUqX4DgpCnwZNdfGV//KikDKwy', 0),
(117, 0, 'Admin', '', 'adminstudentlife@gmail.com', 'StudentLife2020@', 0),
(118, 0, 'Mateusz', 'Kowalski', 'matiorex5@gmail.com', 'Student123', 0),
(122, 1, 'Mateusz', 'Kowalski', 'matiorex15@gmail.com', '$2y$10$S9.tZHzH4Jnyr4hrDhnx7ORhVrGCOWPDqxedfJFYWLeRyxmi9Lffa', 0),
(123, 0, 'Orlaith', 'Hanlon', 'orlaithhanlon@hotmail.com', '$2y$10$knC3pNZ.TYjMxu6mA3JWb.74A1UOKLTcT1YheDM6/e7XfOioohuiG', 0),
(124, 1, 'Niamh', 'Curran', 'niamhthefabulous@gmail.com', '$2y$10$hSKcFK30wbRPpZkK/vhkWejHU8Ei4Xsbo63UmUgHzPD.KOXkLWLYC', 1),
(125, 0, 'Emmet', 'Curran', 'emmet@gmail.com', '$2y$10$JMVxj/R1tlYlbVOikSXyGurKhquu09Q7JxnfFt7cZ4Qbx58IU4nEO', 1);

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
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blogId`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_ID`);

--
-- Indexes for table `cuisine`
--
ALTER TABLE `cuisine`
  ADD PRIMARY KEY (`cuisine_ID`);

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
-- Indexes for table `recipecuisine`
--
ALTER TABLE `recipecuisine`
  ADD KEY `recipe_ID` (`recipe_ID`),
  ADD KEY `cuisine_ID` (`cuisine_ID`);

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
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blogId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cuisine`
--
ALTER TABLE `cuisine`
  MODIFY `cuisine_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `dietrestriction`
--
ALTER TABLE `dietrestriction`
  MODIFY `restriction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `intolerance`
--
ALTER TABLE `intolerance`
  MODIFY `intolerance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `steps`
--
ALTER TABLE `steps`
  MODIFY `steps_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipecuisine`
--
ALTER TABLE `recipecuisine`
  ADD CONSTRAINT `recipecuisine_ibfk_1` FOREIGN KEY (`recipe_ID`) REFERENCES `recipes` (`recipe_ID`),
  ADD CONSTRAINT `recipecuisine_ibfk_2` FOREIGN KEY (`cuisine_ID`) REFERENCES `cuisine` (`cuisine_ID`);

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
