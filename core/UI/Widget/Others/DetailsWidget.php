<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Others;

/**
 * Class DetailsWidget
 *
 * @author Artur Pilch <artur.pi@modulesgarden.com>
 */
class DetailsWidget extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    protected $id = "detailsWidget";
    protected $name = "detailsWidget";
    protected $title = "detailsWidget";
    protected $vueComponent = true;
    protected $defaultVueComponentName = "mg-details-widget";
    public function initContent()
    {
    }
    public function prepareAjaxData()
    {
    }
    public function getParsedTitle()
    {
        if ($this->getRawTitle()) {
            return $this->getRawTitle();
        }
        if ($this->getTitle()) {
            $this->loadLang();
            return $this->lang->controlerContextTranslate($this->getId(), $this->getTitle());
        }
        return "";
    }
    public function returnAjaxData()
    {
        $this->prepareAjaxData();
        return new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\RawDataJsonResponse(["title" => $this->getParsedTitle(), "data" => $this->data]);
    }
}

?>