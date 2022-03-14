<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Helpers;

/**
 * BreadcrumbsHandler
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class BreadcrumbsHandler
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\IsAdmin;
    protected $breadcrumbs = [];
    public function __construct()
    {
        $this->loadDefault();
    }
    public function addBreadcrumb($url = NULL, $title = NULL, $order = NULL, $rawTitle = NULL)
    {
        $this->breadcrumbs[] = new Breadcrumb($url, $title, $this->getOrder($order), $rawTitle);
    }
    public function loadDefault()
    {
        if (!$this->isAdmin()) {
            $clientAreaName = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\Instances\\Addon\\Config")->getConfigValue("clientareaName", "default");
            $url = \ModulesGarden\Servers\ZimbraEmail\Core\Helper\BuildUrl::getUrl();
            $this->addBreadcrumb($url, $clientAreaName, NULL);
        }
        $router = new \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Router();
        if ($this->isAdmin()) {
            $mainMenu = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::create("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Http\\View\\MainMenu")->buildBreadcrumb($router->getController(), $router->getControllerMethod(), []);
            $order = 10;
            foreach ($mainMenu->getBreadcrumb() as $item) {
                $this->addBreadcrumb($item["url"], $item["name"], $order);
                $order += 10;
            }
        }
    }
    public function getOrder($order = NULL)
    {
        if (is_int($order) && 0 < $order) {
            return $order;
        }
        if (count($this->breadcrumbs) === 0) {
            return 100;
        }
        $last = end($this->breadcrumbs);
        return $last->getOrder() + 100;
    }
    public function getBreadcrumbs()
    {
        usort($this->breadcrumbs, function ($a, $b) {
            return $b->getOrder() < $a->getOrder();
        });
        if ($this->isAdmin()) {
            return $this->breadcrumbs;
        }
        $bcList = [];
        foreach ($this->breadcrumbs as $brc) {
            $bcDetails = $brc->getBreadcrumb();
            $bcList[$bcDetails["url"]] = $bcDetails["title"];
        }
        return $bcList;
    }
    public function replaceBreadcrumbTitle($key = NULL, $value = NULL)
    {
        if ($key === NULL || !is_string($value) || $value === "" || !$this->breadcrumbs[$key]) {
            return $this;
        }
        $this->breadcrumbs[$key]->setTitle($value);
        return $this;
    }
    public function disableBreadcrumb($key = NULL)
    {
        if ($key === NULL || !$this->breadcrumbs[$key]) {
            return $this;
        }
        $this->breadcrumbs[$key]->setDisabled();
        return $this;
    }
}

?>