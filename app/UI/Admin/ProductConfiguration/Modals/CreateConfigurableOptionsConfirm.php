<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Modals;

/**
 * Class CreateConfigurableOptionsConfirm
 * User: Nessandro
 * Date: 2019-09-29
 * Time: 15:30
 */
class CreateConfigurableOptionsConfirm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\BaseEditModal implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "createCOConfirmModal";
    protected $name = "createCOConfirmModal";
    protected $title = "createCOConfirmModal";
    public function initContent()
    {
        $this->setModalSizeLarge();
        $this->addForm(new \ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\ProductConfiguration\Forms\CreateConfigurableAction());
    }
}

?>