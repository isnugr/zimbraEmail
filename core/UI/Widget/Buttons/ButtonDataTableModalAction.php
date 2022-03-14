<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons;

/**
 * base button controller
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class ButtonDataTableModalAction extends ButtonModal implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\DisableButtonByColumnValue;
    protected $id = "baseModalDataTableActionButton";
    protected $class = ["lu-btn lu-btn--sm lu-btn lu-btn--link lu-btn--icon lu-btn--plain lu-btn--default"];
    protected $icon = "lu-btn__icon lu-zmdi lu-zmdi-edit";
    protected $title = "baseModalDataTableActionButton";
    public function initContent()
    {
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\ExampleModal());
    }
    public function switchToRemoveBtn()
    {
        $this->replaceClasses(["lu-btn lu-btn--sm lu-btn--danger lu-btn--link lu-btn--icon lu-btn--plain"]);
        $this->setIcon("lu-btn__icon lu-zmdi lu-zmdi-delete");
        return $this;
    }
}

?>