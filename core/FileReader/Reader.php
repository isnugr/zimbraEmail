<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\FileReader;

/**
 * Description of Reader
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Reader
{
    public static function read($file, $renderData = [])
    {
        $path = explode(DIRECTORY_SEPARATOR, $file);
        $file = end($path);
        array_pop($path);
        $path = implode(DIRECTORY_SEPARATOR, $path);
        $instance = NULL;
        $type = self::getType($file);
        switch ($type) {
            case "xml":
                $instance = new Reader\Xml($file, $path, $renderData);
                break;
            case "ini":
                $instance = new Reader\Ini($file, $path, $renderData);
                break;
            case "yml":
                $instance = new Reader\Yml($file, $path, $renderData);
                break;
            case "json":
                $instance = new Reader\Json($file, $path, $renderData);
                break;
            case "php":
                $instance = new Reader\Php($file, $path, $renderData);
                break;
            case "sql":
                $instance = new Reader\Sql($file, $path, $renderData);
                break;
            case "js":
                $instance = new Reader\Js($file, $path, $renderData);
                break;
            case "css":
                $instance = new Reader\Css($file, $path, $renderData);
                break;
            case "html":
                $instance = new Reader\Html($file, $path, $renderData);
                return $instance;
                break;
            default:
                throw new \Exception("Can't read file: " . $file);
        }
    }
    private static function getType($file)
    {
        $type = NULL;
        $array = explode(".", $file);
        if (is_array($array)) {
            $type = end($array);
        }
        return strtolower($type);
    }
}

?>