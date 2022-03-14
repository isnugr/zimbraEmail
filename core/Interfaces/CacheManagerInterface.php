<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Interfaces;

/**
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
final class CacheManagerInterface
{
    public abstract function setKey($key);
    public abstract function getKey();
    public abstract function setData($data);
    public abstract function getData();
    public abstract function save();
    public abstract function remove();
    public abstract function clearAll();
    public abstract function exist();
}

?>