<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Services\Delete;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 02.10.19
 * Time: 08:23
 * Class DeleteDistributionList
 */
class DeleteDistributionList extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\ApiService
{
    public function isValid()
    {
        if (!$this->formData["id"]) {
            $this->setError("Account Id name can not be found.");
            return false;
        }
        return self::isValid();
    }
    public function process()
    {
        $list = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\DistributionList();
        $list->setId($this->formData["id"]);
        $result = $this->api->distributionList->delete($list);
        if (!$result) {
            $this->setError($this->api->distributionList->getError());
            return false;
        }
        return true;
    }
}

?>