<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Buttons;

class MassDeleteEmailAliasButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ButtonMassAction implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "massDeleteEmailAliasButton";
    protected $title = "massDeleteEmailAliasButton";
    public function initContent()
    {
        $this->switchToRemoveBtn();
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Modals\MassDeleteEmailAliasModal());
    }
}

?>