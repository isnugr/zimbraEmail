<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections;

class HalfPageCustomCosSection extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\HalfPageSection
{
    public function loadDataToForm($dataProvider)
    {
        $cos = $dataProvider->getValueById("cos");
        $value = $cos[$field->getId()] ? $cos[$field->getId()] : $dataProvider->getValueById($field->getId());
        $field->setValue($value);
        $avValues = $dataProvider->getAvailableValuesById($field->getId());
        if ($avValues && method_exists($field, "setAvailableValues")) {
            $field->setAvailableValues($avValues);
        }
        $section->loadDataToForm($dataProvider);
    }
}

?>