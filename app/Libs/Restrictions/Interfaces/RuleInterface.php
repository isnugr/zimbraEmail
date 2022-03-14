<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Restrictions\Interfaces;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 07.11.19
 * Time: 09:59
 * Class RuleInterface
 */
final class RuleInterface
{
    public abstract function isValid();
    public abstract function getMessage();
}

?>