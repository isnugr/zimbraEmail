<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\Http;

class ConfigOptionsIntegration extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\HttpController implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\AdminArea
{
    protected $templateName = "configOptionsIntegration";
    protected $templateDir = NULL;
    public function execute($response = NULL)
    {
        $this->setControllerResult($response);
        if (!$this->controllerResult) {
            return "";
        }
        $result = $this->resolveResponse();
        $data = ["content" => $result, "mode" => "advanced"];
        $enc = json_encode($data);
        $this->cleanOutputBuffer();
        echo $enc;
        exit;
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