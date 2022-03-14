<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Graphs\Settings;

/**
 * Description of SettingModal
 *
 * @author inbs
 */
class SettingModal extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\BaseEditModal
{
    protected $id = "settingModal";
    protected $name = "settingModal";
    protected $title = "settingModal";
    protected $configFields = [];
    public function initContent()
    {
        $form = new SettingForm();
        $form->setConfigFields($this->configFields);
        $this->addForm($form);
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