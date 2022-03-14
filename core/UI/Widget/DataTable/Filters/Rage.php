<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Filters;

/**
 * Description of Rage
 *
 * @author inbs
 */
class Rage extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Filters
{
    protected function loadFilter()
    {
        $records = $this->records;
        $from = isset($this->data["from"]) && is_numeric($this->data["from"]) ? (int) $this->data["from"] : NULL;
        $to = isset($this->data["to"]) && is_numeric($this->data["to"]) ? (int) $this->data["to"] : NULL;
        foreach ($records as $key => $item) {
            if (isset($data[$this->name])) {
                $value = is_numeric($item[$this->name]) ? (int) $item[$this->name] : NULL;
                if (isset($value) && (isset($from) && $value < $from || isset($to) && $to < $value)) {
                    unset($this->records[$key]);
                }
            }
        }
    }
}

?>