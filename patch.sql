--creer un dossier 'operations' pour les images
--ajouter un nouveau type transfert de fonds et ajuster les parametres en question
-- creation de la categorie operation achat de stock, acompte fournisseur

ALTER TABLE `operation` ADD `image` TEXT NULL AFTER `date_approbation`;

ALTER TABLE `operation`
	CHANGE COLUMN `image` `image1` TEXT NULL COLLATE 'utf8_bin' AFTER `date_approbation`,
	ADD COLUMN `image2` TEXT NULL AFTER `image1`,
	ADD COLUMN `image3` TEXT NULL AFTER `image2`;


ALTER TABLE `approvisionnement`
	ADD COLUMN `acompteFournisseur` INT(11) NULL DEFAULT NULL AFTER `employe_id_reception`,
	ADD COLUMN `detteFournisseur` INT(11) NULL DEFAULT NULL AFTER `acompteFournisseur`;
	

CREATE TABLE `transfert` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`reference` VARCHAR(20) NOT NULL COLLATE 'utf8_bin',
	`montant` INT(11) NOT NULL,
	`client_id` INT(11) NOT NULL,
	`client_id_receive` INT(11) NOT NULL,
	`comment` TEXT NULL COLLATE 'utf8_bin',
	`etat_id` INT(11) NOT NULL,
	`employe_id` INT(11) NOT NULL,
	`created` DATETIME NULL DEFAULT NULL,
	`modified` DATETIME NULL DEFAULT NULL,
	`protected` INT(11) NOT NULL DEFAULT '0',
	`valide` INT(11) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_bin'
ENGINE=InnoDB
ROW_FORMAT=DYNAMIC
AUTO_INCREMENT=2
;



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


CREATE TABLE `changement` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`reference` VARCHAR(40) NOT NULL COLLATE 'utf8_bin',
	`groupecommande_id` INT(11) NOT NULL,
	`groupecommande_id_new` INT(11) NOT NULL,
	`comment` TEXT NULL COLLATE 'utf8_bin',
	`etat_id` INT(11) NOT NULL,
	`employe_id` INT(11) NOT NULL,
	`created` DATETIME NULL DEFAULT NULL,
	`modified` DATETIME NULL DEFAULT NULL,
	`protected` INT(11) NOT NULL DEFAULT '0',
	`valide` INT(11) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)
COLLATE='utf8_bin'
ENGINE=InnoDB
AUTO_INCREMENT=1
;



CREATE TABLE `lignechangement` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`changement_id` INT(11) NOT NULL,
	`produit_id` INT(11) NOT NULL,
	`quantite_avant` FLOAT NOT NULL,
	`quantite_apres` FLOAT NOT NULL,
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


CREATE TABLE `ligneautrepertejour` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`productionjour_id` INT(11) NOT NULL,
	`produit_id` INT(11) NOT NULL,
	`perte` INT(11) NOT NULL,
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


ALTER TABLE `produit` ADD COLUMN `stock` INT NOT NULL DEFAULT 0 COMMENT 'le stock initial' AFTER `description`;

ALTER TABLE `ressource` ADD COLUMN `stock` INT NOT NULL DEFAULT 0 COMMENT 'le stock initial' AFTER `abbr`;

ALTER TABLE `lignelivraison` ADD COLUMN `perte` INT(11) NULL AFTER `reste`;