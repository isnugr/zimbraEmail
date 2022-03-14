<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Configuration\Addon\Update;

/**
 * Description of PatchManager
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class PatchManager
{
    protected $updatePath = NULL;
    protected $updateFiles = [];
    public function __construct()
    {
        $this->updatePath = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getModuleRootDir() . DS . "app" . DS . "Configuration" . DS . "Addon" . DS . "Update" . DS . "Patch";
        $this->loadUpdatePath();
    }
    public function run($newVersion, $oldVersion)
    {
        $fullPath = $this->getUpdatePath();
        array_map(function ($version, $fileName) {
            while ($this->checkVersion($newVersion, $oldVersion, $version)) {
                try {
                    $className = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getRootNamespace() . "\\App\\Configuration\\Addon\\Update\\Patch\\" . $fileName;
                    \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::create($className)->setVersion($version)->execute();
                } catch (\Exception $exc) {
                    \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager")->addError($exc->getMessage(), ["newVersion" => $newVersion, "oldVersion" => $oldVersion, "updateVersion" => $version, "fullFileName" => $fullPath . DS . $fileName . ".php"]);
                }
            }
        }, array_keys($this->getUpdateFiles()), $this->getUpdateFiles());
        return $this;
    }
    protected function checkVersion($newVersion, $oldVersion, $fileVersion)
    {
        if (version_compare($oldVersion, $fileVersion, "<")) {
            return true;
        }
        return false;
    }
    protected function getUpdatePath()
    {
        return $this->updatePath;
    }
    protected function getUpdateFiles()
    {
        return $this->updateFiles;
    }
    protected function loadUpdatePath()
    {
        $files = scandir($this->getUpdatePath(), 1);
        if (count($files) != 0) {
            foreach ($files as $file) {
                if ($file !== "." && $file !== "..") {
                    $version = $this->generateVersion($file);
                    list($this->updateFiles[$version]) = explode(".", $file);
                }
            }
        }
    }
    protected function generateVersion($fileName)
    {
        list($name) = explode(".", $fileName);
        return str_replace(["M", "P"], ".", substr($name, 1));
    }
}

?>