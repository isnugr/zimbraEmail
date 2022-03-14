<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Sidebar;

/**
 * Description of Sidebar
 *
 * @author Pawel Kopec <pawelk@modulesgardne.com>
 */
class Sidebar extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    use SidebarTrait;
    protected $href = NULL;
    public function __construct($id, $href = NULL, $order = NULL)
    {
        $this->href = $href;
        $this->order = $order;
        parent::__construct($id);
    }
    public function getHref()
    {
        return $this->href;
    }
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
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