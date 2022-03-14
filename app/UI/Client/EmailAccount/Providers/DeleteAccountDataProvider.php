<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Client\EmailAccount\Providers;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 18.09.19
 * Time: 11:28
 * Class DeleteAccountDataProvider
 */
class DeleteAccountDataProvider extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\DataProviders\BaseDataProvider
{
    public function read()
    {
        $this->data["id"] = $this->actionElementId;
    }
    public function update()
    {
    }
    public function delete()
    {
        $hid = $this->request->get("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $service = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->service()->deleteAccount();
        $service->setFormData($this->formData);
        $result = $service->run();
        if (!$result) {
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessage($service->getError())->setStatusError();
        }
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("emailAccountHasBeenDeleted")->setStatusSuccess();
    }
    public function massDelete()
    {
        $hid = $this->request->get("id");
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hid);
        $service = (new \ModulesGarden\Servers\ZimbraEmail\App\Helpers\ZimbraManager())->getApiByHosting($hid)->soap->service()->deleteAccount();
        foreach ($this->request->get("massActions") as $id) {
            $service->setFormData(["id" => $id]);
            $result = $service->run();
        }
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("massEmailAccountHasBeenDeleted")->setStatusSuccess();
    }
}

?>