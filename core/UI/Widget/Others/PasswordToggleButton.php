<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Others;

/**
 * Description of PasswordHiddenButton
 *
 * @author Pawel Kopec <pawelk@modulesgardne.com>
 */
class PasswordToggleButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    protected $iconOn = "lu-zmdi lu-zmdi-eye";
    protected $iconOff = "lu-zmdi lu-zmdi-eye-off";
    private $password = NULL;
    protected $vueComponent = true;
    protected $defaultVueComponentName = "mg-passtoogle";
    public function getIconOn()
    {
        return $this->iconOn;
    }
    public function getIconOff()
    {
        return $this->iconOff;
    }
    public function setIconOn($iconOn)
    {
        $this->iconOn = $iconOn;
        return $this;
    }
    public function setIconOff($iconOff)
    {
        $this->iconOff = $iconOff;
        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    public function getPasswordHidden()
    {
        return str_repeat("*", strlen($this->getPassword()));
    }
}

?>