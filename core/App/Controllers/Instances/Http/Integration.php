<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\Http;

class Integration extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\HttpController implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\AdminArea, \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\ClientArea
{
    protected $templateName = "integration";
    public function execute($params = NULL)
    {
        $this->setParams($params);
        if (!$this->controllerResult) {
            return "";
        }
        return $this->resolveResponse();
    }
    public function resolveResponse()
    {
        if ($this->controllerResult instanceof \ModulesGarden\Servers\ZimbraEmail\Core\Http\Response) {
            $this->controllerResult->setForceHtml();
        }
        return $this->responseResolver->setResponse($this->controllerResult)->setTemplateName($this->getTemplateName())->setTemplateDir($this->getTemplateDir())->setPageController($this)->resolve();
    }
}

?>