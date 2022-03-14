<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions;

/**
 * Base module Exception type
 *
 * @author Sławomir Miśkowicz <rafal.os@modulesgarden.com>
 */
class Exception extends \Exception
{
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\ErrorCodesLibrary;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\Lang;
    use \ModulesGarden\Servers\ZimbraEmail\Core\Traits\IsDebugOn;
    use \ModulesGarden\Servers\ZimbraEmail\Core\UI\Traits\RequestObjectHandler;
    /**
     * An error code object
     * 
     * @var type \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCode
     */
    protected $errorCode = NULL;
    /** 
     * Every Exception which can be caught as \Exception
     * @var type \Exception
     */
    protected $originalException = NULL;
    /** 
     * An array of additionall data that will be logged with the Exception in order to help debug
     * @var type array
     */
    protected $additionalData = [];
    /** 
     * An array of strings to be replaced in translate process, eg. for message:
     * "An error :xyz: occured" in order to replace key ':xyz:' with a '123' set this
     * param to: ['xyz' => '123']
     * 
     * @var type array
     */
    protected $toTranslate = [];
    /** 
     * This is a way to replace standard ErrorCode message, use it when no original exception
     * is present and the ErrorCode message, needs to be replaced, eg. API string error responses
     * 
     * @var type string
     */
    protected $customMessage = NULL;
    const DEFAULT_ERROR_CODE = "CORE_ERR_000001";
    public function __construct($errorCode = NULL, $additionalData = NULL, $toTranslate = NULL, $originalException = NULL)
    {
        $this->errorCode = $this->genErrorCode($errorCode ?: DEFAULT_ERROR_CODE);
        $this->setAdditionalData($additionalData);
        $this->setToTranslate($toTranslate);
        $this->setOriginalException($originalException);
    }
    public function getMgCode()
    {
        return $this->errorCode->getCode();
    }
    public function getMgToken()
    {
        return $this->errorCode->getToken();
    }
    public function getMgTime()
    {
        return date("Y-m-d H:i:s", time());
    }
    public function getMgMessage($translate = true)
    {
        if ($translate) {
            $this->loadLang();
            $message = $this->lang->absoluteTranslate($this->errorCode === DEFAULT_ERROR_CODE ? "errorMessage" : "errorCodeMessage", $this->selectProperMessage());
        } else {
            $message = $this->selectProperMessage();
        }
        return $this->replaceMessageVars($message);
    }
    public function replaceMessageVars($message)
    {
        foreach ($this->toTranslate as $key => $value) {
            $message = str_replace(":" . $key . ":", $value, $message);
        }
        return $message;
    }
    public function getOriginalException()
    {
        return $this->originalException;
    }
    public function getDetailsToDisplay()
    {
        $errorDetails = [];
        if ($this->isDebugOn() && $this->isAdminLogedIn()) {
            $errorDetails["errorCode"] = $this->getMgCode();
            $errorDetails["errorToken"] = $this->getMgToken();
            $errorDetails["errorTime"] = $this->getMgTime();
        }
        $errorDetails["errorMessage"] = $this->getMgMessage(true);
        return $errorDetails;
    }
    public function getDetailsToLog()
    {
        $errorDetails = [];
        $errorDetails["errorCode"] = $this->getMgCode();
        $errorDetails["errorToken"] = $this->getMgToken();
        $errorDetails["errorTime"] = $this->getMgTime();
        $errorDetails["errorMessage"] = $this->getMgMessage(false);
        $errorDetails["additionalData"] = $this->getAdditionalData();
        return $errorDetails;
    }
    protected function selectProperMessage()
    {
        if (is_string($this->customMessage)) {
            return $this->customMessage;
        }
        if ($this->originalException !== NULL) {
            return $this->originalException->getMessage();
        }
        return $this->errorCode->getMessage();
    }
    public function setOriginalException($originalException)
    {
        if ($originalException instanceof \Exception) {
            $this->originalException = $originalException;
            parent::__construct($originalException->getMessage(), $originalException->getCode(), $originalException->getPrevious());
        }
    }
    public function setAdditionalData($data = [])
    {
        if (is_array($data)) {
            $this->additionalData = $data;
        }
        return $this;
    }
    public function getAdditionalData()
    {
        return $this->additionalData;
    }
    public function setToTranslate($data = [])
    {
        if (is_array($data)) {
            $this->toTranslate = $data;
        }
        return $this;
    }
    public function setCustomMessage($message = NULL)
    {
        if (is_string($message) && $message !== "") {
            $this->customMessage = $message;
        }
        return $this;
    }
    public function isLogable()
    {
        if ($this->errorCode->isLogable()) {
            return true;
        }
        if ($this->isAdminLogedIn() && $this->isDebugOn()) {
            return true;
        }
        return false;
    }
    public function isAdminLogedIn()
    {
        $this->loadRequestObj();
        $adminId = $this->request->getSession("adminid");
        if (is_int($adminId) && 0 < $adminId) {
            return true;
        }
        return false;
    }
}

?>