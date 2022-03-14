<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App;

class ErrorHandler
{
    const ERRORS = [1, 4, 16, 64, 256, 4096];
    const WARNINGS = [2, 32, 128, 512, 2048];
    const NOTICES = [8, 1024, 8192, 16384];
    public function __construct()
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . "LowLevelLog.php";
    }
    public function logError($errorToken, $errno, $errstr, $errfile, $errline, $errcontext = NULL)
    {
        $logType = $this->getLogType($errno);
        $errorTime = date("d.m.Y H:i:s", time());
        $errorDetails = ["errno" => $errno, "errstr" => $errstr, "errfile" => $errfile, "errline" => $errline, "errcontext" => $logType === "error" ? $errcontext : NULL];
        $log = new LowLevelLog($logType, $errorToken, $errorTime);
        $log->makeLogs($errorDetails);
    }
    public function getLogType($errno = NULL)
    {
        if (in_array($errno, WARNINGS)) {
            return "warning";
        }
        if (in_array($errno, NOTICES)) {
            return "notice";
        }
        return "error";
    }
}

?>