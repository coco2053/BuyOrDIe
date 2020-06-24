-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 24 juin 2020 à 08:35
-- Version du serveur :  5.7.21
-- Version de PHP :  7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `buy-or-die`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Disques durs'),
(2, 'Cartes graphiques'),
(3, 'Alimentations'),
(4, 'Disques durs'),
(5, 'Souris'),
(6, 'Souris');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200610114518', '2020-06-10 11:45:34'),
('20200610135310', '2020-06-10 13:53:22'),
('20200612142955', '2020-06-12 14:30:16'),
('20200616142140', '2020-06-16 14:21:50'),
('20200618111103', '2020-06-18 11:11:11'),
('20200618171236', '2020-06-18 17:12:48'),
('20200618174830', '2020-06-18 17:48:38'),
('20200623101802', '2020-06-23 10:25:25');

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` double NOT NULL,
  `discount_price` double DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `discount_price`, `reference`, `brand`, `token`, `category_id`, `stock`) VALUES
(1, 'Geforce 9', 'Carte graphique de l\'enfer', 89, NULL, 'erg46e5g46', 'MSI', NULL, 0, 0),
(2, 'Geforce 10', 'Carte graphique de l\'enfer', 109, NULL, 'tyhfg88', 'Asus', NULL, 0, 0),
(3, 'Geforce 11', 'Carte graphique sympa', 129, NULL, 'NV775', 'Nvidia', NULL, 0, 0),
(4, 'SSD 128 Go', 'disque dur SSD', 109, NULL, '860QVO', 'Samsung', '27cce59e6acdbc61b8c234a76c1df4121b3b1b17b20bee944435f6bb3917a0b2', 0, 0),
(5, 'SSD 128 Go', 'disque dur SSD', 109, NULL, '860QVO', 'Samsung', 'a8fa788da67f0ec60b0f1315020db885333e87014b87199b295741b08fa089f0', 0, 0),
(6, 'SSD 128 Go', 'disque dur SSD', 109, NULL, '860QVO', 'Samsung', '34c7d0f7958f2974ca763003123e629fe71d58c9e761cc3acac56a9ff8ffbdfb', 0, 0),
(7, 'SSD 128 Go', 'blalbala', 109, NULL, 'pgp88', 'Samsung', '20229c300dec9576872a0d9f41d09b39a6fd765542d310aa77cbe74a35e35989', 0, 0),
(8, 'gdfg', 'dyjtyj', 12, NULL, 'etyj', 'MSI', '7b1a024d311ca0e70cf5cbf4a40586dca198d5261ff048cef1b31f3dbeaab62e', 0, 0),
(9, 'MSI', 'utiol', 10, 1, 'eteh', 'uytio', '4be3f8dc3a648ff5931fa7e1a415485e72557b2a4e060fdc642bc8dd33756ce1', 0, 0),
(10, 'zfzf', 'ezrgge', 12, NULL, 'azerg', 'MSI', '1f9a46ece525b5597b577c571afb17c1b7b4445974111c235fe1f8d4eda00ce4', 1, 0),
(11, 'zfzf', 'ezrgge', 12, NULL, 'azerg', 'MSI', '23cde39190f4ea9ee1568d9c73a90fa6cf1f4252d1d255ac530d29c076263693', 1, 0),
(12, 'zfzf', 'ezrgge', 12, NULL, 'azerg', 'MSI', '0384bd41f9adc596acb86116d91e7cb8b2641c655810496ede1d75e47799561c', 4, 0),
(13, 'zfzf', 'ezrgge', 12, NULL, 'azerg', 'MSI', '5457041306f4fc0ba71e82e34fdecd7eef0173570eebb55833173286cc2c440d', 1, 0),
(14, 'zfzf', 'ezrgge', 12, NULL, 'azerg', 'MSI', '9634cbea64292efa3b16c2a13a16b2be665fba772fc4ce5162c59c6a3e8bca34', 5, 0),
(15, 'zfzf', 'ezrgge', 12, NULL, 'azerg', 'MSI', '2e9357cc5236454adcdd1f1451accb1bcbdebd045112b9c57050a64d7c3eefc6', 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `product_image`
--

DROP TABLE IF EXISTS `product_image`;
CREATE TABLE IF NOT EXISTS `product_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64617F034584665A` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `url`, `alt`, `product_token`, `original_name`) VALUES
(1, NULL, 'dde1a27c65ed7642644413d347dff81526 dec 03 001.jpg', NULL, NULL, NULL),
(2, NULL, '9f8bb0d5ba071e0589c5823473731226atelier son 0042.jpg', NULL, NULL, NULL),
(3, NULL, '9fd49f01db6334da6cf7993024f1533bP2060282.JPG', NULL, NULL, NULL),
(4, NULL, 'ec66aa0d328b4ac8e9d6739005131fecP2060279.JPG', NULL, NULL, NULL),
(5, NULL, '2678191af3a05c0512635be64a1f456a30 dec 03 007.jpg', NULL, NULL, NULL),
(6, NULL, '7bf934b8527b42b18635f97187e1b050atelier son 0042.jpg', NULL, NULL, NULL),
(7, NULL, 'c4792741b93da590904b9d58ebd96b321.JPG', NULL, '3c9e07670a9f4cc8f32ec9ce5fff67eab5edafeef42cde40a58e7966fc2a73aa', NULL),
(8, NULL, 'df7ba75a4a0e37a12d07335a1540de2138.JPG', NULL, '3c9e07670a9f4cc8f32ec9ce5fff67eab5edafeef42cde40a58e7966fc2a73aa', NULL),
(9, NULL, '6a8517b10fc687a85823ba733700f1a731.JPG', NULL, '8def443f90604b5d4ba8836108b3f264a9562e7db18077161b40982663fc861f', NULL),
(10, NULL, '29e59184355bcafafab2ebae0893d66dP1070036.JPG', NULL, '8def443f90604b5d4ba8836108b3f264a9562e7db18077161b40982663fc861f', NULL),
(11, NULL, 'fafc418cfac7e251d887ecd405cf49d314.JPG', NULL, 'da5975258c6d32246288d284b5a35358f83b69a30c3bd8bbed815c725df14d0f', NULL),
(12, NULL, 'b1bb5f7f5d107f56bcd020a3d0b3b97d18.JPG', NULL, 'da5975258c6d32246288d284b5a35358f83b69a30c3bd8bbed815c725df14d0f', NULL),
(13, NULL, '81891e1c06a8fe008dfcfaa92ea242e326.JPG', NULL, '207743ae7d339be1d26deb52002e3f3a2f7ff9ca63ffee5ba08b29a73dc5925b', NULL),
(14, NULL, '2cd9a041afdfdc10c2a3ee85eda3170c29.JPG', NULL, '207743ae7d339be1d26deb52002e3f3a2f7ff9ca63ffee5ba08b29a73dc5925b', NULL),
(15, NULL, '96ce8f4425e90aa32808457a681c9ca427.JPG', NULL, '65fc3db465cde52ac5a98e8f9bbf6a733b166ec42ce80b730e414f3a3b62e7da', NULL),
(16, NULL, 'cbc881b46e0331f7f734aa780c9ce38eP1070002.JPG', NULL, '65fc3db465cde52ac5a98e8f9bbf6a733b166ec42ce80b730e414f3a3b62e7da', NULL),
(17, NULL, '3595a29f2a256584815d9f51f9faf4e314.JPG', NULL, '32e21ce14264d22df67fd9b368c6ea93d21638f2c5d6299ddee222aa8b715874', NULL),
(18, NULL, '2afa9867a67787a0afbdaaf50a40db6c19.JPG', NULL, '32e21ce14264d22df67fd9b368c6ea93d21638f2c5d6299ddee222aa8b715874', NULL),
(19, NULL, '45a55df7e0532d2808efff11ce39d92924.JPG', NULL, 'd9cf712ee27c3a9dbdac7200fd660cf29f38321bb2f5555ba2e50f2939280a06', NULL),
(20, NULL, 'a5028a103c4410b6e2d052edde4d499329.JPG', NULL, 'd9cf712ee27c3a9dbdac7200fd660cf29f38321bb2f5555ba2e50f2939280a06', NULL),
(21, 9, '2c4d297423ce50999b73a6705846562fP1070001.JPG', NULL, 'fa4449364708b4c87c9b5354a364a6c2ddf900b73e3ddf252d4b033bcb9b6c4f', NULL),
(22, 9, '13ce71540a402b45dcdb7921b09da36833.JPG', NULL, 'fa4449364708b4c87c9b5354a364a6c2ddf900b73e3ddf252d4b033bcb9b6c4f', NULL),
(23, NULL, 'f5abcf04c326d1ed3737f784cedf4dfc15.JPG', NULL, 'b4165ccc9a1bb45dc5e15e558e5a510c010ef4e08e01db851f4bf37719442774', NULL),
(24, NULL, '5b8c4940abbb1aee0d46a544fc936a7d18.JPG', NULL, 'b4165ccc9a1bb45dc5e15e558e5a510c010ef4e08e01db851f4bf37719442774', NULL),
(25, NULL, '22e3eefa8756df7db55ec1ad9fbfcbad22.JPG', NULL, 'b4165ccc9a1bb45dc5e15e558e5a510c010ef4e08e01db851f4bf37719442774', NULL),
(26, NULL, '04dd670cae4ec2f47ed736fd91ae53f116.JPG', NULL, 'b4165ccc9a1bb45dc5e15e558e5a510c010ef4e08e01db851f4bf37719442774', NULL),
(27, NULL, '364ad090bc3cf9f2d7ce423d88e829e5invoice.jpg', NULL, '469ad1201fd852bbadd89b512c737b6fcc7a4f025e5d08b9af530e873eec4b71', 'invoice.jpg'),
(28, NULL, '62cb990fa8d498271129dabe44bc1fb3champ.png', NULL, 'ebb9298245e0fbcf95826d03c7c05774351104b47674df69fd084e71c82773f4', 'champ.png'),
(29, NULL, '395771503d37b89bff0bf6cb3103b326invoice.jpg', NULL, '6e211ecb2638660c0cc76ad4e008ae16e38e70648deeb6302182843ae3994f4e', 'invoice.jpg'),
(30, NULL, '3e70bf858cf157fd86acff0b892428ecchamp.png', NULL, '6e211ecb2638660c0cc76ad4e008ae16e38e70648deeb6302182843ae3994f4e', 'champ.png'),
(31, NULL, 'acac14c9588b602d4fec83ff45ca33f6pngtree-upload-vector-icon-with-transparent-background-png-image_1836029.jpg', NULL, '57a3f732898746eb04782ebb15b69a23abd570291945f256e036b2d04a869b39', 'pngtree-upload-vector-icon-with-transparent-background-png-image_1836029.jpg'),
(32, NULL, '5205d3cec8ef18a34195bfe44c584749champ.png', NULL, 'ca2d0e3ec8191baab53056d69cf06ad704b46f4917ac1fec744ba255cbd91432', 'champ.png'),
(33, NULL, '2ab8d80f2af73452e0c409fd29d0bab1invoice.jpg', NULL, 'ca2d0e3ec8191baab53056d69cf06ad704b46f4917ac1fec744ba255cbd91432', 'invoice.jpg'),
(34, NULL, '4e48f7e748b635aef63b237806ae1fbdinvoice.jpg', NULL, 'ca2d0e3ec8191baab53056d69cf06ad704b46f4917ac1fec744ba255cbd91432', 'invoice.jpg'),
(35, NULL, '525fd11dfc594311b1533ea69ed15325pngtree-upload-vector-icon-with-transparent-background-png-image_1836029.jpg', NULL, 'c0531bba8a6e7e7db85073ae5e9b00d7f3563f55ed69f81340508a39f5e02177', 'pngtree-upload-vector-icon-with-transparent-background-png-image_1836029.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `product_property`
--

DROP TABLE IF EXISTS `product_property`;
CREATE TABLE IF NOT EXISTS `product_property` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_404276494584665A` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product_property`
--

INSERT INTO `product_property` (`id`, `product_id`, `name`, `value`) VALUES
(1, 3, 'Fréquence GPU', '700 Mhz'),
(2, 3, 'Type mémoire', 'DDR5'),
(3, 3, 'Mémoire vive', '2 Go'),
(4, 3, 'Mémoire vive', '2 Go');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `registered_at` datetime NOT NULL,
  `active` tinyint(1) NOT NULL,
  `confirmation_token` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_token` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `birthdate`, `registered_at`, `active`, `confirmation_token`, `password_token`) VALUES
(17, 'coco2053@hotmail.com', '[]', '$argon2i$v=19$m=65536,t=4,p=1$QjF6VW80VTUzUVh4WjZlWg$j5sNiA1/uEs5fZ8DVhekI+J3F2g2utMhCG1aG5/66t4', 'Bastien', 'Vacherand', '1984-03-04', '2020-06-11 13:12:07', 1, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `FK_64617F034584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `product_property`
--
ALTER TABLE `product_property`
  ADD CONSTRAINT `FK_404276494584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
