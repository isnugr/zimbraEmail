<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\LoggerManager\Modals;

/**
 * DOE DeleteTldModal controler
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class MassDeleteLoggerModal extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\BaseModal implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "massDeleteLoggerModal";
    protected $name = "massDeleteLoggerModal";
    protected $title = "massDeleteLoggerModal";
    public function initContent()
    {
        $this->replaceSubmitButtonClasses(["btn btn--danger submitForm"]);
        $this->addForm(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\LoggerManager\Forms\DeleteLoggerForm());
    }
}

?>