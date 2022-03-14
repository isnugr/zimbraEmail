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
 * Date: 09.09.19
 * Time: 15:20
 * Class Domain
 */
class Domain extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractModel
{
    protected $id = NULL;
    protected $name = NULL;
    protected $attrs = NULL;
    const ATTR_ALIAS_TARGET_ID = "zimbraDomainAliasTargetId";
    const ATTR_DOMAIN_TYPE = "zimbraDomainType";
    const ATTR_DESCRIPTION = "description";
    const ATTR_DOMAIN_STATUS = "zimbraDomainStatus";
    const ATTR_MAIL_STATUS = "zimbraMailStatus";
    const ATTR_MAIL_DOMAIN_QUOTA = "zimbraDomainAggregateQuota";
    const TYPE_ALIAS = "alias";
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getAttrs()
    {
        return $this->attrs;
    }
    public function setAttrs($attrs)
    {
        $this->attrs = $attrs;
    }
    public function setAttr($key, $value = NULL)
    {
        $this->attrs[$key] = $value;
    }
    public function getAttr($key)
    {
        return $this->attrs[$key];
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setA($attrs)
    {
        foreach ($attrs as $attr) {
            $this->setAttr($attr["N"], $attr["DATA"]);
        }
    }
    public function isAlias()
    {
        $targetId = $this->getAttr(ATTR_ALIAS_TARGET_ID);
        return $targetId ? true : false;
    }
}

?>