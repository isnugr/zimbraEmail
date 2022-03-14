<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Forms;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 11:50
 * Class AddEmailAliasForm
 */
class AddEmailAliasForm extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Forms\SortedFieldForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "addEmailAliasForm";
    protected $name = "addEmailAliasForm";
    protected $title = "addEmailAliasForm";
    public function initContent()
    {
        $this->setFormType(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::CREATE);
        $this->setProvider(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Providers\AddEmailAliasDataProvider());
        $this->initFields();
        $this->loadDataToForm();
    }
    public function initFields()
    {
        $email = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\InputGroup("usernameGroup");
        $email->addTextField("aliasName", false, true);
        $email->addInputAddon("emailSign", false, "@");
        $email->addInputComponent((new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\InputGroupElements\Text("domain"))->addHtmlAttribute("readonly", "true"));
        $this->addSection($email);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select("mailbox");
        $field->notEmpty();
        $this->addField($field);
    }
}

?>