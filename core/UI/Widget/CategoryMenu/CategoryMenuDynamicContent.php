<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\CategoryMenu;

/**
 * Container controler for category menu with dynemic content
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class CategoryMenuDynamicContent extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\DatatableActionButtons;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\VSortable;
    protected $id = "categoryMenuDynamicContent";
    protected $defaultTemplateName = "categoryMenuDynamicContent";
    protected $searchable = true;
    protected $vueComponent = true;
    protected $defaultVueComponentName = "category-menu";
    public function returnAjaxData()
    {
        return (new ResponseTemplates\RawDataJsonResponse($this->elements))->setCallBackFunction($this->callBackFunction)->setRefreshTargetIds($this->refreshActionIds);
    }
    public function initContent()
    {
    }
}

?>