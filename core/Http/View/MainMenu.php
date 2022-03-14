<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Http\View;

/**
 * Description of MainMenu
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class MainMenu
{
    /**
     * @var array
     */
    protected $menuContect = [];
    /**
     * @var array
     */
    protected $menu = [];
    /**
     * @var Breadcrumb
     */
    protected $breadcrumbModel = NULL;
    /**
     * @var array
     */
    protected $breadcrumb = [];
    public function __construct(Breadcrumb $breadcrumb)
    {
        $this->breadcrumbModel = $breadcrumb;
        $this->loadMenuContect();
        $this->buildMenu();
    }
    private function loadMenuContect()
    {
        $isAdmin = ModulesGarden\Servers\ZimbraEmail\Core\Helper\isAdmin();
        $file = $isAdmin ? "admin.yml" : "client.yml";
        $this->menuContect = \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader::read(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getDevConfigDir() . DS . "menu" . DS . $file)->get();
    }
    private function buildMenu()
    {
        foreach ($this->menuContect as $catName => $category) {
            if (isset($category["submenu"])) {
                if (empty($subPage["url"])) {
                    $subPage["url"] = isset($subPage["externalUrl"]) ? isset($subPage["externalUrl"]) : \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::getUrl($catName, $subName);
                }
            }
            $category["url"] = isset($category["externalUrl"]) ? isset($category["externalUrl"]) : \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::getUrl($catName);
            $this->menu[$catName] = $category;
        }
    }
    public function buildBreadcrumb($controller = NULL, $action = NULL, $arrayBreadcrumb = [])
    {
        $this->breadcrumb = $this->breadcrumbModel->load($this->getMenu(), $controller, $action, $arrayBreadcrumb)->get();
        return $this;
    }
    public function getMenu()
    {
        return $this->menu;
    }
    public function getBreadcrumb()
    {
        return $this->breadcrumb;
    }
}

?>