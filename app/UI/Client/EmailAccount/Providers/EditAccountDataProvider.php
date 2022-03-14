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
 * Date: 18.09.19
 * Time: 09:35
 * Class EditAccountDataProvider
 */
class EditAccountDataProvider extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\DataProviders\BaseDataProvider
{
    public function read()
    {
        $hid = $this->getRequestValue("id");
        $hosting = \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Hosting::where("id", $hid)->first();
        $api = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($hosting->server);
        $repository = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository($api->soap);
        $result = $repository->accounts->getAccountOptionsById($this->actionElementId);
        if ($result instanceof \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Response && $result->getLastError()) {
            throw new \Exception($result->getLastError());
        }
        $mailBoxParams = explode("@", $result->getName());
        $this->data["id"] = $result->getId();
        list($this->data["username"], $this->data["domain"]) = $mailBoxParams;
        $this->data["firstname"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_FIRSTNAME);
        $this->data["lastname"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_LASTNAME);
        $this->data["display_name"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_DISPLAY_NAME);
        $this->data["status"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_ACCOUNT_STATUS);
        $this->data["company"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_COMPANY);
        $this->data["title"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_PROF_TITLE);
        $this->data["phone"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_PHONE);
        $this->data["home_phone"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_HOME_PHONE);
        $this->data["mobile_phone"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_MOBILE_PHONE);
        $this->data["fax"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_FAX);
        $this->data["pager"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_PAGER);
        $this->data["country"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_COUNTRY);
        $this->data["city"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_CITY);
        $this->data["street"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_STREET);
        $this->data["post_code"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_POSTAL_CODE);
        $this->data["currentCosId"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_CLASS_OF_SERVICE_ID);
        $this->data["cosId"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_CLASS_OF_SERVICE_ID);
        $this->data["state"] = $result->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_STATE);
        $lang = ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("lang");
        $this->availableValues["status"] = [\ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_ACTIVE => $lang->absoluteT("zimbra", "account", "status", "active"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_LOCKED => $lang->absoluteT("zimbra", "account", "status", "locked"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_MAINTENANCE => $lang->absoluteT("zimbra", "account", "status", "maintenance"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_CLOSED => $lang->absoluteT("zimbra", "account", "status", "closed"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_LOCKOUT => $lang->absoluteT("zimbra", "account", "status", "lockout"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_PENDING => $lang->absoluteT("zimbra", "account", "status", "pending")];
        $this->readCosParams();
    }
    public function update()
    {
        $hid = $this->request->get("id");
        $fieldToProtection = ["firstname", "lastname", "display_name", "company", "title", "country", "state", "city", "street", "post_code"];
        $value = in_array($field, $fieldToProtection) ? htmlentities($value) : $value;
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $service = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->service()->updateAccount($productManager->get("cos_name"));
        $service->setProductManager($productManager)->setFormData($this->formData);
        $result = $service->run();
        if (!$result) {
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessage($service->getError())->setStatusError();
        }
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("emailAccountHasBeenUpdated")->setStatusSuccess();
    }
    public function updateStatus()
    {
        $hid = $this->request->get("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $service = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->service()->updateAccountStatus()->setProductManager($productManager);
        $service->setFormData($this->formData);
        $result = $service->run();
        if (!$result) {
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessage($service->getError())->setStatusError();
        }
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("emailAccountStatusHasBeenUpdated")->setStatusSuccess();
    }
    public function changePassword()
    {
        $hid = $this->request->get("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $service = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->service()->updateAccountPassword()->setProductManager($productManager);
        $service->setFormData($this->formData);
        $result = $service->run();
        if (!$result) {
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessage($service->getError())->setStatusError();
        }
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("passwordChangedSuccessfully")->setStatusSuccess();
    }
    public function readCosParams()
    {
        $hid = $this->getRequestValue("id");
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