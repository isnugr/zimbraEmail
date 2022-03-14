<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Tasks;

class Manager
{
    public function __construct()
    {
    }
    public function run()
    {
        foreach ($this->getTasks() as $task) {
        }
    }
    protected function getTasks()
    {
        return \ModulesGarden\Servers\ZimbraEmail\Core\Models\Tasks\Tasks::get();
    }
}

?>