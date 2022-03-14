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
class Data
{
    protected $labels = [];
    /**
     * @var DataSet[] 
     */
    protected $datasets = [];
    public function __construct($labels = [], $datasets = [])
    {
        $this->labels = $labels;
        $this->datasets = $datasets;
    }
    public function addLabel($label = "")
    {
        $this->labels[] = $label;
        return $this;
    }
    public function setLabels($labels = [])
    {
        $this->labels = $labels;
        return $this;
    }
    public function addDataSet(DataSet $dataset)
    {
        $this->datasets[] = $dataset;
        return $this;
    }
    public function setDataSets($dataSets = [])
    {
        $this->datasets = $dataSets;
        return $this;
    }
    public function toArray()
    {
        $return = ["labels" => $this->labels, "datasets" => []];
        foreach ($this->datasets as $dataset) {
            $return["datasets"][] = $dataset->toArray();
        }
        return $return;
    }
}

?>