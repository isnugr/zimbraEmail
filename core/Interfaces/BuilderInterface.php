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
final class BuilderInterface
{
    public abstract function isCreate();
    public abstract function enableCreate();
    public abstract function disableCreate();
    public abstract function getType();
    public abstract function findConteiner($name);
    public abstract function call($object, $method, $name);
    public abstract function getContainer($name);
}

?>