<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Actions;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 28.08.19
 * Time: 13:46
 * Class Domain
 */
class Domain extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractAction
{
    public function create(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain $domain)
    {
        $params = [new \SoapParam($domain->getName(), "name")];
        foreach ($domain->getAttrs() as $key => $value) {
            $params[] = new \SoapVar("<ns1:a n=\"" . $key . "\">" . $value . "</ns1:a>", XSD_ANYXML);
        }
        $result = $this->connection->request("CreateDomainRequest", $params);
        $this->setLastResult($result);
        if ($data = $result->getResponseBody()["CREATEDOMAINRESPONSE"]["DOMAIN"]) {
            $domain->fill($data);
            return $domain;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function update(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain $domain)
    {
        $params = [new \SoapParam($domain->getId(), "id")];
        foreach ($domain->getAttrs() as $key => $value) {
            $params[] = new \SoapVar("<ns1:a n=\"" . $key . "\">" . $value . "</ns1:a>", XSD_ANYXML);
        }
        $result = $this->connection->request("ModifyDomainRequest", $params);
        $this->setLastResult($result);
        if ($data = $result->getResponseBody()["MODIFYDOMAINRESPONSE"]["DOMAIN"]) {
            $domain->fill($data);
            return $domain;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function delete(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain $domain)
    {
        $params = [new \SoapParam($domain->getId(), "id")];
        $result = $this->connection->cleanResponse()->request("DeleteDomainRequest", $params);
        $this->setLastResult($result);
        if ($result->getResponseBody()["DELETEDOMAINRESPONSE"]) {
            return true;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function getAll()
    {
        $result = $this->connection->request("GetAllDomainsRequest", []);
        return $result;
    }
    public function getDomainId(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain $domain)
    {
        $params = [new \SoapVar("<ns1:domain by=\"name\">" . $domain->getName() . "</ns1:domain>", XSD_ANYXML)];
        $result = $this->connection->cleanResponse()->request("GetDomainInfoRequest", $params);
        $this->setLastResult($result);
        return $result;
    }
    public function getDomain(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain $domain)
    {
        $params = [new \SoapVar("<ns1:domain by=\"name\">" . $domain->getName() . "</ns1:domain>", XSD_ANYXML)];
        $result = $this->connection->cleanResponse()->request("GetDomainRequest", $params);
        $this->setLastResult($result);
        return $result;
    }
    public function getDomainUsages(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain $domain)
    {
        $params = [new \SoapVar("<ns1:GetQuotaUsageRequest />", XSD_ANYXML), new \SoapParam($domain->getName(), "domain"), new \SoapParam("1", "refresh")];
        $result = $this->connection->request("GetQuotaUsageRequest", $params);
        $this->setLastResult($result);
        return $result;
    }
}

?>