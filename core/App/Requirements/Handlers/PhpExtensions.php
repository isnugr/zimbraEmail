<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Handlers;

/**
 * Description of PhpExtensions
 *
 * @author INBSX-37H
 */
class PhpExtensions extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Handler implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\HandlerInterface
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    protected $extensionsList = [];
    public function __construct($classList = [])
    {
        $this->extensionsList = $classList;
        $this->handleRequirements();
    }
    public function handleRequirements()
    {
        foreach ($this->extensionsList as $record) {
            $this->handleRequirement($record);
        }
    }
    protected function handleRequirement($record)
    {
        $extension = $record[\ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Instances\PhpExtensions::EXTENSION_NAME];
        if (extension_loaded($extension)) {
            return NULL;
        }
        $this->addUnfulfilledRequirement("In order for the module to work correctly, it requires the :extension_name: PHP extension to be installed.", ["extension_name" => $extension]);
    }
}

?>