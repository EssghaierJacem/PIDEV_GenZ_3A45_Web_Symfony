-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2024 at 09:16 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bb_genz`
--

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `note` int(11) DEFAULT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `date_publication` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`id`, `user_id`, `note`, `commentaire`, `date_publication`) VALUES
(1, 1, 4, 'Great experience, would highly recommend!', '2024-02-15'),
(2, 2, 5, 'Absolutely fantastic service and hospitality.', '2024-02-14'),
(3, 3, 3, 'Decent, but could improve in some areas.', '2024-02-16'),
(4, 4, 4, 'Enjoyed my stay, staff was friendly.', '2024-02-13'),
(5, 5, 2, 'Disappointing, wouldn\'t visit again.', '2024-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `categorie_h`
--

CREATE TABLE `categorie_h` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorie_h`
--

INSERT INTO `categorie_h` (`id`, `type`, `description`) VALUES
(1, 'Hotel', 'Accommodation with various amenities'),
(2, 'Hostel', 'Budget-friendly lodging for travelers'),
(3, 'Resort', 'Luxurious lodging with recreational facilities'),
(4, 'Guesthouse', 'Cozy accommodation typically run by locals'),
(5, 'Motel', 'Convenient stopover lodging for road travelers');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `num_commande` varchar(255) DEFAULT NULL,
  `prix` double DEFAULT NULL,
  `code_promo` varchar(255) DEFAULT NULL,
  `type_paiement` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date_commande` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id`, `num_commande`, `prix`, `code_promo`, `type_paiement`, `email`, `date_commande`) VALUES
(1, 'CMD123', 100.5, 'DISCOUNT20', 'Credit Card', 'example1@example.com', '2024-02-15'),
(2, 'CMD124', 75.25, NULL, 'PayPal', 'example2@example.com', '2024-02-16'),
(3, 'CMD125', 200, 'SPRINGSALE', 'Credit Card', 'example3@example.com', '2024-02-14'),
(4, 'CMD126', 50.75, NULL, 'Credit Card', 'example4@example.com', '2024-02-13'),
(5, 'CMD127', 150, NULL, 'Bank Transfer', 'example5@example.com', '2024-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id` int(11) NOT NULL,
  `pays` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `attractions` varchar(255) DEFAULT NULL,
  `accomodation` varchar(255) DEFAULT NULL,
  `devise` varchar(255) NOT NULL,
  `multimedia` varchar(255) DEFAULT NULL,
  `accessibilite` tinyint(1) DEFAULT NULL,
  `cuisine_locale` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `pays`, `ville`, `description`, `attractions`, `accomodation`, `devise`, `multimedia`, `accessibilite`, `cuisine_locale`) VALUES
(1, 'France', 'Paris', 'City of Love and Lights', 'Eiffel Tower, Louvre Museum', 'Hotels, Guesthouses', 'EUR', 'https://www.paris.fr', 1, 'French'),
(2, 'Italy', 'Rome', 'Eternal City rich in history', 'Colosseum, Vatican City', 'Hotels, Hostels', 'EUR', 'https://www.rome.info', 1, 'Italian'),
(3, 'Japan', 'Tokyo', 'Modern metropolis with traditional roots', 'Shibuya Crossing, Senso-ji Temple', 'Hotels, Ryokans', 'JPY', 'https://www.tourismtokyo.jp', 1, 'Japanese'),
(4, 'USA', 'New York City', 'The Big Apple', 'Statue of Liberty, Times Square', 'Hotels, Apartments', 'USD', 'https://www.nycgo.com', 1, 'American'),
(5, 'Thailand', 'Bangkok', 'City of Angels', 'Grand Palace, Wat Arun', 'Hotels, Resorts', 'THB', 'https://www.tourismthailand.org', 1, 'Thai');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240216200736', '2024-02-16 21:07:48', 13760);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `organisateur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `nom`, `date_debut`, `date_fin`, `lieu`, `description`, `organisateur`) VALUES
(1, 'Music Festival', '2024-07-10', '2024-07-12', 'Coachella Valley', 'Annual music and arts festival', 'Goldenvoice'),
(2, 'Tech Conference', '2024-05-20', '2024-05-22', 'Moscone Center', 'Gathering of tech enthusiasts and professionals', 'TechCrunch'),
(3, 'Food Expo', '2024-09-05', '2024-09-08', 'Jacob K. Javits Convention Center', 'Showcasing culinary delights from around the world', 'Food Network'),
(4, 'Fashion Week', '2024-02-28', '2024-03-06', 'Various locations in Paris', 'Premier event for the fashion industry', 'Vogue'),
(5, 'Film Festival', '2024-08-15', '2024-08-25', 'Cannes, France', 'Celebrating the art of cinema', 'Festival de Cannes');

-- --------------------------------------------------------

--
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nationalite` varchar(255) DEFAULT NULL,
  `langues_parlees` varchar(255) DEFAULT NULL,
  `experiences` varchar(255) DEFAULT NULL,
  `tarif_horaire` double DEFAULT NULL,
  `num_tel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guide`
--

INSERT INTO `guide` (`id`, `nom`, `prenom`, `nationalite`, `langues_parlees`, `experiences`, `tarif_horaire`, `num_tel`) VALUES
(1, 'Smith', 'John', 'American', 'English, French', '10 years as a tour guide in Paris', 50, 123456789),
(2, 'Garcia', 'Maria', 'Spanish', 'Spanish, English', 'Specializes in cultural tours in Barcelona', 40, 987654321),
(3, 'Yamamoto', 'Takeshi', 'Japanese', 'Japanese, English', 'Experienced guide for tours in Kyoto', 45, 234567890),
(4, 'Rossi', 'Giulia', 'Italian', 'Italian, English', 'Expert in historical tours of Rome', 55, 876543210),
(5, 'Nguyen', 'Linh', 'Vietnamese', 'Vietnamese, English', 'Offers personalized tours in Hanoi', 35, 345678901);

-- --------------------------------------------------------

--
-- Table structure for table `hebergement`
--

CREATE TABLE `hebergement` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `categorie_h_id` int(11) DEFAULT NULL,
  `nom_h` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `nbr_etoile` int(11) DEFAULT NULL,
  `capacite` int(11) NOT NULL,
  `tarif_par_nuit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hebergement`
--

INSERT INTO `hebergement` (`id`, `user_id`, `categorie_h_id`, `nom_h`, `adresse`, `nbr_etoile`, `capacite`, `tarif_par_nuit`) VALUES
(1, 1, 1, 'Luxury Hotel Paris', '123 Avenue des Champs-Élysées, Paris', 5, 100, 250),
(2, 2, 2, 'Budget Hostel Rome', '456 Via Nazionale, Rome', 2, 50, 50),
(3, 3, 3, 'Resort Tokyo', '789 Shinjuku, Tokyo', 4, 200, 300),
(4, 4, 4, 'Cozy Guesthouse New York', '321 Broadway, New York City', 3, 20, 100),
(5, 5, 5, 'Convenient Motel Bangkok', '987 Sukhumvit Road, Bangkok', 2, 30, 75);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `tel` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`id`, `user_id`, `event_id`, `nom`, `prenom`, `tel`, `email`) VALUES
(1, 1, 1, 'John', 'Doe', 123456789, 'john@example.com'),
(2, 2, 2, 'Jane', 'Doe', 987654321, 'jane@example.com'),
(3, 3, 3, 'Alice', 'Smith', 234567890, 'alice@example.com'),
(4, 4, 4, 'Bob', 'Johnson', 876543210, 'bob@example.com'),
(5, 5, 5, 'Emily', 'Williams', 345678901, 'emily@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `commande_id` int(11) DEFAULT NULL,
  `nom_client` varchar(255) NOT NULL,
  `prenom_client` varchar(255) DEFAULT NULL,
  `num_tel` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `date_reservation` date DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `user_id`, `commande_id`, `nom_client`, `prenom_client`, `num_tel`, `quantite`, `date_reservation`, `qr_code`) VALUES
(1, 1, 1, 'John', 'Doe', 123456789, 2, '2024-02-15', 'ABC123'),
(2, 2, 2, 'Jane', 'Doe', 987654321, 1, '2024-02-16', 'DEF456'),
(3, 3, 3, 'Alice', 'Smith', 234567890, 3, '2024-02-14', 'GHI789'),
(4, 4, 4, 'Bob', 'Johnson', 876543210, 1, '2024-02-13', 'JKL012'),
(5, 5, 5, 'Emily', 'Williams', 345678901, 2, '2024-02-12', 'MNO345');

-- --------------------------------------------------------

--
-- Table structure for table `tournee`
--

CREATE TABLE `tournee` (
  `id` int(11) NOT NULL,
  `destination_id` int(11) DEFAULT NULL,
  `guide_id` int(11) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `duree` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tarif` double DEFAULT NULL,
  `monuments` varchar(255) DEFAULT NULL,
  `tranche_age` varchar(255) DEFAULT NULL,
  `moyen_transport` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tournee`
--

INSERT INTO `tournee` (`id`, `destination_id`, `guide_id`, `nom`, `date_debut`, `duree`, `description`, `tarif`, `monuments`, `tranche_age`, `moyen_transport`) VALUES
(1, 1, 1, 'Paris City Tour', '2024-06-01', '3 days', 'Explore the iconic landmarks of Paris', 500, 'Eiffel Tower, Louvre Museum', 'All ages', 'Bus'),
(2, 2, 2, 'Rome Highlights', '2024-04-15', '2 days', 'Discover the ancient wonders of Rome', 350, 'Colosseum, Vatican City', 'All ages', 'Walking'),
(3, 3, 3, 'Tokyo Cultural Experience', '2024-10-20', '4 days', 'Immerse yourself in Japanese traditions', 700, 'Shibuya Crossing, Senso-ji Temple', 'All ages', 'Train'),
(4, 4, 4, 'New York City Exploration', '2024-03-10', '5 days', 'Experience the hustle and bustle of NYC', 800, 'Statue of Liberty, Times Square', 'All ages', 'Subway'),
(5, 5, 5, 'Bangkok Adventure', '2024-07-05', '3 days', 'Delve into the vibrant culture of Bangkok', 450, 'Grand Palace, Wat Arun', 'All ages', 'Boat');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cin` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`, `cin`, `photo`, `username`, `role`) VALUES
(1, 'Doe', 'John', 'john@example.com', 'password123', 123456789, 'avatar1.jpg', 'john_doe', 'customer'),
(2, 'Doe', 'Jane', 'jane@example.com', 'password456', 987654321, 'avatar2.jpg', 'jane_doe', 'customer'),
(3, 'Smith', 'Alice', 'alice@example.com', 'password789', 234567890, 'avatar3.jpg', 'alice_smith', 'customer'),
(4, 'Johnson', 'Bob', 'bob@example.com', 'password012', 876543210, 'avatar4.jpg', 'bob_johnson', 'customer'),
(5, 'Williams', 'Emily', 'emily@example.com', 'password345', 345678901, 'avatar5.jpg', 'emily_williams', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `user_destination`
--

CREATE TABLE `user_destination` (
  `user_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_destination`
--

INSERT INTO `user_destination` (`user_id`, `destination_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `vol`
--

CREATE TABLE `vol` (
  `id` int(11) NOT NULL,
  `destination_id` int(11) DEFAULT NULL,
  `compagnie_a` varchar(255) NOT NULL,
  `num_vol` int(11) NOT NULL,
  `aeroport_depart` varchar(255) NOT NULL,
  `aeroport_arrivee` varchar(255) NOT NULL,
  `date_depart` date NOT NULL,
  `date_arrivee` date NOT NULL,
  `duree_vol` int(11) NOT NULL,
  `tarif` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vol`
--

INSERT INTO `vol` (`id`, `destination_id`, `compagnie_a`, `num_vol`, `aeroport_depart`, `aeroport_arrivee`, `date_depart`, `date_arrivee`, `duree_vol`, `tarif`) VALUES
(1, 1, 'Air France', 123, 'CDG', 'JFK', '2024-06-01', '2024-06-01', 8, 500),
(2, 2, 'Alitalia', 456, 'FCO', 'LAX', '2024-04-15', '2024-04-15', 10, 350),
(3, 3, 'Japan Airlines', 789, 'HND', 'LHR', '2024-10-20', '2024-10-20', 12, 700),
(4, 4, 'Delta Airlines', 101, 'JFK', 'SFO', '2024-03-10', '2024-03-10', 6, 800),
(5, 5, 'Thai Airways', 112, 'BKK', 'SYD', '2024-07-05', '2024-07-05', 9, 450);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8F91ABF0A76ED395` (`user_id`);

--
-- Indexes for table `categorie_h`
--
ALTER TABLE `categorie_h`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hebergement`
--
ALTER TABLE `hebergement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4852DD9CA76ED395` (`user_id`),
  ADD KEY `IDX_4852DD9C31FF9B85` (`categorie_h_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AB55E24FA76ED395` (`user_id`),
  ADD KEY `IDX_AB55E24F71F7E88B` (`event_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_42C8495582EA2E54` (`commande_id`),
  ADD KEY `IDX_42C84955A76ED395` (`user_id`);

--
-- Indexes for table `tournee`
--
ALTER TABLE `tournee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EBF67D7E816C6140` (`destination_id`),
  ADD KEY `IDX_EBF67D7ED7ED1D4B` (`guide_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_destination`
--
ALTER TABLE `user_destination`
  ADD PRIMARY KEY (`user_id`,`destination_id`),
  ADD KEY `IDX_97DDF73FA76ED395` (`user_id`),
  ADD KEY `IDX_97DDF73F816C6140` (`destination_id`);

--
-- Indexes for table `vol`
--
ALTER TABLE `vol`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_95C97EB816C6140` (`destination_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categorie_h`
--
ALTER TABLE `categorie_h`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `guide`
--
ALTER TABLE `guide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hebergement`
--
ALTER TABLE `hebergement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participation`
--
ALTER TABLE `participation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tournee`
--
ALTER TABLE `tournee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vol`
--
ALTER TABLE `vol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `FK_8F91ABF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `hebergement`
--
ALTER TABLE `hebergement`
  ADD CONSTRAINT `FK_4852DD9C31FF9B85` FOREIGN KEY (`categorie_h_id`) REFERENCES `categorie_h` (`id`),
  ADD CONSTRAINT `FK_4852DD9CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `participation`
--
ALTER TABLE `participation`
  ADD CONSTRAINT `FK_AB55E24F71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `FK_AB55E24FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C8495582EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `FK_42C84955A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `tournee`
--
ALTER TABLE `tournee`
  ADD CONSTRAINT `FK_EBF67D7E816C6140` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`),
  ADD CONSTRAINT `FK_EBF67D7ED7ED1D4B` FOREIGN KEY (`guide_id`) REFERENCES `guide` (`id`);

--
-- Constraints for table `user_destination`
--
ALTER TABLE `user_destination`
  ADD CONSTRAINT `FK_97DDF73F816C6140` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_97DDF73FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vol`
--
ALTER TABLE `vol`
  ADD CONSTRAINT `FK_95C97EB816C6140` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
