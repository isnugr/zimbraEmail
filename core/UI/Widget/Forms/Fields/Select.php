<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields;

/**
 * Select field controler
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class Select extends BaseField
{
    protected $id = "select";
    protected $name = "select";
    protected $multiple = false;
    protected $availableValues = [];
    protected $htmlAttributes = ["@change" => "selectChangeAction(\$event)"];
    public function setSelectedValue($value)
    {
        $this->value = $value;
        return $this;
    }
    public function setAvailableValues($values)
    {
        if (is_array($values)) {
            $this->availableValues = $values;
        }
        return $this;
    }
    public function getAvailableValues()
    {
        return $this->availableValues;
    }
    public function isMultiple()
    {
        return $this->multiple;
    }
    public function enableMultiple()
    {
        $this->multiple = true;
        return $this;
    }
    public function disableMultiple()
    {
        $this->multiple = false;
        return $this;
    }
}

?>