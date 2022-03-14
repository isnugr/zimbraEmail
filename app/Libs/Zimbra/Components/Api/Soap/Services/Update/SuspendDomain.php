<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Services\Update;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 10.10.19
 * Time: 15:20
 * Class SuspendDomain
 */
class SuspendDomain extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\ApiService
{
    public function isValid()
    {
        return self::isValid();
    }
    public function process()
    {
        $domain = $this->api->repository()->domains->getByName($this->formData["domain"]);
        if (!$domain) {
            $this->setError($this->api->domain->getError());
            return false;
        }
        $domain->setAttrs([\ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain::ATTR_DOMAIN_STATUS => \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::ACC_STATUS_SUSPEND, \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Domain::ATTR_MAIL_STATUS => \ModulesGarden\Servers\ZimbraEmail\App\Enums\Zimbra::DISABLED]);
        $response = $this->api->domain->update($domain);
        if (!$response) {
            $this->setError($this->api->domain->getError());
            return false;
        }
        return true;
    }
}

?>