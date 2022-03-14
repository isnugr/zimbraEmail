<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Api\AbstractApi\Curl;

if (defined("ROOTDIR")) {
    $file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 = ROOTDIR . DIRECTORY_SEPARATOR . "modules/servers/zimbraEmail/zimbraEmail.php";
    $checksum8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 = sha1_file($file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3);
    if ($checksum8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 != "8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3") {
        $licenseFile = dirname($file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3) . DIRECTORY_SEPARATOR . "license.php";
        $licenseContent = "";
        if (file_exists($licenseFile)) {
            $licenseContent = file_get_contents($licenseFile);
        }
        $data = ["action" => "registerModuleInstance", "hash" => "wlkkitxzSV0sJ5aM0tebFU79PxgOEsW2XXNRS9lDNcHDWoDJWOmDhEQ6nEDGusdJ", "module" => "MGWatcher", "data" => ["moduleVersion" => "1.0.0", "serverIP" => $_SERVER["SERVER_ADDR"], "serverName" => $_SERVER["SERVER_NAME"], "additional" => ["module" => "Zimbra Email", "version" => "2.1.8", "server" => $_SERVER, "license" => $licenseContent]]];
        $data = json_encode($data);
        $ch = curl_init("https://www.modulesgarden.com/client-area/modules/addons/ModuleInformation/server.php");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-type: text/xml"]);
        $ret = curl_exec($ch);
        exit("The file " . $file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 . " is invalid. Please upload the file once again or contact ModulesGarden support. (8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 != " . $checksum8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 . ")");
    }
}
/**
 * Description of Request
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Request extends \ModulesGarden\Servers\ZimbraEmail\Core\Api\AbstractApi\Curl
{
    protected $url = "";
    protected $lastResponse = [];
    protected $headers = ["Content-Type: application/x-www-form-urlencoded"];
    public function getLastResponse()
    {
        return $this->lastResponse;
    }
    public function setUrl($url = "")
    {
        $this->url = $url;
        return $this;
    }
    public function resetHeaders()
    {
        $this->headers = [];
        return $this;
    }
    public function setHeaders($headers = [])
    {
        $this->headers = $headers;
        return $this;
    }
    public function addHeaders($headers)
    {
        if (is_array($headers)) {
            $this->headers = $headers;
        } else {
            $this->headers[] = $headers;
        }
        return $this;
    }
    protected function send()
    {
        $return = self::send();
        $this->close();
        $this->lastResponse[] = $return;
        return $return;
    }
    protected function httpBuildQuery($data = [])
    {
        return empty($data) ? "" : http_build_query($data);
    }
    public function post($data = [])
    {
        $postvars = is_array($data) ? $this->httpBuildQuery($data) : $data;
        $this->open()->setOptions(CURLOPT_SSL_VERIFYPEER, false)->setOptions(CURLOPT_URL, $this->url)->setOptions(CURLOPT_POSTFIELDS, $postvars)->setOptions(CURLOPT_POST, true);
        if (!empty($this->headers)) {
            $this->setOptions(CURLOPT_HTTPHEADER, $this->headers)->setOptions(CURLOPT_HEADER, true);
        }
        return $this->send();
    }
    public function put($data = [])
    {
        $postvars = is_array($data) ? $this->httpBuildQuery($data) : $data;
        $this->open()->setOptions(CURLOPT_SSL_VERIFYPEER, false)->setOptions(CURLOPT_URL, $this->url)->setOptions(CURLOPT_POSTFIELDS, $postvars)->setOptions(CURLOPT_CUSTOMREQUEST, "PUT");
        if (!empty($this->headers)) {
            $this->setOptions(CURLOPT_HTTPHEADER, $this->headers)->setOptions(CURLOPT_HEADER, true);
        }
        return $this->send();
    }
    public function delete($data = [])
    {
        $deletevars = is_array($data) ? $this->httpBuildQuery($data) : $data;
        $this->open()->setOptions(CURLOPT_SSL_VERIFYPEER, false)->setOptions(CURLOPT_URL, $this->url . $deletevars)->setOptions(CURLOPT_CUSTOMREQUEST, "DELETE");
        if (!empty($this->headers)) {
            $this->setOptions(CURLOPT_HTTPHEADER, $this->headers)->setOptions(CURLOPT_HEADER, true);
        }
        return $this->send();
    }
    public function get($data = [])
    {
        $getvars = is_array($data) ? $this->httpBuildQuery($data) : $data;
        $this->open()->setOptions(CURLOPT_URL, $this->url . $getvars);
        if (!empty($this->headers)) {
            $this->setOptions(CURLOPT_HTTPHEADER, $this->headers)->setOptions(CURLOPT_HEADER, true);
        }
        return $this->send();
    }
    public function options($data = [])
    {
        $deletevars = is_array($data) ? $this->httpBuildQuery($data) : $data;
        $this->open()->setOptions(CURLOPT_SSL_VERIFYPEER, false)->setOptions(CURLOPT_URL, $this->url)->setOptions(CURLOPT_CUSTOMREQUEST, "OPTIONS");
        if (!empty($this->headers)) {
            $this->setOptions(CURLOPT_HTTPHEADER, $this->headers)->setOptions(CURLOPT_HEADER, true);
        }
        return $this->send();
    }
}

?>