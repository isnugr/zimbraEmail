<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI;

/**
 * Description of Conteiner
 *
 * @author inbs
 */
class MainContainerAjax extends MainContainer
{
    protected $namespaceAjax = NULL;
    public function __construct($baseId = NULL)
    {
        $this->namespace = str_replace("\\", "_", get_class($this));
        $this->initIds($baseId);
        $index = ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("request")->get("index");
        if ($index && $index != "") {
            $this->index = $index;
        }
    }
    public function setNamespaceAjax($namespaceAjax)
    {
        $this->namespaceAjax = $namespaceAjax;
        return $this;
    }
    public function addElement($element)
    {
        if (is_string($element)) {
            $element = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::create($element);
        }
        $element->setIndex($this->index);
        $id = $element->getId();
        if (!isset($this->ajaxElements[$id])) {
            $element->setMainContainer($this);
            if ($element instanceof Interfaces\AjaxElementInterface) {
                $this->ajaxElements[$id] =& $element;
            }
            if ($element->isVueComponent()) {
                $this->vueComponents[$element->getTemplateName()] =& $element;
            }
        }
        return $this;
    }
    public function addAjaxElement(Interfaces\AjaxElementInterface $element)
    {
        $this->ajaxElements[$element->getId()] =& $element;
    }
    public function addVueComponent($element)
    {
        if ($element->isVueComponent()) {
            $this->vueComponents[$element->getTemplateName()] =& $element;
        }
    }
    public function valicateACL($isAdmin)
    {
        if ($element->setIsAdminAcl($isAdmin)->validateElement($element) === false) {
            unset($this->elements[$id]);
            ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\MainContainerAjax", "There is no implemented interface for the widget \"" . get_class($element) . "\".");
        }
        if ($element->setIsAdminAcl($isAdmin)->validateElement($element) === false) {
            unset($this->ajaxElements[$id]);
            ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\MainContainerAjax", "There is no implemented interface for the widget \"" . get_class($element) . "\".");
        }
        return $this;
    }
    public function setData($data = [])
    {
        $this->data = $data;
        $this->updateData();
        return $this;
    }
    protected function updateData()
    {
        foreach ($this->data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
        $this->data = [];
        return $this;
    }
    public function getHtml()
    {
        if ($this->html === "") {
            $this->buildHtml();
        }
        return $this->html;
    }
    public function __toString()
    {
        return $this->getHtml();
    }
    public function getAjaxResponse()
    {
        $request = \ModulesGarden\Servers\ZimbraEmail\Core\Http\Request::build();
        foreach ($this->ajaxElements as $aElem) {
            if ($this->namespaceAjax === $aElem->getNamespace()) {
                $response = $aElem->returnAjaxData();
                if ($response instanceof Interfaces\ResponseInterface) {
                    return $response->getFormatedResponse();
                }
                return $response;
            }
        }
    }
    public function getVueComponents()
    {
        $vBody = "";
        foreach ($this->vueComponents as $vElem) {
            $vBody .= $vElem->getVueComponents();
        }
        return $vBody;
    }
    public function getAjaxElems()
    {
        return $this->ajaxElements;
    }
    public function getVueComponentsJs()
    {
        $vJsBody = "";
        foreach ($this->vueComponents as $vElem) {
            $vJsBody .= $vElem->getVueComponentsJs();
        }
        return $vJsBody;
    }
}

?>