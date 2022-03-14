<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Services\Delete;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 13:11
 * Class DeleteAccountAlias
 */
class DeleteAccountAlias extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\ApiService
{
    public function isValid()
    {
        if (!$this->formData["alias"]) {
            $this->setError("Alias can not be deleted. Invalid alias.");
            return false;
        }
        if (!$this->formData["id"]) {
            $this->setError("Alias can not be deleted. Invalid account.");
            return false;
        }
        return true;
    }
    public function process()
    {
        $aliasAccount = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\AccountAlias();
        $aliasAccount->setAlias($this->formData["alias"]);
        $aliasAccount->setAccountId($this->formData["id"]);
        $result = $this->api->account->deleteAlias($aliasAccount);
        if (!$result) {
            $this->setError($this->api->account->getError());
            return false;
        }
        return $result;
    }
}

?>