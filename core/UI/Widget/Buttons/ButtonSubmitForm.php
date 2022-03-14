<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons;

/**
 * base button for submiting standalone forms
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class ButtonSubmitForm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\SubmitButton;
    protected $id = "baseSubmitButton";
    protected $class = ["lu-btn lu-btn--success mg-submit-form"];
    protected $title = "submit";
    protected $htmlAttributes = ["href" => "javascript:;"];
    public function initContent()
    {
        $this->htmlAttributes["@click"] = "submitForm('" . $this->getFormId() . "', \$event)";
        $this->htmlAttributes["@keyup"] = "submitForm('" . $this->getFormId() . "', \$event)";
    }
}

?>