<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models;

/**
 * Description of Breadcrumb
 *
 * @author inbs
 */
class Breadcrumb
{
    protected $name = NULL;
    protected $controller = NULL;
    protected $action = NULL;
    protected $params = [];
    protected $icon = NULL;
    protected $url = NULL;
    public function __construct($name, $controller, $action, $params = [], $icon = NULL, $isUrl = true)
    {
        $this->name = $name;
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
        $this->icon = $icon;
        $this->url = $isUrl ? \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::getUrl($this->controller, $this->action, $this->params) : NULL;
    }
    public function getName()
    {
        return $this->name;
    }
    public function isUrl()
    {
        return $this->url ? true : false;
    }
    public function getUrl()
    {
        return $this->url;
    }
    public function isIcon()
    {
        return $this->icon ? true : false;
    }
    public function getIcon()
    {
        return $this->icon;
    }
}

?>