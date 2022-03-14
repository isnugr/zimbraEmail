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
 * Time: 12:59
 * Class DeleteEmailAliasForm
 */
class DeleteEmailAliasForm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\BaseForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "deleteAccountForm";
    protected $name = "deleteAccountForm";
    protected $title = "deleteAccountForm";
    public function initContent()
    {
        $this->setFormType(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::DELETE);
        $this->dataProvider = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Providers\DeleteEmailAliasDataProvider();
        $this->setConfirmMessage("confirmDeleteAccountAlias");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden("id");
        $this->addField($field);
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden("alias");
        $this->addField($field);
        $this->loadDataToForm();
    }
}

?>