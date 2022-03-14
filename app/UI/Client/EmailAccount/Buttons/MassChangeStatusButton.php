<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons;

class MassChangeStatusButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ButtonMassAction implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "massChangeStatusButton";
    protected $title = "massChangeStatusButton";
    protected $icon = "lu-btn__icon lu-zmdi lu-zmdi-refresh-sync";
    public function initContent()
    {
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Modals\MassChangeStatusModal());
    }
}

?>