<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers;

class Router
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Smarty;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\OutputBuffer;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\IsAdmin;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    protected $controllerClass = NULL;
    protected $controllerMethod = NULL;
    const ADMIN = "admin";
    const CLIENT = "client";
    public function __construct()
    {
        $this->isAdmin();
        $this->loadController();
    }
    public function loadController()
    {
        $this->getControllerClass();
        $this->getControllerMethod();
    }
    public function getControllerClass()
    {
        if ($this->controllerClass === NULL) {
            $this->controllerClass = "\\ModulesGarden\\Servers\\ZimbraEmail\\App\\Http\\" . ucfirst($this->getControllerType()) . "\\" . ucfirst($this->getController());
        }
        return $this->controllerClass;
    }
    public function getControllerType()
    {
        return $this->isAdminStatus ? ADMIN : CLIENT;
    }
    public function getController()
    {
        return filter_var($this->getRequestValue("mg-page", "Home"), FILTER_SANITIZE_SPECIAL_CHARS);
    }
    public function getControllerMethod()
    {
        if ($this->controllerMethod === NULL) {
            $this->controllerMethod = $this->request->get("mg-action", "index");
        }
        return $this->controllerMethod;
    }
    public function isControllerCallable()
    {
        if (!class_exists($this->controllerClass)) {
            return false;
        }
        if (!method_exists($this->controllerClass, $this->controllerMethod)) {
            return false;
        }
        if (!is_callable([$this->controllerClass, $this->controllerMethod])) {
            return false;
        }
        return true;
    }
}

?>