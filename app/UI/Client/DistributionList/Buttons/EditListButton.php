<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Buttons;

class EditListButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ButtonDataTableModalAction implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "editListButton";
    protected $title = "editListButton";
    public function initContent()
    {
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Modals\EditListModal());
    }
}

?>