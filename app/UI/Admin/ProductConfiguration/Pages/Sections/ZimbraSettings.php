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
 * Date: 28.08.19
 * Time: 09:15
 * Class ZimbraSettingsSection
 */
class ZimbraSettings extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections\BoxSectionExtended implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "zimbraSettings";
    protected $name = "zimbraSettings";
    protected $title = "zimbraSettings";
    public function initContent()
    {
        $this->addSection($this->getLeftSection())->addSection($this->getRightSection());
    }
    public function getLeftSection()
    {
        $leftSection = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\HalfPageSection("leftSide");
        $field = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField("acc_limit");
        $field->setFieldType(\ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField::TYPE_NUMBER);
        $field->addHtmlAttribute("min", \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::UNLIMITED);
        $field->setDescription("description");
        $leftSection->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField("alias_limit");
        $field->setFieldType(\ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField::TYPE_NUMBER);
        $field->addHtmlAttribute("min", \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::UNLIMITED);
        $field->setDescription("description");
        $leftSection->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select("cos_name");
        $field->addHtmlAttribute("onChange", "hiddeSections(event)");
        $field->setDescription("description");
        $leftSection->addField($field);
        $loginLink = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("login_link");
        $loginLink->setDescription("description");
        $leftSection->addField($loginLink);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher("filterAccountsByCOS");
        $field->setDescription("description");
        $leftSection->addField($field);
        return $leftSection;
    }
    public function getRightSection()
    {
        $right = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\HalfPageSection("rightSide");
        $field = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField("acc_size");
        $field->setFieldType(\ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField::TYPE_NUMBER);
        $field->addHtmlAttribute("min", \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::UNLIMITED);
        $field->setDescription("description");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField("domain_alias_limit");
        $field->setFieldType(\ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField::TYPE_NUMBER);
        $field->addHtmlAttribute("min", \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::UNLIMITED);
        $field->setDescription("description");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField("dist_list_limit");
        $field->setFieldType(\ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField::TYPE_NUMBER);
        $field->addHtmlAttribute("min", \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::UNLIMITED);
        $field->setDescription("description");
        $right->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField("domainMaxSize");
        $field->setFieldType(\ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields\ExtendedInputField::TYPE_NUMBER);
        $field->addHtmlAttribute("min", \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::UNLIMITED);
        $field->setDescription("description");
        $right->addField($field);
        return $right;
    }
}

?>