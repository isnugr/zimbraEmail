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
class Decimal extends BaseValidator
{
    protected $mValue = 10;
    protected $dValue = 2;
    public function __construct($mValue = 10, $dValue = 2)
    {
        if (is_int($mValue) && 0 < $mValue) {
            $this->mValue = (int) $mValue;
        }
        if (is_int($dValue) && 0 <= $dValue && $dValue <= 30 && $dValue <= $this->mValue) {
            $this->dValue = (int) $dValue;
        }
    }
    protected function validate($data, $additionalData = NULL)
    {
        if (!is_numeric($data)) {
            $this->addValidationError("PleaseProvideANumericValue");
            return false;
        }
        $stringData = trim((int) $data, "-");
        $brake = strpos($stringData, ".");
        $lenght = strlen($stringData);
        if ($lenght - 1 <= $this->mValue && $lenght <= $brake + 1 + $this->dValue) {
            return true;
        }
        $this->addValidationError("PleaseProvideANumericValue");
        return false;
    }
}

?>