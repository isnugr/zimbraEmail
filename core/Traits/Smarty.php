<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Traits;

interface Smarty
{
    /**
     * @var null|\ModulesGarden\Servers\ZimbraEmail\Core\Http\View\Smarty
     */
    protected $smarty = NULL;
    public function loadSmarty();
    public function getSmarty();
}

?>