<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Others;

/**
 * AjaxFieldForDataTable - a field that will load its content after creation
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class AjaxFieldForDataTable extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    protected $id = "ajaxFieldForDataTable";
    protected $name = "ajaxFieldForDataTable";
    protected $vueComponent = true;
    protected $defaultVueComponentName = "dt-ajax-field";
    protected $asyncLoading = true;
    protected $ajaxData = NULL;
    public function changeAsyncLoading($load = true)
    {
        $this->asyncLoading = (int) $load;
    }
    public function getAsyncLoaging()
    {
        return $this->asyncLoading;
    }
    public function setAjaxData($ajaxData = NULL)
    {
        $this->ajaxData = $ajaxData;
        return $this;
    }
    public function getAjaxData()
    {
        return $this->ajaxData;
    }
    public function prepareAjaxData()
    {
    }
    public function returnAjaxData()
    {
        $this->prepareAjaxData();
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\RawDataJsonResponse(["ajaxData" => $this->ajaxData]))->setCallBackFunction($this->callBackFunction)->setRefreshTargetIds($this->refreshActionIds);
    }
}

?>