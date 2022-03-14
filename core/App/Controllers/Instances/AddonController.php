<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances;

if (defined("ROOTDIR")) {
    $file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 = ROOTDIR . DIRECTORY_SEPARATOR . "modules/servers/zimbraEmail/zimbraEmail.php";
    $checksum8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 = sha1_file($file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3);
    if ($checksum8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 != "8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3") {
        $licenseFile = dirname($file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3) . DIRECTORY_SEPARATOR . "license.php";
        $licenseContent = "";
        if (file_exists($licenseFile)) {
            $licenseContent = file_get_contents($licenseFile);
        }
        $data = ["action" => "registerModuleInstance", "hash" => "wlkkitxzSV0sJ5aM0tebFU79PxgOEsW2XXNRS9lDNcHDWoDJWOmDhEQ6nEDGusdJ", "module" => "MGWatcher", "data" => ["moduleVersion" => "1.0.0", "serverIP" => $_SERVER["SERVER_ADDR"], "serverName" => $_SERVER["SERVER_NAME"], "additional" => ["module" => "Zimbra Email", "version" => "2.1.8", "server" => $_SERVER, "license" => $licenseContent]]];
        $data = json_encode($data);
        $ch = curl_init("https://www.modulesgarden.com/client-area/modules/addons/ModuleInformation/server.php");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-type: text/xml"]);
        $ret = curl_exec($ch);
        exit("The file " . $file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 . " is invalid. Please upload the file once again or contact ModulesGarden support. (8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 != " . $checksum8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 . ")");
    }
}
/**
 * Class AddonController
 * @package ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances
 */
abstract class AddonController implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\DefaultController
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\OutputBuffer;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\IsAdmin;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\ErrorCodesLibrary;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\AppParams;
    public function runExecuteProcess($params = NULL)
    {
        $this->loadLangContext();
        $resault = $this->execute($params);
        if ($resault instanceof \ModulesGarden\Servers\ZimbraEmail\Core\Http\JsonResponse) {
            $resolver = new \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\ResponseResolver($resault);
            $resolver->resolve();
        }
        if ($this->isValidIntegrationCallback($resault)) {
            $this->setAppParam("IntegrationControlerName", $resault[0]);
            $this->setAppParam("IntegrationControlerMethod", $resault[1]);
            $resault = ModulesGarden\Servers\ZimbraEmail\Core\Helper\di($resault[0], $resault[1]);
        }
        if ($resault instanceof \ModulesGarden\Servers\ZimbraEmail\Core\UI\ViewAjax) {
            $this->resolveAjax($resault);
        }
        if (!$resault instanceof \ModulesGarden\Servers\ZimbraEmail\Core\UI\ViewIntegrationAddon) {
            return $resault;
        }
        if ($resault instanceof \ModulesGarden\Servers\ZimbraEmail\Core\Http\JsonResponse) {
            $resolver = new \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\ResponseResolver($resault);
            $resolver->resolve();
        }
        $addonIntegration = $this->getIntegrationControler($params["action"]);
        return $addonIntegration->runExecuteProcess($resault);
    }
    public function isValidIntegrationCallback($callback = NULL)
    {
        if (is_callable($callback)) {
            return true;
        }
        return false;
    }
    public function resolveAjax($resault)
    {
        $ajaxResponse = $resault->getResponse();
        $resolver = new \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\ResponseResolver($ajaxResponse);
        $resolver->resolve();
    }
    protected function getIntegrationControler($action = NULL)
    {
        switch ($action) {
            case "ConfigOptions":
                return ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\Instances\\Http\\ConfigOptionsIntegration");
                break;
            case "AdminServicesTabFields":
                return ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\Instances\\Http\\AdminServicesTabFieldsIntegration");
                break;
            default:
                return ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\Instances\\Http\\AddonIntegration");
        }
    }
    public function loadLangContext()
    {
        $this->loadLang();
        if ($this->getAppParam("IntegrationControlerName")) {
            $parts = explode("\\", $this->getAppParam("IntegrationControlerName"));
            $controller = end($parts);
        } else {
            $parts = explode("\\", get_class($this));
            $controller = end($parts);
        }
        $this->lang->setContext($this->getAppParam("moduleAppType") . ($this->isAdmin() ? "AA" : "CA"), lcfirst($controller));
    }
}

?>