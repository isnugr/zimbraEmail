<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 12:24
 * Class Alias
 */
class AccountAlias
{
    protected $accountId = NULL;
    protected $alias = NULL;
    protected $accountName = NULL;
    public function getAccountId()
    {
        return $this->accountId;
    }
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }
    public function getAlias()
    {
        return $this->alias;
    }
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }
    public function getAccountName()
    {
        return $this->accountName;
    }
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;
        return $this;
    }
}

?>