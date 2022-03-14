<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers;

class ResponseResolver
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Smarty;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\OutputBuffer;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\IsAdmin;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Template;
    protected $response = NULL;
    /**
     * @var null|HttpController
     */
    protected $pageController = NULL;
    public function __construct($response = NULL)
    {
        $this->setResponse($response);
        $this->loadSmarty();
    }
    public function setResponse($response = NULL)
    {
        if ($response) {
            $this->response = $response;
        }
        return $this;
    }
    public function resolve()
    {
        if ($this->response instanceof \ModulesGarden\Servers\ZimbraEmail\Core\UI\View) {
            $this->resolveView();
        }
        if ($this->response instanceof \ModulesGarden\Servers\ZimbraEmail\Core\Http\JsonResponse) {
            $this->resolveJson();
        } else {
            if ($this->response instanceof \ModulesGarden\Servers\ZimbraEmail\Core\Http\RedirectResponse) {
                $this->resolveRedirect();
            } else {
                if ($this->response instanceof \ModulesGarden\Servers\ZimbraEmail\Core\Http\Response) {
                    $this->prepareResponse();
                    return $this->resolveResponse();
                }
            }
        }
    }
    public function resolveView()
    {
        $this->response->validateAcl($this->isAdmin());
        $this->response = $this->response->getResponse();
    }
    public function prepareResponse()
    {
        $this->response->setLang($this->lang);
        $this->response->setTemplateName($this->getTemplateName());
        $this->response->setTemplateDir($this->getTemplateDir());
    }
    public function resolveJson()
    {
        $this->cleanOutputBuffer();
        $this->response->send();
        exit;
    }
    public function resolveRedirect()
    {
        exit($this->response->send());
    }
    public function resolveResponse()
    {
        return $this->response->getHtmlResponse($this);
    }
    public function setPageController($pageController)
    {
        $this->pageController = $pageController;
        return $this;
    }
    public function getPageController()
    {
        return $this->pageController;
    }
}

?>