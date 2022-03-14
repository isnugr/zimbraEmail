<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\Addon;

/**
 * Activate module actions
 */
class Activate extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\AddonController implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\AddonController
{
    /**
     * @var null|DatabaseHelper
     */
    protected $databaseHelper = NULL;
    public function execute($params = [])
    {
        try {
            $return = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Configuration\\Addon\\Activate\\Before")->execute($params);
            if (!isset($return["status"])) {
                $return["status"] = "success";
            }
            $return = $this->activate($return);
            $return = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Configuration\\Addon\\Activate\\After")->execute($return);
            return $return;
        } catch (\Exception $exc) {
            \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\ErrorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\Instances\\Addon\\Activate", $exc->getMessage(), $return);
            return ["status" => "error", "description" => $exc->getMessage()];
        }
    }
    protected function activate($params = [])
    {
        $this->databaseHelper = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Helper\\DatabaseHelper");
        if ($params["status"] === "error") {
            return $params;
        }
        $isErrorCore = $this->databaseHelper->performQueryFromFile(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("core", "Database", "schema.sql"));
        $isErrorApp = $this->databaseHelper->performQueryFromFile(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("app", "Database", "schema.sql"));
        $isErrorDataCore = $this->databaseHelper->performQueryFromFile(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("core", "Database", "data.sql"));
        $isErrorDataApp = $this->databaseHelper->performQueryFromFile(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("app", "Database", "data.sql"));
        if ($isErrorCore || $isErrorDataCore || $isErrorApp || $isErrorDataApp) {
            return ["status" => "error", "description" => \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager")->getFirstError()->getMessage()];
        }
        return ["status" => "success"];
    }
}

?>