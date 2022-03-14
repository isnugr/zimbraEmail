<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Others;

/**
 * CopyKeyForDataTable - a copy on click ui element
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class CopyKeyForDataTable extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    protected $id = "copyKeyForDataTable";
    protected $name = "copyKeyForDataTable";
    protected $vueComponent = true;
    protected $defaultVueComponentName = "ds-copy-on-click";
    protected $textToCopy = NULL;
    public function setCopyText($textToCopy)
    {
        if (is_string($textToCopy) && $textToCopy !== "") {
            $this->textToCopy = $textToCopy;
        }
        return $this;
    }
    public function getCopyText()
    {
        return $this->textToCopy;
    }
}

?>