ALTER TABLE `commande` ADD `acompteClient` INT NOT NULL AFTER `comment`, ADD `detteClient` INT NOT NULL AFTER `acompteClient`;

ALTER TABLE `operation` ADD `acompteClient` INT NOT NULL AFTER `comment`, ADD `detteClient` INT NOT NULL AFTER `acompteClient`;