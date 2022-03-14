<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Icons related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface HideByDefaultIfNoData
{
    protected $hideByDefaultIfNoData = false;
    public function setHideByDefaultIfNoData();
    public function unsetHideByDefaultIfNoData();
    public function isHideByDefaultIfNoData();
}

?>