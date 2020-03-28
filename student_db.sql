-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2020 at 02:45 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

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
(1, 'Dangerous Foods for Pets\r\n', 'Most people will give their pets left over food or human food as a treat but depending on what\'s in that food could really do some serious harm to your little friend. <br><br>\r\nHere is a list of foods that should never be given to your cat or dog:\r\n<br>\r\nAlcoholic beverages <br>\r\nAvocados <br>\r\nCherry pits <br>\r\nCandy (particularly chocolate—which is toxic to dogs, cats, and ferrets—and any candy containing the toxic sweetener Xylitol) <br>\r\nCoffee <br>\r\nGarlic <br>\r\nGrapes <br>\r\nGum (can cause blockages and sugar free gums may contain the toxic sweetener Xylitol) <br>\r\nMacadamia nuts <br> \r\nMoldy foods <br>\r\nMushroom plants <br>\r\nMustard seeds <br>\r\nOnions and onion powder <br>\r\nPeach pits <br>\r\nPotato leaves and stems (green parts) <br>\r\nRaisins <br>\r\nRhubarb leaves <br>\r\nSalt <br>\r\nTea <br>\r\nTomato leaves and stems <br>\r\nWalnuts <br>\r\nYeast dough <br>\r\n<br>\r\nSo now you know! Be careful with what you give your pets in future. \r\n'),
(2, '3 Tasty Celebrity Recipes You’ll be Surprised by!\r\n', '\r\nHere are 3 celebrity recipes you’ll want to make straight away after reading this!\r\n\r\nOprah Winfrey’s Deviled Eggs\r\n\r\nINGREDIENTS\r\n\r\n12 large eggs\r\n3 tablespoons mayonnaise\r\n2 tablespoons mustard\r\n1 tablespoon minced sweet pickle\r\n1 dash Worcestershire sauce\r\nsalt & fresh ground pepper\r\n1 dash lemon juice\r\n1 dash horseradish sauce\r\n1 -2 dash Tabasco sauce\r\n2 tablespoons chopped parsley\r\n2 tablespoons paprika (garnish) \r\n\r\nMETHOD\r\nHard boil eggs.\r\nCut each in half lengthwise.\r\nRemove yolks and place in bowl with all other ingredients; mix well.\r\nSpoon into egg whites and sprinkle with parsley & paprika.\r\nCover and refrigerate at least one hour or more.\r\nServe chilled.\r\n\r\nPerfect for your next house gathering or office party!\r\n\r\nDolly Parton’s Coleslaw\r\n\r\nINGREDIENTS\r\n\r\n1 medium head cabbage, minced\r\n1 medium onion, finely minced\r\n1 carrot, minced (or grated)\r\n1⁄2 bell pepper, finely minced\r\n1⁄4 cup sweet pickle juice\r\n1⁄4 cup white vinegar\r\n1 tablespoon dill pickles, minced or 1 tablespoon pickle relish\r\n1 cup mayonnaise\r\n2 tablespoons sugar\r\n1⁄4 teaspoon black pepper\r\n1 teaspoon salt\r\n\r\nMETHOD\r\nMix all ingredients in large bowl. \r\nChill till ready to serve. Serves 10-12.\r\n\r\nPerfect to serve with your favourite burger or on a sandwich!\r\n\r\n\r\nBeyonce’s Guacamole\r\n\r\nINGREDIENTS\r\n\r\n2 ripe avocados (make sure they are a bit soft to the touch)\r\n1 small onion\r\n1 clove garlic (you can use a small amount of crushed garlic)\r\n1 small tomato\r\n1 1/2 Tablespoons lime juice\r\nSalt and pepper to taste\r\n Corn chip scoops\r\n\r\nMETHOD\r\n\r\nPeel avocados and remove the pit\r\nSmash with a spoon in a large bowl\r\nAdd onion, garlic and tomato, lime juice, salt and pepper\r\nMix it well\r\nCover with plastic wrap and place in the refrigerator for about 20 minutes.\r\nFill corn chips scoops with guacamole and enjoy.\r\n\r\nBeyonce’s recipe for guacamole is sure to go down a treat at your next party night!\r\n\r\nWe hope you have fun trying these celebrity recipes! \r\n'),
(3, 'All You Need to Know About Ireland’s NO.1 Takeaway!', 'Every year, popular takeaway ordering app Just Eat hold a national takeaway awards. They have award categories for everything you can think of. From best takeaway Chinese to best takeaway Salad. \r\nBut the one every takeaway wants to bring home is the “Best Takeaway Ireland” award. And this year it was Saba To Go in Rathmines that took the trophy!\r\n\r\nSaba To Go is the sister takeaway restaurant to Saba. Both serving delicious authentic Thai food throughout Dublin. They boast a menu that they say is healthier than your average takeaway with a wide variety of Vegetarian, Gluten and Dairy Free options available.\r\n\r\nYou can order through Saba To Go’s website at sabatogo.com or from the Just Eat app! Maybe you’ll give them a try? After all they’re the countries No. 1!\r\n'),
(4, 'Burger sold for $10,000!\r\n', 'A burger in Dubai has made headlines after being sold for $10,000. \r\nThe burger was created by Sheikh Mohammed bin Abdullah Al Thani and was auctioned off to raise money for a Breast Cancer charity in Dubai at the Eat Pink event at the Dubai Mall. \r\nWe hope that was one tasty burger! But even if not, the money still went to a great cause. Congratulations and well done to all!\r\n'),
(5, 'How To Make Healthier Choices When Cooking\r\n', '1. Use more egg whites to yolk ratio <br>\r\nWhen cooking scrambled egg or your favourite omelette, try using 1 full egg and then removing the yoke from the rest of the eggs. You’ll still have the same great taste but without the extra fat and cholesterol. \r\n<br><br>\r\n2. Replace your morning spread <br>\r\nDo you spread butter and jam on your toast in the morning? Why not try smashed avocado for a tasty and healthier alternative, that will keep you fuller for longer so you won’t have to snack before lunchtime!\r\n<br><br>\r\n3. Switch up your bread <br>\r\nAre you sick and tired of the same old slice pan everyday? Try swapping it for brown or wholewheat bread, you can still add your favourite toppings and fillings and it keep you healthier in the long run. \r\n<br><br>\r\n4. Change your chocolate choice <br>\r\nDo you have a sweet tooth and need your chocolate fix? Try swapping milk chocolate for dark chocolate. Dark chocolate is a good source of antioxidants which are essential for clearing the body of toxins. You should feel much better after switching!\r\n<br><br>\r\n5. Swap a cupcake for a croissant <br>\r\nDitch the unnecessary calories! On average a croissant has 250 less calories than your average cupcake or muffin, and that’s without icing. \r\n<br><br>\r\nWhich of these changes will you make? \r\n'),
(6, '10 Fruit and Veg Facts\r\n', '1. Green, yellow, and red bell peppers are not actually the same vegetable.<br>\r\n2. A typical ear of corn has an even number of rows.<br>\r\n3. Ripe cranberries will bounce like rubber balls.<br>\r\n4. Bananas are technically berries.<br>\r\n5. Strawberries are technically not.<br>\r\n6. Carrots were originally purple.<br>\r\n7. Grapes will explode if you microwave them.<br>\r\n8. Potatoes were the first vegetable to be grown in space.<br>\r\n9. A kiwi contains twice as much vitamin c than an orange. <br>\r\n10. The skin of a cucumber can help erase ink. <br>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_ID` int(11) NOT NULL,
  `comment` text NOT NULL,
  `senderName` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recipe_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_ID`, `comment`, `senderName`, `date`, `recipe_ID`) VALUES
(17, 'Hi\r\n', 'Shauna', '2020-03-27 16:46:20', 12243232),
(18, 'Hi', '', '2020-03-27 16:49:38', 12243232),
(19, 'Ohh cheesy!', 'Steven', '2020-03-27 17:01:37', 12243232),
(20, 'Oh cheesy oh so nice', 'Steven', '2020-03-27 17:02:05', 12243232),
(21, 'Comment\r\n', 'Steven', '2020-03-28 13:38:04', 12243234),
(22, 'Anoother Comment', 'Steven', '2020-03-28 13:38:47', 12243234);

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
  `recipe_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(28, 'Green Pepper', 100, 'g'),
(248, 'cornstarch', 2, '2'),
(249, 'egg yolks', 2, '2'),
(250, 'heavy cream', 118, '118.2'),
(251, 'milk chocolate', 142, '141.7'),
(252, 'salt', 1, '1'),
(253, 'sugar', 3, '3'),
(254, 'unsweetened cocoa po', 2, '2'),
(255, 'vanilla extract', 1, '1'),
(256, 'whole milk', 355, '354.8'),
(282, 'chocolate crumb crus', 1, '1'),
(283, 'cream cheese', 85, '85.04'),
(284, 'hersheys kisses bran', 8, '8'),
(285, 'milk', 118, '118.2'),
(286, 'milk chocolate chips', 237, '236.5'),
(287, 'whipped topping', 227, '226.7'),
(288, 'chocolate crumb crus', 1, '1'),
(289, 'cream cheese', 85, '85.04'),
(290, 'hersheys kisses bran', 8, '8'),
(291, 'milk', 118, '118.2'),
(292, 'milk chocolate chips', 237, '236.5'),
(293, 'whipped topping', 227, '226.7'),
(297, 'on3', 3, ''),
(299, 'large egg', 1, ''),
(300, 'rashers of bacon', 2, ''),
(301, 'grated cheese', 50, 'grams'),
(302, 'olive oil', 1, 'table'),
(303, 'Large chicken fillet', 1, ''),
(304, 'Pasta', 150, 'grams'),
(305, 'Olive oil', 1, 'tbsp'),
(306, 'Head of broccoli', 1, ''),
(307, 'grated cheese', 100, 'grams'),
(308, 'milk', 50, 'mls'),
(309, 'butter', 50, 'grams'),
(310, 'flour', 50, 'grams'),
(311, 'banana', 1, ''),
(312, 'mixed berries', 100, 'grams'),
(313, 'honey', 1, 'tbsp'),
(314, 'milk', 150, 'mls'),
(315, 'porridge oats', 50, 'grams'),
(316, 'prawns', 250, 'grams'),
(317, 'red pepper', 1, ''),
(318, 'olive oil', 1, 'tbsp'),
(319, 'head of broccoli', 1, ''),
(320, 'green beans', 100, 'grams'),
(321, 'soy sauce', 50, 'mls'),
(322, 'flour', 100, 'grams'),
(323, 'egg', 1, ''),
(324, 'milk', 300, 'mls'),
(325, 'mixed berries, icing', 0, ''),
(327, 'Smoked Bacon', 2, 'whole'),
(328, 'Small Onions', 2, 'whole'),
(329, 'Butter', 20, 'grams'),
(330, 'Olive Oil', 1, 'teasp'),
(331, 'Long Grain Rice', 300, 'grams'),
(332, 'White Wine', 75, 'ml'),
(333, 'Chicken Stock', 400, 'ml'),
(334, 'Parmesan', 50, 'grams'),
(335, 'carrot', 59, '59.14'),
(336, 'chili paste', 1, '0.5'),
(337, 'fresh cilantro', 1, '1'),
(338, 'fresh mint', 1, '1'),
(339, 'lime juice', 79, '78.86'),
(340, 'sugar', 2, '2'),
(341, 'thai fish sauce', 2, '2'),
(342, 'carrot', 59, '59.14'),
(343, 'chili paste', 1, '0.5'),
(344, 'fresh cilantro', 1, '1'),
(345, 'fresh mint', 1, '1'),
(346, 'lime juice', 79, '78.86'),
(347, 'sugar', 2, '2'),
(348, 'thai fish sauce', 2, '2'),
(349, 'carrot', 59, '59.14'),
(350, 'chili paste', 1, '0.5'),
(351, 'fresh cilantro', 1, '1'),
(352, 'fresh mint', 1, '1'),
(353, 'lime juice', 79, '78.86'),
(354, 'sugar', 2, '2'),
(355, 'thai fish sauce', 2, '2'),
(356, 'carrot', 59, '59.14'),
(357, 'chili paste', 1, '0.5'),
(358, 'fresh cilantro', 1, '1'),
(359, 'fresh mint', 1, '1'),
(360, 'lime juice', 79, '78.86'),
(361, 'sugar', 2, '2'),
(362, 'thai fish sauce', 2, '2'),
(363, 'carrot', 59, '59.14'),
(364, 'chili paste', 1, '0.5'),
(365, 'fresh cilantro', 1, '1'),
(366, 'fresh mint', 1, '1'),
(367, 'lime juice', 79, '78.86'),
(368, 'sugar', 2, '2'),
(369, 'thai fish sauce', 2, '2'),
(376, 'garlic clove', 1, '1'),
(377, 'honey', 59, '59.14'),
(378, 'lime juice', 118, '118.2'),
(379, 'olive oil', 79, '78.86'),
(380, 'pepper', 0, '0.25'),
(381, 'salt', 1, '0.5');

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
(12243232, 299),
(12243232, 300),
(12243232, 301),
(12243232, 302),
(12243233, 303),
(12243233, 304),
(12243233, 305),
(12243233, 306),
(12243233, 307),
(12243233, 308),
(12243233, 309),
(12243233, 310),
(12243234, 311),
(12243234, 312),
(12243234, 313),
(12243234, 314),
(12243234, 315),
(12243235, 316),
(12243235, 317),
(12243235, 318),
(12243235, 319),
(12243235, 320),
(12243235, 321),
(12243236, 322),
(12243236, 323),
(12243236, 324),
(12243236, 325),
(12243238, 327),
(12243238, 328),
(12243238, 329),
(12243238, 330),
(12243238, 331),
(12243238, 332),
(12243238, 333),
(12243238, 334);

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
  `date_created` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `isAPI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipe_ID`, `user_ID`, `name`, `image`, `video_name`, `rating`, `servings`, `maxTime`, `difficultyID`, `date_created`, `isAPI`) VALUES
(12243232, 127, 'Cheese and Bacon Omelette', '277316.jpg', 'fWl3wW_M2Co', 3, 1, '00:10:00', 1, '2020-03-26 14:52:50.839297', 0),
(12243233, 127, 'Chicken and Broccoli Pasta Bake', '200411.jpg', 'OqfYBxCZWV4', 3, 2, '00:45:00', 2, '2020-03-26 14:57:32.705514', 0),
(12243234, 127, 'Breakfast Berry and Banana Smoothie', '213540.jpg', 'KP-AHMbSiBk', 5, 1, '00:10:00', 1, '2020-03-26 15:01:02.185227', 0),
(12243235, 127, 'Prawn Stirfry', '108912.jpg', 'Sj8CCd3nuUQ', 5, 1, '00:30:00', 2, '2020-03-26 15:13:06.042427', 0),
(12243236, 127, 'Pancakes', '695030.jpg', 'Wtk9VstvYXk', 4, 1, '00:10:00', 1, '2020-03-26 15:16:13.400244', 0),
(12243238, 102, 'Oven Baked Risotto', '718573.jpg', '4NWIs5X7JIM', 0, 2, '00:45:00', 1, '2020-03-26 17:49:33.152178', 0);

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
(12243232, 84),
(12243233, 85),
(12243234, 86),
(12243235, 87),
(12243236, 88),
(12243238, 90);

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
(69, '1. Place chocolate in a bowl a small mixing bowl.In a second mixing bowl, whisk together the sugar, cocoa, cornstarch and salt; whisk in egg yolks and 1/2 cup milk until smooth.In a large saucepan over high heat, bring remaining 1 cup milk and 1/2 cup cream to a simmer. 2. Pour hot milk mixture into bowl with chocolate and whisk until smooth. 3. Whisking constantly, slowly pour hot chocolate mixture into egg mixture until completely incorporated and cocoa is dissolved.Return custard to saucepan. Cook, stirring constantly, over medium heat, until thickened, about 10 minutes (Mine was thick in five, at which point I reduced the heat to low and cooked it another minute or two). Do not let mixture reach a simmer. If custard begins to steam heavily, stir it, off the heat, a moment before returning it to stove top. Strain through a fine-mesh sieve. Stir in vanilla.Lay a piece of waxed paper or parchment over the pudding and let it cool for about 30 minutes at room temperature. 4. Transfer to refrigerator to chill.When pudding is chilled, whip the cream until peaks form. Beat in sugar and vanilla. Layer pudding in glasses with the whipped cream. '),
(82, '1. one one one '),
(84, '1. Crack egg into a bowl and whisk until fully beaten. Leave to one side 2. Heat pan and add oil. Fry bacon until browned. Leave to one side. 3. Add beaten egg to pan and add the cooked bacon and cheese. Once cooked flip over and serve. '),
(85, '1. Chop broccoli and chicken into bite sized pieces. 2. Heat pan, add oil and then fry chicken until golden. 3. Boil pasta and broccoli in water and then drain. Remove from saucepan and leave to one side. 4.  Melt butter in a saucepan and add flour and milk, whisk until thickens and then add half of the cheese. 5. Add chicken, broccoli and pasta to the cheese sauce. 6. Transfer mixture into an oven proof dish, add the remaining cheese on top and bake for 15 minutes. '),
(86, '1. Chop banana into slices.  2. Put banana, mixed berries, milk, porridge oats and honey into blender. 3. Blend for 3-5 minutes until smooth. 4. Serve in a chilled glass and garnish with extra berries. '),
(87, '1. Chop broccoli, red pepper and green beans into bite sized pieces. 2. Heat pan, add oil and then fry prawns until pink. Then add vegetables and fry for 5-10 minutes. 3. Once nearly done, add soy sauce and leave to simmer on a low heat for 8 minutes. 4. Once finished, serve and enjoy! '),
(88, '1. Add flour, eggs and milk to a jug and mix until smooth batter is formed. 2. Heat pan and add oil. The pour some batter to fill the pan. 3. Flip onto the other side once bubbles form on top. 4. Serve when golden and garnish with maple syrup, fresh berries and sprinkle with icing sugar. '),
(90, '1. Chop onion and rashers. Heat pan, add oil and fry. 2. Add the butter to the pan. When melted then add the rice and stir. 3. Add the wine and leave to simmer for 15 minutes. 4. When the rice has absorbed the liquid, transfer to an oven proof dish, sprinkle with parmesan and bake for 20 minutes. '),
(91, '1. Whisk ingredients together and pour over cooked and rinsed noodles. '),
(92, '1. Whisk ingredients together and pour over cooked and rinsed noodles. '),
(93, '1. Whisk ingredients together and pour over cooked and rinsed noodles. '),
(94, '1. Whisk ingredients together and pour over cooked and rinsed noodles. '),
(95, '1. Whisk ingredients together and pour over cooked and rinsed noodles. '),
(97, ''),
(98, '1. Whisk together first 5 ingredients. Gradually whisk in 1/3 cup olive oil until blended. '),
(99, ''),
(100, ''),
(101, '');

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
(102, 1, 'Shauna', 'Goodman', 'shauna@dkit.ie', '$2y$10$ZHP2tg/08x1qqmUjbU4ZU.MdupaNng0.Hr1atPh0N7Bwi8iEm0mxm', 1),
(105, 0, 'Simon', 'Smith', 'simonsmith@gmail.com', '$2y$10$V3mG0lP0.ohlCZVTRNlkJeZsszhIJKes3KvvxeWz8ePAX81EB2cmu', 0),
(114, 0, 'Mary', 'Finnegan', 'maryfinnegan@iol.ie', '$2y$10$d7Znl8yogoPuTELlOk88W.f36/ThUqX4DgpCnwZNdfGV//KikDKwy', 0),
(117, 1, 'Admin', '', 'adminstudentlife@gmail.com', 'StudentLife2020@', 0),
(118, 0, 'Mateusz', 'Kowalski', 'matiorex5@gmail.com', 'Student123', 0),
(122, 1, 'Mateusz', 'Kowalski', 'matiorex15@gmail.com', '$2y$10$S9.tZHzH4Jnyr4hrDhnx7ORhVrGCOWPDqxedfJFYWLeRyxmi9Lffa', 0),
(123, 0, 'Orlaith', 'Hanlon', 'orlaithhanlon@hotmail.com', '$2y$10$knC3pNZ.TYjMxu6mA3JWb.74A1UOKLTcT1YheDM6/e7XfOioohuiG', 0),
(124, 1, 'Niamh', 'Curran', 'niamhthefabulous@gmail.com', '$2y$10$hSKcFK30wbRPpZkK/vhkWejHU8Ei4Xsbo63UmUgHzPD.KOXkLWLYC', 1),
(125, 0, 'Emmet', 'Curran', 'emmet@gmail.com', '$2y$10$JMVxj/R1tlYlbVOikSXyGurKhquu09Q7JxnfFt7cZ4Qbx58IU4nEO', 1),
(126, 0, 'Steven', 'Riordan', 'stevo@iol.ie', '$2y$10$65UD3K4yltgZDqhTly4GYe3Dw9Sgeyv7SBAa1E7P6tG46rmNRQI3K', 1),
(127, 1, 'Orlaith', 'Hanlon', 'orlaithhanlon@gmail.com', '$2y$10$ueSDjkoYM0er1vJJ6hlTpexydFO7TE0lZK4PWyjxnzQCevHn6hk1G', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blogId`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `recipe_ID` (`recipe_ID`);

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
-- Indexes for table `difficulties`
--
ALTER TABLE `difficulties`
  ADD PRIMARY KEY (`difficultyID`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD KEY `recipe_ID` (`recipe_ID`),
  ADD KEY `user_ID` (`user_ID`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_ID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blogId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cuisine`
--
ALTER TABLE `cuisine`
  MODIFY `cuisine_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12243243;

--
-- AUTO_INCREMENT for table `steps`
--
ALTER TABLE `steps`
  MODIFY `steps_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`recipe_ID`) REFERENCES `recipes` (`recipe_ID`);

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`recipe_ID`) REFERENCES `recipes` (`recipe_ID`),
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`user_ID`) REFERENCES `user` (`user_ID`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
