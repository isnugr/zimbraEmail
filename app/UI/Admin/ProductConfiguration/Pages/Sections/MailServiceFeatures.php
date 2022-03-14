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
 * Class MailServiceFeatures
 */
class MailServiceFeatures extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\BoxSectionExtended implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "mailServiceFeatures";
    protected $name = "mailServiceFeatures";
    protected $title = "mailServiceFeatures";
    public function initContent()
    {
        $mainSwitch = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ActionSwitcher("featureSection");
        $mainSwitch->addHtmlAttribute("onchange", "checkSection('',[],event)")->initIds($this->name . "SelectAll")->addClass("configSelectAllButton")->setName($mainSwitch->getName())->setId($mainSwitch->getId());
        $this->setTooltip($mainSwitch)->addSection($this->getLeftSection())->addSection($this->getRightSection());
    }
    public function getLeftSection()
    {
        $left = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\HalfPageSection("left");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureMailPriorityEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $left->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraImapEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $left->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureImapDataSourceEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $left->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureMailSendLaterEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $left->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureFiltersEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $left->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureNewMailNotificationEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $left->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureReadReceiptsEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $left->addField($field);
        return $left;
    }
    public function getRightSection()
    {
        $right = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\HalfPageSection("right");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureFlaggingEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraPop3Enabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeaturePop3DataSourceEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureConversationsEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureOutOfOfficeReplyEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("zimbraFeatureIdentitiesEnabled");
        $field->addHtmlAttribute("onchange", "checkOptionUnderSection(event)");
        $right->addField($field);
        return $right;
    }
}

?>