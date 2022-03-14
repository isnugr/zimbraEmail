<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App;

/**
 * Template Display Wrapper
 *
 * @author slawomir@modulesgarden.com
 */
class TemplateDisplayWrapper
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    protected $templateName = NULL;
    protected $templateDir = NULL;
    protected $vars = [];
    public function __construct($templateName = NULL, $templateDir = NULL, $vars = [], $lang = NULL)
    {
        $this->setTemplate($templateName, $templateDir);
        $this->setVars($vars);
        $this->setLang($lang);
    }
    public function toHtml()
    {
        $pageContent = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("smarty")->setLang($this->lang)->setTemplateDir($path)->view($fileName, $vars);
        return $pageContent;
    }
    public function setTemplate($templateName = NULL, $templateDir = NULL)
    {
        if (file_exists($templateDir . DIRECTORY_SEPARATOR . $templateName . ".tpl")) {
            $this->templateName = $templateName;
            $this->templateDir = $templateDir;
        }
    }
    public function setVars($vars = [])
    {
        if (is_array($vars)) {
            $this->vars = $vars;
        }
    }
    public function setLang($lang = NULL)
    {
        if ($lang instanceof \ModulesGarden\Servers\ZimbraEmail\Core\Lang) {
            $this->lang = $lang;
        }
        $this->loadLang();
    }
}

?>