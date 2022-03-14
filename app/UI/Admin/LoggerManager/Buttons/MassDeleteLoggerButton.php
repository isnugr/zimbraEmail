<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\LoggerManager\Buttons;

/**
 * Description of DeleteTldButton
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class MassDeleteLoggerButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ButtonMassActionContextLang implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "massDeleteLoggerButton";
    protected $name = "massDeleteLoggerButton";
    protected $title = "massDeleteLoggerButton";
    public function initContent()
    {
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\LoggerManager\Modals\MassDeleteLoggerModal());
        $this->switchToRemoveBtn();
    }
}

?>