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
class MainContainer extends Container
{
    use Traits\MainContainerElements;
    protected $name = "mainContainer";
    protected $id = "mainContainer";
    protected $defaultTemplateName = "mainContainer";
    protected $templateName = "mainContainer";
    protected $data = [];
    protected $vueInstanceName = NULL;
    public function __construct($baseId = NULL)
    {
        parent::__construct($baseId);
        $this->prepareElemnentsContainers();
    }
    public function addElement($element, $containerName = NULL)
    {
        if (is_string($element)) {
            $element = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::create($element);
        }
        $container = $this->getElementContainerName($containerName);
        if (!$container) {
            return $this;
        }
        $id = $element->getId();
        if (!isset($this->{$container}[$id])) {
            $element->setMainContainer($this);
            $this->{$container}[$id] = $element;
            if ($element instanceof Interfaces\AjaxElementInterface) {
                $this->{$container}[$id];
                $this->ajaxElements[];
                /* =& ; (=& ..?) easytoyou_error_decompile */
            }
            if ($element->isVueComponent()) {
                $this->{$container}[$id];
                $this->vueComponents[$element->getTemplateName()];
                /* =& ; (=& ..?) easytoyou_error_decompile */
            }
        }
        return $this;
    }
    public function getVueInstanceName()
    {
        if ($this->vueInstanceName === NULL) {
            $randomGen = new \ModulesGarden\Servers\ZimbraEmail\Core\Helper\RandomStringGenerator(32);
            $this->vueInstanceName = $randomGen->genRandomString("mc");
        }
        return $this->vueInstanceName;
    }
    public function valicateACL($isAdmin)
    {
        if ($element->setIsAdminAcl($isAdmin)->validateElement($element) === false) {
            unset($this->elements[$id]);
            ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\MainContainer", "There is no implemented interface for the widget \"" . get_class($element) . "\".");
        }
        if ($element->setIsAdminAcl($isAdmin)->validateElement($element) === false) {
            unset($this->ajaxElements[$id]);
            ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\MainContainer", "There is no implemented interface for the widget \"" . get_class($element) . "\".");
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
        $this->loadDefaultNavbars();
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
            if ($request->get("loadData", false) === $aElem->getId()) {
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
    public function getDefaultVueComponentsJs()
    {
        if ($this->defaultComponentsJs === NULL) {
            $this->loadDefaultVueComponentsJs();
        }
        return $this->defaultComponentsJs;
    }
    protected function loadDefaultVueComponentsJs()
    {
        $componentsPath = str_replace(DS . "ui" . DS, DS . "assets" . DS . "js" . DS . "defaultComponents" . DS, $this->getDefaultTemplateDir());
        $content = scandir($componentsPath);
        $this->defaultComponentsJs = "";
        if ($content) {
            foreach ($content as $file) {
                $fileInfo = pathinfo($componentsPath . $file);
                if ($fileInfo["extension"] === "js") {
                    $jsContent = file_get_contents($componentsPath . $file);
                    $this->defaultComponentsJs .= $jsContent ? $jsContent : "";
                }
            }
        }
        return $this;
    }
}

?>