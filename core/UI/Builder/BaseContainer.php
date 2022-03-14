<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Builder;

/**
 * Base Container element. Every UI element should extend this.
 *
 * @author inbs
 */
class BaseContainer extends Context
{
    protected $data = [];
    public function setData($data = [])
    {
        $this->data = $data;
        $this->updateData();
        return $this;
    }
    public function getData()
    {
        return $this->data;
    }
    protected function updateData()
    {
        foreach ($this->data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
        $this->data = [];
        return $this;
    }
}

?>