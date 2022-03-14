<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Filters\EmailAccounts;

class FilterByCosId
{
    protected $availableCos = [];
    public function setAvailableCoses($availableCoses = [])
    {
        $this->availableCos = $availableCoses;
        return $this;
    }
    public function filter($accounts = [])
    {
        foreach ($accounts as $key => $account) {
            if (!in_array($account->getCosId(), $this->availableCos)) {
                unset($accounts[$key]);
            }
        }
        return $accounts;
    }
}

?>