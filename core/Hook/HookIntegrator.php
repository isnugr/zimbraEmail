<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Hook;

/**
 *  class HookIntegrator
 *  Prepares a views basing on /App/Integrations/Admin/ & /App/Integrations/Client controlers
 *  to be injected on WHMCS subpages
 */
class HookIntegrator
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\AppParams;
    /**
     * @var null
     * an array of WHMCS hook params, in which the Integrator was used
     */
    protected $hookParams = NULL;
    /**
     * @var bool
     *  determines if  works on admin or client area side
     */
    protected $isAdmin = false;
    /** @var array
     *  avalible hook integrations list
     */
    protected $integrations = [];
    /** @var null|string
     * HTML data to be returned as a result of the integration process
     */
    protected $integrationData = [];
    public function __construct($hookParams)
    {
        $this->setHookParams($hookParams);
        $this->checkIsAdmin();
        $this->integrate();
    }
    public function setHookParams($hookParams)
    {
        if (is_array($hookParams)) {
            $this->hookParams = $hookParams;
        }
        return $this;
    }
    public function checkIsAdmin()
    {
        $this->isAdmin = ModulesGarden\Servers\ZimbraEmail\Core\Helper\isAdmin();
    }
    public function getHtmlCode()
    {
        return $this->getWrapperHtml();
    }
    protected function integrate()
    {
        $this->loadAvailableIntegrations();
        $this->loadIntegrationData();
    }
    protected function loadAvailableIntegrations()
    {
        $hooksPath = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getModuleRootDir() . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "Integrations" . DIRECTORY_SEPARATOR . ($this->isAdmin ? "Admin" : "Client");
        if (!file_exists($hooksPath) || !is_readable($hooksPath)) {
            return false;
        }
        $files = scandir($hooksPath, 1);
        if ($files) {
            foreach ($files as $key => $value) {
                if ($value === "." || $value === ".." || 0 >= stripos($value, ".php")) {
                    unset($files[$key]);
                } else {
                    $this->addIntegration(str_replace(".php", "", $value));
                }
            }
        }
    }
    protected function addIntegration($className = NULL)
    {
        $integrationClassName = "\\ModulesGarden\\Servers\\ZimbraEmail\\App\\Integrations\\" . ($this->isAdmin ? "Admin" : "Client") . "\\" . $className;
        if (!class_exists($integrationClassName) || !is_subclass_of($integrationClassName, "ModulesGarden\\Servers\\ZimbraEmail\\Core\\Hook\\AbstractHookIntegrationController")) {
            return false;
        }
        $integrationInstance = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::create($integrationClassName);
        if (!$this->validateIntegrationInstance($integrationInstance)) {
            return false;
        }
        $this->integrations[] = $integrationInstance;
    }
    public function validateIntegrationInstance($instance = NULL)
    {
        if (!is_subclass_of($instance, "ModulesGarden\\Servers\\ZimbraEmail\\Core\\Hook\\AbstractHookIntegrationController")) {
            return false;
        }
        if ($instance->getJqSelector() === NULL || !is_callable($instance->getControllerCallback())) {
            return false;
        }
        return true;
    }
    public function loadIntegrationData()
    {
        foreach ($this->integrations as $integration) {
            if ($this->isIntegrationApplicable($integration)) {
                $callbackData = $integration->getControllerCallback();
                $this->setAppParam("IntegrationControlerName", $callbackData[0]);
                $this->setAppParam("IntegrationControlerMethod", $callbackData[1]);
                $integrationResult = call_user_func([ModulesGarden\Servers\ZimbraEmail\Core\Helper\di($callbackData[0]), $callbackData[1]]);
                if (!$integrationResult instanceof \ModulesGarden\Servers\ZimbraEmail\Core\UI\View) {
                    $this->setAppParam("IntegrationControlerName", NULL);
                    $this->setAppParam("IntegrationControlerMethod", NULL);
                } else {
                    $integrationResult->setIsIntegration(true);
                    $view = new HookIntegratorView($integrationResult, $integration);
                    $this->updateIntegrationData($integration, $view->getHTML());
                    $this->setAppParam("IntegrationControlerName", NULL);
                    $this->setAppParam("IntegrationControlerMethod", NULL);
                }
            }
        }
    }
    public function isIntegrationApplicable($integration = NULL)
    {
        if (!$integration) {
            return false;
        }
        if ($this->hookParams["filename"] !== $integration->getFileName()) {
            return false;
        }
        foreach ($integration->getRequestParams() as $rKey => $rParam) {
            if (is_array($rParam)) {
                $found = false;
                foreach ($rParam as $irParam) {
                    if ($this->getRequestValue($rKey) === $irParam) {
                        $found = true;
                        if (!$found) {
                            return false;
                        }
                    }
                }
            } else {
                if ($this->getRequestValue($rKey) !== $rParam) {
                    return false;
                }
            }
        }
        $integrationCallback = $integration->getControllerCallback();
        if (!is_subclass_of($integrationCallback[0], "ModulesGarden\\Servers\\ZimbraEmail\\Core\\Http\\AbstractController") && !is_subclass_of($integrationCallback[0], "ModulesGarden\\Servers\\ZimbraEmail\\Core\\Http\\AbstractClientController") || !method_exists($integrationCallback[0], $integrationCallback[1])) {
            return false;
        }
        return true;
    }
    protected function updateIntegrationData($integrationDetails, $htmlData)
    {
        if (!is_string($htmlData) || $htmlData === "" || !$integrationDetails || !is_object($integrationDetails)) {
            return false;
        }
        $this->integrationData[] = ["htmlData" => $htmlData, "integrationDetails" => $integrationDetails];
    }
    protected function getWrapperHtml()
    {
        if (!$this->integrationData) {
            return NULL;
        }
        $wrapper = new HookIntegrationsWrapper($this->integrationData);
        return $wrapper->getHtml();
    }
}

?>