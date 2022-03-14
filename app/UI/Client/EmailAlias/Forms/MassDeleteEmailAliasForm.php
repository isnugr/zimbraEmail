<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Forms;

class MassDeleteEmailAliasForm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\BaseForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "deleteAccountForm";
    protected $name = "deleteAccountForm";
    protected $title = "deleteAccountForm";
    protected function getDefaultActions()
    {
        return ["massDelete"];
    }
    public function initContent()
    {
        $this->setFormType("massDelete");
        $this->dataProvider = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Providers\DeleteEmailAliasDataProvider();
        $this->setConfirmMessage("massDeleteEmailAliasModalConfirm");
        $this->loadDataToForm();
    }
}

?>