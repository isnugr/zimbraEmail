<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Pages\Sections;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 29.08.19
 * Time: 08:33
 * Class EssentialFeatures
 */
class EssentialFeatures extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\BoxSectionExtended implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "essentialFeatures";
    protected $name = "essentialFeatures";
    protected $title = "essentialFeatures";
    public function initContent()
    {
        $mainSwitch = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ActionSwitcher("featureSection");
        $mainSwitch->addHtmlAttribute("onchange", "checkSection('',[],event)")->initIds($this->name . "SelectAll")->addClass("configSelectAllButton")->setName($mainSwitch->getName())->setId($mainSwitch->getId());
        $this->setTooltip($mainSwitch)->addSection($this->getLeftSection())->addSection($this->getRightSection());
    }
    public function getLeftSection()
    {
        $leftSection = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\HalfPageSection("essentialFeaturesLeft");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureMailEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $leftSection->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureCalendarEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $leftSection->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureBriefcasesEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $leftSection->addField($field);
        return $leftSection;
    }
    public function getRightSection()
    {
        $right = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\HalfPageSection("essentialFeaturesRight");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureContactsEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureTasksEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureOptionsEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        return $right;
    }
}

?>