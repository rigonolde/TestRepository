CREATE TABLE `category` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `parent_id` INT(11) DEFAULT NULL,
    `libelle` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`),
    foreign key(parent_id) references category(id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
CREATE TABLE `fiche` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `libelle` VARCHAR(255) NOT NULL,
    `category_id` INT(11) NOT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `FK_category_id_fiche` FOREIGN KEY (`category_id`) REFERENCES `category`(`id`) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
