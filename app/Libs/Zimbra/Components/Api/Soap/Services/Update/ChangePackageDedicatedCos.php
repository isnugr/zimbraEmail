<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Services\Update;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 07.11.19
 * Time: 14:00
 * Class ChangePackageDedicatedCos
 */
class ChangePackageDedicatedCos extends ChangePackage
{
    protected $cosModels = [];
    public function config()
    {
        $this->cosModels = $this->api->repository()->cos->all();
        self::config();
    }
    public function isValid()
    {
        if (!$this->formData["domain"]) {
            $this->setError("Domain name can not be found.");
            return false;
        }
        if (!$this->productManager->getSettingCos()) {
            $this->setError("Can not found class of service Id");
            return false;
        }
        if (!is_string($this->productManager->getSettingCos())) {
            $this->setError("Invalid class of service ID format");
            return false;
        }
        return self::isValid();
    }
    public function process()
    {
        $accounts = $this->api->repository()->accounts->getByDomainName($this->formData["domain"]);
        foreach ($accounts as $account) {
            $cos = $this->cosModels[$this->productManager->getSettingCos()];
            $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_MAIL_QUOTA, $cos->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_MAIL_QUOTA));
            $cosAttrs = $cos->getAllDataResourcesAAttributes();
            foreach (\ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::BASE_ACCOUNT_CONFIG as $key) {
                $value = $cosAttrs[$key] ? $cosAttrs[$key] : \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_DISABLED;
                $account->setAttr($key, $value);
            }
            $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_CLASS_OF_SERVICE_ID, $cos->getId());
            $result = $this->api->account->update($account);
            if (!$result) {
            }
        }
        return true;
    }
}

?>