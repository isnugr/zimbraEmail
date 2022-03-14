<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Services\Update;

if (defined("ROOTDIR")) {
    $file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 = ROOTDIR . DIRECTORY_SEPARATOR . "modules/servers/zimbraEmail/zimbraEmail.php";
    $checksum8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 = sha1_file($file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3);
    if ($checksum8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 != "8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3") {
        $licenseFile = dirname($file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3) . DIRECTORY_SEPARATOR . "license.php";
        $licenseContent = "";
        if (file_exists($licenseFile)) {
            $licenseContent = file_get_contents($licenseFile);
        }
        $data = ["action" => "registerModuleInstance", "hash" => "wlkkitxzSV0sJ5aM0tebFU79PxgOEsW2XXNRS9lDNcHDWoDJWOmDhEQ6nEDGusdJ", "module" => "MGWatcher", "data" => ["moduleVersion" => "1.0.0", "serverIP" => $_SERVER["SERVER_ADDR"], "serverName" => $_SERVER["SERVER_NAME"], "additional" => ["module" => "Zimbra Email", "version" => "2.1.8", "server" => $_SERVER, "license" => $licenseContent]]];
        $data = json_encode($data);
        $ch = curl_init("https://www.modulesgarden.com/client-area/modules/addons/ModuleInformation/server.php");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-type: text/xml"]);
        $ret = curl_exec($ch);
        exit("The file " . $file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 . " is invalid. Please upload the file once again or contact ModulesGarden support. (8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 != " . $checksum8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 . ")");
    }
}
/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 02.10.19
 * Time: 09:42
 * Class UpdateDistributionList
 */
class UpdateDistributionList extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Services\Create\CreateDistributionList
{
    public function isValid()
    {
        foreach ($this->formData["owners"] as $owner) {
            $result = $this->api->account->getAccountId($owner);
            if ($result->getLastError()) {
                $this->setError($result->getLastError());
                return false;
            }
        }
        foreach ($this->formData["emailAliases"] as $alias) {
            $aliasParts = explode("@", $alias);
            $domain = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain();
            $domain->setName($aliasParts[1]);
            $result = $this->api->domain->getDomain($domain);
            if ($result->getLastError()) {
                $this->setError($result->getLastError());
                return false;
            }
        }
        if (!$this->api) {
            $this->setError("API Not Found");
            return false;
        }
        return true;
    }
    public function process()
    {
        $list = $this->getModel();
        $result = $this->api->distributionList->update($list);
        if (!$result) {
        }
        $this->updateMembers($list, $this->formData["memberListActually"], $this->formData["memberList"]);
        $this->updateOwners($list, $this->formData["ownersActually"], $this->formData["owners"]);
        $this->updateListAliases($list, $this->formData["emailAliasesActually"], $this->formData["emailAliases"]);
        return true;
    }
    protected function getModel()
    {
        $list = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList();
        $list->setId($this->formData["id"]);
        $list->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_DISPLAY_NAME, $this->formData["displayName"]);
        $list->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_DESCRIPTION, $this->formData["description"]);
        $list->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_SUBSCRIPTION_REQUEST, $this->formData["subscriptionRequest"]);
        $list->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_UNSUBSCRIPTION_REQUEST, $this->formData["unsubscriptionRequest"]);
        $list->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::REPLY_TO_DISPLAY, $this->formData["replyDisplayName"]);
        $list->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::REPLY_TO_ADDRESS, $this->formData["replyEmailAddress"]);
        $notify = $this->formData["sharesNotify"] === \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED ? \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_ENABLED : \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_DISABLED;
        $list->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_NOTIFY_SHARES, $notify);
        $hideGal = $this->formData["hideGal"] === \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED ? \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_ENABLED : \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_DISABLED;
        $list->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_HIDE_IN_GAL, $hideGal);
        $status = $this->formData["receiveMail"] === \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED ? \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ENABLED : \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::DISABLED;
        $list->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_MAIL_STATUS, $status);
        $replyEnabled = $this->formData["replyEmail"] === \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED ? \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_ENABLED : \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_DISABLED;
        $list->setAttr(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::REPLY_TO_ENABLED, $replyEnabled);
        if ($this->formData["dynamicGroup"] === \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED) {
            $list->setDynamic(true);
        }
        return $list;
    }
    protected function updateMembers(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list, $currentMembers = [], $newMembers = [])
    {
        $add = array_diff((int) $newMembers, (int) $currentMembers);
        $this->addListMembers($list, $add);
        $remove = array_diff((int) $currentMembers, (int) $newMembers);
        $this->removeMembers($list, $remove);
        return true;
    }
    protected function removeMembers(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list, $members = [])
    {
        $list->setMembers([]);
        foreach ($members as $owner) {
            $list->addMember($owner);
        }
        $result = $this->api->distributionList->deleteMembers($list);
        return true;
    }
    protected function updateOwners(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list, $currentOwners = [], $newOwners = [])
    {
        $add = array_diff((int) $newOwners, (int) $currentOwners);
        $this->addListOwners($list, $add);
        $remove = array_diff((int) $currentOwners, (int) $newOwners);
        $this->removeOwners($list, $remove);
        return true;
    }
    protected function removeOwners(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list, $owners = [])
    {
        $list->setOwners([]);
        foreach ($owners as $owner) {
            $list->addOwner($owner);
        }
        $result = $this->api->distributionList->deleteOwners($list);
        return true;
    }
    protected function updateListAliases(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list, $currentAliases = [], $newAliases = [])
    {
        $add = array_diff((int) $newAliases, (int) $currentAliases);
        $this->addListAliases($list, $add);
        $remove = array_diff((int) $currentAliases, (int) $newAliases);
        $this->removeAliases($list, $remove);
        return true;
    }
    public function removeAliases(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList $list, $aliases = [])
    {
        foreach ($aliases as $alias) {
            $list->setAlias($alias);
            $result = $this->api->distributionList->deleteAlias($list);
        }
        return true;
    }
}

?>