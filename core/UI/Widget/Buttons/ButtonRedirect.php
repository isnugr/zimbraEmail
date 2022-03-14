<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons;

class ButtonRedirect extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    protected $id = "redirectButton";
    protected $class = ["lu-btn lu-btn--sm lu-btn--link lu-btn--icon lu-btn--plain lu-btn--default"];
    protected $icon = "lu-btn__icon lu-zmdi lu-zmdi-info";
    protected $title = "redirectButton";
    protected $showTitle = false;
    protected $htmlAttributes = ["data-toggle" => "lu-tooltip"];
    protected $rawUrl = NULL;
    protected $redirectParams = [];
    public function initContent()
    {
        $this->htmlAttributes["@click.middle"] = "redirect(\$event, " . $this->parseCustomParams() . ", true)";
        $this->htmlAttributes["@click"] = "redirect(\$event, " . $this->parseCustomParams() . ")";
    }
    protected function parseCustomParams()
    {
        if (count($this->redirectParams) === 0 && $this->rawUrl === NULL) {
            return "{}";
        }
        return $this->parseListTOJsString($this->redirectParams);
    }
    protected function parseListTOJsString($params)
    {
        $jsString = "{";
        if ($this->rawUrl !== NULL) {
            $params["rawUrl"] = $this->rawUrl;
        }
        foreach ($params as $key => $value) {
            $jsString .= " " . str_replace("-", "__", $key) . ": " . (is_array($value) ? $this->parseListTOJsString($value) . "," : "'" . (int) $value . "',");
        }
        $jsString = trim($jsString, ",") . " } ";
        return $jsString;
    }
    public function setRawUrl($url)
    {
        $this->rawUrl = $url;
        return $this;
    }
    public function addRedirectParam($key, $value)
    {
        $this->redirectParams[$key] = $value;
        $this->updateHtmlAttributesByRedirectParams();
        return $this;
    }
    public function setRedirectParams($paramsList)
    {
        $this->redirectParams = $paramsList;
        $this->updateHtmlAttributesByRedirectParams();
        return $this;
    }
    protected function updateHtmlAttributesByRedirectParams()
    {
        foreach ($this->redirectParams as $key => $value) {
            $this->updateHtmlAttribute($key, $value);
        }
    }
    protected function updateHtmlAttribute($key, $value)
    {
        if (strpos($value, ":") === 0) {
            $this->addHtmlAttribute(":data-" . $key, "dataRow." . trim($value, ":"));
        }
    }
}

?>