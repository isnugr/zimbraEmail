<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms;

/**
 * BaseForm controler
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class BaseStandaloneForm extends BaseForm implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface, \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\FormInterface
{
    protected $id = "baseStandaloneForm";
    protected $name = "baseStandaloneForm";
    public function __construct($baseId = NULL)
    {
        parent::__construct($baseId);
        $this->getAllowedActions();
        $submitButton = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\ButtonSubmitForm();
        $submitButton->setFormId($this->id);
        $submitButton->runInitContentProcess();
        $this->setSubmit($submitButton);
    }
    protected function loadDataToForm()
    {
        $this->loadProvider();
        $this->dataProvider->initData();
        $field->setValue($this->dataProvider->getValueById($field->getId()));
        $avValues = $this->dataProvider->getAvailableValuesById($field->getId());
        if ($avValues && method_exists($field, "setAvailableValues")) {
            $field->setAvailableValues($avValues);
        }
        if ($this->dataProvider->isDisabledById($field->getId())) {
            $field->disableField();
        }
        $section->loadDataToForm($this->dataProvider);
        $this->addLangReplacements();
    }
}

?>