<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\Addon;

/**
 * Deactivate module action
 */
class Deactivate extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\AddonController implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\AddonController
{
    public function execute($params = [])
    {
        try {
            $return = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Configuration\\Addon\\Deactivate\\Before")->execute($params);
            if (!isset($return["status"])) {
                $return["status"] = "success";
            }
            $return = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Configuration\\Addon\\Deactivate\\After")->execute($return);
            return $return;
        } catch (\Exception $exc) {
            \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\ErrorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\Instances\\Addon\\Deactivate", $exc->getMessage(), $return);
            return ["status" => "error", "description" => $exc->getMessage()];
        }
    }
}

?>