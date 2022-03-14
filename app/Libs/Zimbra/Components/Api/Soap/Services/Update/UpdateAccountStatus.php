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
 * Time: 09:00
 * Class UpdateAccountStatus
 */
class UpdateAccountStatus extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\ApiService
{
    use \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Traits\ProductManagerHandler;
    public function process()
    {
        $model = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account();
        $model->setId($this->formData["id"]);
        $model->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_ACCOUNT_STATUS, $this->formData["status"]);
        $result = $this->api->account->update($model);
        if (!$result) {
            $this->setError($this->api->account->getError());
            return false;
        }
        return true;
    }
}

?>