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
 * Time: 08:40
 * Class DistributionList
 */
class DistributionLists extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractRepository
{
    public function getAllDistributionListsByDomain($domainName)
    {
        $domain = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain();
        $domain->setName($domainName);
        $result = $this->getClient()->distributionList->getAllDistributionLists($domain);
        $accounts = $result->getResponseBody()["GETALLDISTRIBUTIONLISTSRESPONSE"]["DL"];
        if (isset($accounts["NAME"])) {
            $tmpAccount = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList($accounts);
            $tmp[$tmpAccount->getId()] = $tmpAccount;
        } else {
            foreach ($accounts as $account) {
                $tmpAccount = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList($account);
                $tmp[$tmpAccount->getId()] = $tmpAccount;
            }
        }
        return $tmp;
    }
    public function getDistributionListBydId($id)
    {
        $list = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList();
        $list->setId($id);
        return $this->getClient()->distributionList->read($list);
    }
}

?>