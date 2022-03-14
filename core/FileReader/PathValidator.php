<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\FileReader;

/**
 * Wrapper for files and directories validation methods
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class PathValidator
{
    public function validatePath($path = "", $isReadable = true, $isWritable = false, $create = true)
    {
        if ($create) {
            $this->createDirIfNotExists($path);
        }
        if (!$this->pathExists($path)) {
            return false;
        }
        if ($isReadable && !$this->isPathReadable($path)) {
            return false;
        }
        if ($isWritable && !$this->isPathWritable($path)) {
            return false;
        }
        return true;
    }
    public function createDirIfNotExists($path)
    {
        if (!$this->pathExists($path)) {
            mkdir($path);
        }
    }
    public function pathExists($path)
    {
        return file_exists($path);
    }
    public function isPathReadable($path)
    {
        return is_readable($path);
    }
    public function isPathWritable($path)
    {
        return is_writable($path);
    }
}

?>