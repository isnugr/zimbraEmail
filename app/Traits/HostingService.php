<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Traits;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 10.09.19
 * Time: 10:43
 * Class HostingService
 */
interface HostingService
{
    public function getHostingId();
    public function setHostingId($hostingId);
    public function hosting();
    public function isActive();
    public function isSupportedModule();
    private function getCustomFieldId($fieldName);
    public function customFieldUpdate($name, $value);
}

?>