<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Filters;

class Text extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Text implements Helpers\FilterInterface
{
    protected $id = "textFilter";
    protected $name = "textFilter";
    protected $title = "textFilterTitle";
    protected $vueComponent = true;
    protected $defaultVueComponentName = "mg-dt-text-filter";
    protected $parentId = NULL;
    protected $requiredToSearch = false;
    protected $searchDisablingValue = false;
    public function setParentId($id)
    {
        $this->parentId = $id;
    }
    public function getParentId()
    {
        return $this->parentId;
    }
    public function isVueRegistrationAllowed()
    {
        if ($this->getRequestValue("loadData") === $this->getParentId() && $this->getRequestValue("ajax") == 1) {
            return false;
        }
        return true;
    }
    public function setRequiredToSearch()
    {
        $this->requiredToSearch = true;
    }
    public function isRequiredToSearch()
    {
        return $this->requiredToSearch;
    }
}

?>