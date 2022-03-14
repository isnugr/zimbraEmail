<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection;

/**
 * Class DependencyInjection
 * @package ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection
 */
class DependencyInjection
{
    public static function get($className = NULL, $methodName = NULL, $canClone = true)
    {
        if ($methodName) {
            return Container::getInstance()->call($className . "@" . $methodName);
        }
        return Container::getInstance()->make($className);
    }
    public static function create($className = NULL, $methodName = NULL, $canClone = true)
    {
        if ($methodName) {
            return Container::getInstance()->call($className . "@" . $methodName);
        }
        return Container::getInstance()->make($className);
    }
    public static function call($className = NULL, $methodName = NULL)
    {
        if ($methodName) {
            return Container::getInstance()->call($className . "@" . $methodName);
        }
        return Container::getInstance()->make($className);
    }
}

?>