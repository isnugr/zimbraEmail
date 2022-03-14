<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Api\AbstractApi\Curl;

/**
 * Description of Respons
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Response
{
    protected $body = NULL;
    protected $request = NULL;
    protected $header = NULL;
    protected $code = NULL;
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }
    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }
    public function getBody($isJson = true)
    {
        if ($isJson) {
            return json_decode($this->body);
        }
        return $this->body;
    }
    public function getRequest()
    {
        return $this->request;
    }
    public function getHeader()
    {
        return $this->header;
    }
    public function getCode()
    {
        return $this->code;
    }
    public function isSuccess()
    {
        return (int) (200 <= $this->code && $this->code < 300);
    }
}

?>