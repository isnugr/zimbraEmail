<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields;

/**
 * Number Field controler
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class Number extends BaseField
{
    protected $id = "number";
    protected $name = "number";
    protected $maxValue = NULL;
    protected $minValue = NULL;
    public function __construct($minValue = NULL, $maxValue = NULL)
    {
        parent::__construct();
        $this->minValue = $minValue;
        $this->maxValue = $maxValue;
        $this->isIntNumberBetween($this->minValue, $this->maxValue);
    }
    public function getMinValue()
    {
        return $this->minValue;
    }
    public function getMaxValue()
    {
        return $this->maxValue;
    }
}

?>