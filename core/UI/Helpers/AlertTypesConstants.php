<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Helpers;

/**
 * Constants vars for alert types
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class AlertTypesConstants
{
    const SUCCESS = "success";
    const INFO = "info";
    const WARNING = "warning";
    const DANGER = "danger";
    const EXTRA_SMALL = "xs";
    const SMALL = "sm";
    const DEFAULT_SIZE = "";
    const LARGE = "lg";
    const EXTRA_LARGE = "xlg";
    public static function getAlertTypes()
    {
        return [DANGER, INFO, SUCCESS, WARNING, NULL];
    }
    public static function getAlertSizes()
    {
        return [EXTRA_SMALL, SMALL, DEFAULT_SIZE, LARGE, EXTRA_LARGE];
    }
}

?>