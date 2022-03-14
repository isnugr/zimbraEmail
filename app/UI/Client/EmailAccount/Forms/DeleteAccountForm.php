<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Forms;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 11:28
 * Class DeleteAccountForm
 */
class DeleteAccountForm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\BaseForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "deleteAccountForm";
    protected $name = "deleteAccountForm";
    protected $title = "deleteAccountForm";
    public function initContent()
    {
        $this->setFormType(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::DELETE);
        $this->dataProvider = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Providers\DeleteAccountDataProvider();
        $this->setConfirmMessage("confirmRemoveAccount");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden();
        $field->setId("id");
        $field->setName("id");
        $this->addField($field);
        $this->loadDataToForm();
    }
}

?>