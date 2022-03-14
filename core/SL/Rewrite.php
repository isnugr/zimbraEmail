<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\SL;

/**
 * Description of Register
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Rewrite extends AbstractReaderYml
{
    protected function load()
    {
        $version8OrHigher = (new \ModulesGarden\Servers\ZimbraEmail\Core\Helper\WhmcsVersionComparator())->isWVersionHigherOrEqual("8.0.0");
        $dataDev = $this->readYml(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("app", "Config", "di", "rewrite.yml"));
        $data = [];
        if (isset($dataDev) && isset($dataDev["class"])) {
            foreach ($dataDev["class"] as $class) {
                if ($version8OrHigher) {
                    $class["old"] = "\\" . $class["old"];
                    $class["new"] = "\\" . $class["new"];
                }
                $data[$class["old"]] = $class["new"];
            }
        }
        $this->data = $data;
    }
}

?>