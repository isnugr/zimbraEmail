<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Filters;

/**
 * Description of Date
 *
 * @author inbs
 */
class Date extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Filters
{
    protected function loadFilter()
    {
        $records = $this->records;
        $date = strtotime($this->data);
        foreach ($records as $key => $item) {
            if (isset($data[$this->name])) {
                $value = strtotime($item[$this->name]);
                if ($value != $date) {
                    unset($this->records[$key]);
                }
            }
        }
    }
}

?>