<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DistributionList\Providers;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 02.10.19
 * Time: 08:36
 * Class EditListDataProvider
 */
class EditListDataProvider extends AddListDataProvider
{
    public function read()
    {
        $hosting = \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Hosting::where("id", $this->getRequestValue("id"))->first();
        $api = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($hosting->server);
        $repository = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository($api->soap);
        $list = $repository->lists()->getDistributionListBydId($this->actionElementId);
        $this->data["id"] = $list->getId();
        $res = explode("@", $list->getName());
        list($this->data["listmail"], $this->data["domain"]) = $res;
        $this->data["emailAliases"] = implode(",", $list->getResourceAliases());
        $this->data["owners"] = implode(",", $list->getResourceOwners());
        $this->data["memberListActually"] = $list->getResourceMembers();
        $this->availableValues["memberListActually"] = $this->data["memberListActually"];
        $this->data["emailAliasesActually"] = $list->getResourceAliases();
        $this->availableValues["emailAliasesActually"] = $this->data["emailAliasesActually"];
        $this->data["ownersActually"] = $list->getResourceOwners();
        $this->availableValues["ownersActually"] = $this->data["ownersActually"];
        $this->data["displayName"] = $list->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_DISPLAY_NAME);
        $this->data["description"] = $list->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_DESCRIPTION);
        $this->data["subscriptionRequest"] = $list->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_SUBSCRIPTION_REQUEST);
        $this->data["unsubscriptionRequest"] = $list->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_UNSUBSCRIPTION_REQUEST);
        $this->data["replyDisplayName"] = $list->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::REPLY_TO_DISPLAY);
        $this->data["replyEmailAddress"] = $list->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::REPLY_TO_ADDRESS);
        $this->data["sharesNotify"] = $list->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_NOTIFY_SHARES) === \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_ENABLED ? \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED : \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_DISABLED;
        $this->data["hideGal"] = $list->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_HIDE_IN_GAL) === \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_ENABLED ? \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED : \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_DISABLED;
        $this->data["receiveMail"] = $list->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::ATTR_MAIL_STATUS) === \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ENABLED ? \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED : \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_DISABLED;
        $this->data["replyEmail"] = $list->getDataResourceA(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList::REPLY_TO_ENABLED) === \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ATTR_ENABLED ? \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED : \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_DISABLED;
        $this->data["dynamicGroup"] = (int) $list->isDynamic() === \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ENABLED_AS_INT ? \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_ENABLED : \ModulesGarden\Servers\ZimbraEmail\App\Enums\ProductParams::SWITCHER_DISABLED;
        $accounts = $repository->accounts->getByDomainName($hosting->domain);
        $lang = ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("lang");
        $this->availableValues["subscriptionRequest"] = [\ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::STATUS_ACCEPT => $lang->absoluteT("Automatically accept"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::STATUS_APPROVAL => $lang->absoluteT("Require list owner approval"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::STATUS_REJECT => $lang->absoluteT("Automatically reject")];
        $this->availableValues["unsubscriptionRequest"] = [\ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::STATUS_ACCEPT => $lang->absoluteT("Automatically accept"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::STATUS_APPROVAL => $lang->absoluteT("Require list owner approval"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::STATUS_REJECT => $lang->absoluteT("Automatically reject")];
        $members = $list->getResourceMembers();
        foreach ($accounts as $account) {
            if (in_array($account->getName(), $members)) {
                $this->data["memberList"][] = $account->getName();
            }
            $this->availableValues["memberList"][$account->getName()] = $account->getName();
        }
        $ownMembers = $this->data["memberList"] ? $this->data["memberList"] : [];
        $this->data["customMember"] = implode(",", array_diff($members, $ownMembers));
        if ($this->formData) {
            $this->loadReloadedData();
        }
    }
    public function update()
    {
        $customEmails = explode(",", $this->formData["emailAliases"]);
        $this->formData["emailAliases"] = [];
        foreach ($customEmails as $email) {
            if ($email !== "") {
                $this->formData["emailAliases"][] = $email;
            }
        }
        $owners = explode(",", $this->formData["owners"]);
        $this->formData["owners"] = [];
        foreach ($owners as $email) {
            if ($email !== "") {
                $this->formData["owners"][] = $email;
            }
        }
        $this->formData["displayName"] = htmlentities($this->formData["displayName"]);
        $this->formData["replyDisplayName"] = htmlentities($this->formData["replyDisplayName"]);
        $customMembers = explode(",", $this->formData["customMember"]);
        foreach ($customMembers as $customMember) {
            if ($customMember !== "" && !in_array($customMember, $this->formData["memberList"])) {
                $this->formData["memberList"][] = $customMember;
            }
        }
        $members = $this->formData["memberList"] ? $this->formData["memberList"] : [];
        $this->formData["memberList"] = array_merge($customMembers, $members);
        $hid = $this->request->get("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $service = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->service()->updateDistributionList()->setFormData($this->formData)->setProductManager($productManager);
        $result = $service->run();
        if (!$result) {
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessage($service->getError())->setStatusError();
        }
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("distributionListHasBeenUpdated")->setStatusSuccess();
    }
}

?>