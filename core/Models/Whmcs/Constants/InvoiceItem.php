<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Constants;

class InvoiceItem
{
    const TYPE_PRODUCT = "product";
    const TYPE_ADDON = "addon";
    const TYPE_DOMAIN = "domainpricing";
    const TYPE_DOMAIN_REGISTER = "domainregister";
    const TYPE_DOMAIN_TRANSFER = "domaintransfer";
    const TYPE_DOMAIN_RENEW = "domainrenew";
    const DOMAIN_TYPES = ["domainregister", "domaintransfer", "domainrenew"];
}

?>