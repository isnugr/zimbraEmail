<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap;

/**
 *
 * Class return supported services
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 03.10.19
 * Time: 13:15
 * Class Services
 */
class Services
{
    use Traits\ApiClientHandler;
    public function __construct(Client $api)
    {
        $this->setApi($api);
    }
    public function createAccount($type = Repository\ClassOfServices::CUSTOM_ZIMBRA)
    {
        switch ($type) {
            case Repository\ClassOfServices::CUSTOM_ZIMBRA:
                $service = new Services\Create\CreateAccount($this->getApi());
                break;
            case Repository\ClassOfServices::ZIMBRA_CONFIG_OPTIONS:
                $service = new Services\Create\CreateAccountCosQuota($this->getApi());
                break;
            case Repository\ClassOfServices::CLASS_OF_SERVICE_QUOTA:
                $service = new Services\Create\CreateAccountCosQuota($this->getApi());
                break;
            default:
                $service = new Services\Create\CreateAccountCosQuota($this->getApi());
                return $service;
        }
    }
    public function createAccountAlias()
    {
        return new Services\Create\CreateAccountAlias($this->getApi());
    }
    public function createDistributionList()
    {
        return new Services\Create\CreateDistributionList($this->getApi());
    }
    public function createDomain()
    {
        return new Services\Create\CreateDomain($this->getApi());
    }
    public function createDomainAlias()
    {
        return new Services\Create\CreateDomainAlias($this->getApi());
    }
    public function changePackages($type = Repository\ClassOfServices::CUSTOM_ZIMBRA)
    {
        switch ($type) {
            case Repository\ClassOfServices::CUSTOM_ZIMBRA:
                $service = new Services\Update\ChangePackage($this->getApi());
                break;
            case Repository\ClassOfServices::ZIMBRA_CONFIG_OPTIONS:
                $service = new Services\Update\ChangePackageConfigOptions($this->getApi());
                break;
            case Repository\ClassOfServices::CLASS_OF_SERVICE_QUOTA:
                $service = new Services\Update\ChangePackageCosQuota($this->getApi());
                break;
            default:
                $service = new Services\Update\ChangePackageDedicatedCos($this->getApi());
                return $service;
        }
    }
    public function updateAccount($type = Repository\ClassOfServices::CUSTOM_ZIMBRA)
    {
        switch ($type) {
            case Repository\ClassOfServices::CUSTOM_ZIMBRA:
                $service = new Services\Update\UpdateAccount($this->getApi());
                break;
            case Repository\ClassOfServices::ZIMBRA_CONFIG_OPTIONS:
                $service = new Services\Update\UpdateAccount($this->getApi());
                break;
            case Repository\ClassOfServices::CLASS_OF_SERVICE_QUOTA:
                $service = new Services\Update\UpdateAccountCosQuota($this->getApi());
                break;
            default:
                $service = new Services\Update\UpdateAccount($this->getApi());
                return $service;
        }
    }
    public function updateAccountStatus()
    {
        return new Services\Update\UpdateAccountStatus($this->getApi());
    }
    public function updateAccountPassword()
    {
        return new Services\Update\UpdateAccountPassword($this->getApi());
    }
    public function updateDistributionList()
    {
        return new Services\Update\UpdateDistributionList($this->getApi());
    }
    public function suspendDomain()
    {
        return new Services\Update\SuspendDomain($this->getApi());
    }
    public function unsuspendDomain()
    {
        return new Services\Update\UnsuspendDomain($this->getApi());
    }
    public function deleteAccount()
    {
        return new Services\Delete\DeleteAccount($this->getApi());
    }
    public function deleteDomain()
    {
        return new Services\Delete\DeleteDomain($this->getApi());
    }
    public function deleteAccountAlias()
    {
        return new Services\Delete\DeleteAccountAlias($this->getApi());
    }
    public function deleteDistributionList()
    {
        return new Services\Delete\DeleteDistributionList($this->getApi());
    }
    public function deleteDomainAlias()
    {
        return new Services\Delete\DeleteDomainAlias($this->getApi());
    }
    public function clientSingleSignOnToken()
    {
        return new Services\Sso\ClientSingleSignOnToken($this->getApi());
    }
}

?>