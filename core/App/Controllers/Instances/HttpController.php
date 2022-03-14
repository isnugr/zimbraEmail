<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances;

abstract class HttpController implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\DefaultController
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Smarty;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\OutputBuffer;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\IsAdmin;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\ErrorCodesLibrary;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Params;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\AppParams;
    protected $templateName = "main";
    protected $templateContext = "default";
    protected $templateDir = NULL;
    protected $controllerResult = NULL;
    /**
     * @var Router|null
     *
     */
    protected $router = NULL;
    protected $responseResolver = NULL;
    const ADMIN = "admin";
    const CLIENT = "client";
    public function __construct()
    {
        $this->loadSmarty();
        $this->isAdmin();
        $this->router = new \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Router();
        $this->responseResolver = new \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\ResponseResolver();
    }
    public function execute($params = NULL)
    {
        $this->setParams($params);
        if (!$this->router->isControllerCallable() || !$this->isAdminContextValid()) {
            return $this->controllerResult = $this->getPageNotFound();
        }
        $this->setAppParam("HttpControlerName", $this->router->getControllerClass());
        $this->setAppParam("HttpControlerMethod", $this->router->getControllerMethod());
        $this->controllerResult = $this->getControllerResponse();
        return $this->resolveResponse();
    }
    public function resolveResponse()
    {
        return $this->responseResolver->setResponse($this->controllerResult)->setTemplateName($this->getTemplateName())->setTemplateDir($this->getTemplateDir())->setPageController($this)->resolve();
    }
    public function isAdminContextValid()
    {
        if ($this->isAdmin() && !$this instanceof \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\AdminArea) {
            return false;
        }
        if (!$this->isAdmin() && !$this instanceof \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\ClientArea) {
            return false;
        }
        return true;
    }
    public function getPageNotFound()
    {
        $notFound = new Http\PageNotFound();
        return $notFound->execute();
    }
    protected function getControllerResponse()
    {
        $this->loadLang();
        $this->lang->setContext($this->getType() . ($this->isAdmin() ? "AA" : "CA"), lcfirst($this->getControllerClass(true)));
        $result = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::create($this->router->getControllerClass(), $this->router->getControllerMethod());
        return $result;
    }
    public function getTemplateName()
    {
        return $this->templateName;
    }
    public function getTemplateDir()
    {
        if ($this->templateDir === NULL) {
            $this->templateDir = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getTemplateDir() . DIRECTORY_SEPARATOR . ($this->isAdmin() ? ADMIN : CLIENT . DIRECTORY_SEPARATOR . $this->getTemplateContext()) . DIRECTORY_SEPARATOR . "controlers";
        }
        return $this->templateDir;
    }
    public function getTemplateContext()
    {
        return $this->templateContext;
    }
    public function getControllerClass($raw = false)
    {
        if ($raw) {
            $namespaceParts = explode("\\", $this->getControllerClass());
            return end($namespaceParts);
        }
        return $this->router->getControllerClass();
    }
    public function getControllerMethod()
    {
        return $this->router->getControllerMethod();
    }
    public function setControllerResult($controllerResult)
    {
        $this->controllerResult = $controllerResult;
    }
    public function getControllerResult()
    {
        return $this->controllerResult;
    }
    protected function getType()
    {
        return "addon";
    }
    public function runExecuteProcess($params = NULL)
    {
        return $this->execute($params);
    }
}

?>