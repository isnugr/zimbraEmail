<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Helper;

/**
 * Description of Config
 *
 * @author Mateusz Pawłowski <mateusz.pa@modulesgarden.com>
 */
class ConfigurableOptionsBuilder
{
    public static function build(\ModulesGarden\Servers\ZimbraEmail\App\Services\ConfigurableOptions\ConfigurableOptions $configurableOptions, $fieldsStatus = [], \ModulesGarden\Servers\ZimbraEmail\App\Services\ConfigurableOptions\Strategy\Types\AbstractOptions $options)
    {
        $allOptions = $options->getOptions();
        foreach ($fieldsStatus as $key => $field) {
            if ($field == "on") {
                $configurableOptions->addOption($allOptions[$key]);
            }
        }
        return $configurableOptions;
    }
    public static function buildAll(\ModulesGarden\Servers\ZimbraEmail\App\Services\ConfigurableOptions\ConfigurableOptions $configurableOptions, \ModulesGarden\Servers\ZimbraEmail\App\Services\ConfigurableOptions\Strategy\Types\AbstractOptions $options)
    {
        foreach ($options->getOptions() as $option) {
            $configurableOptions->addOption($option);
        }
        return $configurableOptions;
    }
    private static function convertToCamelCase($string, $delimiter = "_", $addPrefix = "")
    {
        $explodeString = explode($delimiter, $string);
        $newString = "";
        foreach ($explodeString as $value) {
            if (empty($newString) && $addPrefix != "") {
                $newString = lcfirst($addPrefix);
            } else {
                if (empty($newString) && $addPrefix == "") {
                    $newString = lcfirst($value);
                }
            }
            $newString .= ucfirst($value);
        }
        return $newString;
    }
}

?>