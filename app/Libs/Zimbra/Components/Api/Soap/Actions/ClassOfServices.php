<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Actions;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 05.09.19
 * Time: 13:27
 * Class ClassOfServices
 */
class ClassOfServices extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractAction
{
    public function getAllCos()
    {
        $result = $this->connection->request("GetAllCosRequest");
        $body = $result->getResponseBody();
        return $body["GETALLCOSRESPONSE"]["COS"];
    }
    public function getClassOfServiceName($id)
    {
        $params = [new \SoapVar("<ns1:cos by=\"id\">" . $id . "</ns1:cos>", XSD_ANYXML)];
        $this->connection->request("GetCosRequest", $params);
    }
    public function getCosId($name)
    {
        $params = [new \SoapVar("<ns1:cos by=\"name\">" . $name . "</ns1:cos>", XSD_ANYXML)];
        $this->connection->request("GetCosRequest", $params);
    }
}

?>