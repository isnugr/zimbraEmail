<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Home\Pages;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 10.09.19
 * Time: 10:09
 * Class Dashboard
 */
class Dashboard extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\ClientArea
{
    /**
     * @var array
     */
    protected $featureContainer = [];
    public function initContent()
    {
        $this->initFeatures();
    }
    protected function initFeatures()
    {
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($this->getRequestValue("id"));
        if ($productManager->isControllerAccessible(\ModulesGarden\Servers\ZimbraEmail\App\Enums\ControllerEnums::EMAIL_ACCOUNT_PAGE)) {
            $feature = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Home\Fields\FeatureField("emailAccount");
            $feature->setUrl(\ModulesGarden\Servers\ZimbraEmail\App\Helpers\BuildUrlExtended::getProvisioningUrl("emailAccount"));
            $this->addFeature($feature);
        }
        if ($productManager->isControllerAccessible(\ModulesGarden\Servers\ZimbraEmail\App\Enums\ControllerEnums::EMAIL_ALIAS_PAGE)) {
            $feature = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Home\Fields\FeatureField("emailAlias");
            $feature->setUrl(\ModulesGarden\Servers\ZimbraEmail\App\Helpers\BuildUrlExtended::getProvisioningUrl("emailAlias"));
            $this->addFeature($feature);
        }
        if ($productManager->isControllerAccessible(\ModulesGarden\Servers\ZimbraEmail\App\Enums\ControllerEnums::DISTRIBUTION_MAIL_PAGE)) {
            $feature = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Home\Fields\FeatureField("distributionList");
            $feature->setUrl(\ModulesGarden\Servers\ZimbraEmail\App\Helpers\BuildUrlExtended::getProvisioningUrl("distributionList"));
            $this->addFeature($feature);
        }
        if ($productManager->isControllerAccessible(\ModulesGarden\Servers\ZimbraEmail\App\Enums\ControllerEnums::DOMAIN_ALIAS_PAGE)) {
            $feature = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Home\Fields\FeatureField("domainAlias");
            $feature->setUrl(\ModulesGarden\Servers\ZimbraEmail\App\Helpers\BuildUrlExtended::getProvisioningUrl("domainAlias"));
            $this->addFeature($feature);
        }
        if ($productManager->isControllerAccessible(\ModulesGarden\Servers\ZimbraEmail\App\Enums\ControllerEnums::WEBMAIL_PAGE)) {
            $feature = new \ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Home\Fields\FeatureField("goWebmail");
            $feature->setTargetBlank(true);
            $feature->setUrl(\ModulesGarden\Servers\ZimbraEmail\App\Helpers\BuildUrlExtended::getProvisioningUrl("webmail"));
            $this->addFeature($feature);
        }
    }
    protected function addFeature(\ModulesGarden\Servers\ZimbraEmail\App\UI\Client\Home\Fields\FeatureField $feature)
    {
        $this->featureContainer[$feature->getId()] = $feature;
        return $this;
    }
    public function getFeatures()
    {
        return $this->featureContainer;
    }
}

?>