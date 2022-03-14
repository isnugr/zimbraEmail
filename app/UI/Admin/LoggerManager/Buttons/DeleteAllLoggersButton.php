<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\LoggerManager\Buttons;

/**
 * Description of AssignTldButton
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class DeleteAllLoggersButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ButtonModal implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "deleteAllLoggersButton";
    protected $name = "deleteAllLoggersButton";
    protected $title = "deleteAllLoggersButton";
    protected $class = ["lu-btn lu-btn--danger"];
    protected $icon = "lu-btn__icon lu-zmdi lu-zmdi-delete";
    public function initContent()
    {
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\LoggerManager\Modals\DeleteAllLoggersModal());
    }
}

?>