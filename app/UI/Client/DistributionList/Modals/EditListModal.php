<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Modals;

class EditListModal extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Modals\ModalExtendedTabsEdit implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "editListModal";
    protected $name = "editListModal";
    protected $title = "editListModal";
    public function initContent()
    {
        $this->setModalSizeMedium();
        $this->addForm(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Forms\EditListForm());
    }
}

?>