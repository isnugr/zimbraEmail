<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Api\AbstractApi;

/**
 * Description of Parser
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Parser implements \ModulesGarden\Servers\ZimbraEmail\Core\Interfaces\CurlParser
{
    public function rebuild($head, $size)
    {
        return [substr($head, 0, $size), substr($head, $size)];
    }
}

?>