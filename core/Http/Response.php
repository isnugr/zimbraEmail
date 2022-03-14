<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Http;

/**
 * Description of Response
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Response extends \Symfony\Component\HttpFoundation\Response
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Template;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\IsAdmin;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    protected $data = [];
    protected $lang = NULL;
    protected $staticName = NULL;
    protected $isBreadcrumbs = true;
    protected $isDebug = NULL;
    protected $forceHtml = false;
    public function setLang($lang)
    {
        $this->lang = $lang;
        return $this;
    }
    public function setBreadcrumbs($isBreadcrumbs)
    {
        $this->isBreadcrumbs = $isBreadcrumbs;
        return $this;
    }
    public function isBreadcrumbs()
    {
        return $this->isBreadcrumbs;
    }
    public function setName($name)
    {
        $this->staticName = $name;
        return $this;
    }
    public function getName()
    {
        return $this->staticName;
    }
    public function getLang()
    {
        if (empty($this->lang)) {
            $this->lang = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("lang");
        }
        return $this->lang;
    }
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    public function getError()
    {
        $data = $this->getData();
        if (isset($data["status"]) && $data["status"] == "error") {
            return $data["message"];
        }
        return false;
    }
    public function getSuccess()
    {
        $data = $this->getData();
        if (isset($data["status"]) && $data["status"] == "success") {
            return $data["message"];
        }
        return false;
    }
    public function getData($key = NULL, $dafault = NULL)
    {
        if ($key == NULL) {
            return $this->data;
        }
        if (isset($this->data[$key]) || array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        return $dafault;
    }
    public function withSuccess($message = "")
    {
        $data = $this->getData();
        $data["status"] = "success";
        $data["message"] = $message;
        $this->setData($data);
        return $this;
    }
    public function withError($message = "")
    {
        $data = $this->getData();
        $data["status"] = "error";
        $data["message"] = $message;
        $this->setData($data);
        return $this;
    }
    public function getPageContext()
    {
        $tpl = $this->getData("tpl", "home");
        return \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("smarty")->setLang($this->getLang())->view($tpl, $this->getData("data", []), $this->getData("tplDir", false));
    }
    public function getHtmlResponse($responseResolver)
    {
        $pageController = $responseResolver->getPageController();
        $path = $responseResolver->getTemplateDir();
        $fileName = $pageController->getTemplateName() ?: "main";
        $controller = $pageController->getControllerClass(true);
        $action = $pageController->getControllerMethod();
        $mainMenu = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::create("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Http\\View\\MainMenu")->buildBreadcrumb($controller, $action, []);
        $menu = $mainMenu->getMenu();
        $addon = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\Instances\\Addon\\Config");
        $vars = ["assetsURL" => \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::getAssetsURL(), "customAssetsURL" => \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::getAssetsURL(true), "isCustomIntegrationCss" => \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::isCustomIntegrationCss(), "isCustomModuleCss" => \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::isCustomModuleCss(), "mainURL" => \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::getUrl(), "mainName" => $this->staticName === NULL ? $addon->getConfigValue("name") : $this->staticName, "menu" => $menu, "breadcrumbs" => $this->isBreadcrumbs ? $this->data["data"]["breadcrumbs"] : NULL, "JSONCurrentUrl" => \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::getUrl($controller), "currentPageName" => $controller, "mgWhmcsVersionComparator" => new \ModulesGarden\Servers\ZimbraEmail\Core\Helper\WhmcsVersionComparator(), "content" => $this->getPageContext(), "moduleRequirementsErrors" => $this->checkModuleRequirements(), "error" => $this->getData("status", false) == "error" ? $this->getData("message", "") : false, "success" => $this->getData("status", false) == "success" ? $this->getData("message", "") : false, "tagImageModule" => $addon->getConfigValue("moduleIcon"), "isDebug" => (int) (int) $addon->getConfigValue("debug", "0"), "errorPageDetails" => $this->getErrorPageData($responseResolver)];
        try {
            $this->loadLangContext();
            if (!$responseResolver->isAdmin() && !$this->forceHtml) {
                $vars["MGLANG"] = $this->lang;
                if (strpos(trim("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Http\\Response", "\\"), "ModulesGarden\\Servers") === 0) {
                    return $this->returnClientProvisioning($vars, $path, $fileName);
                }
                return $this->returnClientAddon($vars, $path, $fileName);
            }
            $pageContent = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("smarty")->setLang($this->lang)->setTemplateDir($path)->view($fileName, $vars);
            return $pageContent;
        } catch (\Exception $e) {
            \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Http\\Response", $e->getMessage(), $e->getTrace());
        }
    }
    public function returnClientAddon($vars, $path, $fileName)
    {
        return ["vars" => $vars, "templatefile" => str_replace(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getTemplateDir() . DIRECTORY_SEPARATOR, "", $path . DIRECTORY_SEPARATOR . $fileName), "requirelogin" => true, "breadcrumb" => $this->isBreadcrumbs ? $this->data["data"]["breadcrumbs"] : NULL];
    }
    public function returnClientProvisioning($vars, $path, $fileName)
    {
        $templateVarName = $this->getRequestValue("a", false) === "management" ? "tabOverviewReplacementTemplate" : "templatefile";
        return [$templateVarName => str_replace(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getTemplateDir() . DIRECTORY_SEPARATOR, "", $path . DIRECTORY_SEPARATOR . $fileName), "templateVariables" => $vars];
    }
    protected function checkModuleRequirements()
    {
        $requirementsHandler = new \ModulesGarden\Servers\ZimbraEmail\Core\App\Requirements\Checker();
        $requirementsErrors = $requirementsHandler->getUnfulfilledRequirements();
        if ($requirementsErrors) {
            return implode("<br>", $requirementsErrors);
        }
        return $this->getData("status", false) == "error" ? $this->getData("message", "") : false;
    }
    protected function loadLangContext()
    {
        $this->lang->setContext($this->getType() . ($this->isAdmin() ? "AA" : "CA"));
    }
    protected function getType()
    {
        return "addon";
    }
    public function setForceHtml()
    {
        $this->forceHtml = true;
        return $this;
    }
    public function unsetForceHtml()
    {
        $this->forceHtml = false;
        return $this;
    }
    public function isDebugOn()
    {
        if ($this->isDebug === NULL) {
            $addon = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\Instances\\Addon\\Config");
            $this->isDebug = (int) (int) $addon->getConfigValue("debug", "0");
        }
        return $this->isDebug;
    }
    public function getErrorPageData($responseResolver)
    {
        $pageController = $responseResolver->getPageController();
        $error = $pageController->getParam("mgErrorDetails");
        if (!$error) {
            return NULL;
        }
        $errorDetails = $error->getDetailsToDisplay();
        return $errorDetails;
    }
}

?>