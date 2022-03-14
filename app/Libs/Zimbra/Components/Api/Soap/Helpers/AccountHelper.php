<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Helpers;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 09:22
 * Class AccountHelper
 */
class AccountHelper
{
    public static function getFormattedData($date, $format = "d/m/Y")
    {
        if (!$date) {
            return NULL;
        }
        $tmpDate = strstr($date, ".", true);
        $tmpDate = $tmpDate ? $tmpDate : $date;
        return date($format, strtotime($tmpDate));
    }
    public static function getQuotaAsMb($quote)
    {
        return isset($quote) ? $quote / \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::B_TO_MB : \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SIZE_UNLIMITED;
    }
}

?>