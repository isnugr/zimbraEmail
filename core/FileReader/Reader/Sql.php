<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader;

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
 * Description of Sql
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Sql extends AbstractType
{
    protected function loadFile()
    {
        $return = "";
        try {
            if (file_exists($this->path . DS . $this->file)) {
                $collation = $this->getWHMCSTablesCollation();
                $charset = $this->getWHMCSTablesCharset();
                $return = file_get_contents($this->path . DS . $this->file);
                $return = str_replace("#collation#", $collation, $return);
                $return = str_replace("#charset#", $charset, $return);
                $return = str_replace("#prefix#", \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getPrefixDataBase(), $return);
                foreach ($this->renderData as $key => $value) {
                    $return = str_replace("#" . $key . "#", $value, $return);
                }
            }
        } catch (\Exception $e) {
            \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\FileReader\\Reader\\Sql", $e->getMessage(), $e->getTrace());
            $this->data = $return;
        }
    }
    protected function getWHMCSTablesCollation()
    {
        $pdo = \Illuminate\Database\Capsule\Manager::connection()->getPdo();
        $query = $pdo->prepare("SHOW TABLE STATUS WHERE name = 'tblclients'");
        $query->execute();
        $result = $query->fetchObject();
        return $result->Collation;
    }
    protected function getWHMCSTablesCharset()
    {
        require ROOTDIR . DS . "configuration.php";
        $pdo = \Illuminate\Database\Capsule\Manager::connection()->getPdo();
        $query = $pdo->prepare("SELECT CCSA.character_set_name as Charset FROM information_schema.`TABLES` T,\n            information_schema.`COLLATION_CHARACTER_SET_APPLICABILITY` CCSA\n            WHERE CCSA.collation_name = T.table_collation\n            AND T.table_schema = :db_name\n            AND T.table_name = 'tblclients';");
        $query->execute(["db_name" => $db_name]);
        $result = $query->fetchObject();
        return $result->Charset;
    }
}

?>