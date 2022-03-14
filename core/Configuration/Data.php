<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Configuration;

/**
 * Description of Data
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Data
{
    protected static $data = [];
    public function __construct()
    {
        $this->load();
    }
    public function __get($name)
    {
        $this->load();
        if (array_key_exists(lcfirst($name), self::$data)) {
            return self::$data[lcfirst($name)];
        }
        return NULL;
    }
    public function getAll()
    {
        return self::$data;
    }
    private function load()
    {
        if (count(self::$data) == 0) {
            $this->loadConfig();
        }
    }
    private function loadConfig()
    {
        $dataDev = $this->read(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getDevConfigDir() . DS . "configuration.yml");
        $dataCore = $this->read(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getCoreConfigDir() . DS . "configuration.yml");
        $data = $this->parseConfigData($dataDev, $dataCore);
        $this->loadPackageConfig($data);
        self::$data = $data ?: [];
    }
    private function loadPackageConfig($data)
    {
        if (file_exists(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getModuleRootDir() . DS . "moduleVersion.php")) {
            include \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getModuleRootDir() . DS . "moduleVersion.php";
            if ($moduleVersion) {
                $data["version"] = $moduleVersion;
            }
        }
        if ($data["description"] && strpos($data["description"], ":WIKI_URL:")) {
            $data["description"] = str_replace(":WIKI_URL:", $moduleWikiUrl ?: "https://www.docs.modulesgarden.com/", $data["description"]);
        }
        $data["debug"] = file_exists(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getModuleRootDir() . DIRECTORY_SEPARATOR . ".debug") ? true : false;
    }
    private function parseConfigData($dataDev, $dataCore)
    {
        if (!$dataDev && $dataCore) {
            return $dataCore;
        }
        if (!$dataDev && $dataCore) {
            return $dataCore;
        }
        foreach ($dataCore as $coreKey => $core) {
            $isFind = false;
            foreach ($dataDev as $devKey => $dev) {
                if ($devKey === $coreKey) {
                    $isFind = true;
                    if (!$isFind) {
                        $dataDev[$coreKey] = $core;
                    }
                }
            }
        }
        return $dataDev;
    }
    private function read($name)
    {
        return \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader::read($name)->get();
    }
}

?>