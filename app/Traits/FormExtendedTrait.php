<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Traits;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 08.11.19
 * Time: 14:20
 * Class FormExtendedTrait
 */
interface FormExtendedTrait
{
    protected $sectionCounter = 0;
    protected function generateDoubleSection($fields);
}

?>