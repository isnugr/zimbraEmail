<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons;

class ButtonSwitchAjax extends ButtonCustomAction implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    protected $id = "ButtonSwitchAjax";
    protected $class = ["lu-btn lu-btn-circle lu-btn-outline lu-btn-inverse lu-btn-success lu-btn-icon-only"];
    protected $icon = "lu-zmdi lu-zmdi-plus";
    protected $title = "ButtonSwitchAjax";
    protected $htmlAttributes = [];
    protected $switchModel = NULL;
    protected $switchColumn = "enable_value";
    protected $switchOnValue = "on";
    protected $switchOffValue = "off";
    protected $actionIdColumn = "id";
    public function __construct($baseId = NULL)
    {
        parent::__construct($baseId);
        $this->runInitContentProcess();
    }
    public function returnAjaxData()
    {
        $actionId = $this->getRequestValue("actionElementId", false);
        $switchValue = $this->getRequestValue("value", false);
        if (!$this->switchModel || !$this->switchColumn || !$this->switchOnValue || !$actionId || !$switchValue) {
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\DataJsonResponse())->setStatusError()->setMessageAndTranslate("SavingError")->setCallBackFunction($this->callBackFunction)->setRefreshTargetIds($this->refreshActionIds);
        }
        try {
            $model = new $this->switchModel();
            $query = $model->newQuery();
            $query->where($this->actionIdColumn, "=", $actionId);
            if (0 < $query->count()) {
                $query = $model->newQuery();
                $query->where($this->actionIdColumn, "=", $actionId)->update([$this->switchColumn => $switchValue == "on" ? $this->switchOnValue : $this->switchOffValue]);
            } else {
                $model->{$this->actionIdColumn} = $actionId;
                $model->{$this->switchColumn} = $switchValue == "on" ? $this->switchOnValue : $this->switchOffValue;
                $model->save();
            }
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\DataJsonResponse())->setMessageAndTranslate("changesSaved")->setCallBackFunction($this->callBackFunction)->addRefreshTargetId($this->refreshActionIds);
        } catch (\Exception $exc) {
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\DataJsonResponse())->setStatusError()->setMessage($exc->getMessage())->setCallBackFunction($this->callBackFunction)->addRefreshTargetId($this->refreshActionIds);
        }
    }
    public function initContent()
    {
        $this->htmlAttributes["@change"] = "onOffSwitch(\$event, '" . $this->id . "')";
    }
    public function getValue()
    {
        return $this->value;
    }
    public function setValue($value)
    {
        return $this->value;
    }
    public function setSwitchTarget($model = NULL, $columnName = NULL)
    {
        if ($model instanceof \ModulesGarden\Servers\ZimbraEmail\Core\Models\ExtendedEloquentModel || $model instanceof \Illuminate\Database\Eloquent\Model) {
            $this->switchModel = $model;
        }
        if ($columnName !== NULL && is_string($columnName)) {
            $this->switchColumn = $columnName;
        }
        return $this;
    }
    public function getSwitchColumnName()
    {
        return $this->switchColumn;
    }
    public function setSwitchOnValue($value)
    {
        if (is_string($value) || is_numeric($value)) {
            $this->switchOnValue = $value;
        }
        return $this;
    }
    public function getSwitchOnValue()
    {
        return $this->switchOnValue;
    }
    public function setActionIdColumn($colName)
    {
        if ($colName !== "" && is_string($colName)) {
            $this->actionIdColumn = $colName;
        }
        return $this;
    }
}

?>