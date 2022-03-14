<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Api;

/**
 * Description of AbstractApi
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class AbstractApi
{
    protected $token = NULL;
    protected $code = NULL;
    protected function getNewRequest()
    {
        return \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::create("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Api\\AbstractApi\\Curl\\Request");
    }
}

?>