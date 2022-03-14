<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Services\Delete;

class DeleteAccount extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\ApiService
{
    public function process()
    {
        $account = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account();
        $account->setId($this->formData["id"]);
        $result = $this->api->account->delete($account);
        if (!$result) {
            $this->setError($this->api->account->getError());
            return false;
        }
        return $result;
    }
}

?>