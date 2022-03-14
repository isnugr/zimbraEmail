<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App;

class Application
{
    public function run($callerName = NULL, $params = NULL)
    {
        try {
            $this->setWhmcsParams($params);
            $controller = $this->getControllerClass($callerName);
            $controllerInstance = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call($controller);
            $result = $controllerInstance->runController($callerName, $params);
            return $result;
        } catch (\Exception $exc) {
            $errorPage = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\Instances\\Http\\ErrorPage");
            $params["mgErrorDetails"] = $exc;
            $result = $errorPage->execute($params);
            return $result;
        }
    }
    protected function setWhmcsParams($params)
    {
        $whmcsParams = ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("whmcsParams");
        $whmcsParams->setParams($params);
    }
    public function getControllerClass($callerName = NULL)
    {
        $functionName = str_replace($this->getModuleName() . "_", "", $callerName);
        switch ($functionName) {
            case "output":
                return "ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\AppControllers\\Http";
                break;
            case "clientarea":
                return "ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\AppControllers\\Http";
                break;
            case "api":
                return "ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\AppControllers\\Api";
                break;
            default:
                return "ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\AppControllers\\Addon";
        }
    }
    public function getModuleName()
    {
        return "ZimbraEmail";
    }
}

?>