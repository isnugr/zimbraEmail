<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAlias\Providers;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 12:59
 * Class DeleteEmailAliasDataProvider
 */
class DeleteEmailAliasDataProvider extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\DataProviders\BaseDataProvider
{
    public function read()
    {
        $params = json_decode(base64_decode($this->actionElementId), true);
        $this->data["id"] = $params["accId"];
        $this->data["alias"] = $params["alias"];
    }
    public function update()
    {
    }
    public function delete()
    {
        $hid = $this->request->get("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $service = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->service()->deleteAccountAlias()->setFormData($this->formData);
        $result = $service->run();
        if (!$result) {
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessage($service->getError())->setStatusError();
        }
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("emailAliasHasBeenDeleted")->setStatusSuccess();
    }
    public function massDelete()
    {
        $hid = $this->request->get("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $service = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->service()->deleteAccountAlias();
        foreach ($this->request->get("massActions") as $endodedData) {
            $data = json_decode(base64_decode($endodedData), true);
            $data["id"] = $data["accId"];
            $service->setFormData($data);
            $result = $service->run();
        }
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("massEmailAliasHasBeenDeleted")->setStatusSuccess();
    }
}

?>