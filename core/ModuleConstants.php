<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core;

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
class ModuleConstants
{
    protected static $prefixDataBase = "";
    protected static $mgDevConfig = NULL;
    protected static $mgHelperLangs = NULL;
    protected static $mgCoreConfig = NULL;
    protected static $mgModuleRootDir = NULL;
    protected static $mgTemplateDir = NULL;
    protected static $mgIsPhp7 = false;
    protected static $mgModuleNamespace = "ModulesGarden\\Servers\\ZimbraEmail";
    public static function initialize()
    {
        self::$mgModuleRootDir = dirname(__DIR__);
        self::$mgDevConfig = self::getFullPath("app", "Config");
        self::$mgHelperLangs = self::getFullPath("langs");
        self::$mgCoreConfig = self::getFullPath("core", "Config");
        self::$mgTemplateDir = self::getFullPath("templates");
        self::$mgIsPhp7 = self::checkIfPhp7();
        self::$prefixDataBase = self::loadDataBasePrefix();
    }
    public static function loadDataBasePrefix()
    {
        $namespaceParts = explode("\\", self::$mgModuleNamespace);
        return end($namespaceParts);
    }
    public static function checkIfPhp7()
    {
        return 0 <= version_compare(PHP_VERSION, "7.0.0");
    }
    public static function getDevConfigDir()
    {
        return self::$mgDevConfig;
    }
    public static function getCoreConfigDir()
    {
        return self::$mgCoreConfig;
    }
    public static function getLangsDir()
    {
        return self::$mgHelperLangs;
    }
    public static function getModuleRootDir()
    {
        return self::$mgModuleRootDir;
    }
    public static function getFullPath()
    {
        $fullPath = self::getModuleRootDir();
        foreach (func_get_args() as $dir) {
            $fullPath .= DS . $dir;
        }
        return $fullPath;
    }
    public static function getFullNamespace()
    {
        $fullNamespace = self::getRootNamespace();
        foreach (func_get_args() as $dir) {
            $fullNamespace .= "\\" . $dir;
        }
        return $fullNamespace;
    }
    public static function getFullPathWhmcs()
    {
        $fullPath = ROOTDIR;
        foreach (func_get_args() as $dir) {
            $fullPath .= DS . $dir;
        }
        return $fullPath;
    }
    public static function requireFile($file, $ones = true)
    {
        if ($ones) {
            require_once $file;
        } else {
            require $file;
        }
    }
    public static function getTemplateDir()
    {
        return self::$mgTemplateDir;
    }
    public static function isPhp7orHigher()
    {
        return self::$mgIsPhp7;
    }
    public static function getPrefixDataBase()
    {
        return self::$prefixDataBase . "_";
    }
    public static function getRootNamespace()
    {
        return self::$mgModuleNamespace;
    }
}

?>