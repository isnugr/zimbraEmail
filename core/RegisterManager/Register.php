<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\RegisterManager;

/**
 * Description of Register
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class Register
{
    /**
     * @var Entity[]
     */
    private $registeredEntity = [];
    /**
     * @var Register
     */
    private static $instace = NULL;
    private function __construct()
    {
    }
    private function __clone()
    {
    }
    public function register($key = NULL, $data = NULL)
    {
        if ($key != NULL) {
            if ($this->isRegister($key)) {
                throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\Exception(\ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\ErrorCodes\ErrorCodesLib::CORE_CREG_000001, ["registerKey" => $key]);
            }
            $key = str_replace(" ", "", $key);
            $this->registeredEntity[$key] = $this->factoryEntityModel()->setKey($key)->setData($data);
        }
        return $this;
    }
    public function isRegister($key = NULL)
    {
        return isset($this->registeredEntity[$key]);
    }
    public function registry($key = NULL)
    {
        if ($this->isRegister($key)) {
            return $this->registeredEntity[$key]->getData();
        }
        return NULL;
    }
    public function removeRegistry($key = NULL)
    {
        if ($this->isRegister($key)) {
            unset($this->registeredEntity[$key]);
        }
        return $this;
    }
    protected static function createInstace()
    {
        self::$instace = new Register();
    }
    public static function getInstace()
    {
        if (self::$instace === NULL) {
            self::createInstace();
        }
        return self::$instace;
    }
    public function factoryEntityModel()
    {
        return new Entity();
    }
}

?>