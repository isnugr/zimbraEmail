<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\FileReader;

/**
 * Description of File
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class File
{
    public static function createFile()
    {
    }
    public static function createPaths()
    {
        foreach (func_get_args() as $path) {
            if (is_array($path) && isset($path["permission"]) && self::createPath($path["full"], $path["permission"]) === false) {
                $parentPath = explode(DS, $path["full"]);
                array_pop($pathFull);
                $parentPath = implode(DS, $parentPath);
                self::setPermission($parentPath);
                self::setUser($path["full"], "www-data");
                self::createPath($path["full"], $path["permission"]);
            } else {
                if (is_array($path) && self::createPath($path["full"]) === false) {
                    $parentPath = explode(DS, $path["full"]);
                    array_pop($pathFull);
                    $parentPath = implode(DS, $parentPath);
                    self::setPermission($parentPath);
                    self::setUser($path["full"], "www-data");
                    self::createPath($path["full"]);
                } else {
                    self::createPath($path);
                }
            }
        }
    }
    public static function createPath($path, $permission = 511)
    {
        return mkdir($path, $permission);
    }
    public static function setPermission($file, $permission = 511)
    {
        return chmod($file, $permission);
    }
    public static function setUser($file, $user)
    {
        return chown($file, $user);
    }
    public static function getValidator()
    {
        return new PathValidator();
    }
}

?>