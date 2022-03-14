<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections;

/**
 * Base Form Section controler
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class BaseSection extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Fields;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Sections;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Buttons;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Section;
    protected $id = "baseSection";
    protected $name = "baseSection";
    protected $initialized = false;
    public function loadDataToForm($dataProvider)
    {
        $field->setValue($dataProvider->getValueById($field->getId()));
        $avValues = $dataProvider->getAvailableValuesById($field->getId());
        if ($avValues && method_exists($field, "setAvailableValues")) {
            $field->setAvailableValues($avValues);
        }
        $section->loadDataToForm($dataProvider);
    }
    public function loadDataToFormByName($dataProvider)
    {
        $field->setValue($dataProvider->getValueByName($field->getName()));
        if ($dataProvider->isDisabledById($field->getId())) {
            $field->disableField();
        }
        $section->loadDataToFormByName($dataProvider);
    }
}

?>