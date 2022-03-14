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
 * Time: 13:47
 * Class DistributionList
 */
class DistributionList extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractAction
{
    public function getAllDistributionLists(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain $domain)
    {
        $result = NULL;
        $params = [new \SoapVar("<ns1:domain by=\"name\">" . $domain->getName() . "</ns1:domain>", XSD_ANYXML)];
        $this->connection->cleanResponse();
        $result = $this->connection->cleanResponse()->request("GetAllDistributionListsRequest", $params);
        return $result;
    }
    public function read(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list)
    {
        $params = [new \SoapVar("<ns1:dl by=\"id\">" . $list->getId() . "</ns1:dl>", XSD_ANYXML)];
        $result = $result = $this->connection->cleanResponse()->request("GetDistributionListRequest", $params);
        if ($data = $result->getResponseBody()["GETDISTRIBUTIONLISTRESPONSE"]["DL"]) {
            $list->fill($data);
            return $list;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function create(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list)
    {
        $params = [new \SoapParam($list->getName(), "name")];
        $attrs = $list->getAttrs();
        if ($list->isDynamic()) {
            $params[] = new \SoapParam(1, "dynamic");
            unset($attrs["zimbraDistributionListSendShareMessageToNewMembers"]);
        }
        foreach ($attrs as $key => $value) {
            $params[] = new \SoapVar("<ns1:a n=\"" . $key . "\">" . $value . "</ns1:a>", XSD_ANYXML);
        }
        $result = $result = $this->connection->cleanResponse()->request("CreateDistributionListRequest", $params);
        if ($accountData = $result->getResponseBody()["CREATEDISTRIBUTIONLISTRESPONSE"]["DL"]) {
            $list->fill($accountData);
            return $list;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function update(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list)
    {
        $params = [new \SoapParam($list->getId(), "id")];
        $attrs = $list->getAttrs();
        if ($list->isDynamic()) {
            $params[] = new \SoapParam(1, "dynamic");
            unset($attrs["zimbraDistributionListSendShareMessageToNewMembers"]);
        }
        foreach ($attrs as $key => $value) {
            $params[] = new \SoapVar("<ns1:a n=\"" . $key . "\">" . $value . "</ns1:a>", XSD_ANYXML);
        }
        $result = $result = $this->connection->cleanResponse()->request("ModifyDistributionListRequest", $params);
        if ($data = $result->getResponseBody()["MODIFYDISTRIBUTIONLISTRESPONSE"]["DL"]) {
            $list->fill($data);
            return $list;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function delete(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list)
    {
        $params = [new \SoapParam($list->getId(), "id")];
        $result = $result = $this->connection->cleanResponse()->request("DeleteDistributionListRequest", $params);
        if ($result->getResponseBody()["DELETEDISTRIBUTIONLISTRESPONSE"]) {
            return true;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function addMembers(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list)
    {
        $params = [new \SoapParam($list->getId(), "id")];
        foreach ($list->getMembers() as $val) {
            $params[] = new \SoapVar("<ns1:dlm>" . $val . "</ns1:dlm>", XSD_ANYXML);
        }
        $result = $result = $this->connection->cleanResponse()->request("AddDistributionListMemberRequest", $params);
        if ($result->getResponseBody()["ADDDISTRIBUTIONLISTMEMBERRESPONSE"]) {
            return true;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function deleteMembers(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list)
    {
        $params = [new \SoapParam($list->getId(), "id")];
        foreach ($list->getMembers() as $val) {
            $params[] = new \SoapVar("<ns1:dlm>" . $val . "</ns1:dlm>", XSD_ANYXML);
        }
        $result = $result = $this->connection->cleanResponse()->request("RemoveDistributionListMemberRequest", $params);
        return $result;
    }
    public function addOwners(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list)
    {
        $params = [new \SoapVar("<ns1:dl by=\"id\">" . $list->getId() . "</ns1:dl>", XSD_ANYXML), new \SoapVar("<ns1:action op=\"addOwners\">", XSD_ANYXML)];
        foreach ($list->getOwners() as $owner) {
            $params[] = new \SoapVar("<ns1:owner type=\"usr\" by=\"name\">" . $owner . "</ns1:owner>", XSD_ANYXML);
        }
        $params[] = new \SoapVar("</ns1:action>", XSD_ANYXML);
        $result = $this->connection->cleanResponse()->request("DistributionListActionRequest", $params);
        if ($result->getResponseBody()["DISTRIBUTIONLISTACTIONRESPONSE"]) {
            return true;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function deleteOwners(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list)
    {
        $params = [new \SoapVar("<ns1:dl by=\"id\">" . $id . "</ns1:dl>", XSD_ANYXML), new \SoapVar("<ns1:action op=\"removeOwners\">", XSD_ANYXML)];
        foreach ($list->getOwners() as $owner) {
            $params[] = new \SoapVar("<ns1:owner type=\"usr\" by=\"name\">" . $owner . "</ns1:owner>", XSD_ANYXML);
        }
        $params[] = new \SoapVar("</ns1:action>", XSD_ANYXML);
        $result = $result = $this->connection->cleanResponse()->request("DistributionListActionRequest", $params);
    }
    public function addAlias(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list)
    {
        $params = [new \SoapParam($list->getId(), "id"), new \SoapParam($list->getAlias(), "alias")];
        $result = $result = $this->connection->cleanResponse()->request("AddDistributionListAliasRequest", $params);
        if ($result->getResponseBody()["ADDDISTRIBUTIONLISTALIASRESPONSE"]) {
            return true;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function deleteAlias(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list)
    {
        $params = [new \SoapParam($list->getId(), "id"), new \SoapParam($list->getAlias(), "alias")];
        $result = $result = $this->connection->cleanResponse()->request("RemoveDistributionListAliasRequest", $params);
        if ($result->getResponseBody()["REMOVEDISTRIBUTIONLISTALIASRESPONSE"]) {
            return true;
        }
        $this->setError($result->getLastError());
        return false;
    }
}

?>