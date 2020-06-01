--creer un dossier 'operations' pour les images
--ajouter un nouveau type transfert de fonds et ajuster les parametres en question
-- creer la table transfert pour les transferts de fonds
-- creation de la categorie operation achat de stock

ALTER TABLE `operation` ADD `image` TEXT NULL AFTER `date_approbation`;

CREATE TABLE `achatstock` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`reference` VARCHAR(20) NOT NULL COLLATE 'utf8_bin',
	`montant` INT(11) NOT NULL,
	`avance` INT(11) NOT NULL,
	`reste` INT(11) NOT NULL,
	`fournisseur_id` INT(11) NOT NULL,
	`operation_id` INT(11) NULL DEFAULT NULL,
	`datelivraison` DATETIME NULL DEFAULT NULL,
	`etat_id` INT(11) NOT NULL,
	`employe_id` INT(11) NOT NULL,
	`comment` TEXT NULL COLLATE 'utf8_bin',
	`employe_id_reception` INT(11) NULL DEFAULT NULL,
	`visibility` INT(11) NOT NULL,
	`created` DATETIME NULL DEFAULT NULL,
	`modified` DATETIME NULL DEFAULT NULL,
	`protected` INT(11) NOT NULL DEFAULT '0',
	`valide` INT(11) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_bin'
ENGINE=InnoDB
ROW_FORMAT=DYNAMIC
AUTO_INCREMENT=1
;


CREATE TABLE `ligneachatstock` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`achatstock_id` INT(11) NOT NULL,
	`produit_id` INT(11) NOT NULL,
	`quantite` FLOAT NOT NULL,
	`quantite_recu` FLOAT NOT NULL,
	`price` INT(11) NOT NULL,
	`created` DATETIME NULL DEFAULT NULL,
	`modified` DATETIME NULL DEFAULT NULL,
	`protected` INT(11) NOT NULL DEFAULT '0',
	`valide` INT(11) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_bin'
ENGINE=InnoDB
ROW_FORMAT=DYNAMIC
AUTO_INCREMENT=1
;
