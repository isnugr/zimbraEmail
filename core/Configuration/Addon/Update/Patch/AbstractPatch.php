<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Configuration\Addon\Update\Patch;

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
 * Description of AbstractPatch
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class AbstractPatch
{
    /**
     * @var DatabaseHelper 
     */
    protected $databaseHelper = NULL;
    /**
     * @var string
     */
    private $path = NULL;
    /**
     * @var string
     */
    private $versionName = NULL;
    protected $version = NULL;
    public function __construct(\ModulesGarden\Servers\ZimbraEmail\Core\Helper\DatabaseHelper $databaseHelper)
    {
        $this->databaseHelper = $databaseHelper;
        $this->path = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getModuleRootDir() . DS . "app" . DS . "Database";
        $this->versionName = end(explode("\\", get_called_class()));
    }
    protected function runSchema()
    {
        return $this->databaseHelper->performQueryFromFile($this->path . DS . $this->versionName . DS . "schema.sql") === true ? false : true;
    }
    protected function runData()
    {
        return $this->databaseHelper->performQueryFromFile($this->path . DS . $this->versionName . DS . "data.sql") === true ? false : true;
    }
    public function setVersion($version = NULL)
    {
        $this->version = $version;
        return $this;
    }
    public function getVersion()
    {
        return $this->version;
    }
    public function execute()
    {
    }
}

?>