<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Filters;

/**
 * Description of YesNo
 *
 * @author inbs
 */
class YesNo extends \ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\DataTable\Filters
{
    protected function loadFilter()
    {
        $records = $this->records;
        foreach ($records as $key => $data) {
            if (isset($data[$this->name]) && (int) $data[$this->name] != (int) $this->data) {
                unset($this->records[$key]);
            }
        }
    }
}

?>