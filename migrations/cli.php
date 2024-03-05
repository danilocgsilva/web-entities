<?php

declare(strict_types=1);

use Danilocgsilva\WebEntities\Migrations\Migrate;
use Danilocgsilva\WebEntities\Utils\FileSystem;

require_once("../vendor/autoload.php");

$dns = "mysql:host=" . getenv("WEB_ENTITIES_DB_HOST") . ";charset=utf8mb4";
$pdo = new PDO($dns, getenv("WEB_ENTITIES_DB_USER"), getenv("WEB_ENTITIES_DB_PASSWORD"));
$createTableStringPlaceholder = FileSystem::getFileContent("01-database-table.sql.template");
$createTableString = sprintf($createTableStringPlaceholder, getenv("WEB_ENTITIES_DB_NAME"));

$migrations = new Migrate($pdo);
$migrations->runString($createTableString);
