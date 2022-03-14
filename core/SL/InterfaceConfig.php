<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\SL;

/**
 * Description of InterfaceConfig
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class InterfaceConfig extends AbstractReaderYml
{
    protected function load()
    {
        list($dataDev, $dataCore) = $this->readFiles();
        $data = NULL;
        if (isset($dataDev) && isset($dataCore)) {
            $this->buildData($dataDev, $dataCore, $data);
        } else {
            if (!isset($dataDev) && isset($dataCore) && isset($dataCore["interface"])) {
                $data = $dataCore["interface"];
            } else {
                if (isset($dataDev) && !isset($dataCore) && isset($dataDev["interface"])) {
                    $data = $dataDev["interface"];
                }
            }
        }
        $this->data = $this->rebuildData($data);
    }
    private function rebuildData($data)
    {
        $returnData = [];
        foreach ($data as $item) {
            $returnData[$item["namespace"]][$item["where"]] = $item["class"];
        }
        return $returnData;
    }
    private function buildData($dataDev, $dataCore, $data)
    {
        if (isset($dataDev["interface"]) && isset($dataCore["interface"])) {
            foreach ($dataCore["interface"] as $core) {
                $isFind = false;
                foreach ($dataDev["interface"] as $dev) {
                    if ($dev["namespace"] === $core["namespace"] && $dev["class"] === $core["class"] && $dev["where"] === $core["where"]) {
                        $isFind = true;
                        if (!$isFind) {
                            $dataDev["interface"][] = $core;
                        }
                    }
                }
            }
            $data = $dataDev["interface"];
        } else {
            if (!isset($dataDev["interface"]) && isset($dataCore["interface"])) {
                $data = $dataCore["interface"];
            } else {
                if (isset($dataDev["interface"]) && !isset($dataCore["interface"])) {
                    $data = $dataDev["interface"];
                }
            }
        }
    }
    private function readFiles()
    {
        return [$this->readYml(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("app", "Config", "di", "interface.yml")), $this->readYml(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("core", "Config", "di", "interface.yml"))];
    }
}

?>