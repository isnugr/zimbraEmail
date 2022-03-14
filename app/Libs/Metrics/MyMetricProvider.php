<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Metrics;

class MyMetricProvider implements \WHMCS\UsageBilling\Contracts\Metrics\ProviderInterface
{
    private $moduleParams = [];
    public function __construct($moduleParams)
    {
        $this->moduleParams = $moduleParams;
    }
    public function metrics()
    {
        return [new \WHMCS\UsageBilling\Metrics\Metric("mailboxes", "Email Accounts", \WHMCS\UsageBilling\Contracts\Metrics\MetricInterface::TYPE_SNAPSHOT), new \WHMCS\UsageBilling\Metrics\Metric("aliases", "Email Aliases", \WHMCS\UsageBilling\Contracts\Metrics\MetricInterface::TYPE_SNAPSHOT), new \WHMCS\UsageBilling\Metrics\Metric("distributionLists", "Distribution Lists", \WHMCS\UsageBilling\Contracts\Metrics\MetricInterface::TYPE_SNAPSHOT), new \WHMCS\UsageBilling\Metrics\Metric("domainAliases", "Domain Aliases", \WHMCS\UsageBilling\Contracts\Metrics\MetricInterface::TYPE_SNAPSHOT), new \WHMCS\UsageBilling\Metrics\Metric("storage", "Storage", \WHMCS\UsageBilling\Contracts\Metrics\MetricInterface::TYPE_SNAPSHOT, new \WHMCS\UsageBilling\Metrics\Units\MegaBytes())];
    }
    public function usage()
    {
        $domains = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($this->moduleParams["serverid"])->soap->repository()->domains()->getAll();
        $usage = [];
        foreach ($domains as $domain) {
            $domainName = $domain->getName();
            $mailboxes = $this->getAccounts($domainName);
            $countOfMailboxes = count($mailboxes);
            $countOfDistributionList = count($this->getDistributionList($domainName));
            $countOfEmailAliases = 0;
            foreach ($mailboxes as $account) {
                $countOfEmailAliases += count($account->getAliases());
            }
            $domainAliases = $this->getDomainAliases($domainName);
            $countOfDomainAliases = count($domainAliases);
            $storage = $this->getDomainUsage($domainName);
            $domainData = ["mailboxes" => $countOfMailboxes, "distributionLists" => $countOfDistributionList, "aliases" => $countOfEmailAliases, "domainAliases" => $countOfDomainAliases, "storage" => $storage / 1024 / 1024];
            $usage[$domainName] = $this->wrapUserData($domainData);
        }
        return $usage;
    }
    public function tenantUsage($tenant)
    {
        $mailboxes = $this->getAccounts($tenant);
        $countOfMailboxes = count($mailboxes);
        $countOfEmailAliases = 0;
        foreach ($mailboxes as $account) {
            $countOfEmailAliases += count($account->getAliases());
        }
        $countOfDistributionList = count($this->getDistributionList($tenant));
        $domainAliases = $this->getDomainAliases($tenant);
        $countOfDomainAliases = count($domainAliases);
        $storage = $this->getDomainUsage($tenant);
        $userData = ["mailboxes" => $countOfMailboxes, "distributionLists" => $countOfDistributionList, "aliases" => $countOfEmailAliases, "domainAliases" => $countOfDomainAliases, "storage" => $storage / 1024 / 1024];
        return $this->wrapUserData($userData);
    }
    private function wrapUserData($data)
    {
        $wrapped = [];
        foreach ($this->metrics() as $metric) {
            $key = $metric->systemName();
            if ($data[$key]) {
                $value = $data[$key];
                $metric = $metric->withUsage(new \WHMCS\UsageBilling\Metrics\Usage($value));
            }
            $wrapped[] = $metric;
        }
        return $wrapped;
    }
    private function getAccounts($tenant)
    {
        $accounts = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($this->moduleParams["serverid"])->soap->repository()->accounts()->getByDomainName($tenant);
        return $accounts;
    }
    private function getDomainAliases($tenant)
    {
        $domainAliases = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($this->moduleParams["serverid"])->soap->repository()->domains->getAliases($tenant);
        return $domainAliases;
    }
    private function getDomainUsage($tenant)
    {
        $accounts = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($this->moduleParams["serverid"])->soap->repository()->accounts->getUsages($tenant);
        $totalUsage = 0;
        foreach ($accounts as $account) {
            $usage = $account->getUsed();
            $totalUsage += $usage;
        }
        return $totalUsage;
    }
    private function getDistributionList($tenant)
    {
        $distributionList = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($this->moduleParams["serverid"])->soap->repository()->lists->getAllDistributionListsByDomain($tenant);
        return $distributionList;
    }
}

?>