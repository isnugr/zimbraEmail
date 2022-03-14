<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

define("DS", DIRECTORY_SEPARATOR);
$modulePath = dirname(__DIR__);
$whmcsPath = dirname(dirname(dirname($modulePath)));
require_once $whmcsPath . DS . "init.php";
require_once $modulePath . DS . "core" . DS . "Bootstrap.php";
ini_set("max_execution_time", 0);
$argList = $argv ? $argv : $_SERVER["argv"];
if (count($argList) === 0) {
    $argList = ["\7IONCUBE__FILE__"];
}
(new ModulesGarden\Servers\ZimbraEmail\Core\CommandLine\CronManager())->run();

?>