<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Fields related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface RefreshAction
{
    protected $refreshActionIds = [];
    public function getRefreshActionIds();
    public function addRefreshActionId($refreshActionId);
}

?>