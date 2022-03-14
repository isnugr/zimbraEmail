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
 * Date: 08.11.19
 * Time: 12:07
 * Class ChangePasswordModal
 */
class ChangePasswordModal extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\BaseEditModal implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "changePasswordModal";
    protected $name = "changePasswordModal";
    protected $title = "changePasswordModal";
    public function initContent()
    {
        $this->addForm(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Forms\ChangePasswordForm());
    }
}

?>