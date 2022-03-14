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
 * Date: 02.10.19
 * Time: 14:32
 * Class DeleteDomainAliasForm
 */
class DeleteDomainAliasForm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\BaseForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "deleteDomainAliasForm";
    protected $name = "deleteDomainAliasForm";
    protected $title = "deleteDomainAliasForm";
    public function initContent()
    {
        $this->setFormType(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::DELETE);
        $this->setProvider(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DomainAlias\Providers\DeleteDomainAliasProvider());
        $this->setConfirmMessage("confirmRemoveDomainAlias");
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden();
        $field->setId("id");
        $field->setName("id");
        $this->addField($field);
        $this->loadDataToForm();
    }
}

?>