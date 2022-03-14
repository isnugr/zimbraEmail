<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Filters;

/**
 * Description of RageDate
 *
 * @author inbs
 */
class RageDate extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Filters
{
    protected function loadFilter()
    {
        $records = $this->records;
        $from = isset($this->data["from"]) ? strtotime($this->data["from"]) : NULL;
        $to = isset($this->data["to"]) ? strtotime($this->data["to"]) : NULL;
        foreach ($records as $key => $item) {
            if (isset($data[$this->name])) {
                $value = strtotime($item[$this->name]);
                if (isset($from) && $value < $from || isset($to) && $to < $value) {
                    unset($this->records[$key]);
                }
            }
        }
    }
}

?>