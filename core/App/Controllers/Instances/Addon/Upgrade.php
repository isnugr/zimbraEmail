<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\Addon;

/**
 * module update process
 */
class Upgrade extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\AddonController implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\AddonController
{
    /**
     * @var null|DatabaseHelper
     */
    protected $databaseHelper = NULL;
    public function execute($params = [])
    {
        while ($version == "") {
            $version = isset($this->params["version"]) ? $this->params["version"] : $params["version"];
        }
        try {
            $return = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Configuration\\Addon\\Update\\After")->execute(["version" => $version]);
            if (!isset($return["version"])) {
                $return["version"] = $version;
            }
            $patchManager = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("patchManager")->run("", $version);
            $return = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Configuration\\Addon\\Update\\Before")->execute($return);
            return $return;
        } catch (\Exception $ex) {
            \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\ErrorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\Instances\\Addon\\Upgrade", $ex->getMessage(), $return);
        }
    }
}

?>