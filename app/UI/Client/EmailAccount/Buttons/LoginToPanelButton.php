<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Buttons;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 12.11.19
 * Time: 16:44
 * Class LoginToPanel
 */
class LoginToPanelButton extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons\DropdawnButtonWrappers\ButtonDropdownItem implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    protected $icon = "lu-dropdown__link-icon lu-btn__icon lu-zmdi lu-zmdi-email";
    protected $rawUrl = NULL;
    protected $redirectParams = [];
    public function initContent()
    {
        $this->htmlAttributes["@click.middle"] = "redirect(\$event, " . $this->parseCustomParams() . ", true)";
        $this->htmlAttributes["@click"] = "redirect(\$event, " . $this->parseCustomParams() . ", true)";
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