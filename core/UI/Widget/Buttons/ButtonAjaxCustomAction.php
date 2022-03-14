<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons;

class ButtonAjaxCustomAction extends ButtonCustomAction implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    protected $id = "ButtonAjaxCustomAction";
    protected $class = ["lu-btn lu-btn-circle lu-btn-outline lu-btn-inverse lu-btn-default lu-btn-icon-only"];
    protected $icon = "lu-zmdi lu-zmdi-plus";
    protected $title = "ButtonAjaxCustomAction";
    protected $htmlAttributes = ["href" => "javascript:;", "data-toggle" => "lu-tooltip"];
    protected $customActionName = NULL;
    protected $customActionParams = [];
    public function initContent()
    {
        $this->htmlAttributes["@click"] = "makeCustomAction(" . $this->customActionName . ", " . $this->parseCustomParams() . ", \$event, '" . $this->getNamespace() . "', '" . $this->getIndex() . "')";
    }
    public function returnAjaxData()
    {
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\RawDataJsonResponse(["exampleData" => "example"]))->setCallBackFunction($this->callBackFunction)->setRefreshTargetIds($this->refreshActionIds);
    }
    public function setCustomActionName($name)
    {
        $this->customActionName = $name;
        return $this;
    }
    public function setCustomActionParams($params)
    {
        $this->customActionParams = $params;
        return $this;
    }
    public function addCustomActionParam($key, $value)
    {
        $this->customActionParams[$key] = $value;
        return $this;
    }
    public function parseCustomParams()
    {
        if (count($this->customActionParams) === 0) {
            return "{}";
        }
        return $this->parseListTOJsString($this->customActionParams);
    }
    protected function parseListTOJsString($params)
    {
        $jsString = "{";
        foreach ($params as $key => $value) {
            $jsString .= " " . $key . ": " . (is_array($value) ? $this->parseListTOJsString($value) . "," : "'" . (int) $value . "',");
        }
        $jsString = trim($jsString, ",") . " } ";
        return $jsString;
    }
}

?>