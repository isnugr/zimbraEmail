<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Enums;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 11.09.19
 * Time: 11:55
 * Class Size
 */
class Size
{
    const B_TO_MB = 1048576;
    const B_TO_KB = 1024;
    const DEFAULT_ACC_LIMIT = 20;
    const DEFAULT_ACC_SIZE = 100;
    const DEFAULT_ALIAS_LIMIT = 10;
    const DEFAULT_DOMAIN_ALIAS_LIMIT = 10;
    const DEFAULT_DIST_ALIAS_LIMIT = 10;
    const DEFAULT_NULL_VALUE = 0;
    const UNLIMITED = "-1";
}

?>