<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Fields related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface Field
{
    protected $fieldData = [];
    protected $value = NULL;
    protected $defaultValue = NULL;
    protected $description = NULL;
    protected $disabled = false;
    protected $validators = [];
    protected $width = 8;
    protected $labelWidth = 4;
    protected $placeholder = NULL;
    protected $validationErrors = [];
    public function setDescription($description);
    public function getDescription();
    public function setValue($value);
    public function getValue();
    protected function setFieldData($data);
    public function getFieldData();
    public function disableField();
    protected function enableField();
    public function isDisabled();
    public function getValidationErrors();
    public function addValidator($validator);
    public function isValueValid($data, $additionalData);
    public function getWidth();
    public function setWidth($width);
    public function getLabelWidth();
    public function setLabelWidth($width);
    public function setPlaceholder($placeholder);
    public function getPlaceholder();
    public function notEmpty();
    public function isIntNumberBetween($min, $max);
    public function setDecimal($mValue, $dValue);
    public function setPricingMinimalValues($vMin, $vDisabled);
    public function setDefaultValue($value);
    public function getDefaultValue();
    public function addGroupName($groupName);
}

?>