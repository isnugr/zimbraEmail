<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Traits;

/**
 * Trait FormDataHandler
 * @package ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Traits
 */
interface FormDataHandler
{
    /**
     * @var array
     */
    protected $formData = [];
    public function getFormData();
    public function setFormData($formData);
    public function updateEntity($entity);
}

?>