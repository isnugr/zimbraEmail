<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Forms;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 13:32
 * Class AddListForm
 */
class AddListForm extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Forms\SortedFieldForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "addListForm";
    protected $name = "addListForm";
    public function initContent()
    {
        $this->setFormType(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::CREATE);
        $this->setProvider(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Providers\AddListDataProvider());
        $this->initFields();
        $this->loadDataToForm();
    }
    protected function initFields()
    {
        $this->addSection(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Sections\AddMembersDistribution());
        $this->addSection(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Sections\AddPropertiesDistribution());
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