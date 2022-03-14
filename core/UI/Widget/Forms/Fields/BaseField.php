<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields;

/**
 * BaseField controler
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class BaseField extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Field;
    protected $id = "baseField";
    protected $name = "baseField";
    protected $class = ["lu-form-check lu-m-b-2x"];
    protected $htmlAttributes = ["@keyup.enter" => "submitFormByField(\$event)"];
}

?>