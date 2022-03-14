<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Packages;

class PackageManager
{
    protected $packageList = [];
    const STATUS_ACTIVE = "active";
    const STATUS_INACTIVE = "inactive";
    const STATUS_REASON_INACTIVE = "Inactive in the configuration";
    const STATUS_REASON_CONFIG_MISSING = "Inactive because of lack of the configuration file";
    public function __construct()
    {
        $this->loadPackages();
    }
    public function getPackageConfiguration($packageName)
    {
        if (isset($this->packageList[$packageName])) {
            return $this->packageList[$packageName];
        }
        return NULL;
    }
    public function getPackagesConfiguration()
    {
        return $this->packageList;
    }
    protected function loadPackages()
    {
        $packageList = $this->getPackageListByDirectory();
        foreach ($packageList as $className) {
            $config = new $className();
            $packageName = $config->getName();
            if ($this->isNameValid($packageName) && $this->isVersionValid($config->{PackageConfigurationConst::VERSION}) && $this->isStatusValid($config->{AppPackageConfiguration::PACKAGE_STATUS})) {
                $this->packageList[$packageName] = $config;
            }
        }
    }
    public function getPackageListByDirectory()
    {
        $directoryHelper = new \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Directory();
        $packagesDirectory = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getModuleRootDir() . DIRECTORY_SEPARATOR . "packages";
        $packagesList = $directoryHelper->getFilesList($packagesDirectory);
        $existing = [];
        foreach ($packagesList as $packageName) {
            $className = "\\ModulesGarden\\Servers\\ZimbraEmail\\Packages\\" . $packageName . "\\Config\\PackageConfiguration";
            if (class_exists($className) && is_subclass_of($className, "ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Packages\\BasePackageConfiguration")) {
                $existing[] = $className;
            }
        }
        return $existing;
    }
    public function isNameValid($name = NULL)
    {
        if (trim($name) === "" || !is_string($name)) {
            return false;
        }
        return true;
    }
    public function isVersionValid($version = NULL)
    {
        if (trim($version) === "" || !is_string($version)) {
            return false;
        }
        return true;
    }
    public function isStatusValid($status = NULL)
    {
        if (!in_array($status, [AppPackageConfiguration::PACKAGE_STATUS_ACTIVE, AppPackageConfiguration::PACKAGE_STATUS_INACTIVE])) {
            return false;
        }
        return true;
    }
}

?>