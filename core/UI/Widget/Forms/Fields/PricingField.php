<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields;

/**
 * BaseField controler
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class PricingField extends BaseField
{
    protected $id = "pricingField";
    protected $name = "pricingField";
    protected $availableValues = "";
    public function setSelectedValue($value)
    {
        $this->value = $value;
        return $this;
    }
    public function setAvailableValues($values)
    {
        $this->availableValues = $values;
        return $this;
    }
    public function getAvailableValues()
    {
        return $this->availableValues;
    }
}

?>