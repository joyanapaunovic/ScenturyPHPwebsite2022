-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2025 at 11:29 AM
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
-- Database: `the_scentury`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id_basket` int(255) NOT NULL,
  `id_user` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `basket_perfumes`
--

CREATE TABLE `basket_perfumes` (
  `id_basket` int(255) NOT NULL,
  `id_perfume` int(255) NOT NULL,
  `id_mil` int(255) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id_brand` int(255) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `brand_logo_src` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id_brand`, `brand_name`, `brand_logo_src`) VALUES
(1, 'Chanel', 'chanel-logo.png'),
(2, 'Armani', 'armani-logo.png'),
(3, 'Dior', 'dior-logo.png'),
(4, 'Tom Ford', 'tom-ford-logo.png'),
(5, 'Burberry', 'burberry-logo.png'),
(6, 'D&G', 'dolce-gabbana-logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(255) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `category_name`) VALUES
(1, 'Men'),
(2, 'Women'),
(3, 'Unisex');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id_message` int(255) NOT NULL,
  `first_name_messager` varchar(50) NOT NULL,
  `last_name_messager` varchar(50) NOT NULL,
  `email_messager` varchar(60) NOT NULL,
  `message_content` varchar(1000) NOT NULL,
  `message_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id_message`, `first_name_messager`, `last_name_messager`, `email_messager`, `message_content`, `message_date`) VALUES
(1, 'Paula', 'Smith', 'paula.s@gmail.com', 'The precious sandalwood note is central here, combined with cashmere woods, musks, elusive florals, and ambergris—smelling smooth, seasoned, sweet, and velvety with a lush, enigmatic floral texture effect. It\'s unisex but more on the feminine side. It’s not cloying, as it has a certain maturity. Up top, you get rose and plum, both not distinctively vivid to my nose but more so creating a soft, jammy layer in a red or purple hue. Underneath that, the woods are dry; a suede-like texture and more calming woods give the right amount of balance to the sweetness.', '2025-03-04 16:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `milliliters`
--

CREATE TABLE `milliliters` (
  `id_mil` int(20) NOT NULL,
  `value` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `milliliters`
--

INSERT INTO `milliliters` (`id_mil`, `value`) VALUES
(1, 35),
(2, 50),
(3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `navigation`
--

CREATE TABLE `navigation` (
  `id_nav` int(20) NOT NULL,
  `href` varchar(50) NOT NULL,
  `link_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `navigation`
--

INSERT INTO `navigation` (`id_nav`, `href`, `link_name`) VALUES
(1, 'index.php', 'Home'),
(2, 'shop.php', 'Shop'),
(3, 'index.php#contact', 'Contact'),
(4, 'login.php', 'Sign in');

-- --------------------------------------------------------

--
-- Table structure for table `nav_role`
--

CREATE TABLE `nav_role` (
  `id_role` int(11) NOT NULL,
  `id_nav` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perfume`
--

CREATE TABLE `perfume` (
  `id_perfume` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `photo_src` varchar(80) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `id_brand` int(255) NOT NULL,
  `id_category` int(255) NOT NULL,
  `highlighted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perfume`
--

INSERT INTO `perfume` (`id_perfume`, `name`, `photo_src`, `description`, `id_brand`, `id_category`, `highlighted`) VALUES
(1, 'Coco Mademoiselle Eau de Parfum', 'chanel-coco-mademoiselle-product.png | chanel-coco-mademoiselle.png', 'A sparkling ambery fragrance that recalls a daring young Coco Chanel. An absolutely modern composition with a strong yet surprisingly fresh character. Sparks of fresh and vibrant Orange immediately awaken the senses. A clear and sensual heart reveals the transparent accords of Grasse Jasmine and May Rose.', 1, 2, 1),
(2, 'Miss Dior Eau De Parfum', 'miss-dior.png', 'Miss Dior Eau de Parfum (2017) by Dior is a Chypre Floral fragrance for women. Miss Dior Eau de Parfum (2017) was launched in 2017. The nose behind this fragrance is Francois Demachy. Top notes are Pink Pepper, Blood Orange, Sweet Orange, Mandarin Orange, Calabrian bergamot and Lemon; middle notes are Grasse Rose, Damask Rose and Jasmine Leaf; base notes are Patchouli and Palisander Rosewood.', 3, 2, 0),
(3, 'Acqua Di Gio Absolu', 'armani-acqua.png | acqua-armani-absolu.jpg', 'This enticing men’s cologne creates an elegant juxtaposition between the clean fragrance of fresh aquatics and the warmth of woody scents. A sensual and long-lasting men’s fragrance, this ARMANI beauty cologne explores the dynamic relationship between man and nature.', 2, 1, 1),
(4, 'Hypnotic Poison Eau de Toilette', 'hypnotic-poison-product.jpg | hypnotic-poison-product.jpg', 'The Hypnotic Poison Eau de Toilette has four contrasting facets: Intoxicating bitter almond and carvi, opulent sambac jasmine, mysterious jacaranda, and sensuous vanilla and musk all make for a compelling, bewitching fragrance fusion. The mystery of Dior\'s legendary forbidden fruit lives on in a magical, modern philter.| Hypnotic Poison isn\'t a fragrance you wear, it\'s a fragrance that wears you. Hypnotic Poison Eau de Toilette is a magnetic scent, a heady oriental fragrance with carnal Vanilla notes that meld with an Almond and Jasmine accord. A terribly sensual fragrance.', 3, 2, 1),
(5, 'Giorgio Armani My Way', 'my-way-armani.png', 'My Way by Giorgio Armani is a Floral fragrance for women. This is a new fragrance. My Way was launched in 2020. My Way was created by Carlos Benaim and Bruno Jovanovic. Top notes are Orange Blossom and Bergamot; middle notes are Tuberose and Indian Jasmine; base notes are Madagascar Vanilla, White Musk and Virginian Cedar.', 2, 2, 0),
(6, 'Mr. Burberry Indigo', 'mr-burberry-indigo.png', 'Mr. Burberry Indigo by Burberry is a Woody Aromatic fragrance for men. Mr. Burberry Indigo was launched in 2018. The nose behind this fragrance is Francis Kurkdjian. Top notes are Rosemary, Lemon, Bergamot and Grapefruit; middle notes are Mint, Water Notes, Violet, Sage, Tea and Hedione; base notes are Oakmoss, Iso E Super and Amber.', 5, 1, 0),
(7, 'Armani Privé Figuier Eden', 'armani-prive-unisex.png', 'Figuier Eden by Giorgio Armani is a Aromatic Fruity fragrance for women and men. Figuier Eden was launched in 2012. Top notes are Pink Pepper, Bergamot and Mandarin Orange; middle notes are Fig, Tea and Grass; base notes are iris and Amber.', 2, 3, 0),
(8, 'BLEU DE CHANEL', 'bleu-de-chanel.png', 'An ode to masculine freedom expressed in an aromatic-woody fragrance with a captivating trail. A timeless scent housed in a bottle of deep and mysterious blue.\r\nBLEU DE CHANEL Parfum is an accomplished composition with a pure, deep character. An intensely masculine signature that exudes self-confidence. | BLEU DE CHANEL Parfum is an aromatic, intensely woody fragrance. It opens with powerful freshness, then lingers with a precious accord of New Caledonian sandalwood that unfurls its generous, powerful notes in a dense and sophisticated trail. BLEU DE CHANEL is the fragrance of a man who refuses to be bound by rules. ', 1, 1, 0),
(9, 'Burberry Her Eau de Parfum', 'burberry-her.png | burberry-her-product.png', 'Burberry Her Eau de Parfum for women is an artful blend of berries elevated by spirited jasmine and violet. Her Eau de Parfum is the first gourmand fragrance with a British twist by Burberry. A burst of red and dark berry notes lightened by a luminous, white woody accord. | Effortlessly stylish, energetic, optimistic, adventurous and bold - the spirit of Her, captured in London - a beautiful, bustling, creative metropolis, eclectic and full of life. The bottle is luxurious yet understated, inspired by an archival Burberry fragrance design. | Fragrance Family: Floral | Scent Type: Fruity Floral | Key Notes: Dark Berries, Jasmine, Musk-Amber', 5, 2, 1),
(10, 'DOLCE&GABBANA Pour Femme', 'dolce-gabbana-pour-femme.png', 'Experience the essence of femininity with Pour Femme. From the Mediterranean—the epicenter of harmony and contrast—this classic perfume embodies the DOLCE&GABBANA woman: passionate, sensual, maternal, and aware of her strength and instincts.\r\nTop notes are Raspberry, Neroli and Mandarin Orange; middle notes are Orange Blossom and Jasmine; base notes are Marshmallow, Vanilla, Sandalwood and Heliotrope.', 6, 2, 0),
(11, 'DOLCE&GABBANA The one', 'dolce-gabbana-the-one.png', 'Sensuous and timeless, The One Eau de Parfum is the essence of the DOLCE&GABBANA woman. This floral fragrance combines contemporary fruit ingredients with the perfumer\'s classic palette of white flowers. The scent opens with sparkling bergamot and mandarin blended with notes of lychee and peach.', 6, 1, 0),
(12, 'Armani Prive the Yulong', 'prive-the-yulong-armani.jpg', 'Thé Yulong by Giorgio Armani is a Aromatic Green fragrance for women and men. This is a new fragrance. Thé Yulong was launched in 2020. The nose behind this fragrance is Julie Masse. Top notes are Mandarin Orange, Cardamom and Petitgrain; middle notes are Green Tea, Black Tea, Jasmine and Orange Blossom; base notes are Vetiver, Ambrette (Musk Mallow) and iris.', 2, 3, 0),
(13, 'Tom Ford Oud Wood', 'tom-ford-our-wood.png', 'Oud Wood by Tom Ford is a Amber Woody fragrance for women and men. Oud Wood was launched in 2007. The nose behind this fragrance is Richard Herpin. A composition of exotic, smoky woods including rare oud, sandalwood, rosewood, eastern spices, and sensual amber—revealing oud‘s rich and compelling power. Smoky, incense-filled temples and a passion for rare, precious oud wood inspire TOM FORD‘s pioneering composition of exotic woods and spices.', 4, 3, 0),
(14, 'Ebene Fume Eau de Parfum', 'tom-ford-ebene.png', 'Ébène Fumé by Tom Ford is a Amber Woody fragrance for women and men. This is a new fragrance, it was launched in 2021. Ébène Fumé merges the purifying essence of Palo Santo with notes of seductive ebony wood, arousing exquisite calm and heightened spiritual luxury. | „I wanted a scent that captured a meditative feeling. Ébène Fumé has an almost spiritual sensuality that uplifts your mood…which might be the most seductive indulgence of all.” — Tom Ford', 4, 3, 0),
(15, 'GABRIELLE CHANEL', 'gabrielle-chanel.png', 'Gabrielle by Chanel is a Floral fragrance for women. Gabrielle was launched in 2017. The nose behind this fragrance is Olivier Polge. GABRIELLE CHANEL Eau de Parfum is a luminous, airy composition. It is a pure floral composed around four flowers: exotic and intense jasmine, radiant and fruity ylang-ylang, fresh and sparkling orange blossom, and creamy, highly feminine Grasse tuberose.', 1, 2, 0),
(16, 'BURBERRY London for Men', 'burberry-london.jpg', 'This sophisticated cologne features top notes of bergamot, lavender, and warm cinnamon, artfully balanced with heart notes of mimosa flower and rich leather. Lower tones combine tobacco leaves and oak moss for a deep, elegant, and stylish cologne which celebrates the city of London and its distinctive style. | The glass bottle is wrapped in iconic BURBERRY check fabric, echoing the idea that London customers are drawn to fine tailoring fabrics. This fragrance was created for a modern English gentleman who appreciates fine tailoring— from bespoke suits to classic chesterfield coats. It‘s a fougère, spicy scent with a sartorial elegance. The base note of opoponax, has a warm-balsamic, honey-like aroma, a component of incense and perfumes for centuries.', 5, 1, 0),
(17, 'BURBERRY Brit', 'burberry-brit.png', 'A fresh, oriental scent inspired by the British man. It is a sharp, woody cologne, warm and spicy with notes of ginger blended with cedar wood and tonka bean. This iconic Brit glass bottle design is instantly recognizable with the Brit check applied onto the transparent glass. It was designed by Fabien Baron. The spirit of Burberry Brit for Men is free-spirited and laid-back, with a confidence that comes from authenticity and effortless style.', 5, 1, 0),
(18, 'K by Dolce & Gabbana', 'dolce-gabbana-k.png', 'This Mediterranean woody aromatic respects traditions while embracing modernity. The citrus freshness of blood orange and Sicilian lemon scent embrace the senses. Heart notes ignite the citruses with the amber accents of clary sage, married with crisp geranium and energizing lavandin. | An unexpected spark of fiery pimento essence gives to K by Dolce&Gabbana a strong personality. Then comes the sensuality of cedarwood, blended with two elegant and masculine ingredients: green vetiver and patchouli. K by Dolce&Gabbana is a blazing, charismatic trail of lingering seduction.', 6, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `perfume_milliliters`
--

CREATE TABLE `perfume_milliliters` (
  `id_perfume` int(255) NOT NULL,
  `id_mil` int(20) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `perfume_milliliters`
--

INSERT INTO `perfume_milliliters` (`id_perfume`, `id_mil`, `price`) VALUES
(1, 1, 90.00),
(1, 2, 116.00),
(1, 3, 146.00),
(2, 1, 85.00),
(2, 2, 112.00),
(2, 3, 142.00),
(3, 1, 107.00),
(7, 2, 142.00),
(3, 3, 183.00),
(4, 1, 65.00),
(4, 2, 88.00),
(4, 3, 118.00),
(5, 1, 78.00),
(5, 2, 100.00),
(5, 3, 132.00),
(6, 1, 71.00),
(6, 3, 100.00),
(7, 1, 195.00),
(7, 3, 335.00),
(8, 1, 120.00),
(8, 3, 178.00),
(9, 1, 105.00),
(9, 3, 133.00),
(10, 1, 98.00),
(11, 1, 74.00),
(11, 2, 94.00),
(11, 3, 125.00),
(12, 1, 195.00),
(12, 3, 335.00),
(13, 1, 163.00),
(13, 2, 270.00),
(13, 3, 365.00),
(14, 1, 163.00),
(14, 2, 270.00),
(13, 3, 365.00),
(15, 1, 90.00),
(15, 2, 116.00),
(15, 3, 146.00),
(16, 1, 80.00),
(16, 3, 98.00),
(17, 1, 84.00),
(17, 3, 105.00),
(18, 1, 78.00),
(18, 3, 107.00);

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `id_picture` int(255) NOT NULL,
  `id_perfume` int(255) NOT NULL,
  `src` varchar(50) NOT NULL,
  `alt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`id_picture`, `id_perfume`, `src`, `alt`) VALUES
(1, 9, 'burberry-her-product.png', 'Burberry Her Eau de Parfum'),
(2, 3, 'acqua-armani-absolu.jpg', 'Acqua Di Gio Absolu'),
(3, 1, 'chanel-coco-mademoiselle.png', 'Coco Mademoiselle Eau de Parfum'),
(4, 4, 'hypnotic-poison-product.jpg', 'Hypnotic Poison Eau de Toilette');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(10) NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `label`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password_user` text NOT NULL,
  `id_role` int(10) NOT NULL,
  `date_reg` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `first_name`, `last_name`, `email`, `password_user`, `id_role`, `date_reg`) VALUES
(1, 'Jovana', 'Paunovic', 'admin@gmail.com', 'df62b48c0305bdc4d1109175664c8690', 1, '2025-03-04 13:58:22'),
(9, 'Ruby', 'Williams', 'ruby.williams@gmail.com', 'e1f85ff03045bdf829f9b235e2d9a4c8', 2, '2025-03-04 13:58:22'),
(10, 'Diana', 'Tillman', 'diana123@mailinator.com', 'b6b3a8fba6bee3a32deffd2ec8408969', 2, '2025-03-04 13:58:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id_basket`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `basket_perfumes`
--
ALTER TABLE `basket_perfumes`
  ADD KEY `id_basket` (`id_basket`),
  ADD KEY `id_perfume` (`id_perfume`),
  ADD KEY `id_mil` (`id_mil`),
  ADD KEY `id_basket_2` (`id_basket`),
  ADD KEY `id_perfume_2` (`id_perfume`),
  ADD KEY `id_mil_2` (`id_mil`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`);

--
-- Indexes for table `milliliters`
--
ALTER TABLE `milliliters`
  ADD PRIMARY KEY (`id_mil`);

--
-- Indexes for table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`id_nav`);

--
-- Indexes for table `nav_role`
--
ALTER TABLE `nav_role`
  ADD KEY `id_role` (`id_role`),
  ADD KEY `id_nav` (`id_nav`);

--
-- Indexes for table `perfume`
--
ALTER TABLE `perfume`
  ADD PRIMARY KEY (`id_perfume`),
  ADD KEY `id_brand` (`id_brand`),
  ADD KEY `id_categio` (`id_category`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `perfume_milliliters`
--
ALTER TABLE `perfume_milliliters`
  ADD KEY `id_perfume` (`id_perfume`),
  ADD KEY `id_mil` (`id_mil`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id_picture`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id_basket` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id_brand` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `milliliters`
--
ALTER TABLE `milliliters`
  MODIFY `id_mil` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `id_nav` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `perfume`
--
ALTER TABLE `perfume`
  MODIFY `id_perfume` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `id_picture` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `basket_perfumes`
--
ALTER TABLE `basket_perfumes`
  ADD CONSTRAINT `basket_perfumes_ibfk_1` FOREIGN KEY (`id_perfume`) REFERENCES `perfume` (`id_perfume`),
  ADD CONSTRAINT `basket_perfumes_ibfk_2` FOREIGN KEY (`id_basket`) REFERENCES `basket` (`id_basket`),
  ADD CONSTRAINT `basket_perfumes_ibfk_3` FOREIGN KEY (`id_mil`) REFERENCES `milliliters` (`id_mil`);

--
-- Constraints for table `nav_role`
--
ALTER TABLE `nav_role`
  ADD CONSTRAINT `nav_role_ibfk_1` FOREIGN KEY (`id_nav`) REFERENCES `navigation` (`id_nav`),
  ADD CONSTRAINT `nav_role_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Constraints for table `perfume`
--
ALTER TABLE `perfume`
  ADD CONSTRAINT `perfume_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`),
  ADD CONSTRAINT `perfume_ibfk_2` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id_brand`);

--
-- Constraints for table `perfume_milliliters`
--
ALTER TABLE `perfume_milliliters`
  ADD CONSTRAINT `perfume_milliliters_ibfk_1` FOREIGN KEY (`id_perfume`) REFERENCES `perfume` (`id_perfume`),
  ADD CONSTRAINT `perfume_milliliters_ibfk_2` FOREIGN KEY (`id_mil`) REFERENCES `milliliters` (`id_mil`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
