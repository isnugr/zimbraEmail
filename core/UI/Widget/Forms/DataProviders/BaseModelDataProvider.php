<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\DataProviders;

/**
 * Description of BaseModelDataProvider
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class BaseModelDataProvider extends BaseDataProvider
{
    protected $model = NULL;
    public function __construct($model)
    {
        parent::__construct();
        $this->setModel($model);
    }
    protected function setModel($model)
    {
        if ($this->isModelProper($model)) {
            $this->model = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::create($model);
        }
        return $this;
    }
    protected function getModel()
    {
        return $this->model;
    }
    protected function isModelProper($model)
    {
        if (in_array(get_parent_class($model), ["ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\ExtendedEloquentModel", "Illuminate\\Database\\Eloquent\\Model"])) {
            return true;
        }
        return false;
    }
    public function read()
    {
        if (!$this->actionElementId) {
            return false;
        }
        $dbData = $this->model->where("id", $this->actionElementId)->first();
        if ($dbData !== NULL) {
            $this->data = $dbData->toArray();
        }
    }
    public function create()
    {
        $this->model->fill($this->formData)->save();
    }
    public function update()
    {
        $dbData = $this->model->where("id", $this->formData["id"])->first();
        if ($dbData === NULL) {
            return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\HtmlDataJsonResponse())->setMessageAndTranslate("ItemNotFound")->setStatusError()->setCallBackFunction($this->callBackFunction);
        }
        $dbData->fill($this->formData)->save();
    }
    public function delete()
    {
        if (!isset($this->formData["id"])) {
        }
        $this->model->where("id", $this->formData["id"])->delete();
    }
}

?>