<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances;

/**
 * Description of Classes
 *
 * @author INBSX-37H
 */
abstract class Classes extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\RequirementsList implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\RequirementInterface
{
    const CLASS_NAME = "className";
    public final function getHandler()
    {
        return "ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Requirements\\Handlers\\Classes";
    }
}

?>