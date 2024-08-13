CREATE TABLE entities (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE aliases (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `entities_id` INT UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

ALTER TABLE aliases ADD CONSTRAINT `aliases_entities_eneities_id` FOREIGN KEY (`entities_id`) REFERENCES `entities` (`id`);

CREATE TABLE properties (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `values` VARCHAR(255) NOT NULL,
    `entity_id` INT UNSIGNED NOT NULL,
    `property_name` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

ALTER TABLE `properties` ADD CONSTRAINT `properties_alias_entity_id` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`id`);
