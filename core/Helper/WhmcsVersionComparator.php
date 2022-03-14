<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Helper;

class WhmcsVersionComparator
{
    public static function isWhmcsVersionHigherOrEqual($toCompare)
    {
        if (isset($GLOBALS["CONFIG"]["Version"])) {
            $version = explode("-", $GLOBALS["CONFIG"]["Version"]);
            return version_compare($version[0], $toCompare, ">=");
        }
        global $whmcs;
        return version_compare($whmcs->getVersion()->getRelease(), $toCompare, ">=");
    }
    public function isWVersionHigherOrEqual($toCompare)
    {
        return self::isWhmcsVersionHigherOrEqual($toCompare);
    }
}

?>