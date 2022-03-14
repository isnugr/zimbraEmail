<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Traits;

/**
 * Class ApiClientHandler
 * User: Nessandro
 * Date: 2019-10-01
 * Time: 07:52
 */
interface ApiClientHandler
{
    /**
     * @var Client
     */
    protected $api = NULL;
    public function setApi(\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Client $api);
    public function getApi();
}

?>