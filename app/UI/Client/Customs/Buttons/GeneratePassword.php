<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Customs\Buttons;

class GeneratePassword extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ButtonSubmitForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $id = "generatePasswordButton";
    protected $name = "generatePasswordButton";
    protected $title = "generatePasswordButton";
    protected $class = ["lu-btn lu-btn--default"];
    public function initContent()
    {
        $this->htmlAttributes["onclick"] = "generateRandomPassword()";
    }
}

?>