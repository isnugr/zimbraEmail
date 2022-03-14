<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ModalActionButtons;

/**
 * Base Modal Accept Button
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class BaseAcceptButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    protected $id = "baseAcceptButton";
    protected $name = "baseAcceptButton";
    protected $class = ["lu-btn lu-btn--success submitForm mg-submit-form"];
    protected $title = "title";
    protected $htmlAttributes = ["@click" => "submitForm(\$event)"];
}

?>