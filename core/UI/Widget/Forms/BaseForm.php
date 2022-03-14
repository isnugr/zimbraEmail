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
class BaseForm extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface, \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\FormInterface
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Form;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Fields;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Sections;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\FormDataProvider;
    protected $id = "baseForm";
    protected $name = "baseForm";
    protected $formAction = NULL;
    protected $requestObj = NULL;
    protected $htmlAttributes = ["onsubmit" => "return false;"];
    public function __construct()
    {
        parent::__construct();
        $formAction = $this->getRequestValue("mgformtype", false);
        if ($formAction === FormConstants::RELOAD) {
            $this->formAction = $formAction;
        }
    }
    public function returnAjaxData()
    {
        $this->loadProvider();
        $this->formAction = $this->getRequestValue("mgformtype", false);
        $resp = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse();
        $resp->setCallBackFunction($this->getCallBackFunction());
        $resp->setRefreshTargetIds($this->refreshActionIds);
        if (!$this->isFormActionValid()) {
            return $resp->setMessageAndTranslate("undefinedAction")->setStatusError();
        }
        $this->reloadFormStructure();
        if (!$this->validateForm()) {
            $resp = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\RawDataJsonResponse();
            $resp->setCallBackFunction($this->getCallBackFunction());
            return $resp->setMessageAndTranslate("formValidationError")->setStatusError()->setData(["FormValidationErrors" => $this->validationErrors]);
        }
        $response = $this->dataProvider->{$this}->formAction();
        if ($response instanceof \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ResponseInterface) {
            return $response;
        }
        return $resp->setMessageAndTranslate("changesHasBeenSaved");
    }
    protected function validateForm()
    {
        if (in_array($this->formAction, [FormConstants::READ, FormConstants::REORDER, FormConstants::RELOAD])) {
            return true;
        }
        $this->validateFields($this->request);
        $this->validateSections($this->request);
        if (0 < count($this->validationErrors)) {
            return false;
        }
        return true;
    }
    protected function isReadDatatoForm()
    {
        if (!$this->formAction) {
            $this->formAction = $this->getRequestValue("mgformtype", false);
        }
        return $this->formAction && ($this->formAction === FormConstants::READ || $this->formAction === FormConstants::REORDER || $this->formAction === FormConstants::RELOAD);
    }
    protected function loadDataToForm()
    {
        if (!ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("request")->get("ajax") || !$this->isReadDatatoForm()) {
            return NULL;
        }
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
    protected function isFormActionValid()
    {
        if ($this->formAction === false || !in_array($this->formAction, $this->getAllowedActions()) || !method_exists($this->dataProvider, $this->formAction)) {
            return false;
        }
        return true;
    }
    protected function loadDataToFormByName()
    {
        $this->loadProvider();
        $field->setValue($this->dataProvider->getValueByName($field->getName()));
        if ($this->dataProvider->isDisabledById($field->getId())) {
            $field->disableField();
        }
        $section->loadDataToFormByName($this->dataProvider);
        $this->addLangReplacements();
    }
    protected function runFormAction()
    {
        $this->dataProvider->{$this}->formAction();
    }
    protected function reloadFormStructure()
    {
    }
    protected function reloadForm()
    {
        if ($this->formAction === FormConstants::RELOAD) {
            $this->reloadFormStructure();
            $this->runFormAction();
        }
    }
    public function getHtml()
    {
        $this->reloadForm();
        if ($this->html === "") {
            $this->buildHtml();
        }
        return $this->html;
    }
}

?>