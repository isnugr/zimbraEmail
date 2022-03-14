<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Fields Elements related functions
 *
 * @author Sławomir Miśkowicz <slawomir@modulesgarden.com>
 */
interface Fields
{
    /**
     * Fields List
     * @var Array
     */
    protected $fields = [];
    /**
     * List of validation errors
     * @var Array
     */
    protected $validationErrors = [];
    public function addField(\ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Forms\Fields\BaseField $field);
    protected function initFieldsContainer();
    public function getField($fieldId);
    public function getFields();
    public function validateFields($request);
    protected function convertStringToValue($name, $formData);
    public function getValidationErrors();
    public function removeField($fieldId);
}

?>