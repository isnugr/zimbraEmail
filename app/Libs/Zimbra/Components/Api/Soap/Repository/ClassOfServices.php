<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Repository;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 29.08.19
 * Time: 08:27
 * Class ClassOfServices
 */
class ClassOfServices extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\AbstractRepository
{
    const CUSTOM_ZIMBRA = "customMGzimbra";
    const ZIMBRA_CONFIG_OPTIONS = "zimbraConfigurableOptions";
    const CLASS_OF_SERVICE_QUOTA = "cosQuota";
    public function all()
    {
        $result = $this->getClient()->classOfServices->getAllCos();
        foreach ($result as $item) {
            $cos = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\ClassOfService($item);
            $tmp[$cos->getId()] = $cos;
        }
        return $tmp;
    }
    public function asArrayList()
    {
        $result = $this->getClient()->classOfServices->getAllCos();
        foreach ($result as $item) {
            $tmp[] = $item["NAME"];
        }
        return $tmp;
    }
    public function byName($name)
    {
    }
    public function byId($id)
    {
    }
}

?>