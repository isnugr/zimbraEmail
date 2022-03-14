<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader;

/**
 * Description of Ini
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Ini extends AbstractType
{
    protected function loadFile()
    {
        $return = [];
        $reader = new \Piwik\Ini\IniReader();
        try {
            if (file_exists($this->path . DS . $this->file)) {
                $return = $reader->readFile($this->path . DS . $this->file);
            }
        } catch (\Piwik\Ini\IniReadingException $e) {
            \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\FileReader\\Reader\\Ini", $e->getMessage(), $e->getTrace());
            $this->data = $return;
        }
    }
}

?>