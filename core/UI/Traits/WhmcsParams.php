<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * WhmcsParams related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface WhmcsParams
{
    /**
     *
     * @var \ModulesGarden\Servers\ZimbraEmail\Core\Helper\WhmcsParams
     */
    private $whmcsParams = NULL;
    public function initWhmcsParams();
    protected function getWhmcsParamByKey($key, $default);
    public function getWhmcsParamsByKeys($keys, $default);
}

?>