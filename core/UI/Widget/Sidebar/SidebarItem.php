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
class SidebarItem extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer
{
    use SidebarTrait;
    public function __construct($id, $href = NULL, $order = NULL, $targetBlankl = false)
    {
        if ($href) {
            $this->setHref($href);
        }
        $this->order = $order;
        $this->targetBlank = $targetBlankl;
        parent::__construct($id);
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getHref()
    {
        return $this->htmlAttributes["href"];
    }
    public function setHref($href)
    {
        $this->htmlAttributes["href"] = $href;
        return $this;
    }
    public function setTarget($target)
    {
        $this->htmlAttributes["target"] = $target;
        return $this;
    }
    public function setHtml($html)
    {
        $this->html = $html;
        return $this;
    }
}

?>