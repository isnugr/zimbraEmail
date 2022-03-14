<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App;

class AppParamsContainer
{
    /**
     * @var array
     * params container
     */
    protected $params = [];
    public function getParams()
    {
        return $this->params;
    }
    public function getParam($key, $default = NULL)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }
        return $default;
    }
    public function setParam($key, $value = NULL)
    {
        $this->params[$key] = $value;
        return $this;
    }
}

?>