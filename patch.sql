--creer un dossier 'operations' pour les images
--ajouter un nouveau type transfert de fonds et ajuster les parametres en question
-- creer la table transfert pour les transferts de fonds


ALTER TABLE `operation` ADD `image` TEXT NULL AFTER `date_approbation`;