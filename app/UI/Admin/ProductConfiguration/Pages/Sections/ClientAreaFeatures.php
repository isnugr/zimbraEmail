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
 * Date: 10.10.19
 * Time: 09:55
 * Class ClientAreaFeatures
 */
class ClientAreaFeatures extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\BoxSectionExtended implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "clientAreaFeatures";
    protected $name = "clientAreaFeatures";
    protected $title = "clientAreaFeatures";
    public function initContent()
    {
        $mainSwitch = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ActionSwitcher("featureSection");
        $mainSwitch->addHtmlAttribute("onchange", "checkSection('',[],event)")->initIds($this->name . "SelectAll")->addClass("configSelectAllButton")->setName($mainSwitch->getName())->setId($mainSwitch->getId());
        $this->setTooltip($mainSwitch)->addSection($this->getLeftSection())->addSection($this->getRightSection());
    }
    public function getLeftSection()
    {
        $leftSection = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\HalfPageSection("clientAreaFeaturesLeft");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("ca_emailAccountPage");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $leftSection->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("ca_distributionListPage");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $leftSection->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("ca_goToWebmailPage");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $leftSection->addField($field);
        return $leftSection;
    }
    public function getRightSection()
    {
        $right = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\HalfPageSection("clientAreaFeaturesRight");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("ca_emailAliasesPage");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("ca_domainAliasesPage");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("ca_logInToMailboxButton");
        $right->addField($field);
        return $right;
    }
}

?>