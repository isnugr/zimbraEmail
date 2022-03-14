<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Alerts related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface Alerts
{
    protected $internalAlertMessage = NULL;
    protected $internalAlertMessageType = "info";
    protected $internalAlertMessageRaw = false;
    protected $internalAlertSize = "sm";
    public function setInternalAlertMessage($message);
    public function getInternalAlertMessage();
    public function setInternalAlertMessageType($type);
    public function getInternalAlertMessageType();
    public function setInternalAlertMessageRaw($isRaw);
    public function isInternalAlertMessageRaw();
    public function addInternalAlert($message, $type, $size, $isRaw);
    public function haveInternalAlertMessage();
    public function setInternalAlertSize($size);
    public function getInternalAlertSize();
}

?>