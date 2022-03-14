<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Traits;

/**
 * Description of AppParams
 *
 * @author INBSX-37H
 */
interface AppParams
{
    /** 
     *
     * @var type \ModulesGarden\Servers\ZimbraEmail\Core\App\AppParamsContainer
     */
    protected $appParams = NULL;
    public function initParams();
    public function setAppParam($key, $value);
    public function getAppParams();
    public function getAppParam($key, $default);
}

?>