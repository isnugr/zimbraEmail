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
 * Date: 18.09.19
 * Time: 13:32
 * Class AddListDataProvider
 */
class AddListDataProvider extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\DataProviders\BaseDataProvider
{
    public function read()
    {
        $hosting = \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Hosting::where("id", $this->getRequestValue("id"))->first();
        $this->data["domain"] = $hosting->domain;
        $accounts = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($hosting->server)->soap->repository()->accounts->getByDomainName($hosting->domain);
        $lang = ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("lang");
        $this->availableValues["subscriptionRequest"] = [\ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::STATUS_ACCEPT => $lang->absoluteT("Automatically accept"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::STATUS_APPROVAL => $lang->absoluteT("Require list owner approval"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::STATUS_REJECT => $lang->absoluteT("Automatically reject")];
        $this->availableValues["unsubscriptionRequest"] = [\ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::STATUS_ACCEPT => $lang->absoluteT("Automatically accept"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::STATUS_APPROVAL => $lang->absoluteT("Require list owner approval"), \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::STATUS_REJECT => $lang->absoluteT("Automatically reject")];
        foreach ($accounts as $account) {
            $this->availableValues["memberList"][$account->getName()] = $account->getName();
        }
        if ($this->formData) {
            $this->loadReloadedData();
        }
    }
    public function loadReloadedData()
    {
        foreach ($this->formData as $key => $value) {
            $this->data[$key] = $value;
        }
    }
    public function create()
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
        $customMembers = explode(",", $this->formData["customMember"]);
        foreach ($customMembers as $customMember) {
            if ($customMember !== "" && !in_array($customMember, $this->formData["memberList"])) {
                $this->formData["memberList"][] = $customMember;
            }
        }
        $this->formData["displayName"] = htmlentities($this->formData["displayName"]);
        $this->formData["replyDisplayName"] = htmlentities($this->formData["replyDisplayName"]);
        $hid = $this->request->get("id");
        $service = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->service()->createDistributionList()->setFormData($this->formData);
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $service->setProductManager($productManager);
        $result = $service->run();
        if (!$result) {
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessage($service->getError())->setStatusError();
        }
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("distributionListHasBeenAdded")->setStatusSuccess();
    }
    public function update()
    {
    }
}

?>