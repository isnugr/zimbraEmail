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
 * Time: 07:59
 * Class Domains
 */
class Domains extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractRepository
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    public function getByName($name)
    {
        $domain = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain();
        $domain->setName($name);
        $result = $this->getClient()->domain->getDomainId($domain);
        if (!$result->getLastError()) {
            $domain = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain($result->getResponseBody()["GETDOMAININFORESPONSE"]["DOMAIN"]);
            return $domain;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function getAliases($name)
    {
        $mainDomain = $this->getByName($name);
        if (!$mainDomain) {
            return false;
        }
        foreach ($aliases = $this->getAll() as $key => $alias) {
            if (!$alias->isAlias()) {
                unset($aliases[$key]);
            } else {
                if ($alias->getAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain::ATTR_ALIAS_TARGET_ID) !== $mainDomain->getId()) {
                    unset($aliases[$key]);
                }
            }
        }
        return $aliases;
    }
    public function getAll()
    {
        $result = $this->getClient()->domain->getAll();
        $domains = $result->getResponseBody()["GETALLDOMAINSRESPONSE"]["DOMAIN"];
        if (isset($domains["NAME"])) {
            $tmpAccount = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain($domains);
            $tmp[$tmpAccount->getId()] = $tmpAccount;
        } else {
            foreach ($domains as $account) {
                $tmpAccount = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain($account);
                $tmp[$tmpAccount->getId()] = $tmpAccount;
            }
        }
        return $tmp;
    }
    public function getDomain()
    {
        $result = $this->getClient()->domain->getAll();
        $domains = $result->getResponseBody()["GETALLDOMAINSRESPONSE"]["DOMAIN"];
        $domain = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain();
        $result = $this->getClient()->domain->getDomain($domain);
    }
}

?>