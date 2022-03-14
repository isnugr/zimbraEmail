<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Hook;

/**
 * Description of Config
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Config
{
    /**
     * @var type
     */
    protected $data = [];
    public function __construct()
    {
        $this->data = \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader::read(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getDevConfigDir() . DS . "hooks.yml")->get("name", []);
    }
    public function checkHook($name)
    {
        if (isset($this->data) && count($this->data) != 0) {
            return (int) array_get($this->data, $name, true);
        }
        return true;
    }
}

?>