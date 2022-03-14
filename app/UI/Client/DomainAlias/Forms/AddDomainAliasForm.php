<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DomainAlias\Forms;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 13:38
 * Class AddDomainAliasForm
 */
class AddDomainAliasForm extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Forms\SortedFieldForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "addDomainAliasForm";
    protected $name = "addDomainAliasForm";
    public function initContent()
    {
        $this->setFormType(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::CREATE);
        $this->setProvider(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DomainAlias\Providers\AddDomainAliasDataProvider());
        $this->initFields();
        $this->loadDataToForm();
    }
    protected function initFields()
    {
        $email = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\InputGroup("aliasGroup");
        $email->addInputComponent((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\InputGroupElements\Text("domain"))->addHtmlAttribute("readonly", "true"));
        $email->addInputAddon("emailSign", false, "→");
        $email->addInputComponent(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\InputGroupElements\Text("alias"));
        $this->addSection($email);
        $this->addField((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text("description"))->setDescription("descriptionDomainList"));
        $this->addField(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden("domainId"));
    }
}

?>