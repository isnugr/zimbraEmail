<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Traits;

interface Params
{
    /**
     * @var array
     * params container
     */
    protected $params = [];
    public function setParams($params);
    public function getParams();
    public function getParam($key, $default);
    public function setParam($key, $value);
}

?>