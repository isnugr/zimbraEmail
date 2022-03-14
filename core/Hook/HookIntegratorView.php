<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Hook;

/**
 *  class HookIntegratorView
 *  Prepares a views basing on /App/Integrations/Admin/ & /App/Integrations/Client controlers
 *  to be injected on WHMCS subpages
 */
class HookIntegratorView
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Smarty;
    /**
     * @var null|string|\ModulesGarden\Servers\ZimbraEmail\Core\UI\View
     * integration data
     */
    protected $view = NULL;
    /**
     * @var null|string
     * HTML integration code
     */
    protected $HTMLData = NULL;
    public function __construct($view, $integration)
    {
        $this->view = $view;
    }
    public function getHTML()
    {
        $this->viewToHtml();
        return $this->HTMLData;
    }
    protected function viewToHtml()
    {
        if ($this->view instanceof \ModulesGarden\Servers\ZimbraEmail\Core\UI\View) {
            $resp = $this->view->getResponse();
            $integrationPageController = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\Instances\\Http\\Integration");
            $integrationPageController->setControllerResult($resp);
            $this->HTMLData = $integrationPageController->execute();
            return true;
        }
        if (is_string($this->view)) {
            $this->HTMLData = $this->view;
            return true;
        }
        $this->HTMLData = "";
    }
}

?>