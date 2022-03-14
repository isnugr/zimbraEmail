<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Modals;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 09:30
 * Class EditAccountModal
 */
class EditAccountModal extends \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Modals\ModalExtendedTabsEdit implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "editAccountModal";
    protected $name = "editAccountModal";
    protected $title = "editAccountModal";
    public function initContent()
    {
        $this->addForm(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Forms\EditAccountForm());
    }
}

?>