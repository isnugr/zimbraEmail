<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Traits;

interface Lang
{
    /**
     * @var null|\ModulesGarden\Servers\ZimbraEmail\Core\Lang\Lang
     */
    protected $lang = NULL;
    public function loadLang();
}

?>