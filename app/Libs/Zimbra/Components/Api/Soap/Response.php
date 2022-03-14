<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 05.09.19
 * Time: 10:51
 * Class Response
 */
class Response
{
    protected $request = NULL;
    protected $options = NULL;
    protected $params = NULL;
    protected $headers = NULL;
    protected $xmlResponse = NULL;
    protected $responseHead = NULL;
    protected $responseBody = NULL;
    protected $responseModel = NULL;
    protected $lastError = NULL;
    protected $errors = [];
    public function getRequest()
    {
        return $this->request;
    }
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }
    public function getOptions()
    {
        return $this->options;
    }
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
    public function getParams()
    {
        return $this->params;
    }
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }
    public function getHeaders()
    {
        return $this->headers;
    }
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }
    public function getXmlResponse()
    {
        return $this->xmlResponse;
    }
    public function setXmlResponse($xmlResponse)
    {
        $this->xmlResponse = $xmlResponse;
        return $this;
    }
    public function getResponseBody()
    {
        return $this->responseBody;
    }
    public function getResponseModel()
    {
        return $this->responseModel;
    }
    public function setResponseModel($responseModel)
    {
        $this->responseModel = $responseModel;
        return $this;
    }
    public function getLastError()
    {
        return $this->lastError;
    }
    public function setLastError($lastError)
    {
        $this->errors[] = $lastError;
        $this->lastError = $lastError;
    }
    public function getLastErrorCode()
    {
        if ($code = $this->responseBody["SOAP:FAULT"]["SOAP:DETAIL"]["ERROR"]["CODE"]["DATA"]) {
            return $code;
        }
        return false;
    }
    public function response()
    {
        $xml = new Helpers\XmlParser();
        $array = $xml->parse($this->xmlResponse);
        $this->responseHead = $array["SOAP:ENVELOPE"]["SOAP:HEADER"];
        $this->responseBody = $array["SOAP:ENVELOPE"]["SOAP:BODY"];
        return $this;
    }
}

?>