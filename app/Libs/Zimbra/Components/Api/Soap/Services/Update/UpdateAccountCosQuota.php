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
 * Date: 09.10.19
 * Time: 08:25
 * Class UpdateAccountCosQuota
 */
class UpdateAccountCosQuota extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Services\Create\CreateAccountCosQuota
{
    protected function process()
    {
        $model = $this->getModel();
        $result = $this->api->account->update($model);
        if (!$result) {
            $this->setError($this->api->account->getError());
            return false;
        }
        return $result;
    }
    public function getModel()
    {
        $account = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account();
        $account->setId($this->formData["id"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_FIRSTNAME, $this->formData["firstname"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_LASTNAME, $this->formData["lastname"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_PHONE, $this->formData["phone"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_MOBILE_PHONE, $this->formData["mobile_phone"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_FAX, $this->formData["fax"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_PAGER, $this->formData["pager"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_HOME_PHONE, $this->formData["home_phone"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_COUNTRY, $this->formData["country"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_STATE, $this->formData["state"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_PROF_TITLE, $this->formData["title"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_POSTAL_CODE, $this->formData["post_code"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_CITY, $this->formData["city"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_STREET, $this->formData["street"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_COMPANY, $this->formData["company"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_ACCOUNT_STATUS, $this->formData["status"]);
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_DISPLAY_NAME, $this->formData["display_name"]);
        $cos = $this->cosModels[$this->formData["cosId"]];
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_MAIL_QUOTA, $cos->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_MAIL_QUOTA));
        $cosAttrs = $cos->getAllDataResourcesAAttributes();
        foreach (\ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::BASE_ACCOUNT_CONFIG as $key) {
            $value = $cosAttrs[$key] ? $cosAttrs[$key] : \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_DISABLED;
            $account->setAttr($key, $value);
        }
        $account->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_CLASS_OF_SERVICE_ID, $cos->getId());
        return $account;
    }
}

?>