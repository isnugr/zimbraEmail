<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Packages;

abstract class AppPackageConfiguration
{
    const PACKAGE_STATUS = "packageStatus";
    const PACKAGE_STATUS_ACTIVE = "active";
    const PACKAGE_STATUS_INACTIVE = "inactive";
    public function getSuboptionsByCallback($optName = NULL)
    {
        $fullOptName = $optName . "GetSubOptions";
        if (method_exists($this, $fullOptName)) {
            return $this->{$fullOptName}();
        }
        return false;
    }
}

?>