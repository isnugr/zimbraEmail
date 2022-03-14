<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Packages;

abstract class BasePackageConfiguration
{
    protected $configuration = NULL;
    protected $appConfigFound = false;
    public static $protectedConfigOptions = NULL;
    public function __get($key)
    {
        $this->loadConfiguration();
        if (isset($this->configuration[$key])) {
            return $this->configuration[$key];
        }
        return NULL;
    }
    public function getConfig()
    {
        $this->loadConfiguration();
        return $this->configuration;
    }
    public function getName()
    {
        $this->loadConfiguration();
        return $this->configuration[PackageConfigurationConst::PACKAGE_NAME];
    }
    public function loadConfiguration($forceReload = false)
    {
        if (!($this->configuration === NULL || $forceReload)) {
            return NULL;
        }
        $config = self::CONFIGURATION;
        $packageName = $config[PackageConfigurationConst::PACKAGE_NAME];
        $appPackageConfig = $this->getAppPackageConfig($packageName);
        $merged = array_merge($config, $appPackageConfig);
        foreach (self::$protectedConfigOptions as $protectedOption) {
            $merged[$protectedOption] = $config[$protectedOption];
        }
        $this->configuration = $merged;
    }
    public function getAppPackageConfig($packageName = NULL)
    {
        $appConfigClassName = "\\ModulesGarden\\Servers\\ZimbraEmail\\App\\Config\\Packages\\" . $packageName;
        if (!class_exists($appConfigClassName) || !is_subclass_of($appConfigClassName, "ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Packages\\AppPackageConfiguration") || !defined($appConfigClassName . "::APP_CONFIGURATION")) {
            return [];
        }
        $this->appConfigFound = true;
        return $appConfigClassName::APP_CONFIGURATION;
    }
}

?>