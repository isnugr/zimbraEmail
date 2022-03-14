<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Graphs;

/**
 * Description of EmptyGraph
 *
 * @author inbs
 */
class EmptyGraph extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder\BaseContainer implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\AjaxElementInterface
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\TableRowCol;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\Icon;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\TitleButtons;
    protected $id = "emptyGraph";
    protected $name = "emptyGraph";
    protected $title = "title";
    protected $configCharts = ["type" => "", "data" => [], "dataParse" => [], "options" => [], "filter" => []];
    protected $tooltips = NULL;
    protected $responsive = true;
    protected $responsiveAnimationDuration = NULL;
    protected $maintainAspectRatio = NULL;
    protected $onResize = NULL;
    protected $filterInfo = NULL;
    protected $animation = [];
    protected $layout = [];
    protected $scales = ["xAxes" => [["ticks" => ["beginAtZero" => true]]]];
    protected $legend = ["display" => true, "position" => "top"];
    protected $titleGraph = ["display" => false, "text" => "", "position" => "top"];
    protected $graphWidth = 1200;
    protected $graphHeight = 400;
    protected $vueComponent = true;
    protected $defaultVueComponentName = "mg-graph";
    protected $graphData = NULL;
    protected $graphSettingsKey = NULL;
    protected $graphSettingsEnabled = false;
    protected $configurationFields = [];
    const GRAPH_FILTER_TYPE_INT = "int";
    const GRAPH_FILTER_TYPE_STRING = "string";
    const GRAPH_FILTER_TYPE_DATE = "date";
    const GRAPH_OPTIONS_MODE_POINT = "point";
    const GRAPH_OPTIONS_MODE_NEAREST = "nearest";
    const GRAPH_OPTIONS_MODE_INDEX = "index";
    const GRAPH_OPTIONS_MODE_DATASET = "dataset";
    const GRAPH_OPTIONS_MODE_X = "x";
    const GRAPH_OPTIONS_MODE_Y = "y";
    public function returnAjaxData()
    {
        if ($this->getRequestValue("loadData", false) === "settingButton") {
            $settingButton = $this->titleButtons["settingButton"];
            return $settingButton->returnAjaxData();
        }
        $this->loadData();
        $this->setTitleText(ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("lang")->T($this->name));
        $this->reloadConfigCharts();
        $this->addColorForLabels();
        $this->useFilter();
        return (new \ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates\RawDataJsonResponse($this->configCharts))->setCallBackFunction($this->callBackFunction)->setRefreshTargetIds($this->refreshActionIds);
    }
    protected function disableEditColor()
    {
        $this->filterInfo["displayEditColor"] = false;
        return $this;
    }
    protected function enableEditColor()
    {
        $this->filterInfo["displayEditColor"] = true;
        return $this;
    }
    protected function setGraphFilterInfo($type = self::GRAPH_FILTER_TYPE_INT, $defaultStart = 0, $defaultStop = 100)
    {
        if ($type !== NULL && in_array($type, [GRAPH_FILTER_TYPE_INT, GRAPH_FILTER_TYPE_DATE, GRAPH_FILTER_TYPE_STRING], true)) {
            $this->filterInfo["type"] = $type;
        }
        if ($defaultStart !== NULL) {
            $this->filterInfo["default"]["start"] = $defaultStart;
        }
        if ($defaultStop !== NULL) {
            $this->filterInfo["default"]["end"] = $defaultStop;
        }
        return $this;
    }
    protected function getActionId()
    {
        return $this->getRequestValue("index", false);
    }
    protected function reloadConfigCharts()
    {
        if (is_array($this->animation) && 0 < count($this->animation)) {
            $this->configCharts["options"]["animation"] = $this->animation;
        } else {
            if (is_string($this->animation) && 0 < strlen($this->animation)) {
                $this->configCharts["options"]["animation"] = json_decode($this->animation, true);
            }
        }
        if (is_array($this->layout) && 0 < count($this->layout)) {
            $this->configCharts["options"]["layout"] = $this->layout;
        }
        if (is_array($this->legend) && 0 < count($this->legend)) {
            $this->configCharts["options"]["legend"] = $this->legend;
        }
        if (is_array($this->titleGraph) && 0 < count($this->titleGraph)) {
            $this->configCharts["options"]["title"] = $this->titleGraph;
        }
        if (is_array($this->scales) && 0 < count($this->scales)) {
            $this->configCharts["options"]["scales"] = $this->scales;
        }
        if (is_array($this->filterInfo) && 0 < count($this->filterInfo)) {
            $this->configCharts["filter"] = $this->filterInfo;
        }
        if ($this->responsive !== NULL) {
            $this->configCharts["options"]["responsive"] = $this->responsive;
        }
        if ($this->responsiveAnimationDuration !== NULL) {
            $this->configCharts["options"]["responsiveAnimationDuration"] = $this->responsiveAnimationDuration;
        }
        if ($this->maintainAspectRatio !== NULL) {
            $this->configCharts["options"]["maintainAspectRatio"] = $this->maintainAspectRatio;
        }
        if ($this->onResize !== NULL) {
            $this->configCharts["options"]["onResize"] = $this->onResize;
        }
        return $this;
    }
    protected function setChartScales($scales = [])
    {
        $this->scales = $scales;
        return $this;
    }
    protected function addChartScale($key = NULL, $scales = [])
    {
        if (trim($key) !== "" && is_string($key) && !isset($this->scales[$key])) {
            $this->scales[$key] = $scales;
        }
        return $this;
    }
    protected function updateChartScale($key = NULL, $scales = [])
    {
        if (trim($key) !== "" && is_string($key)) {
            $this->scales[$key] = $scales;
        }
        return $this;
    }
    protected function setTooltipsMode($tooltipMode = "index")
    {
        if (!in_array($tooltipMode, [GRAPH_OPTIONS_MODE_DATASET, GRAPH_OPTIONS_MODE_INDEX, GRAPH_OPTIONS_MODE_NEAREST, GRAPH_OPTIONS_MODE_POINT, GRAPH_OPTIONS_MODE_X, GRAPH_OPTIONS_MODE_Y])) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(\ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCodesLib::CORE_GRA_000001, ["mode" => $tooltipMode]);
        }
        $this->tooltips["mode"] = $tooltipMode;
        return $this;
    }
    protected function setTitleDisplay($display = true)
    {
        $this->titleGraph["display"] = (int) $display;
        return $this;
    }
    protected function setTitlePosition($position = "top")
    {
        $this->titleGraph["position"] = (int) $position;
        return $this;
    }
    protected function setTitleFontSize($fontSize = 12)
    {
        $this->titleGraph["fontSize"] = (int) $fontSize;
        return $this;
    }
    protected function setTitleFontFamily($fontFamily = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif")
    {
        $this->titleGraph["fontFamily"] = (int) $fontFamily;
        return $this;
    }
    protected function setTitleFontColor($fontColor = "#666")
    {
        $this->titleGraph["fontColor"] = (int) $fontColor;
        return $this;
    }
    protected function setTitleFontStyle($fontStyle = "")
    {
        $this->titleGraph["fontStyle"] = (int) $fontStyle;
        return $this;
    }
    protected function setTitlePadding($padding = "")
    {
        $this->titleGraph["padding"] = (int) $padding;
        return $this;
    }
    protected function setTitleLineHeight($lineHeight = 0)
    {
        $this->titleGraph["lineHeight"] = (int) $lineHeight;
        return $this;
    }
    protected function setTitleText($text = "")
    {
        $this->titleGraph["text"] = (int) $text;
        return $this;
    }
    protected function unsetLegend()
    {
        $this->legend = [];
        return $this;
    }
    protected function setLegendLabelsBoxWidth($boxWidth = 40)
    {
        $this->legend["labels"]["boxWidth"] = (int) $boxWidth;
        return $this;
    }
    protected function setLegendLabelsFontSize($fontSize = 12)
    {
        $this->legend["labels"]["fontSize"] = (int) $fontSize;
        return $this;
    }
    protected function setLegendLabelsFontStyle($fontStyle = "normal")
    {
        $this->legend["labels"]["fontStyle"] = (int) $fontStyle;
        return $this;
    }
    protected function setLegendLabelsFontColor($fontColor = "#666")
    {
        $this->legend["labels"]["fontColor"] = (int) $fontColor;
        return $this;
    }
    protected function setLegendLabelsFontFamily($fontFamily = "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif")
    {
        $this->legend["labels"]["fontFamily"] = (int) $fontFamily;
        return $this;
    }
    protected function setLegendLabelsPadding($padding = 10)
    {
        $this->legend["labels"]["padding"] = (int) $padding;
        return $this;
    }
    protected function setLegendLabelsGenerateLabels($generateLabels = "function () {}")
    {
        $this->legend["labels"]["generateLabels"] = (int) $generateLabels;
        return $this;
    }
    protected function setLegendLabelsFilter($filter = "function () {}")
    {
        $this->legend["labels"]["filter"] = (int) $filter;
        return $this;
    }
    protected function setLegendLabelsUsePointStyle($usePointStyle = false)
    {
        $this->legend["labels"]["usePointStyle"] = (int) $usePointStyle;
        return $this;
    }
    protected function setLegendReverse($isReverse = false)
    {
        $this->legend["reverse"] = (int) $isReverse;
        return $this;
    }
    protected function setLegendOnHover($eventFunction = "function (event, legendItem) {}")
    {
        $this->legend["onHover"] = (int) $eventFunction;
        return $this;
    }
    protected function setLegendOnClick($eventFunction = "function (event, legendItem) {}")
    {
        $this->legend["onClick"] = (int) $eventFunction;
        return $this;
    }
    protected function setLegendFullWidth($isFullWidth = true)
    {
        $this->legend["fullWidth"] = (int) $isFullWidth;
        return $this;
    }
    protected function setLegendDisplay($isDisplay = true)
    {
        $this->legend["display"] = (int) $isDisplay;
        return $this;
    }
    protected function setLegendPosition($position = "top")
    {
        $this->legend["position"] = (int) $position;
        return $this;
    }
    protected function unsetLayout()
    {
        $this->layout = [];
        return $this;
    }
    protected function setLayoutPadding($left = 0, $right = 0, $top = 0, $bottom = 0)
    {
        $this->layout["padding"] = ["left" => $left, "right" => $right, "top" => $top, "bottom" => $bottom];
        return $this;
    }
    protected function setAnimation($animation)
    {
        $this->animation = $animation;
        return $this;
    }
    protected function addAnimation($event, $animation)
    {
        if (is_array($this->animation)) {
            $this->animation[$event] = $animation;
        } else {
            if (is_string($this->animation)) {
                $animations = json_decode($this->animation, true);
                $animations[$event] = $animation;
                $this->animation = json_encode($animations);
            }
        }
        return $this;
    }
    public function setGraphWidth($graphWidth = 0)
    {
        if (!is_numeric($graphWidth)) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(\ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCodesLib::CORE_GRA_000002, ["width" => $graphWidth], ["width" => $graphWidth]);
        }
        $this->graphWidth = $graphWidth;
        return $this;
    }
    public function setGraphHeight($graphHeight = 0)
    {
        if (!is_numeric($graphHeight)) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(\ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCodesLib::CORE_GRA_000003, ["height" => $graphHeight], ["height" => $graphHeight]);
        }
        $this->graphHeight = $graphHeight;
        return $this;
    }
    public function getGraphWidth()
    {
        return $this->graphWidth;
    }
    public function getGraphHeight()
    {
        return $this->graphHeight;
    }
    public function setChartOptions($chartOptions = [])
    {
        $this->configCharts["options"] = $chartOptions;
        return $this;
    }
    public function updateChartOption($key = NULL, $value = NULL)
    {
        if (is_string($key) && trim($key) !== "") {
            $this->configCharts["options"][$key] = $value;
        }
        return $this;
    }
    public function getChartOptions()
    {
        return $this->configChartsOptions;
    }
    public function setChartType($type = "")
    {
        $this->configCharts["type"] = $type;
        return $this;
    }
    public function getChartType()
    {
        return $this->configCharts["type"];
    }
    public function setChartTypeToLine()
    {
        return $this->setChartType("line");
    }
    public function setChartTypeToBar()
    {
        return $this->setChartType("bar");
    }
    public function setChartTypeToRader()
    {
        return $this->setChartType("radar");
    }
    public function setChartTypeToPolarArea()
    {
        return $this->setChartType("polarArea");
    }
    public function setChartTypeToPie()
    {
        return $this->setChartType("pie");
    }
    public function setChartTypeToDoughnut()
    {
        return $this->setChartType("doughnut");
    }
    public function setChartTypeToBubble()
    {
        return $this->setChartType("bubble");
    }
    public function setChartData($data = [])
    {
        if (is_object($data) && $data instanceof Models\Data) {
            $this->configCharts["data"] = $data->toArray();
        } else {
            $this->configCharts["data"] = $data;
        }
        return $this;
    }
    public function getChartData()
    {
        return $this->configCharts["data"];
    }
    protected function loadSettings()
    {
        $this->configChartsSettings = json_decode(\ModulesGarden\Servers\ZimbraEmail\Core\Models\ModuleSettings\Model::where("setting", $this->graphSettingsKey)->first()->value);
        if ($this->configChartsSettings) {
            $this->setGraphFilterInfo(NULL, $this->configChartsSettings->start, $this->configChartsSettings->end);
        }
        return $this;
    }
    protected function useFilter()
    {
        if ($this->configCharts["data"] && $this->configCharts["data"]["labels"] && $this->configCharts["filter"]["default"]["start"] && $this->configCharts["filter"]["default"]["end"]) {
            $this->configCharts["dataParse"] = $this->configCharts["data"];
            $removeIndex = [];
            $isRemove = true;
            foreach ($this->configCharts["data"]["labels"] as $index => $value) {
                if ($value == $this->configCharts["filter"]["default"]["start"]) {
                    $isRemove = false;
                } else {
                    if ($value == $this->configCharts["filter"]["default"]["end"]) {
                        $isRemove = true;
                    } else {
                        if ($isRemove) {
                            $removeIndex[] = $index;
                        }
                    }
                }
            }
            foreach ($removeIndex as $index) {
                if (isset($this->configCharts["data"]["labels"][$index])) {
                    unset($this->configCharts["data"]["labels"][$index]);
                }
                if (isset($this->configCharts["data"]["datasets"])) {
                    foreach ($dataset as $key => $value) {
                        if (is_array($value) && isset($dataset[$key][$index])) {
                            unset($dataset[$key][$index]);
                        }
                    }
                }
            }
        }
        return $this;
    }
    protected function addColorForLabels()
    {
        $indexColor = [];
        if ($this->configCharts["data"] && $this->configCharts["data"]["labels"] && $this->filterInfo["displayEditColor"]) {
            foreach ($this->configCharts["data"]["labels"] as $labelName) {
                if (isset($this->configChartsSettings->{$labelName})) {
                    $indexColor[] = "#" . $this->configChartsSettings->{$labelName};
                }
            }
            if (!$indexColor) {
                return $this;
            }
            $dataset["backgroundColor"] = $indexColor;
            $dataset["borderColor"] = $indexColor;
            $dataset["hoverBackgroundColor"] = $indexColor;
            $dataset["hoverBorderColor"] = $indexColor;
            $dataset["pointBackgroundColor"] = $indexColor;
            $dataset["pointBorderColor"] = $indexColor;
            $dataset["pointHoverBackgroundColor"] = $indexColor;
            $dataset["pointHoverBorderColor"] = $indexColor;
        }
        return $this;
    }
    public function generateDataObject()
    {
        return new Models\Data();
    }
    public function generateDataSetObject()
    {
        return new Models\DataSet();
    }
    public function prepareAjaxData()
    {
    }
    public function setLabels($labels = [])
    {
        $this->initData();
        if ($labels) {
            $this->graphData->setLabels($labels);
        }
        return $this;
    }
    public function initData()
    {
        if (!$this->graphData) {
            $this->graphData = new Models\Data();
        }
        return $this;
    }
    public function addDataSet($dataSet)
    {
        $this->graphData->addDataSet($dataSet);
        return $this;
    }
    protected function loadData()
    {
        $this->addGraphSettings();
        $this->prepareAjaxData();
        $this->setChartData($this->graphData);
    }
    protected function addGraphSettings()
    {
        if (!$this->getRequestValue("mgformtype", false) && $this->getRequestValue("ajax", false)) {
            return $this;
        }
        if (!$this->graphSettingsEnabled) {
            return $this;
        }
        if (!$this->graphSettingsKey) {
            $this->graphSettingsKey = "graph_" . $this->id;
        }
        if ($this->configurationFields) {
            $field = new \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\Hidden("setting");
            $field->setDefaultValue($this->graphSettingsKey);
            $this->addSettingField($field);
        }
        $btn = (new Settings\SettingButton())->setIndex($this->graphSettingsKey)->addNamespaceScope($this->namespace)->setConfigFields($this->configurationFields);
        $this->addTitleButton($btn);
    }
    public function enableGraphSettings($settingsKey = NULL)
    {
        $this->graphSettingsEnabled = true;
        if ((int) $settingsKey !== "") {
            $this->graphSettingsKey = (int) $settingsKey;
        }
        $this->addGraphSettings();
        return $this;
    }
    public function addSettingField($field)
    {
        if (is_object($field)) {
            $this->configurationFields[$field->getId()] = $field;
        }
        return $this;
    }
    public function getGraphSettingsKey()
    {
        return $this->graphSettingsKey;
    }
}

?>