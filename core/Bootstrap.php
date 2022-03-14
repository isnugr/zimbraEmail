<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

if (!defined("DS")) {
    define("DS", DIRECTORY_SEPARATOR);
}
if (!defined("PS")) {
    define("PS", PATH_SEPARATOR);
}
if (!defined("CRLF")) {
    define("CRLF", "\r\n");
}
require_once dirname(__DIR__) . DS . "vendor" . DS . "autoload.php";
ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::initialize();
new ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection\Builder();
new ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection\Services();
if (is_dir(ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage")) === false || is_writable(ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage")) === false || is_writable(ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage", "app")) === false || is_writable(ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage", "crons")) === false || is_writable(ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage", "logs")) === false) {
    ModulesGarden\Servers\ZimbraEmail\Core\FileReader\File::createPaths(["full" => ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage"), "permission" => 511], ["full" => ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage", "app"), "permission" => 511], ["full" => ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage", "crons"), "permission" => 511], ["full" => ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage", "logs"), "permission" => 511]);
}
$pathValidator = new ModulesGarden\Servers\ZimbraEmail\Core\FileReader\PathValidator();
if (!$pathValidator->validatePath(ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage", "logs"), true, true, true)) {
    ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager")->addError("Bootstrap", PHP_EOL . ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("lang")->absoluteT("permissionsStorage"), ["path" => ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage")]);
}

?>