<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Forms;

class DeleteListForm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\BaseForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "deleteAccountForm";
    protected $name = "deleteAccountForm";
    protected $title = "deleteAccountForm";
    public function initContent()
    {
        $this->setFormType(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::DELETE);
        $this->dataProvider = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Providers\DeleteListDataProvider();
        $this->setConfirmMessage("confirmRemoveList");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden();
        $field->setId("id");
        $field->setName("id");
        $this->addField($field);
        $this->loadDataToForm();
    }
}

?>