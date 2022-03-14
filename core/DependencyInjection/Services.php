<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection;

/**
 * Load all services from yml file and mark them as shared in DI container
 * @author Mariusz Miodowski <mariusz@modulesgarden.com>
 * @package ModulesGarden\DomainOrdersExtended\Core\Services
 */
class Services
{
    public function __construct()
    {
        $this->load();
    }
    protected function load()
    {
        foreach ($this->getFilesList() as $file) {
            $servicesList = \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader::read($file)->get();
            if (is_array($servicesList) && !empty($servicesList)) {
                $this->registerServices($servicesList);
            }
        }
    }
    protected function registerServices($servicesList)
    {
        foreach ($servicesList as $service) {
            Container::getInstance()->singleton($service);
        }
    }
    protected function getFilesList()
    {
        return [\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("app", "Config", "di", "services.yml"), \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("core", "Config", "di", "services.yml")];
    }
}

?>