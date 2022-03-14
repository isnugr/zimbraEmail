<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/**
 * Adds methods to handle requests form data
 * Requires using \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler
 */
interface RequestFormDataHandler
{
    /**
     * list of form data passed in formData variable
     * @var array
     */
    protected $formData = NULL;
    protected $actionElementId = NULL;
    protected function loadFormDataFromRequest();
    protected function getFormDataValues();
    protected function getActionElementIdValue();
    protected function getMassActionsValues();
}

?>