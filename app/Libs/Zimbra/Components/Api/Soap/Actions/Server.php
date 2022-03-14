<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Actions;

class Server extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractAction
{
    public function getAllServers()
    {
        $result = $this->connection->request("GetAllServersRequest");
        $body = $result->getResponseBody();
        return $body["GETALLSERVERSRESPONSE"]["SERVER"];
    }
}

?>