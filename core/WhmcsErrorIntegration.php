<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

if (!class_exists("\\ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\WhmcsErrorManagerWrapper")) {
    require_once __DIR__ . DIRECTORY_SEPARATOR . "HandlerError" . DIRECTORY_SEPARATOR . "WhmcsErrorManagerWrapper.php";
}
ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\WhmcsErrorManagerWrapper::setErrorManager($errMgmt);

?>