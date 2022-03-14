<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons;

class ButtonCustomAction extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    protected $id = "ButtonCustomAction";
    protected $class = ["lu-btn lu-btn--sm lu-btn--link lu-btn--icon lu-btn--plain lu-btn--default"];
    protected $icon = "lu-zmdi lu-zmdi-plus";
    protected $title = "ButtonCustomAction";
    protected $htmlAttributes = ["href" => "javascript:;", "data-toggle" => "lu-tooltip"];
    protected $customActionName = NULL;
    protected $customActionParams = [];
    public function initContent()
    {
    }
    protected function afterInitContent()
    {
        $this->htmlAttributes["@click"] = "makeCustomAction('" . $this->customActionName . "', " . $this->parseCustomParams() . ", \$event, '" . $this->getNamespace() . "', '" . $this->getIndex() . "')";
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
    protected function parseCustomParams()
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