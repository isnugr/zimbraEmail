<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Helpers;

/**
 * Breadcrumb
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class Breadcrumb
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Title;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\IsAdmin;
    protected $url = NULL;
    protected $order = 100;
    protected $disabled = false;
    public function __construct($url = NULL, $title = NULL, $order = NULL, $rawTitle = NULL)
    {
        $this->setUrl($url);
        $this->setTitle($title);
        $this->setOrder($order);
        $this->setRawTitle($rawTitle);
    }
    public function setOrder($order = NULL)
    {
        if (is_int($order) && 0 <= $order) {
            $this->order = $order;
        }
        return $this;
    }
    public function getOrder()
    {
        return $this->order;
    }
    public function setUrl($url = NULL)
    {
        if (is_string($url) && $url !== "") {
            $this->url = $url;
        }
        return $this;
    }
    public function getUrl()
    {
        return $this->url;
    }
    public function getBreadcrumb()
    {
        return ["url" => $this->url, "title" => $this->buildTitle()];
    }
    public function buildTitle()
    {
        if ($this->getRawTitle()) {
            return $this->getRawTitle();
        }
        $this->loadLang();
        return $this->lang->absoluteTranslate("addon" . ($this->isAdmin() ? "AA" : "CA"), "breadcrumbs", $this->title);
    }
    public function setDisabled()
    {
        $this->disabled = true;
    }
    public function isDisabled()
    {
        return $this->disabled;
    }
}

?>