<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader;

/**
 * Description of Yml
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Yml extends AbstractType
{
    protected function loadFile()
    {
        $return = [];
        try {
            if (file_exists($this->path . DS . $this->file)) {
                $return = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($this->path . DS . $this->file));
                $return = array_map("ModulesGarden\\Servers\\ZimbraEmail\\Core\\FileReader\\Reader\\Yml::replaceBackslash", $return ?: []);
            }
        } catch (\Symfony\Component\Yaml\Exception\ParseException $e) {
            \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\FileReader\\Reader\\Yml", $e->getMessage(), $e->getTrace());
            $this->data = $return;
        }
    }
    protected static function replaceBackslash($data)
    {
        if (is_array($data)) {
            return array_map("ModulesGarden\\Servers\\ZimbraEmail\\Core\\FileReader\\Reader\\Yml::replaceBackslash", $data);
        }
        return str_replace("\\\\", "\\", $data);
    }
}

?>