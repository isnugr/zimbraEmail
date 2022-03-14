<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons;

class ChangeStatusButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\DropdawnButtonWrappers\ButtonDropdownItem implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "changeStatusButton";
    protected $title = "changeStatusButton";
    protected $icon = "lu-dropdown__link-icon lu-btn__icon lu-zmdi lu-zmdi-refresh-sync";
    public function initContent()
    {
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Modals\ChangeStatusModal());
    }
}

?>