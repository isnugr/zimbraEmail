<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders;

/**
 *
 */
abstract class DataProvider
{
    protected $limit = 10;
    protected $offset = 0;
    protected $data = NULL;
    protected $orderColumn = NULL;
    protected $orderDir = NULL;
    protected $request = NULL;
    protected $avalibleCols = NULL;
    protected $filter = [];
    protected $records = [];
    protected $filterFields = [];
    protected $toSearch = NULL;
    private $response = NULL;
    protected $customSearch = false;
    protected $defaultOrderColumn = NULL;
    protected $defaultOrderDir = NULL;
    const FILTR_BY_DATE = "\\ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\DataTable\\Filters\\Date";
    const FILTR_BY_RAGE = "\\ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\DataTable\\Filters\\Rage";
    const FILTR_BY_RAGE_DATE = "\\ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\DataTable\\Filters\\RageDate";
    const FILTR_BY_SELECT = "\\ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\DataTable\\Filters\\Select";
    const FILTR_BY_TEXT = "\\ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\DataTable\\Filters\\Text";
    const FILTR_BY_YESNO = "\\ModulesGarden\\Servers\\ZimbraEmail\\Core\\UI\\Widget\\DataTable\\Filters\\YesNo";
    const SORT_ASC = "ASC";
    const SORT_DESC = "DESC";
    public function __construct()
    {
        $this->request = \ModulesGarden\Servers\ZimbraEmail\Core\Http\Request::build();
        $this->response = new DataSet();
        $this->loadLimits();
        $this->loadSortings();
        $this->loadFilter();
        $this->loadSearch();
    }
    protected function loadLimits()
    {
        if ($this->request->query->get("iDisplayLength")) {
            $this->setLimit((int) $this->request->query->get("iDisplayLength"));
        }
        if ($this->request->query->get("iDisplayStart")) {
            $this->setOfset((int) $this->request->query->get("iDisplayStart"));
        }
    }
    protected function loadSortings()
    {
        if ($this->request->query->get("iSortCol_0") && $this->request->query->get("sSortDir_0")) {
            $this->setSortBy($this->request->query->get("iSortCol_0"));
            $this->setSortDir($this->request->query->get("sSortDir_0"));
        }
    }
    protected function loadSearch()
    {
        if ($this->request->query->get("sSearch")) {
            $this->setSearch(html_entity_decode($this->request->query->get("sSearch"), ENT_QUOTES));
        }
    }
    protected function loadFilter()
    {
        $filters = $this->request->query->get("filter", []);
        foreach ($filters as $filter) {
            $this->addFilter($filter["name"], $filter["data"]);
        }
        return $this;
    }
    protected function addFilter($key, $data = NULL)
    {
        if (isset($data)) {
            array_set($this->filter, $key, $data);
        }
        return $this;
    }
    public function setLimit($limit)
    {
        $this->limit = (int) $limit;
    }
    public function setSearch($toSearch)
    {
        $this->toSearch = $toSearch;
    }
    protected function useSearch($data = [])
    {
        if ($this->toSearch && str_replace(" ", "", $this->toSearch) != "" && $this->customSearch === false) {
            $searchable = [];
            foreach ($this->avalibleCols as $column) {
                if ($column->searchable === true) {
                    $searchable[] = $column->name;
                }
            }
            $removeIds = [];
            foreach ($data as $id => $record) {
                $isFind = false;
                foreach ($record as $fieldKey => $fieldData) {
                    if (strpos(strtolower(str_replace(" ", "", $fieldData)), strtolower(str_replace(" ", "", $this->toSearch))) !== false && in_array($fieldKey, $searchable)) {
                        $isFind = true;
                        if ($isFind === false) {
                            $removeIds[] = $id;
                        }
                    }
                }
            }
            if (is_object($data)) {
                foreach ($removeIds as $id) {
                    unset($data->{$id});
                }
            } else {
                foreach ($removeIds as $id) {
                    unset($data[$id]);
                }
            }
        }
        return $data;
    }
    public function setOfset($offset)
    {
        $this->offset = (int) $offset;
    }
    public function setData($data = [])
    {
        $this->data = $data;
        return $this;
    }
    public function setSortBy($colName)
    {
        $this->orderColumn = $colName;
    }
    public function setSortDir($sortDir)
    {
        $this->orderDir = $sortDir;
    }
    public function getData($avalibleCols = [])
    {
        $this->avalibleCols = $avalibleCols;
        $this->data = $this->useSearch($this->data);
        $this->records = $this->data;
        $this->response->fullDataLenght = count($this->records);
        $this->sortData();
        $this->addLimit($this->records);
        $this->response->offset = $this->offset;
        $this->response->records = $this->records;
        return $this->response;
    }
    protected function sortData()
    {
        if ($this->orderColumn && $this->orderDir && $this->avalibleCols[$this->orderColumn]) {
            $column = $this->avalibleCols[$this->orderColumn];
            $this->sortNow($this->orderColumn, $column->type, strtolower($this->orderDir) === strtolower("ASC"));
        }
    }
    protected function addLimit($data)
    {
        $data = array_slice($data, $this->offset, $this->limit);
    }
    protected function useSort()
    {
        foreach ($this->sort as $field => $sort) {
            $this->sortNow($field, $this->getType($field), strtolower($sort) === strtolower("ASC"));
        }
        return $this;
    }
    protected function sortNow($fieldName, $type, $asc)
    {
        if ($type == "string") {
            usort($this->records, function ($a, $b) {
                if ($asc) {
                    return strcmp(strtolower($a[$fieldName]), strtolower($b[$fieldName]));
                }
                return strcmp(strtolower($b[$fieldName]), strtolower($a[$fieldName]));
            });
        } else {
            if ($type == "int") {
                usort($this->records, function ($a, $b) {
                    if ($a[$fieldName] == $b[$fieldName]) {
                        $return = 0;
                    } else {
                        if ($a[$fieldName] != $b[$fieldName] && $asc) {
                            $return = $a[$fieldName] < $b[$fieldName] ? -1 : 1;
                        } else {
                            $return = $b[$fieldName] < $a[$fieldName] ? -1 : 1;
                        }
                    }
                    return $return;
                });
            } else {
                if ($type == "date") {
                    usort($this->records, function ($a, $b) {
                        $a = strtotime($a[$fieldName]);
                        $b = strtotime($b[$fieldName]);
                        if ($a == $b) {
                            $return = 0;
                        } else {
                            if ($a != $b && $asc) {
                                $return = $a < $b ? -1 : 1;
                            } else {
                                $return = $b < $a ? -1 : 1;
                            }
                        }
                        return $return;
                    });
                } else {
                    foreach ($this->sortFunction as $typeCallBack => $callback) {
                        if ($typeCallBack == $type) {
                            usort($this->records, $callback);
                        }
                    }
                }
            }
        }
    }
    protected function addSortFunction($type, $callback)
    {
        array_set($this->sortFunction, $type, $callback);
        return $this;
    }
    private function setType($field, $type = self::TYPE_STRING)
    {
        array_set($this->type, $field, $type);
        return $this;
    }
    protected function getType($field)
    {
        if (array_key_exists($field, $this->type)) {
            return $this->type[$field];
        }
        return "string";
    }
    private function addFilterField($field, $class = self::FILTR_BY_TEXT)
    {
        array_set($this->filterFields, $field, $class);
        return $this;
    }
    protected function useFilter()
    {
        foreach ($this->filter as $field => $value) {
            if (isset($this->filterFields[$field])) {
                $class = $this->filterFields[$field];
                $this->setData($class::create($this->getRecords(), $field, $value));
            } else {
                $this->setData(Filters\Text::create($this->getRecords(), $field, $value));
            }
        }
        return $this;
    }
    public function setDefaultSorting($column, $direction)
    {
        if (!$this->request->query->get("iSortCol_0") && !$this->request->query->get("sSortDir_0")) {
            $this->setSortBy($column);
            $this->setSortDir($direction);
        }
        return $this;
    }
    public function enableCustomSearch()
    {
        $this->customSearch = true;
    }
}

?>