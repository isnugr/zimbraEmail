<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Enum;

/**
 * Description of StatusColor
 *
 * @author Pawel Kopec <pawelk@modulesgardne.com>
 */
class StatusColor extends Enum
{
    const PENDING = "f89406";
    const ACTIVE = "46a546";
    const COMPLETED = "008b8b";
    const SUSPENDED = "0768b8";
    const CANCELLED = "bfbfbf";
    const FRAUD = "000";
    public static function getColors()
    {
        return ["Pending" => PENDING, "Active" => ACTIVE, "Completed" => COMPLETED, "Suspended" => SUSPENDED, "Cancelled" => CANCELLED, "Fraud" => FRAUD];
    }
}

?>