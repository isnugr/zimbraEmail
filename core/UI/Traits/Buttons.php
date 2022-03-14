<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits;

interface Buttons
{
    protected $buttons = [];
    public function addButton($button);
    public function insertButton($buttonId);
    public function getButtons();
    public function getButtonsCount();
}

?>