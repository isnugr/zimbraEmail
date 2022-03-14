<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Cache;

/**
 * Description of CacheManager
 *
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class CacheManager implements \ModulesGarden\Servers\ZimbraEmail\Core\Interfaces\CacheManagerInterface
{
    /**
     * @var CacheManagerInterface
     */
    protected $manager = NULL;
    /**
     * @var string
     */
    protected $dir = "";
    /**
     * @var string
     */
    protected $namespace = "";
    /**
     * @var string
     */
    protected $key = NULL;
    /**
     * @var string|array|object
     */
    protected $data = NULL;
    protected static $instance = NULL;
    public function __construct()
    {
        $this->namespace = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getRootNamespace();
        $this->dir = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getModuleRootDir() . DS . "storage" . DS . "framework";
        $this->manager = new \Symfony\Component\Cache\Simple\FilesystemCache("", 0, $this->dir);
    }
    private function __clone()
    {
    }
    public function setKey($key = "default")
    {
        $this->key = $key;
        $this->setData($this->manager->get($this->key));
        return $this;
    }
    public function getKey()
    {
        return $this->key;
    }
    public function setData($data = NULL)
    {
        if ($data !== NULL) {
            $this->data = $data;
        }
        return $this;
    }
    public function getData()
    {
        try {
            if (isset($this->key)) {
                $this->data = $this->manager->get($this->key);
            }
            return $this->data;
        } catch (\Exception $ex) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\MGModuleException("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Cache\\CacheManager", $ex->getMessage(), $ex->getCode(), $ex);
        }
    }
    public function save()
    {
        try {
            $this->manager->set($this->key, $this->data);
            return $this;
        } catch (\Exception $ex) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\MGModuleException("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Cache\\CacheManager", $ex->getMessage(), $ex->getCode(), $ex);
        }
    }
    public function remove()
    {
        try {
            $this->manager->delete($this->key);
            return $this;
        } catch (\Exception $ex) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\MGModuleException("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Cache\\CacheManager", $ex->getMessage(), $ex->getCode(), $ex);
        }
    }
    public function clearAll()
    {
        try {
            $this->manager->clear();
            return $this;
        } catch (\Exception $ex) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\MGModuleException("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Cache\\CacheManager", $ex->getMessage(), $ex->getCode(), $ex);
        }
    }
    public function exist()
    {
        try {
            return $this->manager->has($this->key);
        } catch (\Exception $ex) {
            throw new \ModulesGarden\Servers\ZimbraEmail\Core\HandlerError\Exceptions\MGModuleException("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Cache\\CacheManager", $ex->getMessage(), $ex->getCode(), $ex);
        }
    }
    public static function instance()
    {
        if (self::$instance === NULL) {
            self::$instance = new CacheManager();
        }
        return self::$instance;
    }
    public static function cache($key = NULL)
    {
        $istance = self::instance();
        if ($key) {
            $istance->setKey($key);
        }
        return $istance;
    }
}

?>