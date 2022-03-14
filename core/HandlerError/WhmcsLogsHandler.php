<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\HandlerError;

/**
 * Handles adding new records to WHMCS Module and Activity Logs
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class WhmcsLogsHandler
{
    /**
     * @var Config
     */
    private $addon = NULL;
    /**
     * @var Request
     */
    private $request = NULL;
    public function __construct(\ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\Addon\Config $addon, \ModulesGarden\Servers\ZimbraEmail\Core\Http\Request $request)
    {
        $this->addon = $addon;
        $this->request = $request;
    }
    public function addModuleLog($responseData = [], $replaceVars = [])
    {
        if ($this->isDebugin()) {
            if (is_array($responseData) === false && is_object($responseData)) {
                $responseData = print_r($responseData, true);
            }
            logModuleCall($this->getModuleName(), $this->getFullAction(), $this->getRequestData(), $responseData, print_r($responseData, true), $replaceVars);
        }
        return $this;
    }
    public function addActiveLog($message, $userId = 0)
    {
        if ($this->isDebugin()) {
            if (is_string($message) === false) {
                $message = print_r($message, true);
            }
            logActivity($message, $userId);
        }
        return $this;
    }
    private function getRequestData()
    {
        return array_merge($this->request->request->all(), $this->request->query->all());
    }
    private function getModuleName()
    {
        return $this->addon->getConfigValue("name", "ZimbraEmail");
    }
    private function isDebugin()
    {
        return (int) (int) $this->addon->getConfigValue("debug", "0");
    }
    private function getFullAction()
    {
        return $this->request->get("mg-page", "Home") . $this->request->get("mg-action", "Index");
    }
    public function addModuleLogError(Exceptions\Exception $exception, $replaceVars = [])
    {
        $responseData = $exception->getOriginalException();
        if (!$exception->isLogable()) {
            return NULL;
        }
        if (is_object($responseData)) {
            $responseData = print_r(["message" => $responseData->getMessage(), "code" => $responseData->getCode(), "file" => $responseData->getFile(), "line" => $responseData->getLine(), "trace" => $responseData->getTraceAsString()], true);
        }
        if (!$responseData) {
            $responseData = ["message" => $exception->getMgMessage(false), "trace" => $exception->getTraceAsString()];
        }
        logModuleCall($this->getModuleName(), $this->getFullAction(), ["deteils" => $exception->getDetailsToLog(), "request" => $this->getRequestData()], $responseData, print_r($responseData, true), $replaceVars);
        return $this;
    }
}

?>