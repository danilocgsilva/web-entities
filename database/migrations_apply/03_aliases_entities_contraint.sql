ALTER TABLE aliases ADD CONSTRAINT `aliases_entities_entities_id` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`id`);