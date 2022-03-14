<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\DomainAlias\Providers;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 13:39
 * Class AddDomainAliasDataProvider
 */
class AddDomainAliasDataProvider extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\DataProviders\BaseDataProvider
{
    public function read()
    {
        $hosting = \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Hosting::where("id", $this->getRequestValue("id"))->first();
        $api = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByServer($hosting->server)->soap;
        $domain = $api->repository()->domains->getByName($hosting->domain);
        $this->data["domainId"] = $domain->getId();
        $this->data["domain"] = $hosting->domain;
    }
    public function update()
    {
    }
    public function create()
    {
        $hid = $this->request->get("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $service = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->service()->createDomainAlias()->setProductManager($productManager)->setFormData($this->formData);
        $result = $service->run();
        if (!$result) {
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessage($service->getError())->setStatusError();
        }
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("domainAliasHasBeenCreated")->setStatusSuccess();
    }
}

?>