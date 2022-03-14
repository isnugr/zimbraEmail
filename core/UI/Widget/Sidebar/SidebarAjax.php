<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Sidebar;

/**
 * Description of SidebarAjax
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgardne.com>
 */
class SidebarAjax extends Sidebar implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    protected $id = "sidebarAjax";
    protected $name = "sidebarAjax";
    protected $vueComponent = true;
    protected $defaultVueComponentName = "mg-ajax-sidebar";
    protected $ajaxMenuElements = [];
    public function prepareAjaxData()
    {
    }
    public function returnAjaxData()
    {
        $this->prepareAjaxData();
        $returnData = $this->parseProvidedData();
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\RawDataJsonResponse($returnData))->setCallBackFunction($this->callBackFunction);
    }
    protected function parseProvidedData()
    {
        $this->loadLang();
        $data = [];
        foreach ($this->ajaxMenuElements as $mItem) {
            $data[] = ["id" => $mItem->getId(), "namespace" => $mItem->getNamespace(), "icon" => $mItem->getIcon(), "href" => method_exists($mItem, "getHref") ? $mItem->getHref() : NULL, "htmlAtributes" => $mItem->getHtmlAttributes(), "class" => $mItem->getClasses(), "clickAction" => $this->parseOnClickAction($mItem->getHtmlAttributes()["@click"]), "title" => $this->lang->tr($this->id, $mItem->getTitle())];
        }
        return $data;
    }
    public function add($sidebar)
    {
        $this->ajaxMenuElements[$sidebar->getId()] = $sidebar;
        if (method_exists($sidebar, "setParent")) {
            $sidebar->setParent($this);
        }
        return $this;
    }
    public function parseOnClickAction($actionString)
    {
        if (0 < stripos($actionString, "(")) {
            $actions = explode("(", $actionString);
            $action = $actions[0];
            $paramsString = trim(trim(trim($actions[1], ";"), ")"), "'");
            $params = explode(",", $paramsString);
            foreach ($params as $key => $param) {
                $params[$key] = trim(trim(trim($param), "'"), "\"");
            }
            return ["action" => $action, "params" => $params];
        } else {
            return ["action" => $actionString, "params" => []];
        }
    }
}

?>