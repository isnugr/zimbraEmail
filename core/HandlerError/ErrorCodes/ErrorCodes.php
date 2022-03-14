<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes;

abstract class ErrorCodes
{
    const MESSAGE = "message";
    const LOG = "log";
    const CODE = "code";
    const DEV_MESSAGE = "dev_message";
    public function getErrorMessageByCode($code = NULL, $errorToken = NULL)
    {
        $constantName = get_class($this) . "::" . $code;
        if (!defined($constantName)) {
            return $this->getUndefinedErrorMessage($code, $errorToken);
        }
        return $this->getErrorCode($code, constant($constantName), $errorToken);
    }
    public function getUndefinedErrorMessage($code = NULL, $errorToken = NULL)
    {
        return $this->getErrorCode($code, "Invalid Error Code!", $errorToken);
    }
    protected function getErrorCode($code = NULL, $message = NULL, $token = NULL)
    {
        $token = new ErrorCode($code, $message, $token ?: $this->genToken());
        return $token;
    }
    protected function genToken()
    {
        return md5(time());
    }
    public function errorCodeExists($code = NULL)
    {
        $constantName = get_class($this) . "::" . $code;
        if (!defined($constantName)) {
            return false;
        }
        return true;
    }
}

?>