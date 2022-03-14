<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Fields;

class ActionSwitcher extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Switcher implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    protected $customActionName = NULL;
    protected $showTitle = true;
    public function initContent()
    {
        unset($this->htmlAttributes["data-toggle"]);
        if ($this->customActionName) {
            $this->htmlAttributes["@change"] = "makeCustomAction(" . $this->customActionName . ",[] , \$event)";
        }
    }
    public function setCustomActionName($customActionName)
    {
        $this->customActionName = $customActionName;
        return $this;
    }
    public function disableTitle()
    {
        $this->showTitle = false;
        return $this;
    }
    public function enableTitle()
    {
        $this->showTitle = true;
        return $this;
    }
    public function titleEnabled()
    {
        return $this->showTitle;
    }
}

?>