<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Graphs\Settings;

/**
 * Description of SettingButton
 *
 * @author inbs
 */
class SettingButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ButtonDatatableModalContextLang
{
    protected $id = "settingButton";
    protected $name = "settingButton";
    protected $title = "settingButton";
    protected $icon = "lu-btn__icon lu-zmdi lu-zmdi-edit";
    protected $configFields = [];
    public function initContent()
    {
        $modal = new SettingModal();
        $modal->setConfigFields($this->configFields);
        $this->initLoadModalAction($modal);
    }
    public function addNamespaceScope($namespaceScope = NULL)
    {
        $this->namespaceScope = $namespaceScope;
        return $this;
    }
    public function getNamespace()
    {
        if ($this->namespaceScope) {
            return $this->namespaceScope;
        }
        return self::getNamespace();
    }
    public function setConfigFields($fieldsList = [])
    {
        if ($fieldsList) {
            $this->configFields = $fieldsList;
        }
        return $this;
    }
}

?>