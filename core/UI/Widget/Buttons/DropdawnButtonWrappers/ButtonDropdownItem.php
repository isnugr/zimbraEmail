<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\DropdawnButtonWrappers;

/**
 * A button in dropdawn buttons list
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class ButtonDropdownItem extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ButtonModal
{
    protected $id = "duttonDropdownItem";
    protected $class = ["lu-dropdown__link"];
    protected $icon = "lu-dropdown__link-icon lu-zmdi lu-zmdi-edit";
    protected $title = "dropdownButton";
    protected $htmlAttributes = ["href" => "javascript:;"];
}

?>