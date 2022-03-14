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
 * Class Account
 */
class Account extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractAction
{
    public function read()
    {
    }
    public function create(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account $account)
    {
        $params = [new \SoapParam($account->getName(), "name"), new \SoapParam($account->getPassword(), "password")];
        foreach ($account->getAttrs() as $key => $value) {
            $params[] = new \SoapVar("<ns1:a n=\"" . $key . "\">" . $value . "</ns1:a>", XSD_ANYXML);
        }
        $result = $this->connection->request("CreateAccountRequest", $params);
        if ($accountData = $result->getResponseBody()["CREATEACCOUNTRESPONSE"]["ACCOUNT"]) {
            $account->fill($accountData);
            return $account;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function createAlias(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\AccountAlias $alias)
    {
        $params = [new \SoapParam($alias->getAccountId(), "id"), new \SoapParam($alias->getAlias(), "alias")];
        $result = $this->connection->request("AddAccountAliasRequest", $params);
        if (!$result->getLastError()) {
            return $alias;
        }
        return false;
    }
    public function update(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account $account)
    {
        $params = [new \SoapParam($account->getId(), "id")];
        foreach ($account->getAttrs() as $key => $value) {
            $params[] = new \SoapVar("<ns1:a n=\"" . $key . "\">" . $value . "</ns1:a>", XSD_ANYXML);
        }
        $result = $this->connection->request("ModifyAccountRequest", $params);
        if ($accountData = $result->getResponseBody()["MODIFYACCOUNTRESPONSE"]["ACCOUNT"]) {
            $account->fill($accountData);
            return $account;
        }
        $this->setError($result->getLastError());
        return false;
    }
    public function setPassword(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account $account)
    {
        $params = [new \SoapParam($account->getId(), "id"), new \SoapParam($account->getPassword(), "newPassword")];
        $result = $this->connection->request("SetPasswordRequest", $params);
        if ($result->getLastError()) {
            $this->setError($result->getLastError());
            return false;
        }
        return true;
    }
    public function delete(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account $account)
    {
        $params = [new \SoapParam($account->getId(), "id")];
        $result = $this->connection->request("DeleteAccountRequest", $params);
        if ($result->getLastError()) {
            $this->setError($result->getLastError());
            return false;
        }
        return true;
    }
    public function deleteAlias(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\AccountAlias $alias)
    {
        $params = [new \SoapParam($alias->getAccountId(), "id"), new \SoapParam($alias->getAlias(), "alias")];
        $result = $this->connection->request("RemoveAccountAliasRequest", $params);
        if (!$result->getLastError()) {
            return true;
        }
        return false;
    }
    public function getAccountId($name)
    {
        $params = [new \SoapVar("<ns1:account by=\"name\">" . $name . "</ns1:account>", XSD_ANYXML)];
        return $this->connection->cleanResponse()->request("GetAccountInfoRequest", $params);
    }
    public function getAccountInfo(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account $account)
    {
        if ($value = $account->getId()) {
            $type = "id";
        } else {
            if ($value = $account->getName()) {
                $type = "name";
            }
        }
        $result = NULL;
        $params = [new \SoapVar("<ns1:account by=\"" . $type . "\">" . $value . "</ns1:account>", XSD_ANYXML)];
        return $this->connection->request("GetAccountInfoRequest", $params);
    }
    public function delegateAuth(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account $account)
    {
        if ($value = $account->getId()) {
            $type = "id";
        } else {
            if ($value = $account->getName()) {
                $type = "name";
            }
        }
        $result = NULL;
        $params = [new \SoapVar("<ns1:account by=\"" . $type . "\">" . $value . "</ns1:account>", XSD_ANYXML)];
        $result = $this->connection->cleanResponse()->request("DelegateAuthRequest", $params);
        if ($result->getLastError()) {
            $this->setError($result->getLastError());
            return false;
        }
        return $result;
    }
    public function getAccountOptions(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account $account)
    {
        if ($value = $account->getId()) {
            $type = "id";
        } else {
            if ($value = $account->getName()) {
                $type = "name";
            }
        }
        $params = [new \SoapVar("<ns1:account by=\"" . $type . "\">" . $value . "</ns1:account>", XSD_ANYXML)];
        return $this->connection->cleanResponse()->request("GetAccountRequest", $params);
    }
    public function getAllByDomain(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain $domain)
    {
        if ($value = $domain->getId()) {
            $type = "id";
        } else {
            if ($value = $domain->getName()) {
                $type = "name";
            }
        }
        $params = [new \SoapVar("<ns1:domain by=\"" . $type . "\">" . $value . "</ns1:domain>", XSD_ANYXML)];
        $result = $this->connection->request("GetAllAccountsRequest", $params);
        return $result;
    }
    public function getAllAccounts($idOrNameDomain, $type = "auto")
    {
        if ($type != "auto") {
            $realType = $type;
        }
        $result = NULL;
        $params = [new \SoapVar("<ns1:domain by=\"" . $realType . "\">" . $idOrNameDomain . "</ns1:domain>", XSD_ANYXML)];
        return $this->connection->request("GetAllAccountsRequest", $params);
    }
}

?>