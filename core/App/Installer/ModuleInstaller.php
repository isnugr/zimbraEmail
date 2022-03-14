<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Installer;

class ModuleInstaller
{
    protected $databaseInstaller = NULL;
    public function __construct()
    {
        $this->databaseInstaller = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::get("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Installer\\DatabaseInstaller");
    }
    public function makeInstall()
    {
        $this->installModule();
        $this->installPackages();
    }
    public function installModule()
    {
        array_map(function ($value) {
            $this->databaseInstaller->performQueryFromFile($value);
        }, $this->getModuleQueriesPaths());
    }
    public function getModuleQueriesPaths()
    {
        return [\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("core", "Database", "schema.sql"), \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("app", "Database", "schema.sql"), \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("core", "Database", "data.sql"), \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("app", "Database", "data.sql")];
    }
    public function installPackages()
    {
        $packageManager = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::get("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Packages\\PackageManager");
        array_map(function ($package) {
            $packageName = $package->getName();
            $packageSchemaPath = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("packages", $packageName, "Database", "schema.sql");
            if (file_exists($packageSchemaPath) && is_readable($packageSchemaPath)) {
                $this->databaseInstaller->performQueryFromFile($packageSchemaPath);
            }
            $packageDataPath = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("packages", $packageName, "Database", "schema.sql");
            if (file_exists($packageDataPath) && is_readable($packageDataPath)) {
                $this->databaseInstaller->performQueryFromFile($packageDataPath);
            }
        }, $packageManager->getPackagesConfiguration());
    }
    public function isInstallCorrect()
    {
        return $this->databaseInstaller->isInstallCorrect();
    }
    public function getFailedQueries()
    {
        return $this->databaseInstaller->getFailedQueries();
    }
    public function getQueriesResults()
    {
        return $this->databaseInstaller->getQueriesResults();
    }
}

?>