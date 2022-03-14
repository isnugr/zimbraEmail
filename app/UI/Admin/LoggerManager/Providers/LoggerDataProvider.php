<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\UI\Admin\LoggerManager\Providers;

/**
 * CategoryDataProvider
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class LoggerDataProvider extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\DataProviders\BaseModelDataProvider implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AdminArea
{
    public function __construct()
    {
        parent::__construct("\\ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Logger\\Model");
    }
    public function delete()
    {
        if ($this->formData["id"]) {
            self::delete();
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("loggerDeletedSuccesfully");
        }
        if ($this->requestObj->get("massActions", [])) {
            foreach ($this->requestObj->get("massActions", []) as $tldId) {
                $this->model->where("id", $tldId)->delete();
            }
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("loggersDeletedSuccesfully");
        }
    }
    public function deleteall()
    {
        $this->model->truncate();
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("loggersDeletedSuccesfully");
    }
}

?>