<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Modals;

class MassDeleteListModal extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\BaseModal implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "massDeleteListModal";
    protected $name = "massDeleteListModal";
    protected $title = "massDeleteListModal";
    public function initContent()
    {
        $this->setSubmitButtonClassesDanger();
        $this->setModalTitleTypeDanger();
        $this->addForm(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Forms\MassDeleteListForm());
    }
}

?>