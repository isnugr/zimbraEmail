<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements;

/**
 * Description of Requirements
 *
 * @author INBSX-37H
 */
abstract class RequirementsList
{
    protected $requirementsList = [];
    public function getHandlerInstance()
    {
        $handler = $this->getHandler();
        if (!class_exists($handler)) {
            return NULL;
        }
        return new $handler($this->requirementsList);
    }
    public abstract function getHandler();
}

?>