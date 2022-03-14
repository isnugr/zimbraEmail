<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable;

/**
 * Description of Configuration
 *
 * @author inbs
 */
class Column
{
    protected $id = NULL;
    protected $name = NULL;
    protected $title = NULL;
    protected $rawTitle = NULL;
    protected $filter = NULL;
    protected $type = self::TYPE_STRING;
    protected $class = NULL;
    protected $orderable = false;
    protected $searchable = false;
    protected $orderableClass = "";
    protected $customJsDrawFunction = NULL;
    protected $tableName = NULL;
    const TYPE_INT = "int";
    const TYPE_STRING = "string";
    const TYPE_DATE = "date";
    public function __construct($name, $tableName = NULL)
    {
        $this->name = $name;
        $this->id = $name;
        $this->class = "";
        $this->title = $name;
        if ($tableName) {
            $this->tableName = $tableName;
        }
        return $this;
    }
    public function setOrderable($isOrderable = true)
    {
        $allowed = [true, false, DataProviders\DataProvider::SORT_ASC, DataProviders\DataProvider::SORT_DESC];
        if (in_array($isOrderable, $allowed)) {
            $this->orderable = $isOrderable;
            $this->orderableClass = $this->getOrderableClass($isOrderable);
        }
        return $this;
    }
    public function setSearchable($isSearchable, $type = self::TYPE_STRING)
    {
        $this->searchable = (int) $isSearchable;
        $this->setType($type);
        return $this;
    }
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }
    public function setRawTitle($title)
    {
        $this->rawTitle = $title;
        return $this;
    }
    public function setFilter(Filters $filter)
    {
        $this->filter = $filter;
        return $this;
    }
    public function setClass($className)
    {
        $this->class = $className;
        return $this;
    }
    public function setType($type)
    {
        $allowed = [TYPE_STRING, TYPE_DATE, TYPE_INT];
        $this->type = in_array($type, $allowed) ? $type : TYPE_STRING;
        return $this;
    }
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }
        return NULL;
    }
    public function getOrderableClass($order)
    {
        if ($order === true) {
            return "sorting";
        }
        $allowed = [DataProviders\DataProvider::SORT_ASC => "sorting_asc", DataProviders\DataProvider::SORT_DESC => "sorting_desc"];
        return $allowed[$order] ?: "";
    }
    public function setCustomJsDrawFunction($functionName)
    {
        $this->customJsDrawFunction = $functionName;
        return $this;
    }
    public function getCustomJsDrawFunction()
    {
        return $this->customJsDrawFunction;
    }
    public function setTableName($tableName)
    {
        if ($tableName) {
            $this->tableName = $tableName;
        }
        return $this;
    }
    public function getTableName()
    {
        return $this->tableName;
    }
    public function getFullName($wrapped = true)
    {
        $vWrapp = $wrapped ? "`" : "";
        if ($this->tableName) {
            return $vWrapp . $this->tableName . $vWrapp . "." . $vWrapp . $this->name . $vWrapp;
        }
        return $vWrapp . $this->name . $vWrapp;
    }
}

?>