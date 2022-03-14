<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Forms;

class EditListForm extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Forms\SortedFieldForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "editListForm";
    protected $name = "editListForm";
    public function initContent()
    {
        $this->setFormType(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::UPDATE);
        $this->setProvider(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Providers\EditListDataProvider());
        $this->initFields();
        $this->loadDataToForm();
    }
    protected function initFields()
    {
        $this->addSection(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Sections\EditMembersDistribution());
        $this->addSection(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Sections\EditPropertiesDistribution());
        $this->addSection(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Sections\AddAliasesDistribution());
        $this->addSection(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Sections\AddOwnersDistribution());
        $this->addSection(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Sections\AddPreferencesDistribution());
    }
    public function reloadFormStructure()
    {
        $this->loadDataToForm();
    }
}

?>