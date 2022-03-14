<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances;

/**
 * Description of Files
 *
 * @author INBSX-37H
 */
abstract class Files extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\RequirementsList implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\RequirementInterface
{
    const WHMCS_PATH = ":WHMCS_PATH:";
    const MODULE_PATH = ":MODULE_PATH:";
    const PATH = "path";
    const TYPE = "type";
    const REMOVE = "remove";
    const EXISTS = "exists";
    const IS_WRITABLE = "isWritable";
    const IS_READABLE = "isReadable";
    public final function getHandler()
    {
        return "ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Requirements\\Handlers\\Files";
    }
}

?>