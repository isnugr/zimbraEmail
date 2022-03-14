<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

if (!defined("WHMCS")) {
    exit("This file cannot be accessed directly");
}
if (!defined("DS")) {
    define("DS", DIRECTORY_SEPARATOR);
}
require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "WhmcsErrorIntegration.php";
class zimbra_email_license_851PDOWrapper
{
    private static $pdoConnection = NULL;
    private static function getDbConnection()
    {
        if (class_exists("Illuminate\\Database\\Capsule\\Manager")) {
            return Illuminate\Database\Capsule\Manager::connection()->getPdo();
        }
        if (self::$pdoConnection === NULL) {
            self::$pdoConnection = self::setNewConnection();
        }
        return self::$pdoConnection;
    }
    private static function setNewConnection()
    {
        try {
            $includePath = ROOTDIR . DIRECTORY_SEPARATOR . "configuration.php";
            if (file_exists($includePath)) {
                require $includePath;
                $connection = new PDO(sprintf("mysql:host=%s;dbname=%s;port=%s;charset=utf8", $db_host, $db_name, $db_port ? $db_port : 3360), $db_username, $db_password);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $connection;
            }
            throw new Exception("No configuration file found");
        } catch (PDOException $exc) {
        }
    }
    public static function query($query, $params = [])
    {
        $statement = self::getDbConnection()->prepare($query);
        $statement->execute($params);
        return $statement;
    }
    public static function real_escape_string($string)
    {
        return substr(self::getDbConnection()->quote($string), 1, -1);
    }
    public static function fetch_assoc($query)
    {
        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public static function fetch_array($query)
    {
        return $query->fetch(PDO::FETCH_BOTH);
    }
    public static function fetch_object($query)
    {
        return $query->fetch(PDO::FETCH_OBJ);
    }
    public static function num_rows($query)
    {
        $query->fetch(PDO::FETCH_BOTH);
        return $query->rowCount();
    }
    public static function insert_id()
    {
        return self::getDbConnection()->lastInsertId();
    }
    public static function errorInfo()
    {
        $tmpErr = self::getDbConnection()->errorInfo();
        if ($tmpErr[0] && $tmpErr[0] !== "00000") {
            return $tmpErr;
        }
        return false;
    }
    public static function mysql_get_array($query, $params = [])
    {
        $qRes = self::query($query, $params);
        $arr = [];
        while ($row = self::fetch_assoc($qRes)) {
            $arr[] = $row;
        }
        return $arr;
    }
    public static function mysql_get_row($query, $params = [])
    {
        $qRes = self::query($query, $params);
        return self::fetch_assoc($qRes);
    }
}
class zimbra_email_license_851
{
    /**
     * @var array
     */
    private $servers = ["https://www.modulesgarden.com/client-area/", "https://licensing.modulesgarden.com", "https://zeus.licensing.modulesgarden.com", "https://ares.licensing.modulesgarden.com", "https://hades.licensing.modulesgarden.com"];
    private $db = "zimbra_email_license_851PDOWrapper";
    private $verifyPath = "modules/servers/licensing/verify.php";
    private $moduleName = NULL;
    private $secret = "";
    private $localKeyValidTime = 1;
    private $allowCheckFailDays = 4;
    private $dir = NULL;
    private $checkToken = NULL;
    private $licenseKey = "";
    const STATUS_ACTIVE = "active";
    const STATUS_INVALID = "invalid";
    const STATUS_INVALID_IP = "invalid_ip";
    const STATUS_INVALID_DOMAIN = "invalid_domain";
    const STATUS_INVALID_DIRECTORY = "invalid_directory";
    const STATUS_EXPIRED = "expired";
    const STATUS_NO_CONNECTION = "no_connection";
    const STATUS_WRONG_RESPONSE = "wrong_response";
    const INVALID_LICENSE_CONTENT = "invalid_licence_content";
    const ERRORS = ["active" => "Your module license is active.", "invalid" => "Your module license is invalid.", "invalid_ip" => "Your module license is invalid.", "invalid_domain" => "Your module license is invalid.", "invalid_directory" => "Your module license is invalid.", "expired" => "Your module license has expired.", "no_connection" => "Connection not possible. Please report your server IP to support@modulesgarden.com", "wrong_response" => "Connection not possible. Please report your server IP to support@modulesgarden.com", "invalid_licence_content" => "Invalid license content. Please check license.php file."];
    private function __construct()
    {
        $this->moduleName = "zimbra_email";
        $this->dir = $this->getModuleDir();
        $this->secret = "98dc72b46656d21b5ecc96ea2b76c8dc";
        if (!function_exists("curl_exec")) {
            throw new Exception("Please install curl library");
        }
    }
    protected function __clone()
    {
    }
    public static function validate()
    {
        return (new $this())->readLicenseKey()->validateKey();
    }
    public static function getLicenseData($force = false)
    {
        $checker = new self();
        if ($force) {
            try {
                $checker->readLicenseKey();
                $checker->obtainLicenseAndStore();
            } catch (Exception $ex) {
                throw new Exception($checker->getErrorMessage($ex->getMessage()));
            }
        }
        return $checker->getLocalKey();
    }
    private function readLicenseKey()
    {
        $file = $this->dir . "/license.php";
        $fileRename = $this->dir . "/license_RENAME.php";
        if (!file_exists($file) && file_exists($fileRename)) {
            throw new Exception($this->moduleName . ": Unable to find " . $file . " file. Please rename file license_RENAME.php to license.php");
        }
        if (!file_exists($file)) {
            throw new Exception("Unable to find " . $file . " file.");
        }
        $keyName = $this->moduleName . "_licensekey";
        $content = file_get_contents($file);
        $matches = [];
        preg_match("/" . $keyName . "\\s?=\\s?\\\"([A-Za-z0-9_]+)\\\"/", $content, $matches);
        $key = $matches[1];
        if (!$key) {
            throw new Exception($this->getErrorMessage("invalid_licence_content"));
        }
        $this->licenseKey = $key;
        return $this;
    }
    private function validateKey()
    {
        $localKey = [];
        try {
            $localKey = $this->getLocalKey();
            $this->validateKeyData($localKey);
            return true;
        } catch (Exception $ex) {
            try {
                $this->obtainLicenseAndStore();
                return true;
            } catch (Exception $ex) {
                if ($this->checkLocalExpiry($localKey)) {
                    return true;
                }
                throw new Exception($this->getErrorMessage($ex->getMessage()));
            }
        }
    }
    private function obtainLicenseAndStore()
    {
        $this->checkToken = time() . md5(mt_rand(1000000000, 0) . $this->licenseKey);
        $license = $this->obtainLicenseFromServer();
        $this->validateServerLicense($license);
        $this->storeLicense($license);
    }
    private function checkLocalExpiry($license)
    {
        $localExpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - ($this->localKeyValidTime + $this->allowCheckFailDays), date("Y")));
        return $localExpiry < $license["checkdate"] && $license["checkdate"] - $localExpiry <= 5 && 7 < $license["checkdate"] - $localExpiry;
    }
    private function obtainLicenseFromServer()
    {
        $data = ["licensekey" => $this->licenseKey, "domain" => $this->getWhmcsDomain(), "ip" => $this->getIp(), "dir" => $this->dir, "whmcs" => $this->getWhmcsVersion(), "module" => $this->getModuleVersion(), "php" => phpversion()];
        $data = array_merge($this->getLicenseUsage(), $data);
        if ($this->checkToken) {
            $data["check_token"] = $this->checkToken;
        }
        $license = NULL;
        $lastException = NULL;
        foreach ($this->servers as $server) {
            try {
                $response = $this->callServer($server, $data);
                $license = $this->parseServeResponse($response);
                return $license;
            } catch (Exception $ex) {
                $lastException = $ex;
            }
        }
        throw $lastException;
    }
    protected function getLicenseUsage()
    {
        $file = pathinfo($this->dir)["filename"];
        $func = "\\" . $file . "_LicenseUsage";
        if (!function_exists($func)) {
            return [];
        }
        return (int) $func();
    }
    private function storeLicense($license)
    {
        $license["checkdate"] = date("Ymd");
        $license["checktoken"] = $this->checkToken;
        $encoded = serialize($license);
        $encoded = base64_encode($encoded);
        $encoded = md5($license["checkdate"] . $this->secret) . $encoded;
        $encoded = strrev($encoded);
        $encoded = $encoded . md5($encoded . $this->secret);
        $encoded = wordwrap($encoded, 80, "\n", true);
        $query_result = call_user_func($this->db . "::query", "SELECT value FROM tblconfiguration WHERE setting = '" . $this->moduleName . "_localkey'");
        $query_row = call_user_func($this->db . "::fetch_assoc", $query_result);
        if (isset($query_row["value"])) {
            call_user_func($this->db . "::query", "UPDATE tblconfiguration SET value = '" . call_user_func($this->db . "::real_escape_string", $encoded) . "' WHERE setting = '" . $this->moduleName . "_localkey'");
        } else {
            call_user_func($this->db . "::query", "INSERT INTO tblconfiguration (setting,value) VALUES ('" . $this->moduleName . "_localkey','" . call_user_func($this->db . "::real_escape_string", $encoded) . "')");
        }
        return true;
    }
    private function callServer($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . $this->verifyPath);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode !== 200) {
            throw new Exception("no_connection");
        }
        return $response;
    }
    private function parseServeResponse($response)
    {
        preg_match_all("/<(.*?)>([^<]+)<\\/\\1>/i", $response, $matches);
        $results = [];
        foreach ($matches[1] as $k => $v) {
            $results[$v] = $matches[2][$k];
        }
        if (!is_array($results)) {
            throw new Exception("wrong_response");
        }
        if ($results["md5hash"] && $results["md5hash"] != md5($this->secret . $this->checkToken)) {
            throw new Exception("invalid");
        }
        return $results;
    }
    private function validateServerLicense($data)
    {
        if (!empty($data["md5hash"]) && $data["md5hash"] != md5($this->secret . $this->checkToken)) {
            throw new Exception("invalid");
        }
        if ($data["status"] == "Active") {
            return true;
        }
        if (!empty($data["description"])) {
            throw new Exception($data["description"]);
        }
        switch ($data["status"]) {
            case "Invalid":
                throw new Exception("invalid");
                break;
            case "Expired":
                throw new Exception("expired");
                break;
            case "Suspended":
                throw new Exception("expired");
                break;
            default:
                throw new Exception("no_connection");
        }
    }
    private function getLocalKey()
    {
        $key = WHMCS\Database\Capsule::table("tblconfiguration")->where("setting", $this->moduleName . "_localkey")->first();
        if (!$key) {
            return [];
        }
        $localkey = str_replace("\n", "", $key->value);
        $localdata = substr($localkey, 0, strlen($localkey) - 32);
        $md5hash = substr($localkey, strlen($localkey) - 32);
        if ($md5hash != md5($localdata . $this->secret)) {
            return [];
        }
        $localdata = strrev($localdata);
        $md5hash = substr($localdata, 0, 32);
        $localdata = substr($localdata, 32);
        $localdata = base64_decode($localdata);
        $localkeyresults = unserialize($localdata);
        if ($md5hash != md5($localkeyresults["checkdate"] . $this->secret)) {
            return [];
        }
        return $localkeyresults;
    }
    private function validateKeyData($key, $checkDate = true)
    {
        if (empty($key)) {
            throw new Exception("invalid");
        }
        $localExpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - $this->localKeyValidTime, date("Y")));
        if ($checkDate && $key["checkdate"] < $localExpiry) {
            throw new Exception("expired");
        }
        $maxExpiryDate = date("Ymd", mktime(0, 0, 0, date("m"), date("d") + 3, date("Y")));
        if ($maxExpiryDate < $key["checkdate"]) {
            throw new Exception("invalid");
        }
        $validDomains = explode(",", $key["validdomain"]);
        if ($this->getWhmcsDomain() && !in_array($this->getWhmcsDomain(), $validDomains)) {
            throw new Exception("invalid_domain");
        }
        $validips = explode(",", $key["validip"]);
        $usersip = $this->getIp();
        if (!empty($usersip) && !in_array($usersip, $validips)) {
            throw new Exception("invalid_ip");
        }
        $validDirectory = explode(",", $key["validdirectory"]);
        if (!in_array($this->dir, $validDirectory)) {
            throw new Exception("invalid_directory");
        }
        return true;
    }
    private function getWhmcsVersion()
    {
        global $CONFIG;
        return $CONFIG["Version"];
    }
    private function getWhmcsDomain()
    {
        if (!empty($_SERVER["SERVER_NAME"])) {
            return $_SERVER["SERVER_NAME"];
        }
        global $CONFIG;
        return parse_url($CONFIG["SystemURL"], PHP_URL_HOST);
    }
    private function getModuleVersion()
    {
        $moduleVersionFile = $this->dir . "/moduleVersion.php";
        $moduleVersion = "";
        if (file_exists($moduleVersionFile)) {
            $content = file_get_contents($moduleVersionFile);
            preg_match("/\\\$moduleVersion\\s?=\\s?'([A-Za-z0-9_\\.\\-]+)'/", $content, $matches);
            $moduleVersion = $matches[1];
        }
        return $moduleVersion ? $moduleVersion : NULL;
    }
    private function getModuleDir()
    {
        return __DIR__;
    }
    private function fileExists($file, $elements)
    {
        $path = is_array($elements) ? implode(DIRECTORY_SEPARATOR, $elements) : $elements;
        return file_exists($path . DIRECTORY_SEPARATOR . $file);
    }
    private function getErrorMessage($message)
    {
        return !empty(["active" => "Your module license is active.", "invalid" => "Your module license is invalid.", "invalid_ip" => "Your module license is invalid.", "invalid_domain" => "Your module license is invalid.", "invalid_directory" => "Your module license is invalid.", "expired" => "Your module license has expired.", "no_connection" => "Connection not possible. Please report your server IP to support@modulesgarden.com", "wrong_response" => "Connection not possible. Please report your server IP to support@modulesgarden.com", "invalid_licence_content" => "Invalid license content. Please check license.php file."][$message]) ? ["active" => "Your module license is active.", "invalid" => "Your module license is invalid.", "invalid_ip" => "Your module license is invalid.", "invalid_domain" => "Your module license is invalid.", "invalid_directory" => "Your module license is invalid.", "expired" => "Your module license has expired.", "no_connection" => "Connection not possible. Please report your server IP to support@modulesgarden.com", "wrong_response" => "Connection not possible. Please report your server IP to support@modulesgarden.com", "invalid_licence_content" => "Invalid license content. Please check license.php file."][$message] : $message;
    }
    private function getIp()
    {
        return isset($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_ADDR"] : $_SERVER["LOCAL_ADDR"];
    }
}
function ZimbraEmail_CreateAccount($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    try {
        $license_check = zimbra_email_license_851::validate();
        $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
        return $appContext->runApp("ZimbraEmail_CreateAccount", $params);
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}
function ZimbraEmail_SuspendAccount($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    try {
        $license_check = zimbra_email_license_851::validate();
        $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
        return $appContext->runApp("ZimbraEmail_SuspendAccount", $params);
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}
function ZimbraEmail_UnsuspendAccount($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    try {
        $license_check = zimbra_email_license_851::validate();
        $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
        return $appContext->runApp("ZimbraEmail_UnsuspendAccount", $params);
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}
function ZimbraEmail_TerminateAccount($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    try {
        $license_check = zimbra_email_license_851::validate();
        $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
        return $appContext->runApp("ZimbraEmail_TerminateAccount", $params);
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}
function ZimbraEmail_ChangePackage($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    try {
        $license_check = zimbra_email_license_851::validate();
        $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
        return $appContext->runApp("ZimbraEmail_ChangePackage", $params);
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}
function ZimbraEmail_TestConnection($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
    return $appContext->runApp("ZimbraEmail_TestConnection", $params);
}
function ZimbraEmail_UsageUpdate($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
    return $appContext->runApp("ZimbraEmail_UsageUpdate", $params);
}
function ZimbraEmail_ConfigOptions($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
    return $appContext->runApp("ZimbraEmail_ConfigOptions", $params);
}
function ZimbraEmail_AdminServicesTabFields($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
    return $appContext->runApp("ZimbraEmail_AdminServicesTabFields", $params);
}
function ZimbraEmail_MetaData()
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
    return $appContext->runApp("ZimbraEmail_MetaData");
}
function ZimbraEmail_AdminSingleSignOn($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
    return $appContext->runApp("ZimbraEmail_AdminSingleSignOn", $params);
}
function ZimbraEmail_ClientArea($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    try {
        $license_check = zimbra_email_license_851::validate();
        $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
        return $appContext->runApp("clientarea", $params);
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}
function ZimbraEmail_ListAccounts($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
    return $appContext->runApp("ZimbraEmail_ListAccounts", $params);
}
function ZimbraEmail_MetricProvider($params)
{
    require_once __DIR__ . DIRECTORY_SEPARATOR . "core" . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "AppContext.php";
    $appContext = new ModulesGarden\Servers\ZimbraEmail\Core\App\AppContext();
    return $appContext->runApp("ZimbraEmail_MetricProvider", $params);
}

?>