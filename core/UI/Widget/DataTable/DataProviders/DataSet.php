<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\DataProviders;

class DataSet implements \ModulesGarden\Servers\ZimbraEmail\Core\UI\Interfaces\DataSetInterface
{
    public $offset = 0;
    public $fullDataLenght = 0;
    public $records = [];
    public function getOffset()
    {
        return $this->offset;
    }
    public function getRecords()
    {
        return $this->records;
    }
    public function getLenght()
    {
        return count($this->records);
    }
    public function getFullLenght()
    {
        return $this->fullDataLenght;
    }
}

?>