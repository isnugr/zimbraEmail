<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder;

/**
 * Description of Context
 *
 * @author inbs
 */
class Context
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Title;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\HtmlElements;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Template;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Searchable;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Buttons;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Icon;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\VueComponent;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\HtmlAttributes;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\ACL;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\CallBackFunction;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Alerts;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RefreshAction;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\WidgetView;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\AjaxComponent;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\ContainerElements;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\WhmcsParams;
    protected $html = "";
    protected $customTplVars = [];
    protected $mainContainer = NULL;
    protected $namespace = "";
    protected $errorMessage = false;
    public static $findItemContext = false;
    protected $initialized = true;
    public function __construct($baseId = NULL)
    {
        $this->addNewElementsContainer("buttons");
        $this->namespace = str_replace("\\", "_", get_class($this));
        $this->initIds($baseId);
        $this->prepareDefaultHtmlElements();
        $this->loadTemplateVars();
    }
    public function getErrorMessage()
    {
        return $this->errorMessage;
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
    protected function buildHtml()
    {
        $this->html = self::generate($this);
    }
    public function getCustomTplVars()
    {
        return $this->customTplVars;
    }
    public function getCustomTplVarsValue($varName)
    {
        return $this->customTplVars[$varName];
    }
    public static function generate(Context $object)
    {
        $tpl = $object->getTemplateName();
        $vars = ["title" => $object->getTitle(), "class" => $object->getClasses(), "name" => $object->getName(), "elementId" => $object->getId(), "htmlAttributes" => $object->getHtmlAttributes(), "elements" => $object->getElements(), "scriptHtml" => $object->getScriptHtml(), "customTplVars" => $object->getCustomTplVars(), "rawObject" => $object, "namespace" => $object->getNamespace(), "isDebug" => (int) (int) ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("configurationAddon")->getConfigValue("debug", "0"), "isError" => (int) $object->getErrorMessage(), "errorMessage" => $object->getErrorMessage()];
        $lang = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("lang");
        $lang->stagCurrentContext("builder" . $object->getName());
        $lang->addToContext(lcfirst($object->getName()));
        $return = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("smarty")->setLang($lang)->view($tpl, $vars, $object->getTemplateDir());
        if (!$object->isVueRegistrationAllowed()) {
            return $return;
        }
        if ($object->isVueComponent() && file_exists($object->getTemplateDir() . str_replace(".tpl", "", $tpl) . "_components.tpl")) {
            $vueComponents = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("smarty")->setLang($lang)->view(str_replace(".tpl", "", $tpl) . "_components", $vars, $object->getTemplateDir());
            $object->addVueComponentTemplate($vueComponents, $object->getId());
        }
        if ($object->isVueComponent() && file_exists($object->getTemplateDir() . str_replace(".tpl", "", $tpl) . "_components.js")) {
            $vueComponentsJs = file_get_contents($object->getTemplateDir() . str_replace(".tpl", "", $tpl) . "_components.js");
            $object->addVueComponentJs($vueComponentsJs, $object->getDefaultVueComponentName());
        }
        if ($object->isVueComponent() && $object->getDefaultVueComponentName()) {
            $object->registerVueComponent($object->getId(), $object->getDefaultVueComponentName());
        }
        $lang->unstagContext("builder" . $object->getName());
        return $return;
    }
    public function setMainContainer(\ModulesGarden\Servers\ZimbraEmail\Core\UI\MainContainer $mainContainer)
    {
        if ($this->mainContainer !== NULL) {
            return $this;
        }
        $this->mainContainer =& $mainContainer;
        $this->registerMainContainerAdditions($this);
        $this->propagateMainContainer($mainContainer);
        if (self::$findItemContext === false) {
            $this->runInitContentProcess();
        }
        return $this;
    }
    protected function propagateMainContainer($mainContainer)
    {
        foreach ($this->getElementsContainers() as $containerName) {
            $container->setMainContainer($mainContainer);
        }
    }
    public function initContent()
    {
    }
    public function runInitContentProcess()
    {
        $this->preInitContent();
        $this->initContent();
        $this->afterInitContent();
        $this->initialized = true;
    }
    protected function preInitContent()
    {
    }
    protected function afterInitContent()
    {
    }
    public function getNamespace()
    {
        return $this->namespace;
    }
    public function wasInitialized()
    {
        return $this->initialized;
    }
}

?>