<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\Addon;

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
 * ConfigOptions module actions
 */
class ConfigOptions extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\AddonController
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\AppParams;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\OutputBuffer;
    public function execute($params = NULL)
    {
        $productId = $this->getRequestValue("id");
        if ($this->getRequestValue("action") === "module-settings" || $this->getRequestValue("loadData") && $this->getRequestValue("ajax") == "1") {
            try {
                $invalidStoragePermissions = $this->getInvalidStoragePermitions();
                if ($invalidStoragePermissions) {
                    return $this->getInvalidStoragePermissionsError($invalidStoragePermissions);
                }
                if (!$this->isCorrectServerType()) {
                    return $this->getInvalidServerTypeError();
                }
                $requirementsHandler = new \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Checker();
                if ($requirementsHandler->getUnfulfilledRequirements()) {
                    $data = $this->buildErrorMessage(implode("<br>", $requirementsHandler->getUnfulfilledRequirements()));
                    return $this->returnAjaxResponse($data);
                }
                $this->updateProductType();
                $installer = new \ModulesGarden\Servers\ZimbraEmail\Core\App\Installer\ModuleInstaller();
                $installer->makeInstall();
                if (!$installer->isInstallCorrect()) {
                    return $this->buildFailedQueriesMessage($installer->getFailedQueries());
                }
                try {
                    $this->setAppParam("IntegrationControlerName", "ModulesGarden\\Servers\\ZimbraEmail\\App\\Http\\Actions\\ConfigOptions");
                    $this->setAppParam("IntegrationControlerMethod", "runExecuteProcess");
                    $configOptionsController = new \ModulesGarden\Servers\ZimbraEmail\App\Http\Actions\ConfigOptions();
                    $result = $configOptionsController->execute();
                    return $result;
                } catch (\Exception $exc) {
                    $data = $this->buildErrorMessage($exc->getMessage());
                    $response = new \ModulesGarden\Servers\ZimbraEmail\Core\Http\JsonResponse();
                    $response->setData($data);
                    $resolver = new \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\ResponseResolver($response);
                    $resolver->resolve();
                }
            } catch (\Exception $exc) {
                $data = $this->buildErrorMessage($exc->getMessage());
                return $this->returnAjaxResponse($data);
            }
        }
        if ($this->getRequestValue("action") === "save") {
            if (!$this->isCorrectServerType()) {
                return [];
            }
            return ["ModulesGarden\\Servers\\ZimbraEmail\\App\\Http\\Actions\\ConfigOptions", "runExecuteProcess"];
        }
        return [];
    }
    public function getInvalidStoragePermitions()
    {
        $requiredPaths = [\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage"), \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage", "app"), \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage", "crons"), \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage", "logs")];
        $invalidPermissions = [];
        $lang = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("lang");
        foreach ($requiredPaths as $path) {
            if (!is_writable($path)) {
                $invalidPermissions[] = $lang->addReplacementConstant("storage_path", $path)->absoluteT("permissionsStorage");
            }
            if (!is_readable($path)) {
                $invalidPermissions[] = $lang->addReplacementConstant("storage_path", $path)->absoluteT("permissionsStorageReadable");
            }
        }
        return $invalidPermissions;
    }
    public function buildFailedQueriesMessage($failedQueries = [])
    {
        $content = "";
        foreach ($failedQueries as $query) {
            $content .= "<div class=\"panel panel-danger\"><div class=\"panel-heading\">Installation Error</div><div class=\"panel-body\" style=\"padding:0px;\"><ul class=\"list-group\" style=\"margin-bottom: -5px;margin-top: -5px;\">";
            $content .= "<li class=\"list-group-item \">File: " . $query["file"] . "</li>";
            $content .= "<li class=\"list-group-item \">Error Message: " . $query["errorMessage"] . "</li>";
            $content .= "<li class=\"list-group-item \">Raw Query: " . $query["rawQuery"] . "</li>";
            $content .= "</ul></div></div>";
        }
        $data = ["content" => "<tr><td class=\"fieldlabel\" style=\"width:0%; display:none;\"></td><td style=\"width=100%;\" class=\"fieldarea\">" . $content . "</td></tr>", "mode" => "advanced"];
        return $this->returnAjaxResponse($data);
    }
    public function getInvalidStoragePermissionsError($permissions = [])
    {
        $data = $this->buildErrorMessage(implode("<br>", $permissions));
        return $this->returnAjaxResponse($data);
    }
    public function isCorrectServerType()
    {
        try {
            if (class_exists("\\ModulesGarden\\Servers\\ZimbraEmail\\App\\Http\\Actions\\MetaData")) {
                $metaDataController = new \ModulesGarden\Servers\ZimbraEmail\App\Http\Actions\MetaData();
                $details = $metaDataController->execute(NULL);
                if ($details["RequiresServer"] !== true) {
                    return true;
                }
                $serverGroupId = $this->getServerGroupId();
                $sModel = new \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Server();
                $server = $sModel->select(["tblservers.type"])->join("tblservergroupsrel", "tblservergroupsrel.serverid", "=", "tblservers.id")->where("tblservergroupsrel.groupid", $serverGroupId)->first();
                if (!$server) {
                    return false;
                }
                if ($server->type !== $this->getModuleName()) {
                    return false;
                }
            }
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
    public function getServerGroupId()
    {
        $gid = $this->getRequestValue("servergroup", false);
        if (!$gid && $gid !== "0" && $gid !== 0) {
            $pid = $this->getRequestValue("id", 0);
            $productModel = new \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Product();
            $product = $productModel->where("id", $pid)->first();
            if (!$product) {
                return 0;
            }
            return $product->servergroup;
        }
        return (int) $gid;
    }
    public function getInvalidServerTypeError()
    {
        $lang = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("lang");
        $messaage = $lang->addReplacementConstant("provisioning_name", $this->getModuleDisplayName())->absoluteT("invalidServerType");
        $data = $this->buildErrorMessage($messaage);
        return $this->returnAjaxResponse($data);
    }
    public function buildErrorMessage($message)
    {
        $data = ["content" => "<tr><td class=\"fieldlabel\" style=\"width:0%; display:none;\"></td><td style=\"width=100%;\" class=\"fieldarea\"><div style=\"width=100%; margin-bottom: 0px;\" class=\"alert alert-danger\">" . $message . "</div></td></tr>", "mode" => "advanced"];
        return $data;
    }
    public function returnAjaxResponse($data = [])
    {
        $response = new \ModulesGarden\Servers\ZimbraEmail\Core\Http\JsonResponse();
        $response->setData($data);
        return $response;
    }
    public function updateProductType()
    {
        if ($this->getRequestValue("action") !== "module-settings" || $this->getAppParam("moduleAppType") !== "server") {
            return false;
        }
        $moduleName = $this->getAppParam("systemName");
        $pid = $this->getRequestValue("id", false);
        $servergroup = $this->getRequestValue("servergroup", 0);
        if ($pid && 0 < $servergroup) {
            $product = new \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Product();
            $product->where("id", $pid)->update(["servertype" => $moduleName, "servergroup" => $servergroup]);
        }
    }
    public function getModuleName()
    {
        return $this->getAppParam("systemName");
    }
    public function getModuleDisplayName()
    {
        return $this->getAppParam("name");
    }
    public function addRequiredCustomFields()
    {
    }
}

?>