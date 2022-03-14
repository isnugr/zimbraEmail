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
 * Time: 15:13
 * Class ProductConfig
 */
class ProductParams
{
    const CLASS_OF_SERVICE_NAME = "cos_name";
    const FILTER_ACCOUNT_BY_COS = "filterAccountsByCOS";
    const ACCOUNT_LIMIT = "acc_limit";
    const ACCOUNT_SIZE = "acc_size";
    const SIZE_UNLIMITED = "-1";
    const ZIMBRA_PREFIX_SETTINGS = "zimbra";
    const PASSWORD_MIN_PREFIX_SETTINGS = "minPass";
    const PASSWORD_MAX_PREFIX_SETTINGS = "maxPass";
    const ALIAS_LIMIT = "alias_limit";
    const DOMAIN_ALIAS_LIMIT = "domain_alias_limit";
    const DOMAIN_LIST_LIMIT = "dist_list_limit";
    const DOMAIN_MAX_SIZE = "domainMaxSize";
    const SWITCHER_ENABLED = "on";
    const SWITCHER_DISABLED = "off";
}

?>