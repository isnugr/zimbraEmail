<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Graphs\Models;

/**
 * Description of ChartData
 *
 * @author inbs
 */
class DataSet
{
    protected $label = NULL;
    protected $type = NULL;
    /**
     * @var double[]|integer[]|array
     */
    protected $data = [];
    /**
     * @var string[]|string 
     */
    protected $backgroundColor = [];
    /**
     * @var string[]|string
     */
    protected $borderColor = [];
    /**
     * @var double[]|integer[]
     */
    protected $borderDash = [];
    /**
     * @var string[]|string[]
     */
    protected $hoverBackgroundColor = [];
    /**
     * @var string[]|string[]
     */
    protected $hoverBorderColor = [];
    /**
     * @var double[]|double|integer[]|integer
     */
    protected $hoverBorderWidth = [];
    /**
     * @var string[]|string
     */
    protected $pointBackgroundColor = [];
    /**
     * @var string[]|string
     */
    protected $pointBorderColor = [];
    /**
     * @var double[]|double|integer[]|integer
     */
    protected $pointBorderWidth = [];
    /**
     * @var double[]|double|integer[]|integer
     */
    protected $pointRadius = [];
    /**
     * @var string[]|string
     */
    protected $pointStyle = [];
    /**
     * @var double[]|double|integer[]|integer
     */
    protected $pointHitRadius = [];
    /**
     * @var string[]|string
     */
    protected $pointHoverBackgroundColor = [];
    /**
     * @var string[]|string
     */
    protected $pointHoverBorderColor = [];
    /**
     * @var double[]|double|integer[]|integer
     */
    protected $pointHoverBorderWidth = [];
    /**
     * @var double[]|double|integer[]|integer
     */
    protected $pointHoverRadius = [];
    /**
     * @var double[]|double|integer[]|integer
     */
    protected $borderWidth = [];
    /**
     * @var double|integer
     */
    protected $borderDashOffset = NULL;
    /**
     * @var string 
     */
    protected $xAxisID = NULL;
    /**
     * @var string 
     */
    protected $yAxisID = NULL;
    /**
     * @var string 
     */
    protected $borderCapStyle = NULL;
    /**
     * @var string 
     */
    protected $borderJoinStyle = NULL;
    /**
     * @var string 
     */
    protected $cubicInterpolationMode = NULL;
    /**
     * @var boolean|string 
     */
    protected $fill = NULL;
    /**
     * @var double|integer
     */
    protected $lineTension = NULL;
    /**
     * @var boolean 
     */
    protected $showLine = NULL;
    /**
     * @var boolean 
     */
    protected $spanGaps = NULL;
    /**
     * @var boolean|string
     */
    protected $steppedLine = false;
    /**
     * @var string 
     */
    protected $borderSkipped = NULL;
    const POINT_STYLE_CIRCLE = "circle";
    const POINT_STYLE_CROSS_ROT = "crossRot";
    const POINT_STYLE_DASH = "dash";
    const POINT_STYLE_LINE = "line";
    const POINT_STYLE_RECT = "rect";
    const POINT_STYLE_RECT_ROUNDED = "rectRounded";
    const POINT_STYLE_RECT_ROT = "rectRot";
    const POINT_STYLE_STAR = "star";
    const POINT_STYLE_TRIANGLE = "triangle";
    const STEPPED_LINE_FALSE = false;
    const STEPPED_LINE_TRUE = false;
    const STEPPED_LINE_BEFORE = "before";
    const STEPPED_LINE_AFTER = "after";
    public function addDataItem($value, $configuration = [])
    {
        $this->data[] = $value;
        foreach ($configuration as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key}[] = $value;
            }
        }
        return $this;
    }
    public function setConfigurationDataSet($configuration = [])
    {
        foreach ($configuration as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
        return $this;
    }
    public function setLabel($label = "")
    {
        $this->label = $label;
        return $this;
    }
    public function setType($type = "line")
    {
        $this->type = $type;
        return $this;
    }
    public function setBorderDashOffset($borderDashOffset = 0)
    {
        $this->borderDashOffset = $borderDashOffset;
        return $this;
    }
    public function setBorderWidth($borderWidth = 0)
    {
        $this->borderWidth = $borderWidth;
        return $this;
    }
    public function setXAxisID($xAxisID = "")
    {
        $this->xAxisID = $xAxisID;
        return $this;
    }
    public function setYAxisID($yAxisID = "")
    {
        $this->yAxisID = $yAxisID;
        return $this;
    }
    public function setBorderCapStyle($borderCapStyle = "")
    {
        $this->borderCapStyle = $borderCapStyle;
        return $this;
    }
    public function setBorderJoinStyle($borderJoinStyle = "")
    {
        $this->borderJoinStyle = $borderJoinStyle;
        return $this;
    }
    public function setCubicInterpolationMode($cubicInterpolationMode = "")
    {
        $this->cubicInterpolationMode = $cubicInterpolationMode;
        return $this;
    }
    public function setFill($fill = "")
    {
        $this->fill = $fill;
        return $this;
    }
    public function setLineTension($lineTension = 0)
    {
        $this->lineTension = $lineTension;
        return $this;
    }
    public function setShowLine($showLine = true)
    {
        $this->showLine = $showLine;
        return $this;
    }
    public function setSpanGaps($spanGaps = true)
    {
        $this->spanGaps = $spanGaps;
        return $this;
    }
    public function setBorderSkipped($borderSkipped = true)
    {
        $this->borderSkipped = $borderSkipped;
        return $this;
    }
    public function setSteppedLine($steppedLine = self::STEPPED_LINE_FALSE)
    {
        if (in_array($steppedLine, [STEPPED_LINE_FALSE, STEPPED_LINE_TRUE, STEPPED_LINE_BEFORE, STEPPED_LINE_AFTER], true)) {
            $this->steppedLine = $steppedLine;
        }
        return $this;
    }
    public function toArray()
    {
        $return = [];
        foreach ($this as $key => $value) {
            if (property_exists($this, $key) && ($value !== NULL && !is_array($value) || is_array($value) && 0 < count($value))) {
                $return[$key] = $value;
            }
        }
        return $return;
    }
    public function setTitle($title = "")
    {
        $this->setLabel($title);
        return $this;
    }
    public function setData($data = [])
    {
        foreach ($data as $value) {
            $this->addDataItem($value, []);
        }
        return $this;
    }
}

?>