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
 * Time: 13:03
 * Class ChangePackage
 */
class ChangePackage extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\ApiService
{
    use \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Traits\ProductManagerHandler;
    public function isValid()
    {
        if (!$this->formData["domain"]) {
            $this->setError("Domain name can not be found.");
            return false;
        }
        return self::isValid();
    }
    public function process()
    {
        $accounts = $this->api->repository()->accounts->getByDomainName($this->formData["domain"]);
        foreach ($accounts as $account) {
            foreach ($this->productManager->getZimbraConfiguration() as $key => $value) {
                $value = $value === \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED ? \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_ENABLED : \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_DISABLED;
                $account->setAttr($key, $value);
                $result = $this->api->account->update($account);
                if (!$result) {
                }
            }
        }
        return true;
    }
}

?>