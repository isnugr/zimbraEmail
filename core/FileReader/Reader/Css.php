<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader;

/**
 * Description of Json
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Css extends AbstractType
{
    protected function loadFile()
    {
        $return = "";
        try {
            if (file_exists($this->path . DS . $this->file)) {
                $return = file_get_contents($this->path . DS . $this->file);
                foreach ($this->renderData as $key => $value) {
                    $return = str_replace("#" . $key . "#", $value, $return);
                }
            }
        } catch (\Exception $e) {
            \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\FileReader\\Reader\\Css", $e->getMessage(), $e->getTrace());
            $this->data = $return;
        }
    }
}

?>