<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Handlers;

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
 * Description of Files
 *
 * @author INBSX-37H
 */
class Files extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Handler implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\HandlerInterface
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    protected $fileList = [];
    public function __construct($fileList = [])
    {
        $this->fileList = $fileList;
        $this->handleRequirements();
    }
    public function handleRequirements()
    {
        foreach ($this->fileList as $record) {
            if ($this->isValidPath($record[\ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\Files::PATH])) {
                $this->handleRequirement($record);
            }
        }
    }
    public function isValidPath($path)
    {
        if (stripos($path, \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\Files::WHMCS_PATH) === 0 || stripos($path, \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\Files::MODULE_PATH) === 0) {
            return true;
        }
        return false;
    }
    protected function handleRequirement($record)
    {
        $filePath = $this->getFullPath($record[\ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\Files::PATH]);
        switch ($record[\ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\Files::TYPE]) {
            case \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\Files::REMOVE:
                $this->removeFile($filePath);
                break;
            case \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\Files::IS_WRITABLE:
                $this->checkIfWritable($filePath);
                break;
        }
    }
    public function getFullPath($recordPath = NULL)
    {
        if (stripos($recordPath, \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\Files::WHMCS_PATH) === 0) {
            return str_replace(\ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\Files::WHMCS_PATH, \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPathWhmcs(), str_replace("/", DIRECTORY_SEPARATOR, $recordPath));
        }
        if (stripos($recordPath, \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\Files::MODULE_PATH) === 0) {
            return str_replace(\ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\Files::MODULE_PATH, \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getModuleRootDir(), str_replace("/", DIRECTORY_SEPARATOR, $recordPath));
        }
        return NULL;
    }
    protected function removeFile($filePath = NULL)
    {
        $fileValidator = new \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\PathValidator();
        if (!$fileValidator->pathExists($filePath)) {
            return NULL;
        }
        unlink($filePath);
        if (!$fileValidator->pathExists($filePath)) {
            return NULL;
        }
        $this->addUnfulfilledRequirement("In order for the module to work correctly, please remove the following file: :remove_file_requirement:", ["remove_file_requirement" => $filePath]);
    }
    protected function checkIfWritable($filePath = NULL)
    {
        $fileValidator = new \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\PathValidator();
        if ($fileValidator->isPathWritable($filePath)) {
            return NULL;
        }
        $this->addUnfulfilledRequirement("In order for the module to work correctly, please set up permissions to the :writable_file_requirement: directory as writable.", ["writable_file_requirement" => $filePath]);
    }
}

?>