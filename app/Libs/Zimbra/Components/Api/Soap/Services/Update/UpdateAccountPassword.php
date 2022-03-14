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
 * Date: 08.11.19
 * Time: 12:15
 * Class UpdateAccountPassword
 */
class UpdateAccountPassword extends \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Interfaces\ApiService
{
    use \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Traits\ProductManagerHandler;
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
        $model = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Models\Account();
        $model->setId($this->formData["id"]);
        $model->setPassword($this->formData["password"]);
        $result = $this->api->account->setPassword($model);
        if (!$result) {
            $this->setError($this->api->account->getError());
            return false;
        }
        return true;
    }
}

?>