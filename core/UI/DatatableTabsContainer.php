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
class DatatableTabsContainer extends Container
{
    protected $name = "datatableTabsContainer";
    protected $data = [];
    protected $topLine = [];
    protected $internalLine = [];
    protected $defaultTemplateName = "tabContainerRight";
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function addElement($element)
    {
        if (is_string($element)) {
            $element = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::get($element);
        }
        $id = $element->getId();
        if (!isset($this->elements[$id])) {
            $this->elements[$id] = $element;
            if ($element instanceof Interfaces\AjaxElementInterface) {
                $this->mainContainer->addAjaxElement($this->elements[$id]);
            }
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
        $this->runInitContentProcess();
        if ($this->html === "") {
            $this->buildHtml();
        }
        return $this->html;
    }
}

?>