<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Api\AbstractApi;

/**
 * Description of Curl
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
abstract class Curl
{
    private $curl = NULL;
    private $options = NULL;
    protected $curlParser = NULL;
    public function setCurlParser($curlParser)
    {
        $this->curlParser = $curlParser;
        return $this;
    }
    public function setOptions($options, $value)
    {
        $this->options[$options] = $value;
        return $this;
    }
    protected function open()
    {
        $this->curl = curl_init();
        return $this;
    }
    protected function close()
    {
        curl_close($this->curl);
        return $this;
    }
    protected function unsetOptions($options)
    {
        if (is_array($options)) {
            foreach ($options as $option) {
                if (isset($this->options[$option])) {
                    unset($this->options[$option]);
                }
            }
        } else {
            unset($this->options[$options]);
        }
        return $this;
    }
    protected function send()
    {
        $this->includeOptions();
        if (($head = $this->execute()) === false) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(\ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCodesLib::CORE_CURL_000001, ["lastCurlError" => $this->getLastErrorWithCurl()]);
        }
        if ($errno = $this->getLastErrorNumber()) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(\ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCodesLib::CORE_CURL_000002, ["curlError" => $this->getLastError($errno)]);
        }
        list($header, $body) = $this->curlParser->rebuild($head, $this->getHeaderSize());
        return \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::create("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Api\\AbstractApi\\Curl\\Response")->setRequest($this->getHeaderOut())->setHeader($header)->setCode($this->getHttpCode())->setBody($body);
    }
    private function execute()
    {
        return curl_exec($this->curl);
    }
    private function getLastErrorNumber()
    {
        return curl_errno($this->curl);
    }
    private function getLastError($errmo)
    {
        return curl_strerror($errmo);
    }
    private function getLastErrorWithCurl()
    {
        return curl_error($this->curl);
    }
    private function getHeaderSize()
    {
        return curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
    }
    private function getHeaderOut()
    {
        return curl_getinfo($this->curl, CURLINFO_HEADER_OUT);
    }
    private function getHttpCode()
    {
        return curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
    }
    private function includeOptions()
    {
        curl_setopt_array($this->curl, $this->options);
        return $this;
    }
}

?>