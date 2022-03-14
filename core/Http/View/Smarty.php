<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Http\View;

/**
 * Smarty Wrapper
 *
 * @author Michal Czech <michael@modulesgarden.com>
 * @SuppressWarnings(PHPMD)
 */
class Smarty
{
    private $smarty = NULL;
    private $templateDIR = NULL;
    private $lang = NULL;
    private static $instance = NULL;
    private final function __construct()
    {
        $this->smarty = new \Smarty();
    }
    private final function __clone()
    {
    }
    public static function get()
    {
        if (!isset($instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function setLang($land)
    {
        $this->lang = $land;
        return $this;
    }
    public function setTemplateDir($dir)
    {
        if (is_array($dir)) {
            \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Http\\View\\Smarty", "Wrong Template Path : " . $dir, ["dir" => $dir]);
        }
        $this->templateDIR = $dir;
        return $this;
    }
    public function view($template, $vars = [], $customDir = false)
    {
        if (is_array($customDir)) {
            \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Http\\View\\Smarty", "Wrong Template Path : " . $customDir, ["dir" => $customDir]);
            return "";
        }
        global $templates_compiledir;
        if ($customDir) {
            $this->smarty->template_dir = $customDir;
        } else {
            $this->smarty->template_dir = $this->templateDIR;
        }
        $this->smarty->compile_dir = $templates_compiledir;
        $this->smarty->force_compile = 1;
        $this->smarty->caching = 0;
        $this->clear();
        $this->smarty->assign("MGLANG", $this->lang);
        if (is_array($vars)) {
            foreach ($vars as $key => $val) {
                $this->smarty->assign($key, $val);
            }
        }
        if (is_array($this->smarty->template_dir)) {
            $file = $this->smarty->template_dir[0] . DS . $template . ".tpl";
        } else {
            $file = $this->smarty->template_dir . DS . $template . ".tpl";
        }
        if (!file_exists($file)) {
            $errorManager = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("errorManager");
            $errorManager->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Http\\View\\Smarty", "Unable to find Template: " . $file, ["file" => $file]);
            return (int) $errorManager;
        }
        if (isset($vars["isError"]) && $vars["isError"] === false || !isset($vars["isError"]) || self::$isDebug === false) {
            return $this->smarty->fetch($template . ".tpl", uniqid());
        }
        $template = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getTemplateDir() . DS . (ModulesGarden\Servers\ZimbraEmail\Core\Helper\isAdmin() ? "admin" : "client" . DS . "default") . DS . "ui" . DS . "core" . DS . "default" . DS;
        return $this->smarty->fetch($template . "errorComponent.tpl", uniqid());
    }
    protected function clear()
    {
        if (method_exists($this->smarty, "clearAllAssign")) {
            $this->smarty->clearAllAssign();
        } else {
            if (method_exists($this->smarty, "clear_all_assign")) {
                $this->smarty->clear_all_assign();
            }
        }
    }
}

?>