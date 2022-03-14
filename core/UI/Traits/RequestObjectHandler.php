<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

/** 
 * Adds methods to handle requests data
 */
interface RequestObjectHandler
{
    /** 
     * request object variable
     * @var \ModulesGarden\Servers\ZimbraEmail\Core\Http\Request
     */
    protected $request = NULL;
    protected function loadRequestObj();
    public function getRequestValue($key, $defaultValue);
}

?>