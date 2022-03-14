<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\RegisterManager;

/**
 * Description of Entity
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Entity
{
    protected $key = NULL;
    protected $data = NULL;
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    public function getData()
    {
        return $this->data;
    }
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }
    public function getKey()
    {
        return $this->key;
    }
}

?>