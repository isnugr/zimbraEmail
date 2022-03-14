<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Errors;

/**
 * Register Error in WHMCS Module Log
 *
 * @author Michal Czech <michael@modulesgarden.com>
 */
class Register extends \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception
{
    protected $exception = NULL;
    public static function register($exc)
    {
        if (!self::isExceptionLogable($exc)) {
            return NULL;
        }
        $debug = var_export($exc, true);
        logModuleCall("Error", "ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Errors", ["message" => $exc->getMessage(), "code" => $exc->getCode(), "token" => self::getToken($exc)], $debug, 0, 0);
    }
    public static function getToken($exception)
    {
        $token = "Unknow Token";
        if (method_exists($exception, "getToken")) {
            $token = $exception->getToken();
        }
        return $token;
    }
    public static function isExceptionLogable($exception = NULL)
    {
        if (method_exists($exception, "isLogable")) {
            return $exception->isLogable();
        }
        return false;
    }
}

?>