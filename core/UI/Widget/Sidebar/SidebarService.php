<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Sidebar;

/**
 * Description of SidebarService
 *
 * @author Pawel Kopec <pawelk@modulesgardne.com>
 */
class SidebarService
{
    use SidebarTrait;
    protected $id = NULL;
    /**
     *
     * @var Sidebar[]
     */
    protected $children = [];
    public function __construct()
    {
        $this->load();
    }
    private function load()
    {
        if (!file_exists(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getDevConfigDir() . DS . "sidebars.yml")) {
            return NULL;
        }
        $data = \ModulesGarden\Servers\ZimbraEmail\Core\FileReader\Reader::read(\ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getDevConfigDir() . DS . "sidebars.yml");
        foreach ($data->get() as $parent => $sidebars) {
            $this->add(new Sidebar($parent));
            foreach ($sidebars as $id => $sidebar) {
                $sidebarItem = new SidebarItem($id, $sidebar["uri"], $sidebar["order"], $sidebar["target_blank"]);
                if ($sidebarItem->getTitle() === ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("request")->get("mg-page")) {
                    $sidebarItem->setActive(true);
                }
                $this->getSidebar($parent)->add($sidebarItem);
            }
        }
    }
    public function getSidebar($id)
    {
        if (!isset($this->children[$id])) {
            throw new \Exception(sprintf("Sidebar %s does not exist", $id));
        }
        return $this->children[$id];
    }
    public function isEmpty()
    {
        return empty($this->children);
    }
    public function get()
    {
        $children = [];
        foreach ($this->children as $child) {
            if (!$child->getOrder()) {
                $children[] = $child;
            } else {
                $children[$child->getOrder()] = $child;
            }
        }
        ksort($children);
        return $children;
    }
}

?>