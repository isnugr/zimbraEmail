<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Sidebar;

/**
 * Description of SidebarTrait
 *
 * @author Pawel Kopec <pawelk@modulesgardne.com>
 */
interface SidebarTrait
{
    protected $order = NULL;
    protected $targetBlank = false;
    protected $children = [];
    /**
     * @var Sidebar
     */
    protected $parent = NULL;
    protected $active = false;
    public function add($sidebar);
    public function getChild($id);
    public function hasChildren();
    public function childrenDelete($id);
    public function getChildren();
    public function destroy();
    public function getParent();
    public function setParent($parent);
    public function delete();
    public function isActive();
    public function setActive($active);
    public function setOrder($order);
    public function getOrder();
}

?>