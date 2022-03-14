<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Buttons;

/**
 * base button controller
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class ButtonModal extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    protected $id = "ButtonModal";
    protected $class = ["lu-btn lu-btn--sm lu-btn--link lu-btn--icon lu-btn--plain lu-btn--default"];
    protected $icon = "lu-zmdi lu-zmdi-plus";
    protected $title = "ButtonModal";
    protected $htmlAttributes = ["href" => "javascript:;", "data-toggle" => "lu-tooltip"];
    protected $modal = NULL;
    public function returnAjaxData()
    {
        $returnHtml = $this->modal->getHtml();
        $returnTemplate = $this->mainContainer->getVueComponents();
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\RawDataJsonResponse(["htmlData" => $returnHtml, "template" => $returnTemplate, "registrations" => self::getVueComponentsRegistrations()]))->setCallBackFunction($this->callBackFunction)->setRefreshTargetIds($this->refreshActionIds);
    }
    public function initContent()
    {
        $this->initLoadModalAction(new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Modals\ExampleModal());
    }
    public function setModal($modal)
    {
        $modal->setMainContainer($this->mainContainer);
        $this->modal = $modal;
        if ($modal instanceof \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface) {
            $this->mainContainer->addAjaxElement($this->modal->runInitContentProcess());
        }
    }
    protected function initLoadModalAction($modal)
    {
        $this->htmlAttributes["@click"] = "loadModal(\$event, '" . $this->id . "', '" . $this->getNamespace() . "', '" . $this->getIndex() . "', null, true)";
        $this->setModal($modal);
    }
}

?>