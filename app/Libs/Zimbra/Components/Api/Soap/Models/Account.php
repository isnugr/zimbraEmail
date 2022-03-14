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
 * Date: 10.09.19
 * Time: 08:43
 * Class Account
 */
class Account extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractModel
{
    protected $id = NULL;
    protected $name = NULL;
    protected $password = NULL;
    protected $attrs = NULL;
    protected $limit = NULL;
    protected $used = NULL;
    const ATTR_FIRSTNAME = "givenName";
    const ATTR_LASTNAME = "sn";
    const ATTR_PHONE = "telephoneNumber";
    const ATTR_MOBILE_PHONE = "mobile";
    const ATTR_FAX = "facsimileTelephoneNumber";
    const ATTR_PAGER = "pager";
    const ATTR_HOME_PHONE = "homePhone";
    const ATTR_COUNTRY = "co";
    const ATTR_STATE = "st";
    const ATTR_POSTAL_CODE = "postalCode";
    const ATTR_CITY = "l";
    const ATTR_STREET = "street";
    const ATTR_COMPANY = "company";
    const ATTR_PROF_TITLE = "title";
    const ATTR_ACCOUNT_STATUS = "zimbraAccountStatus";
    const ATTR_DISPLAY_NAME = "displayName";
    const ATTR_MAIL_QUOTA = "zimbraMailQuota";
    const ATTR_ALIAS = "zimbraMailAlias";
    const ATTR_CLASS_OF_SERVICE_ID = "zimbraCOSId";
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getLimit()
    {
        return $this->limit;
    }
    public function setLimit($limit = 0)
    {
        $this->limit = $limit;
        return $this;
    }
    public function getUsed()
    {
        return $this->used;
    }
    public function setUsed($used = 0)
    {
        $this->used = $used;
        return $this;
    }
    public function getAttrs()
    {
        return $this->attrs;
    }
    public function setAttr($key, $value = NULL)
    {
        $this->attrs[$key] = $value;
        return $this;
    }
    public function getAttr($key)
    {
        return $this->attrs[$key];
    }
    public function setAttrs($attrs = [])
    {
        $this->attrs = $attrs;
        return $this;
    }
    public function getCosId()
    {
        return $this->getDataResourceA(ATTR_CLASS_OF_SERVICE_ID);
    }
    public function getAliases()
    {
        foreach ($this->resources["a"] as $res) {
            if ($res["N"] === ATTR_ALIAS) {
                $tmp[$res["DATA"]] = $res["DATA"];
            }
        }
        return $tmp;
    }
}

?>