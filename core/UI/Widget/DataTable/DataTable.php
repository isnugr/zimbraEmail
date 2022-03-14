<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable;

/**
 * Description of Service
 *
 * @author inbs
 */
class DataTable extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\DatatableActionButtons;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\DatatableMassActionButtons;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\VSortable;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\TitleButtons;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\TableLength;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Datatable\Filters;
    protected $name = "dataTable";
    protected $key = "id";
    protected $type = ["id" => "int"];
    protected $recordsSet = [];
    protected $sort = [];
    protected $columns = [];
    protected $isActive = true;
    protected $html = "";
    protected $config = [];
    protected $dataProvider = NULL;
    protected $searchable = true;
    protected $vueComponent = true;
    protected $defaultVueComponentName = "mg-datatable";
    protected $searchBarButtonsVisible = 1;
    protected $dropdawnWrapper = NULL;
    protected $elementsContainers = ["elements", "buttons"];
    protected $autoloadDataAfterCreated = true;
    protected $actionIdColumnName = "id";
    protected function loadData()
    {
    }
    protected function loadHtml()
    {
    }
    public function initContent()
    {
    }
    protected function getJsDrawFunctions()
    {
        $functionsList = [];
        foreach ($this->columns as $column) {
            if ($column->getCustomJsDrawFunction() !== NULL) {
                $functionsList[$column->name] = $column->getCustomJsDrawFunction();
            }
        }
        return $functionsList;
    }
    public function returnAjaxData()
    {
        $this->loadHtml();
        $this->loadData($this->columns);
        $this->parseDataRecords();
        $returnTemplate = self::getVueComponents();
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\RawDataJsonResponse(["recordsSet" => $this->recordsSet, "template" => $returnTemplate, "registrations" => self::getVueComponentsRegistrations()]))->setCallBackFunction($this->callBackFunction)->setRefreshTargetIds($this->refreshActionIds);
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function getName()
    {
        return $this->name;
    }
    protected function setKey($key)
    {
        $this->key = $key;
        return $this;
    }
    protected function setStatus($status)
    {
        $this->isActive = $status;
        return $this;
    }
    protected function addColumn(Column $column)
    {
        if (!array_key_exists($column->name, $this->columns)) {
            $this->columns[$column->name] = $column;
        }
        return $this;
    }
    public function setData(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\DataSetInterface $data)
    {
        $this->recordsSet = $data;
        return $this;
    }
    protected function getCount()
    {
        return count($this->recordsSet->records);
    }
    protected function getRecords()
    {
        return $this->recordsSet;
    }
    protected function setHtml($html)
    {
        $this->html = $html;
        return $this;
    }
    public function setDataProvider(DataProviders\DataProvider $dataProv)
    {
        $this->dataProvider = $dataProv;
        if (!$this->columns) {
            $this->loadHtml();
        }
        $this->setData($this->dataProvider->getData($this->columns));
    }
    protected function parseDataRecords()
    {
        $replacementFunctions = $this->getReplacementFunctions();
        if (count($replacementFunctions) === 0) {
            return false;
        }
        foreach ($this->recordsSet->records as $key => $row) {
            $this->recordsSet->records[$key] = $this->replaceRowData($row, $replacementFunctions);
        }
    }
    protected function replaceRowData($row, $replacementFunctions)
    {
        foreach ($replacementFunctions as $colName => $functionName) {
            if (method_exists($this, $functionName)) {
                $this->setValueForDataRow($row, $colName, $this->{$functionName}($colName, $row));
            }
        }
        return $row;
    }
    protected function getReplacementFunctions()
    {
        $replacementFunctions = [];
        foreach ($this->columns as $column) {
            if (method_exists($this, "replaceField" . ucfirst($column->name))) {
                $replacementFunctions[$column->name] = "replaceField" . ucfirst($column->name);
            }
        }
        return $replacementFunctions;
    }
    protected function setValueForDataRow($row, $colName, $value)
    {
        if (is_array($row)) {
            $row[$colName] = $value;
            return $this;
        }
        $row->{$colName} = $value;
        return $this;
    }
    public function hasCustomColumnHtml($colName)
    {
        if (method_exists($this, "customColumnHtml" . ucfirst($colName))) {
            return true;
        }
        return false;
    }
    public function getCustomColumnHtml($colName)
    {
        if ($this->hasCustomColumnHtml($colName)) {
            return $this->{"customColumnHtml" . ucfirst($colName)}();
        }
        return false;
    }
    public function getSearchBarButtonsVisible()
    {
        return $this->searchBarButtonsVisible;
    }
    public function addButton($button)
    {
        if ($this->getRequestValue("ajax") !== false && $this->getRequestValue("iDisplayLength") !== false && $this->getRequestValue("iDisplayStart") !== false) {
            return $this;
        }
        if ($this->getButtonsCount() < $this->getSearchBarButtonsVisible()) {
            self::addButton($button);
            return $this;
        }
        $this->addButtonToDropdawn($button);
        return $this;
    }
    public function addButtonToDropdawn($button)
    {
        if ($this->dropdawnWrapper === NULL) {
            $this->dropdawnWrapper = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection\DependencyInjection::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\Buttons\\DropdawnButtonWrappers\\ButtonDropdown");
            $this->registerMainContainerAdditions($this->dropdawnWrapper);
        }
        $this->dropdawnWrapper->addButton($button);
        return $this;
    }
    public function hasDropdawnButton()
    {
        return $this->dropdawnWrapper !== NULL;
    }
    public function getDropdawnButtonHtml()
    {
        return $this->dropdawnWrapper->getHtml();
    }
    protected function preInitContent()
    {
        $this->loadHtml();
    }
    protected function afterInitContent()
    {
        self::afterInitContent();
        $this->customTplVars["columns"] = $this->columns;
        $this->customTplVars["jsDrawFunctions"] = $this->getJsDrawFunctions();
    }
    public function enableAutoloadDataAfterCreated()
    {
        $this->autoloadDataAfterCreated = true;
    }
    public function disableAutoloadDataAfterCreated()
    {
        $this->autoloadDataAfterCreated = false;
    }
    public function isAutoloadDataAfterCreated()
    {
        return $this->autoloadDataAfterCreated;
    }
    public function getActionIdColumnName()
    {
        return $this->actionIdColumnName;
    }
}

?>