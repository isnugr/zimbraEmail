<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ModalActionButtons;

/**
 * Base Modal Cancel Button
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class BaseCancelButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    protected $id = "baseCancelButton";
    protected $name = "baseCancelButton";
    protected $class = ["lu-btn lu-btn--danger lu-btn--outline lu-btn--plain closeModal"];
    protected $title = "title";
    protected $htmlAttributes = ["@click" => "closeModal(\$event)"];
}

?>