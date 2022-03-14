<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Validators;

/**
 * IsNumberBetween form data validator
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class IsIntNumberBetween extends BaseValidator
{
    protected $minValue = 0;
    protected $maxValue = 0;
    public function __construct($min = 0, $max = 0)
    {
        $this->minValue = (int) $min;
        $this->maxValue = (int) $max;
    }
    protected function validate($data, $additionalData = NULL)
    {
        if (is_numeric($data) && $this->minValue === 0 && $this->maxValue === 0) {
            return true;
        }
        if (is_numeric($data) && $this->minValue <= (int) $data && (int) $data <= $this->maxValue) {
            return true;
        }
        if ($this->minValue === $this->maxValue) {
            $this->addValidationError("PleaseProvideANumericValue");
            return false;
        }
        $this->addValidationError("PleaseProvideANumericValueBetween", false, ["minValue" => $this->minValue, "maxValue" => $this->maxValue]);
        return false;
    }
}

?>