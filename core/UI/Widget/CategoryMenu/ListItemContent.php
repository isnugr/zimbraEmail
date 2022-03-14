<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\CategoryMenu;

/**
 * controler for Tab in DOE Category Page
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class ListItemContent extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Tab implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    public $category = NULL;
    protected $defaultTemplateName = "ItemContent";
    public function setCategory($category)
    {
        $this->category = $category;
    }
    public function returnAjaxData()
    {
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse($this->getHtml()))->setCallBackFunction($this->callBackFunction)->setRefreshTargetIds($this->refreshActionIds);
    }
    public function initContent()
    {
    }
    public function setId($id = NULL)
    {
        $this->id = "menuItemContent" . (int) $id;
    }
}

?>