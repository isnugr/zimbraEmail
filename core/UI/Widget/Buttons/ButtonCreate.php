<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons;

/**
 * Description of Button Create
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class ButtonCreate extends ButtonModal
{
    protected $id = "buttonCreate";
    protected $class = ["lu-btn lu-btn--primary"];
    protected $icon = "lu-btn__icon lu-zmdi lu-zmdi-plus";
    protected $title = "buttonCreate";
    protected $htmlAttributes = ["href" => "javascript:;"];
}

?>