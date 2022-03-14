<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Filters;

class Select extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Select implements Helpers\FilterInterface
{
    protected $id = "selectFilter";
    protected $name = "selectFilter";
    protected $title = "selectFilterTitle";
    protected $vueComponent = true;
    protected $defaultVueComponentName = "mg-dt-select-filter";
    protected $parentId = NULL;
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
}

?>