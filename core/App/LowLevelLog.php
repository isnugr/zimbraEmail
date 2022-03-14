<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App;

class LowLevelLog
{
    protected $logType = NULL;
    protected $logToken = NULL;
    protected $logTime = NULL;
    protected $moduleName = NULL;
    public function __construct($logType, $logToken, $logTime)
    {
        $this->logType = $logType;
        $this->logToken = $logToken;
        $this->logTime = $logTime;
    }
    public function makeLogs($logDetails)
    {
        if ($this->logType === "error") {
            $this->logToDb($logDetails);
        }
        $this->logToFile($logDetails);
        if ($this->logType === "error") {
            $this->logToPHPLog($logDetails);
        }
    }
    public function logToDb($logDetails = [])
    {
        logModuleCall($this->getModuleName() . " Error", "Token: " . $this->logToken, ["time" => $this->logTime], var_export($logDetails, true));
    }
    public function logToFile($logDetails)
    {
        $logData = date("d.m.Y H:i:s", time()) . " - Token: " . $this->logToken . " - " . var_export($logDetails, true) . PHP_EOL;
        $logFile = $this->getLogFile($this->logType);
        file_put_contents($logFile, $logData, FILE_APPEND);
    }
    public function logToPHPLog($logDetails)
    {
    }
    public function getLogFile($logType = "error")
    {
        $logDir = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "storage" . DIRECTORY_SEPARATOR . "logs";
        $logFile = $logDir . DIRECTORY_SEPARATOR . $logType . ".log";
        if (!file_exists($logFile) && !is_writable($logDir)) {
        }
        if (file_exists($logFile) && !is_writable($logFile)) {
        }
        return $logFile;
    }
    public function getModuleName()
    {
        if (!$this->moduleName) {
            $className = trim("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\LowLevelLog", "\\");
            if (strpos($className, "ModulesGarden") === 0) {
                $pt1 = str_replace("ModulesGarden\\", "", $className);
                if (strpos($pt1, "\\Core\\App")) {
                    $this->moduleName = substr($pt1, 0, strpos($pt1, "\\Core\\App"));
                }
            }
        }
        return $this->moduleName;
    }
}

?>