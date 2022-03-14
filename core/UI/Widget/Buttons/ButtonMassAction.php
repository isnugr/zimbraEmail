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
class ButtonMassAction extends ButtonModal
{
    protected $id = "baseMassActionButton";
    protected $class = ["lu-btn lu-btn--link lu-btn--plain lu-btn--default"];
    protected $icon = "lu-btn__icon lu-zmdi lu-zmdi-account";
    protected $title = "baseMassActionButton";
    protected $htmlAttributes = ["href" => "javascript:;"];
    public function initContent()
    {
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\ExampleModal());
    }
    public function switchToRemoveBtn()
    {
        $this->replaceClasses(["lu-btn lu-btn--danger lu-btn--link lu-btn--plain"]);
        $this->setIcon("lu-btn__icon lu-zmdi lu-zmdi-delete");
        return $this;
    }
}

?>