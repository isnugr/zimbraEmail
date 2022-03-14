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
 * Class DistributionList
 */
class DistributionList extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractModel
{
    protected $name = NULL;
    protected $id = NULL;
    protected $attrs = NULL;
    protected $dynamic = false;
    protected $members = [];
    protected $owners = [];
    protected $alias = NULL;
    const ATTR_DISPLAY_NAME = "displayName";
    const ATTR_DESCRIPTION = "description";
    const ATTR_SUBSCRIPTION_REQUEST = "zimbraDistributionListSubscriptionPolicy";
    const ATTR_UNSUBSCRIPTION_REQUEST = "zimbraDistributionListUnsubscriptionPolicy";
    const ATTR_NOTIFY_SHARES = "zimbraDistributionListSendShareMessageToNewMembers";
    const ATTR_HIDE_IN_GAL = "zimbraHideInGal";
    const ATTR_MAIL_STATUS = "zimbraMailStatus";
    const REPLY_TO_ENABLED = "zimbraPrefReplyToEnabled";
    const REPLY_TO_DISPLAY = "zimbraPrefReplyToDisplay";
    const REPLY_TO_ADDRESS = "zimbraPrefReplyToAddress";
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function isDynamic()
    {
        return $this->dynamic;
    }
    public function setDynamic($dynamic)
    {
        $this->dynamic = $dynamic;
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
    public function addMember($member)
    {
        $this->members[$member] = $member;
        return $this;
    }
    public function setMembers($members = [])
    {
        $this->members = $members;
        return $this;
    }
    public function getMembers()
    {
        return $this->members;
    }
    public function setOwners($owners = [])
    {
        $this->owners = $owners;
        return $this;
    }
    public function addOwner($owner)
    {
        $this->owners[$owner] = $owner;
        return $this;
    }
    public function getOwners()
    {
        return $this->owners;
    }
    public function setAlias($alias)
    {
        $this->alias = $alias;
        return $this;
    }
    public function getAlias()
    {
        return $this->alias;
    }
    public function getResourceMembers()
    {
        if ($this->resources["dlm"]["DATA"]) {
            $tmp[$this->resources["dlm"]["DATA"]] = $this->resources["dlm"]["DATA"];
            return $tmp;
        }
        foreach ($this->resources["dlm"] as $owner) {
            $tmp[$owner["DATA"]] = $owner["DATA"];
        }
        return $tmp;
    }
    public function getResourceOwners()
    {
        $owners = $this->resources["owners"] ? $this->resources["owners"] : $this->owners;
        if ($owners["OWNER"]["NAME"]) {
            $tmp[$owners["OWNER"]["NAME"]] = $owners["OWNER"]["NAME"];
            return $tmp;
        }
        foreach ($owners["OWNER"] as $owner) {
            $tmp[$owner["NAME"]] = $owner["NAME"];
        }
        return $tmp;
    }
    public function getResourceAliases()
    {
        foreach ($this->getDataResourceACollection("zimbraMailAlias") as $alias) {
            if (isset($alias["DATA"]) && $this->getName() !== $alias["DATA"]) {
                $tmp[$alias["DATA"]] = $alias["DATA"];
            } else {
                if ($this->getName() !== $alias) {
                    $tmp[$alias] = $alias;
                }
            }
        }
        return $tmp;
    }
}

?>