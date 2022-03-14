<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Hook;

class HookIntegrationsWrapper
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\IsAdmin;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Smarty;
    protected $integrations = [];
    protected $templateName = "integrationsWrapper";
    protected $templateDirectory = NULL;
    public function __construct($integrations = [])
    {
        if (is_array($integrations)) {
            $this->integrations = $integrations;
        }
        $this->templateDirectory = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getTemplateDir() . DIRECTORY_SEPARATOR . ($this->isAdmin() ? "admin" : "client" . DIRECTORY_SEPARATOR . "default") . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . "controlers";
    }
    public function getHtml()
    {
        foreach ($this->integrations as $key => $integration) {
            if (!$integration["htmlData"] || $integration["htmlData"] === "" || !is_string($integration["htmlData"]) || !$integration["integrationDetails"] || !is_object($integration["integrationDetails"])) {
                unset($this->integrations[$key]);
            }
        }
        if (!$this->integrations) {
            return NULL;
        }
        $smarty = $this->getSmarty();
        $integrationHtml = $smarty->view($this->templateName, $this->getWrapperData(), $this->templateDirectory);
        return $integrationHtml;
    }
    protected function getWrapperData()
    {
        return ["integrations" => $this->integrations];
    }
}

?>