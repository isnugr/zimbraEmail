<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Http\View;

/**
 * Description of Breadcrumb
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Breadcrumb
{
    /**
     * @var array
     */
    protected $data = [];
    public function __construct()
    {
    }
    public function load($menu = [], $controller = NULL, $action = NULL, $arrayBreadcrumb = [])
    {
        if (empty($controller)) {
            $controller = key($menu);
        }
        if ($controller) {
            $this->data[] = ["name" => $controller, "url" => $menu[strtolower($controller)]["url"] ?: $menu[$controller]["url"], "icon" => $menu[strtolower($controller)]["icon"] ?: $menu[$controller]["icon"]];
        }
        if ($arrayBreadcrumb) {
            $count = count($arrayBreadcrumb) - 1;
            foreach ($arrayBreadcrumb as $number => $breadcrumb) {
                $this->data[] = ["name" => $breadcrumb->getName(), "url" => $breadcrumb->isUrl() && $count != $number ? $breadcrumb->getUrl() : NULL, "icon" => $breadcrumb->isIcon() ? $breadcrumb->getIcon() : NULL];
            }
        } else {
            if ($action && $action !== "index") {
                $this->data[] = ["name" => $action, "url" => $menu[$controller]["submenu"][$action]["url"], "icon" => $menu[$controller]["submenu"][$action]["icon"]];
            }
        }
        return $this;
    }
    public function get()
    {
        return $this->data;
    }
}

?>