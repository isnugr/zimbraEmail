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
 * Time: 08:34
 * Class SearchFeatures
 */
class SearchFeatures extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\BoxSectionExtended implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "searchFeatures";
    protected $name = "searchFeatures";
    protected $title = "searchFeatures";
    public function initContent()
    {
        $mainSwitch = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ActionSwitcher("featureSection");
        $mainSwitch->addHtmlAttribute("onchange", "checkSection('',[],event)")->initIds($this->name . "SelectAll")->addClass("configSelectAllButton")->setName($mainSwitch->getName())->setId($mainSwitch->getId());
        $this->setTooltip($mainSwitch)->addSection($this->getLeftSection())->addSection($this->getRightSection());
    }
    public function getLeftSection()
    {
        $left = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\HalfPageSection("left");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureAdvancedSearchEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $left->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureInitialSearchPreferenceEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $left->addField($field);
        return $left;
    }
    public function getRightSection()
    {
        $right = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\HalfPageSection("right");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureSavedSearchesEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeaturePeopleSearchEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        return $right;
    }
}

?>