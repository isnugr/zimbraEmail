<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Api;

class Whmcs
{
    /**
     * @var Admins
     */
    protected $admins = NULL;
    /**
     * @var string
     */
    protected $username = NULL;
    public function __construct(\ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\Admins $admins)
    {
        $this->admins = $admins;
        $this->getAdminUserName();
        if (function_exists("localAPI") === false) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(\ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCodesLib::CORE_WAPI_000001);
        }
    }
    protected function getAdminUserName()
    {
        if (isset($this->username) === false) {
            $this->username = $this->admins->first()->toArray()["username"];
        }
        return $this->username;
    }
    public function call($command, $config = [])
    {
        $result = localAPI($command, $config, $this->getAdminUserName());
        if ($result["result"] == "error") {
            $exc = new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(\ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCodesLib::CORE_WAPI_000002, ["command" => $command, "data" => $config, "result" => $result]);
            $exc->setCustomMessage($result["message"]);
            throw $exc;
        }
        unset($result["result"]);
        return $result;
    }
    public function getAdminDetails($adminId)
    {
        $data = $this->admins->where("id", "LIKE", $adminId)->first();
        if ($data === NULL) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(\ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCodesLib::CORE_WAPI_000003, ["adminId" => $adminId], ["adminId" => $adminId]);
        }
        $result = localAPI("getadmindetails", [], $data->toArray()["username"]);
        if ($result["result"] == "error") {
            $exc = new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(\ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCodesLib::CORE_WAPI_000004, ["command" => "getadmindetails", "data" => [], "result" => $result]);
            $exc->setCustomMessage($result["message"]);
            throw $exc;
        }
        $result["allowedpermissions"] = explode(",", $result["allowedpermissions"]);
        unset($result["result"]);
        return $result;
    }
}

?>