<?php

declare(strict_types=1);

namespace Danilocgsilva\WebEntities\Utils;

class FileSystem
{
    public static function getFileContent(string $filePath): string
    {
        $handle = fopen($filePath, "r");
        $fileContents = fread($handle, filesize($filePath));
        fclose($handle);
        return $fileContents;
    }
}
