<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Modals;

/**
 * Class ModalExtendedTabsEdit
 * User: Nessandro
 * Date: 2019-09-20
 * Time: 12:40
 */
class ModalExtendedTabsEdit extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\ModalTabsEdit implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $id = "modalExtendedTabsEdit";
    protected $name = "modalExtendedTabsEdit";
    protected $title = "modalExtendedTabsEdit";
    protected function afterInitContent()
    {
        self::afterInitContent();
        $form->getHtml();
    }
}

?>