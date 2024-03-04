<?php

declare(strict_types=1);

use PDO;
use Danilocgsilva\WebEntitie\Migrations\Migrations;
use Danilocgsilva\WebEntities\Utils\FileSystem;

require_once("../vendor/autoload.php");

$dns = "mysql:" . getenv("WEB_ENTITIES_DB_HOST") . ";dbname=" . getenv("WEB_ENTITIES_DB_NAME") . ";charset=UTF-8";
$pdo = new PDO($dns, getenv("WEB_ENTITIES_DB_USER"), getenv("WEB_ENTITIES_DB_PASSWORD"));
$createTableString = FileSystem::getFileContent("01-database-table.sql");

$migrations = new Migrations($pdo);
$migrations->runString($createTableString);