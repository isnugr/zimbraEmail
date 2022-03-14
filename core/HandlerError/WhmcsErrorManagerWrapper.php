<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\HandlerError;

class WhmcsErrorManagerWrapper
{
    protected static $errorManager = NULL;
    public static function setErrorManager($errManager = NULL)
    {
        if ($errManager) {
            self::$errorManager = $errManager;
        }
    }
    public static function getErrorManager()
    {
        return self::$errorManager;
    }
}

?>