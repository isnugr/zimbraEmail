<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\Custom\Sections;

class BoxSectionExtended extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Sections\BoxSection
{
    protected $id = "boxSectionExtended";
    protected $name = "boxSectionExtended";
    protected $tooltip = NULL;
    public function setTooltip($tooltip)
    {
        $this->tooltip = $tooltip;
        return $this;
    }
    public function getTooltip()
    {
        return $this->tooltip;
    }
}

?>