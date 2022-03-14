<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI;

/**
 * Integration Addon View Controller
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class ViewIntegrationAddon extends View
{
    protected $wrapperTemplate = "integrationAddon";
    protected $integration = true;
    public function __construct($wrapperTemplate = NULL, $viewTemplate = NULL)
    {
        $this->setTemplate($viewTemplate);
        $this->mainContainer = new MainContainerIntegrationAddon();
        $this->initBreadcrumbs();
        $this->initCustomAssetFiles();
    }
}

?>