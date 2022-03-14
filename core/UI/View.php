<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI;

/**
 * Main View Controller
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class View
{
    use Traits\AppLayouts;
    use Traits\CustomJsCode;
    use Traits\ViewBreadcrumb;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\AppParams;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\IsDebugOn;
    /**
     * Controler for all widgets inside of View
     * @var \ModulesGarden\Servers\ZimbraEmail\Core\UI\MainContainer
     */
    protected $mainContainer = NULL;
    protected $template = NULL;
    protected $name = NULL;
    protected $isBreadcrumbs = true;
    protected $templateDir = NULL;
    protected $defaultComponentsJs = NULL;
    protected $integration = false;
    public function __construct($template = NULL)
    {
        $this->setTemplate($template);
        $this->mainContainer = new MainContainer();
        $this->initBreadcrumbs();
        $this->initCustomAssetFiles();
    }
    public function addElement($element, $containerName = NULL)
    {
        $this->mainContainer->addElement($element, $containerName);
        return $this;
    }
    public function getResponse()
    {
        $this->mainContainer->setTemplate($this->getAppLayoutTemplateDir(), $this->getAppLayout());
        $request = \ModulesGarden\Servers\ZimbraEmail\Core\Http\Request::build();
        if ($request->get("ajax", false)) {
            return $this->mainContainer->getAjaxResponse();
        }
        return ModulesGarden\Servers\ZimbraEmail\Core\Helper\response(["tpl" => $this->template, "tplDir" => $this->templateDir, "data" => ["mainContainer" => $this->mainContainer, "customJsCode" => $this->getCustomJsCode(), "customCssCode" => $this->getCustomCssCode(), "breadcrumbs" => $this->getBreadcrumbs()]])->setStatusCode(200)->setName($this->name)->setBreadcrumbs($this->isBreadcrumbs);
    }
    public function validateAcl($isAdmin)
    {
        $this->mainContainer->valicateACL($isAdmin);
        return $this;
    }
    public function setTemplate($template = NULL)
    {
        if ($template === NULL) {
            $this->template = "view";
            $this->templateDir = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getTemplateDir() . DS . (ModulesGarden\Servers\ZimbraEmail\Core\Helper\isAdmin() ? Helpers\TemplateConstants::ADMIN_PATH : Helpers\TemplateConstants::CLIENT_PATH) . DS . Helpers\TemplateConstants::MAIN_DIR;
        } else {
            $this->template = $template;
            $this->templateDir = NULL;
        }
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function disableBreadcrumbs()
    {
        $this->isBreadcrumbs = false;
        return $this;
    }
    public function genResponse()
    {
        return $this->getResponse();
    }
    public function setIsIntegration($isIntegration = false)
    {
        if (is_bool($isIntegration)) {
            $this->integration = $isIntegration;
            $this->initCustomAssetFiles();
        }
    }
    public function isIntegration()
    {
        return $this->integration;
    }
}

?>