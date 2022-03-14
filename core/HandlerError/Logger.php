<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\HandlerError;

/**
 * Description of Logger
 * 
 * @author Rafal Ossowski <rafal.os@modulesgarden.com>
 */
class Logger implements \ModulesGarden\Servers\ZimbraEmail\Core\Interfaces\LoggerInterface
{
    protected $name = NULL;
    /**
     * @var \Monolog\Logger
     */
    protected $logger = NULL;
    protected $mainPath = NULL;
    protected $handlers = [];
    /**
     * @var \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Logger
     */
    protected static $instance = NULL;
    protected function __construct($name = "", $debugName = "", $warningName = "", $errorName = "")
    {
    }
    private function __clone()
    {
    }
    public function isLoggerExist()
    {
        return isset($this->logger);
    }
    public function createLogger()
    {
        $this->logger = new \Monolog\Logger($this->name);
        return $this;
    }
    public function __call($name, $arguments)
    {
        if (method_exists($this->logger, $name)) {
            return $this->logger->{$name}(isset($arguments[0]) ? $arguments[0] : "", isset($arguments[1]) ? $arguments[1] : []);
        }
        throw new Exceptions\Exception(ErrorCodes\ErrorCodesLib::CORE_LOG_000001, ["functionName" => $name]);
    }
    public function debug($message, $context = [])
    {
    }
    public function error($message, $context = [])
    {
    }
    public function warning($message, $context = [])
    {
    }
    public function err($message, $context = [])
    {
    }
    public function warn($message, $context = [])
    {
    }
    public function addDebug($message, $context = [])
    {
    }
    public function addWarning($message, $context = [])
    {
    }
    public function addError($message, $context = [])
    {
    }
    private function addHandlerToLogger()
    {
        $formatter = $this->getFormatter();
        foreach ($this->handlers as $handler) {
            $handler->setFormatter($formatter);
            $this->logger->pushHandler($handler);
        }
    }
    private function buildHandlar($path, $type)
    {
        return new \Monolog\Handler\StreamHandler($path, $type);
    }
    private function getFormatter()
    {
        return new \Monolog\Formatter\LineFormatter(NULL, NULL, false, true);
    }
    protected static function create($name = "default", $debugName = "debug.log", $warningName = "warning.log", $errorName = "error.log")
    {
        return new $this($name, $debugName, $warningName, $errorName);
    }
    public static function get($name = "default", $debugName = "debug.log", $warningName = "warning.log", $errorName = "error.log")
    {
        if (!isset($instance)) {
            self::$instance = self::create($name, $debugName, $warningName, $errorName);
        }
        if (self::$instance->isLoggerExist()) {
            self::$instance->createLogger();
        }
        return self::$instance;
    }
}

?>