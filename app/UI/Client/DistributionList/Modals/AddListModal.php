<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Modals;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 13:32
 * Class AddListModal
 */
class AddListModal extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Modals\ModalExtendedTabsEdit implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "addListModal";
    protected $name = "addListModal";
    protected $title = "addListModal";
    public function initContent()
    {
        $this->setModalSizeMedium();
        $this->addForm(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Forms\AddListForm());
    }
}

?>