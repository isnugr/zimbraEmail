<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\Http;

class PageNotFound extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\HttpController implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\AdminArea, \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\ClientArea
{
    protected $templateName = "pageNotFound";
    public function execute($params = NULL)
    {
        $this->setParams($params);
        return $this->resolveResponse();
    }
    public function resolveResponse()
    {
        $view = ModulesGarden\Servers\ZimbraEmail\Core\Helper\view();
        $view->replaceBreadcrumbTitle("1", "pageNotFound");
        return $this->responseResolver->setResponse($view)->setTemplateName($this->getTemplateName())->setTemplateDir($this->getTemplateDir())->setPageController($this)->resolve();
    }
}

?>