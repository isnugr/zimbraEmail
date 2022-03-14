<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Forms;

class MassChangeStatusForm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\BaseForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "massChangeStatusForm";
    protected $name = "massChangeStatusForm";
    protected $title = "massChangeStatusForm";
    public function initContent()
    {
        $this->setFormType(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\FormConstants::UPDATE);
        $this->dataProvider = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Providers\AccountDataProvider();
        $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select("status");
        $this->addField($field);
        $this->loadDataToForm();
    }
}

?>