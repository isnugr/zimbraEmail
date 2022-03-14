<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\Http;

class ErrorPage extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\HttpController implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\AdminArea, \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\ClientArea
{
    protected $templateName = "errorPage";
    public function execute($params = NULL)
    {
        $this->setParams($params);
        $this->parseError();
        return $this->resolveResponse();
    }
    public function resolveResponse()
    {
        if ($this->getRequestValue("ajax") == "1") {
            return $this->resolveResponseAjax();
        }
        return $this->responseResolver->setResponse(ModulesGarden\Servers\ZimbraEmail\Core\Helper\view())->setTemplateName($this->getTemplateName())->setTemplateDir($this->getTemplateDir())->setPageController($this)->resolve();
    }
    public function parseError()
    {
        $err = $this->getParam("mgErrorDetails");
        if (!$err) {
            return NULL;
        }
        if (!$err instanceof \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception) {
            $nErr = new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(NULL, NULL, NULL, $err);
            $this->setParam("mgErrorDetails", $nErr);
        }
        $this->logError();
    }
    public function logError()
    {
        $err = $this->getParam("mgErrorDetails");
        $logger = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("whmcsLogger");
        $logger->addModuleLogError($err);
    }
    public function resolveResponseAjax()
    {
        $err = $this->getParam("mgErrorDetails");
        if (!$err) {
            return NULL;
        }
        $ajaxData = (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\DataJsonResponse($err->getDetailsToDisplay()))->setStatusError();
        return $this->responseResolver->setResponse($ajaxData->getFormatedResponse())->setTemplateName($this->getTemplateName())->setTemplateDir($this->getTemplateDir())->setPageController($this)->resolve();
    }
}

?>