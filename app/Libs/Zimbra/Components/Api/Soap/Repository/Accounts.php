<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 10.09.19
 * Time: 08:28
 * Class Accounts
 */
class Accounts extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractRepository
{
    const NO_COS_INDEX = "default";
    public function getByDomainName($name)
    {
        $domain = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain();
        $domain->setName($name);
        $result = $this->getClient()->account->getAllByDomain($domain);
        $accounts = $result->getResponseBody()["GETALLACCOUNTSRESPONSE"]["ACCOUNT"];
        $tmp = [];
        if (isset($accounts["NAME"])) {
            $tmpAccount = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account($accounts);
            if (strpos($tmpAccount->getName(), "galsync@") !== false) {
                return [];
            }
            $tmp[$tmpAccount->getId()] = $tmpAccount;
        } else {
            foreach ($accounts as $account) {
                $tmpAccount = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account($account);
                if (strpos($tmpAccount->getName(), "galsync@") === false) {
                    $tmp[$tmpAccount->getId()] = $tmpAccount;
                }
            }
        }
        return $tmp;
    }
    public function getGroupedByCos($name)
    {
        $accounts = $this->getByDomainName($name);
        foreach ($accounts as $account) {
            $cosId = $account->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account::ATTR_CLASS_OF_SERVICE_ID);
            $key = $cosId ? $cosId : NO_COS_INDEX;
            $tmp[$key][] = $account;
        }
        return $tmp;
    }
    public function getMailboxes($name)
    {
        $accounts = $this->getByDomainName($name);
        foreach ($accounts as $key => $account) {
            if (strpos($account->getName(), "galsync@") !== false) {
                unset($accounts[$key]);
            }
        }
        return $accounts;
    }
    public function getAccountInfoById($id)
    {
        $account = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account();
        $account->setId($id);
        $result = $this->getClient()->account->getAccountInfo($account);
        if (!$result->getLastError()) {
            $body = $result->getResponseBody();
            $result = $account->fill($body["GETACCOUNTINFORESPONSE"]);
            $result->setName($body["GETACCOUNTINFORESPONSE"]["NAME"]["DATA"]);
            return $result;
        }
        return $result;
    }
    public function getAccountOptionsById($id)
    {
        $account = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account();
        $account->setId($id);
        $result = $this->getClient()->account->getAccountOptions($account);
        if (!$result->getLastError()) {
            $body = $result->getResponseBody();
            return $account->fill($body["GETACCOUNTRESPONSE"]["ACCOUNT"]);
        }
        return $result;
    }
    public function getUsages($name)
    {
        $domain = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain();
        $domain->setName($name);
        $result = $this->getClient()->domain->getDomainUsages($domain);
        $accounts = $result->getResponseBody()["GETQUOTAUSAGERESPONSE"]["ACCOUNT"];
        if (isset($accounts["NAME"])) {
            $tmpAccount = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account($accounts);
            $tmp[$tmpAccount->getId()] = $tmpAccount;
        } else {
            foreach ($accounts as $account) {
                $tmpAccount = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account($account);
                $tmp[$tmpAccount->getId()] = $tmpAccount;
            }
        }
        return $tmp;
    }
    public function getFullUsages($name)
    {
        foreach ($this->getUsages($name) as $acc) {
            $used += (int) $acc->getUsed();
        }
        $used = round($used / \ModulesGarden\Servers\ZimbraEmail\App\Enums\Size::B_TO_MB, 2);
        return $used;
    }
    public function getAccountAliasesByDomainName($domain)
    {
        $accounts = $this->getByDomainName($domain);
        foreach ($accounts as $account) {
            foreach ($account->getAliases() as $al) {
                $alias = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\AccountAlias();
                $alias->setAccountId($account->getId());
                $alias->setAccountName($account->getName());
                $alias->setAlias($al);
                $data[] = $alias;
            }
        }
        return $data;
    }
}

?>