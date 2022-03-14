<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI;

/**
 * Main Vuew Controler
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class ViewAjax extends View
{
    protected $elements = [];
    protected $namespace = "";
    public function __construct($template = NULL)
    {
        $this->setTemplate($template);
        $this->mainContainer = new MainContainerAjax();
    }
    public function addElement($element)
    {
        return $this;
    }
    public function validateAcl($isAdmin)
    {
        $this->mainContainer->valicateACL($isAdmin);
        return $this;
    }
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
        $this->mainContainer->setNamespaceAjax($this->namespace);
        return $this;
    }
    public function getResponse()
    {
        return $this->mainContainer->getAjaxResponse();
    }
    public function initAjaxElementContext($namespace)
    {
        $this->setNamespace($namespace);
        $this->mainContainer->addElement(ModulesGarden\Servers\ZimbraEmail\Core\Helper\convertStringToNamespace($namespace));
    }
}

?>