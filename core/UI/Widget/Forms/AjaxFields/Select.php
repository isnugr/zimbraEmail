<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\AjaxFields;

/**
 * Select field controler
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class Select extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\HideByDefaultIfNoData;
    protected $id = "ajaxSelect";
    protected $name = "ajaxSelect";
    protected $vueComponent = true;
    protected $defaultVueComponentName = "mg-ajax-select";
    /**
     * a list of fields id's, fi those fields are changed the select will reload its content
     * @var type array
     */
    protected $reloadOnChangeFields = [];
    public function returnAjaxData()
    {
        $this->prepareAjaxData();
        $returnData = ["options" => $this->getAvailableValues(), "selected" => $this->getValue(), "additionalData" => $this->data["additionalData"]];
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\RawDataJsonResponse($returnData))->setCallBackFunction($this->callBackFunction);
    }
    public function prepareAjaxData()
    {
        $this->setAvailableValues([["key" => "1", "value" => "value1"], ["key" => "2", "value" => "value2"]]);
        $this->setSelectedValue("2");
    }
    public function initContent()
    {
    }
    public function addReloadOnChangeField($fieldId = NULL)
    {
        if (is_string($fieldId) && $fieldId !== "") {
            $this->reloadOnChangeFields[] = $fieldId;
        }
        return $this;
    }
    public function getReloadOnChangeFields()
    {
        return $this->reloadOnChangeFields;
    }
    public function wrappReloadIdsToString()
    {
        $str = "";
        foreach ($this->reloadOnChangeFields as $key => $value) {
            $str .= (int) $key . " : '" . $value . "'" . ($key === end(array_keys($this->reloadOnChangeFields)) ? " " : ", ");
        }
        return $str;
    }
}

?>