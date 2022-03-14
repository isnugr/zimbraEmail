<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\Http;

class ClientPageController extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\HttpController implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\ClientArea
{
    public function execute($params = NULL)
    {
        if (class_exists("\\ModulesGarden\\Servers\\ZimbraEmail\\App\\Hooks\\InternalHooks\\PreClientAreaPageLoad")) {
            $preClietAreaHook = new \ModulesGarden\Servers\ZimbraEmail\App\Hooks\InternalHooks\PreClientAreaPageLoad($params);
            $newParams = $preClietAreaHook->execute();
            if ($newParams && is_array($newParams)) {
                $params = $newParams;
            }
        }
        return self::execute($params);
    }
}

?>