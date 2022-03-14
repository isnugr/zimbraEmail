<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\ResponseTemplates;

/**
 *  Abstract Ajax Response Model
 */
abstract class Response
{
    protected $status = self::STATUS_SUCCESS;
    protected $data = [];
    protected $message = NULL;
    protected $dataType = "data";
    protected $callBackFunction = NULL;
    protected $refreshTargetId = [];
    protected $customParams = [];
    protected $lang = NULL;
    const STATUS_SUCCESS = "success";
    const STATUS_ERROR = "error";
    public function __construct($data = [])
    {
        $this->data = $data;
    }
    public function setStatusSuccess()
    {
        $this->status = STATUS_SUCCESS;
        return $this;
    }
    public function setRefreshTargetIds($targetIds = [])
    {
        $this->refreshTargetId = $targetIds;
        return $this;
    }
    public function addRefreshTargetId($targetId)
    {
        if (in_array($targetId, $this->refreshTargetId, true) === false) {
            $this->refreshTargetId[] = $targetId;
        }
        return $this;
    }
    public function setStatusError()
    {
        $this->status = STATUS_ERROR;
        return $this;
    }
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    public function addData($key, $data)
    {
        $this->data[$key] = $data;
        return $this;
    }
    public function setCallBackFunction($name)
    {
        $this->callBackFunction = $name;
        return $this;
    }
    public function disableCallBackFunction()
    {
        $this->callBackFunction = NULL;
        return $this;
    }
    public function getData()
    {
        $return = ["status" => $this->status, "message" => $this->message, $this->dataType => $this->data, "refreshIds" => $this->refreshTargetId, "customParams" => $this->customParams];
        if ($this->callBackFunction) {
            $return["callBackFunction"] = $this->callBackFunction;
        }
        return $return;
    }
    public function getFormatedResponse()
    {
        return ModulesGarden\Servers\ZimbraEmail\Core\Helper\json($this->getData())->setStatusCode(200);
    }
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
    protected function loadLang()
    {
        if ($this->lang === NULL) {
            $this->lang = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("lang");
        }
    }
    public function setMessageAndTranslate($message)
    {
        $this->loadLang();
        $this->message = $this->lang->absoluteT($message);
        return $this;
    }
    public function setCustomParam($key, $value)
    {
        $this->customParams[$key] = $value;
        return $this;
    }
}

?>