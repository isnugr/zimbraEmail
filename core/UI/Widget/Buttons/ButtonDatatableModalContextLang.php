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
class ButtonDatatableModalContextLang extends ButtonModal implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    protected $id = "ButtonDatatableModalContextLang";
    protected $icon = "lu-zmdi lu-zmdi-plus";
    protected $title = "ButtonDatatableModalContextLang";
    protected $htmlAttributes = ["href" => "javascript:;", "data-toggle" => "lu-tooltip"];
    public function initContent()
    {
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\ExampleModal());
    }
}

?>