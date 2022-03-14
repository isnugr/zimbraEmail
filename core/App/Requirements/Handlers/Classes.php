<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Handlers;

/**
 * Description of Files
 *
 * @author INBSX-37H
 */
class Classes extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Handler implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\HandlerInterface
{
    protected $classList = [];
    public function __construct($classList = [])
    {
        $this->classList = $classList;
        $this->handleRequirements();
    }
    public function handleRequirements()
    {
        foreach ($this->classList as $record) {
            $this->handleRequirement($record);
        }
    }
    protected function handleRequirement($record)
    {
        $className = $record[\ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\Classes::CLASS_NAME];
        if ($className[0] !== "\\") {
            $className = "\\" . $className;
        }
        if (class_exists($className)) {
            return NULL;
        }
        $this->addUnfulfilledRequirement("In order for the module to work correctly, it requires the :class_name: class.", ["class_name" => $className]);
    }
}

?>