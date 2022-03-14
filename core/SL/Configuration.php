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
class Configuration extends AbstractReaderYml
{
    protected function load()
    {
        list($dataDev, $dataCore) = $this->readFiles();
        $data = NULL;
        if (isset($dataDev) && isset($dataCore)) {
            $this->buildData($dataDev, $dataCore, $data);
        } else {
            if (!isset($dataDev) && isset($dataCore) && isset($dataCore["class"])) {
                $data = $dataCore["class"];
            } else {
                if (isset($dataDev) && !isset($dataCore) && isset($dataDev["class"])) {
                    $data = $dataDev["class"];
                }
            }
        }
        $this->data = $data;
    }
    private function buildData($dataDev, $dataCore, $data)
    {
        if (isset($dataDev["class"]) && isset($dataCore["class"])) {
            foreach ($dataCore["class"] as $core) {
                $isFind = false;
                foreach ($dataDev["class"] as $dev) {
                    if ($dev["name"] === $core["name"]) {
                        $isFind = true;
                        if (!$isFind) {
                            $dataDev["class"][] = $core;
                        }
                    }
                }
            }
            $data = $dataDev["class"];
        } else {
            if (!isset($dataDev["class"]) && isset($dataCore["class"])) {
                $data = $dataCore["class"];
            } else {
                if (isset($dataDev["class"]) && !isset($dataCore["class"])) {
                    $data = $dataDev["class"];
                }
            }
        }
    }
    private function readFiles()
    {
        return [$this->readYml(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("app", "Config", "di", "buildWithDefaultMethod.yml")), $this->readYml(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("core", "Config", "di", "buildWithDefaultMethod.yml"))];
    }
}

?>