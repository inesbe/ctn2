-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 19 août 2021 à 10:16
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ctn`
--

-- --------------------------------------------------------

--
-- Structure de la table `bureaucitoyen`
--

CREATE TABLE `bureaucitoyen` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationalite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codepostale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chassis`
--

CREATE TABLE `chassis` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule_chassis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metre_linaire` int(11) DEFAULT NULL,
  `largeur` int(11) DEFAULT NULL,
  `hauteur` int(11) DEFAULT NULL,
  `tare` int(11) DEFAULT NULL,
  `numero_plomb` int(11) DEFAULT NULL,
  `date_changement` date DEFAULT NULL,
  `date_enlevment` date DEFAULT NULL,
  `nature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nb_unite` int(11) DEFAULT NULL,
  `temeprature` int(11) DEFAULT NULL,
  `poids_brute` int(11) DEFAULT NULL,
  `unite_payante` int(11) DEFAULT NULL,
  `nb_colis` int(11) DEFAULT NULL,
  `poids_unitaire` int(11) DEFAULT NULL,
  `marchandises` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emballage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_destinataire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postale` int(11) DEFAULT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bl` int(11) DEFAULT NULL,
  `etat_bl` tinyint(1) DEFAULT NULL,
  `etat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chassis`
--

INSERT INTO `chassis` (`id`, `reservation_id`, `user_id`, `type`, `ref`, `matricule_chassis`, `metre_linaire`, `largeur`, `hauteur`, `tare`, `numero_plomb`, `date_changement`, `date_enlevment`, `nature`, `nb_unite`, `temeprature`, `poids_brute`, `unite_payante`, `nb_colis`, `poids_unitaire`, `marchandises`, `emballage`, `nom_destinataire`, `adresse`, `code_postale`, `pays`, `ville`, `remarque`, `bl`, `etat_bl`, `etat`) VALUES
(29, 31, 1, 'AMBULANCE', NULL, 'Ch8217', 4, 45, 15, 5, NULL, '2021-08-05', '2021-08-21', 'Dangereux', NULL, 456, NULL, NULL, 45, 1561, 'dazd', '', 'azdaz', 'zdadz', 7050, 'tunisie', 'dzadza', 'zadazdazd', 4075726, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `offres_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ferme` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires_media`
--

CREATE TABLE `commentaires_media` (
  `id` int(11) NOT NULL,
  `medias_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `commentaire_med` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `condition_utilisation`
--

CREATE TABLE `condition_utilisation` (
  `id` int(11) NOT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `connaissement`
--

CREATE TABLE `connaissement` (
  `id` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `bl` int(11) NOT NULL,
  `conditions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `connaissement`
--

INSERT INTO `connaissement` (`id`, `id_reservation`, `id_utilisateur`, `bl`, `conditions`) VALUES
(8, 1, 1, 1601920, 'Quai'),
(9, 1, 1, 4075726, 'Quai');

-- --------------------------------------------------------

--
-- Structure de la table `conteneur`
--

CREATE TABLE `conteneur` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_plomb` int(11) DEFAULT NULL,
  `date_chargement` date DEFAULT NULL,
  `date_enlevement` date DEFAULT NULL,
  `poids_tare` int(11) DEFAULT NULL,
  `poids_brute` int(11) DEFAULT NULL,
  `unite_payante` int(11) DEFAULT NULL,
  `nb_colis` int(11) DEFAULT NULL,
  `temperature` int(11) DEFAULT NULL,
  `prorietaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bl` int(11) DEFAULT NULL,
  `etat` int(11) DEFAULT NULL,
  `bl_etat` tinyint(1) DEFAULT NULL,
  `num_container` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `conteneur`
--

INSERT INTO `conteneur` (`id`, `reservation_id`, `user_id`, `type`, `ref`, `num_plomb`, `date_chargement`, `date_enlevement`, `poids_tare`, `poids_brute`, `unite_payante`, `nb_colis`, `temperature`, `prorietaire`, `bl`, `etat`, `bl_etat`, `num_container`) VALUES
(55, 30, 1, 'Standar40', 'c4567', 15464, '2021-08-14', '2021-08-04', 456, 456, 156, 4, 156, 'hamma', 1601920, 1, 1, 9491),
(56, 31, 1, 'AMBULANCE', NULL, 4564, '2021-08-17', '2021-08-17', 1561, 456, 45, 4, 61, 'hamma', 4075726, 1, 1, 3138);

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `id` int(11) NOT NULL,
  `date_expiration` date NOT NULL,
  `max_cont` int(11) NOT NULL,
  `max_vrac` int(11) NOT NULL,
  `max_roulant` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210707121719', '2021-07-07 14:17:59', 770),
('DoctrineMigrations\\Version20210710180031', '2021-07-10 20:01:09', 582),
('DoctrineMigrations\\Version20210710180538', '2021-07-10 20:05:49', 766),
('DoctrineMigrations\\Version20210710180714', '2021-07-10 20:07:23', 434),
('DoctrineMigrations\\Version20210711193834', '2021-07-11 21:38:53', 867),
('DoctrineMigrations\\Version20210711194047', '2021-07-11 21:41:09', 821),
('DoctrineMigrations\\Version20210712155946', '2021-07-12 17:59:58', 1096),
('DoctrineMigrations\\Version20210712161401', '2021-07-12 18:14:11', 621),
('DoctrineMigrations\\Version20210712162900', '2021-07-12 18:29:10', 1348),
('DoctrineMigrations\\Version20210713132656', '2021-07-13 15:29:51', 946),
('DoctrineMigrations\\Version20210716121419', '2021-07-16 14:14:35', 6893),
('DoctrineMigrations\\Version20210730150723', '2021-08-02 13:35:10', 18926),
('DoctrineMigrations\\Version20210731135757', '2021-08-02 13:35:30', 1164),
('DoctrineMigrations\\Version20210802152903', '2021-08-19 00:50:19', 167),
('DoctrineMigrations\\Version20210802154118', '2021-08-19 00:50:46', 119),
('DoctrineMigrations\\Version20210807141606', '2021-08-15 23:44:13', 821),
('DoctrineMigrations\\Version20210807142522', '2021-08-15 23:44:14', 124),
('DoctrineMigrations\\Version20210807144719', '2021-08-15 23:44:14', 459),
('DoctrineMigrations\\Version20210811142036', '2021-08-15 23:44:15', 121),
('DoctrineMigrations\\Version20210812154033', '2021-08-15 23:44:15', 291),
('DoctrineMigrations\\Version20210815214403', '2021-08-16 00:43:06', 404),
('DoctrineMigrations\\Version20210815231441', '2021-08-16 01:15:51', 157),
('DoctrineMigrations\\Version20210816011746', '2021-08-16 03:17:58', 735),
('DoctrineMigrations\\Version20210816011929', '2021-08-16 03:19:39', 175),
('DoctrineMigrations\\Version20210816013143', '2021-08-16 03:31:53', 224),
('DoctrineMigrations\\Version20210818222536', '2021-08-19 02:31:39', 11171),
('DoctrineMigrations\\Version20210819004824', '2021-08-19 02:48:36', 173),
('DoctrineMigrations\\Version20210819005235', '2021-08-19 02:53:12', 456),
('DoctrineMigrations\\Version20210819011032', '2021-08-19 03:11:21', 194),
('DoctrineMigrations\\Version20210819012150', '2021-08-19 03:21:57', 605),
('DoctrineMigrations\\Version20210819012444', '2021-08-19 03:24:50', 481),
('DoctrineMigrations\\Version20210819013506', '2021-08-19 03:35:12', 279),
('DoctrineMigrations\\Version20210819014855', '2021-08-19 03:49:01', 666),
('DoctrineMigrations\\Version20210819041307', '2021-08-19 06:13:19', 362);

-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_pdf` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `guest`
--

CREATE TABLE `guest` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_pratique`
--

CREATE TABLE `info_pratique` (
  `id` int(11) NOT NULL,
  `recommandations` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recoepargne` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reconecessaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `info_service`
--

CREATE TABLE `info_service` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ligne`
--

CREATE TABLE `ligne` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `medias`
--

CREATE TABLE `medias` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offres`
--

CREATE TABLE `offres` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_release` date DEFAULT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_resultat` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result_rel_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `quota`
--

CREATE TABLE `quota` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `companie` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demande` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationalite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codepostal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Marchandise','Passager') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_min` date NOT NULL,
  `date_max` date NOT NULL,
  `date_exacte` date DEFAULT NULL,
  `valide` tinyint(1) DEFAULT NULL,
  `confirme` tinyint(1) DEFAULT NULL,
  `tarif` double DEFAULT NULL,
  `port_arrive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reservation_text` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archive` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `user_id`, `date_min`, `date_max`, `date_exacte`, `valide`, `confirme`, `tarif`, `port_arrive`, `reservation_text`, `archive`) VALUES
(30, 1, '2021-08-04', '2021-08-20', '2021-08-17', 1, 1, NULL, 'dzadazd', 'Bonjour, J\'amerais reserver vers dzadazd, dans un intervale de temps de 2021-08-04 jusqu\'à 2021-08-20 : Conteneur de type Stadard20, benamorines', NULL),
(31, 1, '2021-08-19', '2021-08-24', NULL, NULL, NULL, NULL, 'zadzaazd', 'Bonjour, J\'amerais reserver vers zadzaazd, dans un intervale de temps de 2021-08-19 jusqu\'à 2021-08-24 : Conteneur de type Stadard20,  Chassis de type semi, benamorines', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `rotation`
--

CREATE TABLE `rotation` (
  `id` int(11) NOT NULL,
  `nom_navire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `port_depart` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_depart` date NOT NULL,
  `port_arrive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_arrive` date NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_ligne` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `langue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `societe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typesociete` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complementadresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codepostal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tva` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collegue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` tinyint(1) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `langue`, `email`, `password`, `prenom`, `nom`, `telephone`, `societe`, `typesociete`, `adresse`, `complementadresse`, `ville`, `codepostal`, `pays`, `tva`, `collegue`, `etat`, `is_verified`, `token`, `role`, `image`, `role_admin`) VALUES
(1, 'Français', 'ines.benamor@esprit.tn', '$2y$13$Admru9wxIMpoW5yur80Vp./m5YwXD.iPls2Psj4HW9yyEpJW6TTaK', 'ines', 'benamor', '22276831', 'esprit', 'Agent d Etat', 'klibia', 'ariana', 'klibia', '7164', 'ALGERIA', '24561', NULL, 1, 0, '551298ae1c57c8d35f127cc02720bcad', 0, '208259282_341882204249516_6777423330012412289_n.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `vrac`
--

CREATE TABLE `vrac` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vrack`
--

CREATE TABLE `vrack` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_emballage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marchandises` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nb_colis` int(11) DEFAULT NULL,
  `poids_brute` int(11) DEFAULT NULL,
  `poids_unitaire` int(11) DEFAULT NULL,
  `nom_destinataire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_postale` int(11) DEFAULT NULL,
  `pays` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule_vrac` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bl` int(11) DEFAULT NULL,
  `etat` int(11) DEFAULT NULL,
  `etat_bl` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bureaucitoyen`
--
ALTER TABLE `bureaucitoyen`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chassis`
--
ALTER TABLE `chassis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_35C973DFB83297E7` (`reservation_id`),
  ADD KEY `IDX_35C973DFA76ED395` (`user_id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D9BEC0C4A76ED395` (`user_id`),
  ADD KEY `IDX_D9BEC0C46C83CD9F` (`offres_id`),
  ADD KEY `IDX_D9BEC0C49A4AA658` (`guest_id`);

--
-- Index pour la table `commentaires_media`
--
ALTER TABLE `commentaires_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FC8DCEFFC7F4A74B` (`medias_id`),
  ADD KEY `IDX_FC8DCEFFA76ED395` (`user_id`),
  ADD KEY `IDX_FC8DCEFF9A4AA658` (`guest_id`);

--
-- Index pour la table `condition_utilisation`
--
ALTER TABLE `condition_utilisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `connaissement`
--
ALTER TABLE `connaissement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `conteneur`
--
ALTER TABLE `conteneur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E9628FD2B83297E7` (`reservation_id`),
  ADD KEY `IDX_E9628FD2A76ED395` (`user_id`);

--
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `info_pratique`
--
ALTER TABLE `info_pratique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `info_service`
--
ALTER TABLE `info_service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ligne`
--
ALTER TABLE `ligne`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `quota`
--
ALTER TABLE `quota`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_42C84955A76ED395` (`user_id`);

--
-- Index pour la table `rotation`
--
ALTER TABLE `rotation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `vrac`
--
ALTER TABLE `vrac`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vrack`
--
ALTER TABLE `vrack`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AC23ABC6B83297E7` (`reservation_id`),
  ADD KEY `IDX_AC23ABC6A76ED395` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bureaucitoyen`
--
ALTER TABLE `bureaucitoyen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chassis`
--
ALTER TABLE `chassis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commentaires_media`
--
ALTER TABLE `commentaires_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `condition_utilisation`
--
ALTER TABLE `condition_utilisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `connaissement`
--
ALTER TABLE `connaissement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `conteneur`
--
ALTER TABLE `conteneur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `info_pratique`
--
ALTER TABLE `info_pratique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `info_service`
--
ALTER TABLE `info_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligne`
--
ALTER TABLE `ligne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `medias`
--
ALTER TABLE `medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `offres`
--
ALTER TABLE `offres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `quota`
--
ALTER TABLE `quota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `rotation`
--
ALTER TABLE `rotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `vrac`
--
ALTER TABLE `vrac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vrack`
--
ALTER TABLE `vrack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chassis`
--
ALTER TABLE `chassis`
  ADD CONSTRAINT `FK_35C973DFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_35C973DFB83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `FK_D9BEC0C46C83CD9F` FOREIGN KEY (`offres_id`) REFERENCES `offres` (`id`),
  ADD CONSTRAINT `FK_D9BEC0C49A4AA658` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`id`),
  ADD CONSTRAINT `FK_D9BEC0C4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `commentaires_media`
--
ALTER TABLE `commentaires_media`
  ADD CONSTRAINT `FK_FC8DCEFF9A4AA658` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`id`),
  ADD CONSTRAINT `FK_FC8DCEFFA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_FC8DCEFFC7F4A74B` FOREIGN KEY (`medias_id`) REFERENCES `medias` (`id`);

--
-- Contraintes pour la table `conteneur`
--
ALTER TABLE `conteneur`
  ADD CONSTRAINT `FK_E9628FD2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_E9628FD2B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C84955A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `vrack`
--
ALTER TABLE `vrack`
  ADD CONSTRAINT `FK_AC23ABC6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_AC23ABC6B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
