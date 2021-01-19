-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 19, 2021 at 06:49 PM
-- Server version: 5.5.68-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grandgi24u`
--

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_com` int(100) NOT NULL,
  `id_liste` int(100) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`id_com`, `id_liste`, `nom`, `text`) VALUES
(21, 73, 'Françoise', 'Je te prends le premier cadeau !'),
(29, 1, 'Clément', 'J&#39;espère que tout sera réserver !');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `liste_id` int(11) NOT NULL,
  `nom` text NOT NULL,
  `descr` text,
  `img` text,
  `url` text,
  `tarif` decimal(5,2) DEFAULT NULL,
  `etat` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `liste_id`, `nom`, `descr`, `img`, `url`, `tarif`, `etat`) VALUES
(1, 2, 'Champagne', 'Bouteille de champagne + flutes + jeux à gratter', 'champagne.jpg', '', '20.00', 0),
(2, 2, 'Musique', 'Partitions de piano à 4 mains', 'musique.jpg', '', '25.00', 0),
(3, 2, 'Exposition', 'Visite guidée de l’exposition ‘REGARDER’ à la galerie Poirel', 'poirelregarder.jpg', '', '14.00', 0),
(4, 3, 'Goûter', 'Goûter au FIFNL', 'gouter.jpg', '', '20.00', 0),
(5, 3, 'Projection', 'Projection courts-métrages au FIFNL', 'film.jpg', '', '10.00', 0),
(6, 2, 'Bouquet', 'Bouquet de roses et Mots de Marion Renaud', 'rose.jpg', '', '16.00', 0),
(7, 2, 'Diner Stanislas', 'Diner à La Table du Bon Roi Stanislas (Apéritif /Entrée / Plat / Vin / Dessert / Café / Digestif)', 'bonroi.jpg', '', '60.00', 0),
(8, 3, 'Origami', 'Baguettes magiques en Origami en buvant un thé', 'origami.jpg', '', '12.00', 0),
(9, 3, 'Livres', 'Livre bricolage avec petits-enfants + Roman', 'livres.jpg', '', '24.00', 0),
(10, 2, 'Diner  Grand Rue ', 'Diner au Grand’Ru(e) (Apéritif / Entrée / Plat / Vin / Dessert / Café)', 'grandrue.jpg', '', '59.00', 0),
(11, 0, 'Visite guidée', 'Visite guidée personnalisée de Saint-Epvre jusqu’à Stanislas', 'place.jpg', '', '11.00', 0),
(12, 2, 'Bijoux', 'Bijoux de manteau + Sous-verre pochette de disque + Lait après-soleil', 'bijoux.jpg', '', '29.00', 0),
(19, 0, 'Jeu contacts', 'Jeu pour échange de contacts', 'contact.png', '', '5.00', 0),
(22, 0, 'Concert', 'Un concert à Nancy', 'concert.jpg', '', '17.00', 0),
(23, 1, 'Appart Hotel', 'Appart’hôtel Coeur de Ville, en plein centre-ville', 'apparthotel.jpg', '', '56.00', 0),
(24, 2, 'Hôtel d\'Haussonville', 'Hôtel d\'Haussonville, au coeur de la Vieille ville à deux pas de la place Stanislas', 'hotel_haussonville_logo.jpg', '', '169.00', 0),
(25, 1, 'Boite de nuit', 'Discothèque, Boîte tendance avec des soirées à thème & DJ invités', 'boitedenuit.jpg', '', '32.00', 1),
(26, 1, 'Planètes Laser', 'Laser game : Gilet électronique et pistolet laser comme matériel, vous voilà équipé.', 'laser.jpg', '', '15.00', 0),
(27, 1, 'Fort Aventure', 'Découvrez Fort Aventure à Bainville-sur-Madon, un site Accropierre unique en Lorraine ! Des Parcours Acrobatiques pour petits et grands, Jeu Mission Aventure, Crypte de Crapahute, Tyrolienne, Saut à l&#39;élastique inversé, Toboggan géant... et bien plus encore.', 'fort.jpg', '', '26.00', 0),
(92, 93, 'Guitare', 'Une petite guitare pour vous jouer de beaux morceaux', 'cl44-nat-hd-10-117538.jpg', '', '150.00', 1),
(93, 93, 'Raquette', 'Une sortie raquette avec ma copine à la montagne', 'comment-marcher-raquettes-neige-7020.jpg', '', '20.00', 0),
(94, 94, 'Bateau mouche', 'Un petit trajet romantique en bateau mouche', 'Bateau-Mouche-Galere.jpg', '', '25.00', 0),
(95, 94, 'Train', 'Les billets de trains', 'billets-de-train-1-euro-region-hauts-de-france-ete.jpg', '', '80.00', 0),
(96, 94, 'Musée ', 'Visite du musée d&#39;histoire naturel', 'orleans-val-de-loire-tourisme-85.jpg', '', '15.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `liste`
--

CREATE TABLE `liste` (
  `no` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `expiration` date DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tokenModif` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `acces` varchar(8) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'private'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `liste`
--

INSERT INTO `liste` (`no`, `user_id`, `titre`, `description`, `expiration`, `token`, `tokenModif`, `acces`) VALUES
(1, 2, 'Pour fêter le bac !', 'Pour un week-end à Nancy qui nous fera oublier les épreuves. ', '2021-06-27', '7879ba959514c256dc19', 'cebbce73b81108f31311', 'public'),
(2, 2, 'Liste de mariage d&#39;Alice et Bob', 'Nous souhaitons passer un week-end royal à Nancy pour notre lune de miel :)', '2021-06-30', 'cebbce73111108f31311', '787adn14z314c256dc19', 'public'),
(3, 2, 'C\'est l\'anniversaire de Charlie', 'Pour lui préparer une fête dont il se souviendra :)', '2020-12-12', 'cebazdd5264108f31311', '781521959514c256dc19', 'private'),
(93, 14, 'Anniversaire', 'Petite liste pour mon anniversaire ! Merci à tous les participants', '2021-02-06', '81156765a2e34cc6ac9b', '40a0bc8bd395fbbad66e', 'public'),
(94, 2, 'Voyage a paris', 'Voyage a paris pour les 20 ans de mariages avec ma femme', '2021-01-17', '31e7bcae5cbae303818d', '812cadf98b7eec646b2a', 'public');

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `id_participation` int(10) NOT NULL,
  `id_item` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`id_participation`, `id_item`, `id_user`, `nom`, `commentaire`) VALUES
(7, 25, 14, 'GRANDGIRARD', 'On ira ensemble ;)'),
(8, 92, 2, 'admin', 'Hate de te voir en jouer ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `login` varchar(250) NOT NULL,
  `pass` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `login`, `pass`) VALUES
(2, 'admin', 'admin', 'admin', '$2y$10$DcCXQKVku4bnJRqb9BbDxOhBBeJ3UlmLSRP7jZ8HRVm/rxH4xz7ca'),
(14, 'GRANDGIRARD', 'Clément', 'grandgi24u', '$2y$10$A9Plk334jWdmkdJOPIlGWezlCzi5Nwcklf8u3wlU3MscUwm3BteeS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_com`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liste`
--
ALTER TABLE `liste`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id_participation`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_com` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `liste`
--
ALTER TABLE `liste`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `participation`
--
ALTER TABLE `participation`
  MODIFY `id_participation` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
