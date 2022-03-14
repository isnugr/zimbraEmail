<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DomainAlias\Buttons;

class MassDeleteDomainAliasButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ButtonMassAction implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "massDeleteDomainAliasButton";
    protected $title = "massDeleteDomainAliasButton";
    public function initContent()
    {
        $this->switchToRemoveBtn();
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DomainAlias\Modals\MassDeleteDomainAliasModal());
    }
}

?>