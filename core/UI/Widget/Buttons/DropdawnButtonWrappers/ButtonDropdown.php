<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\DropdawnButtonWrappers;

/**
 * base button controller
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class ButtonDropdown extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ButtonBase
{
    protected $id = "dropdownButton";
    protected $class = ["lu-btn lu-btn--primary"];
    protected $icon = "lu-zmdi lu-zmdi-plus";
    protected $title = "dropdownButton";
    protected $htmlAttributes = ["href" => "javascript:;", "data-toggle" => "lu-tooltip"];
    protected $vueComponent = true;
    protected $defaultVueComponentName = "mg-dropdawn-btn-wrapper";
}

?>