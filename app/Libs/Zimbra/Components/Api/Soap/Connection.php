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
 * Date: 28.08.19
 * Time: 13:47
 * Class Connection
 */
class Connection implements \ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Interfaces\ConnectionInterface
{
    /**
     * @var MySoapClient
     */
    protected $soapClient = NULL;
    /**
     * @var mixed
     */
    protected $params = NULL;
    /**
     * @var
     */
    protected $header = NULL;
    /**
     * @var
     */
    protected $responseModel = NULL;
    /**
     * @var bool
     */
    protected $connected = false;
    /**
     * @var null
     */
    protected $connectionError = NULL;
    /**
     * @var string
     */
    protected $authToken = "";
    /**
     * @var string
     */
    protected $serverUrl = "";
    protected $server = NULL;
    protected $port = NULL;
    const URI_ADMIN = "urn:zimbraAdmin";
    const URI_ACCOUNT = "urn:zimbraAccount";
    const HTTPS_PROTOCOL = "https://";
    const ADMIN_PATH = "/service/admin/soap/";
    const ACCOUNT_PATH = "/service/soap/";
    const CLIENT_PORT = "8443";
    public function __construct($server, $port = 7071, $username, $password = NULL, $user = "admin", $authToken = NULL, $preauth = NULL)
    {
        $this->server = $server;
        $this->port = $port;
        list($location, $uri, $params) = $this->getLoginDetails($server, $port, $username, $password, $user, $authToken, $preauth);
        $this->soapClient = new MySoapClient(NULL, ["location" => $location, "uri" => $uri, "trace" => 1, "exceptions" => 1, "soap_version" => SOAP_1_2, "style" => SOAP_RPC, "use" => SOAP_LITERAL, "stream_context" => stream_context_create(["ssl" => ["verify_peer" => false, "verify_peer_name" => false]])]);
        $this->params = $params;
    }
    protected function getLoginDetails($server, $port, $username, $password, $user, $authToken = NULL, $preauth = NULL)
    {
        $this->serverUrl = HTTPS_PROTOCOL . $server . ":" . $port;
        if ($user == "admin") {
            $location = HTTPS_PROTOCOL . $server . ":" . $port . ADMIN_PATH;
            $uri = URI_ADMIN;
            $params = [new \SoapParam($username, "name"), new \SoapParam($password, "password")];
        }
        if ($user == "user") {
            $location = HTTPS_PROTOCOL . $server . ":" . ($port ? $port : CLIENT_PORT) . ACCOUNT_PATH;
            $uri = URI_ACCOUNT;
            $params = [new \SoapVar("<ns1:account by=\"name\">" . $username . "</ns1:account>", XSD_ANYXML)];
            if ($authToken) {
                $params[] = new \SoapParam($authToken, "authToken");
            } else {
                $params[] = new \SoapParam($password, "password");
            }
        }
        return [$location, $uri, $params];
    }
    public function login()
    {
        try {
            $this->setSoapHeader();
            $result = $this->soapClient->__soapCall("AuthRequest", $this->params, NULL, $this->getSoapHeader());
            $this->authToken = $result["authToken"];
            $this->setSoapHeader($this->authToken);
            $this->setConnected(true);
        } catch (\SoapFault $exception) {
            $result = $exception;
            $this->setConnected(false);
            $this->setConnectionError($exception->getMessage());
            return $result;
        }
    }
    public function getSoapHeader()
    {
        return $this->header;
    }
    public function setSoapHeader($authToken = NULL)
    {
        if (!$authToken) {
            $this->header = new \SoapHeader("urn:zimbra", "context");
        } else {
            $this->header = [new \SoapHeader("urn:zimbra", "context", new \SoapVar("<ns2:context><ns2:authToken>" . $authToken . "</ns2:authToken></ns2:context>", XSD_ANYXML))];
        }
    }
    public function request($request, $params = [], $options = [])
    {
        $soapHeader = $this->getSoapHeader();
        $response = $this->getResponseModel();
        try {
            $this->soapClient->__soapCall($request, $params, $options, $soapHeader);
        } catch (\SoapFault $ex) {
            $response->setLastError($ex->getMessage());
        } catch (\Exception $ex) {
            $response->setLastError($ex->getMessage());
            $soapRes = $this->soapClient->__getLastResponse();
            $response->setRequest($request)->setParams($params)->setOptions($options)->setHeaders($soapHeader)->setXmlResponse($soapRes)->response();
            return $response;
        }
    }
    public function setResponseModel($response)
    {
        $this->responseModel = $response;
    }
    public function getResponseModel()
    {
        if (!$this->responseModel) {
            $this->responseModel = new Response();
        }
        return $this->responseModel;
    }
    public function cleanResponse()
    {
        $this->responseModel = NULL;
        return $this;
    }
    public function isConnected()
    {
        return $this->connected;
    }
    public function setConnected($connected)
    {
        $this->connected = $connected;
        return $this;
    }
    public function getConnectionError()
    {
        return $this->connectionError;
    }
    public function setConnectionError($connectionError)
    {
        $this->connectionError = $connectionError;
        return $this;
    }
    public function getAuthToken()
    {
        return $this->authToken;
    }
    public function getServerUrl()
    {
        return $this->serverUrl;
    }
}

?>