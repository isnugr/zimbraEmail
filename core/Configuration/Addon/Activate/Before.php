<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Configuration\Addon\Activate;

/**
 * Runs before module activation actions
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Before extends \ModulesGarden\Servers\ZimbraEmail\Core\Configuration\Addon\AbstractBefore
{
    public function execute($params = [])
    {
        $path = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getModuleRootDir() . DS . "storage";
        if (is_writable($path) === false || is_readable($path) === false) {
            $params["status"] = "error";
            $params["description"] .= PHP_EOL . \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("lang")->addReplacementConstant("storage_path", \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage"))->absoluteT("permissionsStorage");
        }
        return $params;
    }
}

?>