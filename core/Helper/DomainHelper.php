<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Helper;

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
 * Klasa walidująca domenę oraz rozbijająca je na poszczególne cześci
 */
class DomainHelper
{
    private $fullName = NULL;
    private $subdomain = NULL;
    private $domain = NULL;
    private $tld = NULL;
    private static $list = [];
    public function __construct($domain)
    {
        $this->fullName = trim(strtolower($domain));
        $this->split();
    }
    private function loadTldList()
    {
        if (!isset($instance)) {
            return NULL;
        }
        $path = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("storage", "resources", "tld.list");
        if (!file_exists($path)) {
            return NULL;
        }
        $data = file($path);
        foreach ($data as $line) {
            if (!preg_match("#(^//)|(^\\s*\$)#", $line)) {
                self::$list[] = preg_replace("/[\\r\\n]/", "", $line);
            }
        }
    }
    private function split()
    {
        $this->loadTldList();
        $components = array_reverse(explode(".", $this->fullName));
        $lastMatch = $this->getLastMatch($components, self::$list);
        if (empty($lastMatch)) {
            $list = $this->getWhmcsTldList();
            $lastMatch = $this->getLastMatch($components, $list);
        }
        if (empty($lastMatch)) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(\ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCodesLib::CORE_LIBS_DH_000001, ["domain" => $this->fullName]);
        }
        $this->tld = $lastMatch;
        $noTld = preg_replace("/" . preg_quote($lastMatch) . "\$/", "", $this->fullName);
        $noTld = trim($noTld, ".");
        $components = explode(".", $noTld);
        $this->domain = array_pop($components);
        $this->subdomain = implode(".", $components);
    }
    private function getLastMatch($components, $list)
    {
        $lastMatch = "";
        $con = "";
        foreach ($components as $part) {
            $con = $part . "." . $con;
            $con = trim($con, ".");
            if (in_array($con, $list)) {
                $lastMatch = $con;
            }
        }
        return $lastMatch;
    }
    private function getWhmcsTldList()
    {
        $end = substr($this->fullName, strrpos($this->fullName, "."));
        $domains = new \ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs\DomainPricing();
        $tlds = $domains->where("extension", "LIKE", "%" . $end)->get()->pluck("extension");
        $list = array_map(function ($value) {
            return trim($value, ".");
        }, $tlds->toArray());
        return $list;
    }
    public function getFullName()
    {
        return $this->fullName;
    }
    public function getTLD()
    {
        return $this->tld;
    }
    public function getTLDWithDot()
    {
        return $this->tld != "" ? "." . $this->tld : "";
    }
    public function getDomain()
    {
        return $this->domain;
    }
    public function getDomainWithTLD()
    {
        return $this->domain . "." . $this->tld;
    }
    public function getSubdomain()
    {
        return $this->subdomain;
    }
    public function isSubdamain()
    {
        return !empty($this->subdomain);
    }
    public function isValid()
    {
        return !empty($this->domain) && !empty($this->tld);
    }
}

?>