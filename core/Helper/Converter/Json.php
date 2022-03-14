<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Helper\Converter;

class Json
{
    public static function encodeUTF8($array)
    {
        array_walk_recursive($array, function ($item, $key) {
            if (is_array($item) || is_object($item)) {
                if (is_array($param) || is_object($param)) {
                    $param = self::encodeUTF8($param);
                } else {
                    if (!mb_detect_encoding($param, "utf-8", true)) {
                        $param = utf8_encode($param);
                    }
                }
            } else {
                if (!mb_detect_encoding($item, "utf-8", true)) {
                    $item = utf8_encode($item);
                }
            }
        });
        return $array;
    }
}

?>