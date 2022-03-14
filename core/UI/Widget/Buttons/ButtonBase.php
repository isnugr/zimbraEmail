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
class ButtonBase extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    protected $id = "ButtonBase";
    protected $name = "ButtonBase";
    protected $class = ["lu-btn lu-btn-circle lu-btn-outline lu-btn-inverse lu-btn-success lu-btn-icon-only"];
    protected $icon = "lu-zmdi lu-zmdi-plus";
    protected $title = "ButtonBase";
    protected $htmlAttributes = ["href" => "javascript:;", "data-toggle" => "lu-tooltip"];
}

?>