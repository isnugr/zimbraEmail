<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Helpers;

class ServiceFactory
{
    public static function createAccount($type)
    {
        switch ($type) {
            case \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CUSTOM_ZIMBRA:
                $service = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Services\Create\CreateCustomAccountOld();
                break;
            case \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::ZIMBRA_CONFIG_OPTIONS:
                $service = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Services\Create\CreateConfigOptionAccountOld();
                break;
            default:
                return $service;
        }
    }
}

?>