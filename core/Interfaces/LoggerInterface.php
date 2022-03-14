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
final class LoggerInterface
{
    public abstract function debug($message, $context);
    public abstract function error($message, $context);
    public abstract function warning($message, $context);
    public abstract function err($message, $context);
    public abstract function warn($message, $context);
    public abstract function addDebug($message, $context);
    public abstract function addWarning($message, $context);
    public abstract function addError($message, $context);
}

?>