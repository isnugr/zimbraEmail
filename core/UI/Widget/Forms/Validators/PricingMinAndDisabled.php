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
class PricingMinAndDisabled extends BaseValidator
{
    protected $vMin = 0;
    protected $vDisabled = -1;
    public function __construct($vMin = 0, $vDisabled = -1)
    {
        if (is_int($vMin) && 0 <= $vMin) {
            $this->vMin = (int) $vMin;
        }
        if (is_int($vDisabled)) {
            $this->vDisabled = (int) $vDisabled;
        }
    }
    protected function validate($data, $additionalData = NULL)
    {
        $fValue = (int) $data;
        if (is_numeric($data) && ($this->vMin < $fValue || $fValue === $this->vDisabled)) {
            return true;
        }
        $this->addValidationError($this->vMin === $this->vDisabled ? "PleaseProvideAPriceEqualOrHigher" : "PleaseProvideAPriceEqualOrHigherThan", false, ["minValue" => $this->vMin, "eqValue" => $this->vDisabled]);
        return false;
    }
}

?>