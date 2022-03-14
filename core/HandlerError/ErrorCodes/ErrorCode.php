<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes;

class ErrorCode
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    protected $code = NULL;
    protected $message = NULL;
    protected $token = NULL;
    protected $logable = false;
    public function __construct($code = NULL, $codeDetails = NULL, $token = NULL)
    {
        $this->setToken($token);
        $this->setCode($code);
        $this->setDetails($codeDetails);
    }
    public function setCode($code = NULL)
    {
        if (is_string($code)) {
            $this->code = $code;
        }
    }
    public function setMessage($message = NULL)
    {
        if (is_string($message) && $message !== "") {
            $this->message = $message;
        }
    }
    public function setToken($token = NULL)
    {
        if (is_string($token)) {
            $this->token = $token;
        }
    }
    public function getCode()
    {
        return $this->code === NULL ? "" : $this->code;
    }
    public function getToken()
    {
        return $this->token === NULL ? "" : $this->token;
    }
    public function getMessage()
    {
        return $this->message === NULL ? "" : $this->message;
    }
    public function getRawErrorMessage()
    {
        return "Error Code: " . ($this->getCode() ?: "none") . " Error Token: " . ($this->getToken() ?: "none") . "Error Message: " . $this->getMessage() ?: "none.";
    }
    public function setLogable($logable)
    {
        if (is_bool($logable)) {
            $this->logable = $logable;
        }
    }
    public function isLogable()
    {
        return $this->logable;
    }
    public function setDetails($codeDetails)
    {
        if (is_string($codeDetails)) {
            $this->setMessage($codeDetails);
        } else {
            $this->setMessage($codeDetails[ErrorCodes::MESSAGE]);
            $this->setLogable($codeDetails[ErrorCodes::LOG]);
        }
    }
}

?>