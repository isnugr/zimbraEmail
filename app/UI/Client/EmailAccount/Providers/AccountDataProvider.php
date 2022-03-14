<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Providers;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 10.09.19
 * Time: 13:06
 * Class AccountDataProvider
 */
class AccountDataProvider extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\DataProviders\BaseDataProvider
{
    public function read()
    {
        $hid = $this->request->get("id");
        $hosting = \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Hosting::where("id", $hid)->first();
        $this->data["domain"] = $hosting->domain;
        $lang = ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("lang");
        $this->availableValues["status"] = [\ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_ACTIVE => $lang->absoluteT("zimbra", "account", "status", "active"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_LOCKED => $lang->absoluteT("zimbra", "account", "status", "locked"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_MAINTENANCE => $lang->absoluteT("zimbra", "account", "status", "maintenance"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_CLOSED => $lang->absoluteT("zimbra", "account", "status", "closed"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_LOCKOUT => $lang->absoluteT("zimbra", "account", "status", "lockout"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_PENDING => $lang->absoluteT("zimbra", "account", "status", "pending")];
        $this->readCosParams();
    }
    public function create()
    {
        $hid = $this->request->get("id");
        $fieldToProtection = ["firstname", "lastname", "display_name", "company", "title", "country", "state", "city", "street", "post_code"];
        $value = in_array($field, $fieldToProtection) ? htmlentities($value) : $value;
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $service = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->service()->createAccount($productManager->get("cos_name"));
        $service->setProductManager($productManager)->setFormData($this->formData);
        $result = $service->run();
        if (!$result) {
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessage($service->getError())->setStatusError();
        }
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("emailAccountHasBeenAdded")->setStatusSuccess();
    }
    public function updateStatus()
    {
    }
    public function update()
    {
        $hid = $this->request->get("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $service = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->service()->updateAccountStatus()->setProductManager($productManager);
        foreach ($this->request->get("massActions") as $id) {
            $service->setFormData(["status" => $this->formData["status"], "id" => $id]);
            $result = $service->run();
        }
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("massEmailAccountStatusHasBeenUpdated")->setStatusSuccess();
    }
    protected function readCosParams()
    {
        $hid = $this->request->get("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        if ($productManager->get("cos_name") === \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CLASS_OF_SERVICE_QUOTA) {
            $api = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap;
            $classOfServices = $api->repository()->cos->all();
            $supportedCos = $productManager->getSettingCos();
            $configoptions = $this->getFilteredCosConfigurableOptions();
            foreach ($classOfServices as $cos) {
                if ($supportedCos && array_key_exists($cos->getId(), $supportedCos)) {
                    if (!$configoptions || array_key_exists("cosQuota_" . $cos->getId(), $configoptions)) {
                        if (!($configoptions && $configoptions["cosQuota_" . $cos->getId()] == 0)) {
                            if ($configoptions || $supportedCos[$cos->getId()] != 0) {
                                $this->availableValues["cosId"][$cos->getId()] = $cos->getMbMailQuote() . " MB";
                            }
                        }
                    }
                }
            }
            return $this;
        } else {
            if ($productManager->get("cos_name") === \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::ZIMBRA_CONFIG_OPTIONS) {
                $this->data["cosId"] = key($productManager->getSettingCos());
                return $this;
            }
            if ($productManager->get("cos_name") !== \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository\ClassOfServices::CUSTOM_ZIMBRA) {
                $this->data["cosId"] = $productManager->get("cos_name");
                return $this;
            }
            return $this;
        }
    }
    protected function getFilteredCosConfigurableOptions()
    {
        $configoptions = $this->getWhmcsParamByKey("configoptions");
        foreach ($configoptions as $key => $value) {
            if (strpos($key, \ModulesGarden\Servers\ZimbraEmail\App\Services\ConfigurableOptions\Strategy\Types\ClassOfServicesOptions::COS_CONFIG_OPT_PREFIX) === false) {
                unset($configoptions[$key]);
            }
        }
        return $configoptions;
    }
}

?>