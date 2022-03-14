<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 08.11.19
 * Time: 12:07
 * Class ChangePassword
 */
class ChangePasswordButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\DropdawnButtonWrappers\ButtonDropdownItem implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "changePassword";
    protected $title = "changePassword";
    protected $icon = "lu-dropdown__link-icon lu-btn__icon lu-zmdi lu-zmdi-lock";
    public function initContent()
    {
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Modals\ChangePasswordModal());
    }
}

?>