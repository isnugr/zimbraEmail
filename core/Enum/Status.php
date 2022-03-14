<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Enum;

/**
 * Description of Status
 *
 * @author Pawel Kopec <pawelk@modulesgardne.com>
 */
class Status extends Enum
{
    const DEBUG = "debug";
    const ERROR = "error";
    const INFO = "info";
    const SUCCESS = "success";
    const CRITICAL = "critical";
}

?>