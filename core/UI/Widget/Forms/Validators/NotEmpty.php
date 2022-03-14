<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Validators;

/**
 * NotEmpty form data validator
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
class NotEmpty extends BaseValidator
{
    protected function validate($data, $additionalData = NULL)
    {
        if (is_array($data) && 0 < count($data)) {
            return true;
        }
        if (is_string($data) && 0 < strlen(trim($data)) || is_numeric($data)) {
            return true;
        }
        $this->addValidationError("thisFieldCannotBeEmpty");
        return false;
    }
}

?>