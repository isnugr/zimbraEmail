<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable;

/**
 * Description of Filters
 *
 * @author inbs
 */
abstract class Filters
{
    protected $name = "";
    protected $data = NULL;
    protected $records = [];
    public function __construct($records = [], $name = "", $data = NULL)
    {
        $this->name = $name;
        $this->data = $data;
        $this->records = $records;
        $this->loadFilter();
    }
    protected abstract function loadFilter();
    public function getRecords()
    {
        return $this->records;
    }
    public static function create($records = [], $name = "", $data = NULL)
    {
        if (count($records) != 0) {
            $instance = new $this($records, $name, $data);
            $records = $instance->getRecords();
        }
        return $records;
    }
}

?>