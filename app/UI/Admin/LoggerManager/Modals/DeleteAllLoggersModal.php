<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\LoggerManager\Modals;

/**
 * DOE AddCategoryModal controler
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class DeleteAllLoggersModal extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\BaseModal implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "deleteAllLoggersModal";
    protected $name = "deleteAllLoggersModal";
    protected $title = "deleteAllLoggersModal";
    public function initContent()
    {
        $this->addForm(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\LoggerManager\Forms\DeleteAllLoggerForm());
    }
}

?>