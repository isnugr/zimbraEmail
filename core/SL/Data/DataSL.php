<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\SL\Data;

/**
 * @author Rafał Ossowski <rafal.os@modulesgarden.com>
 */
class DataSL
{
    /**
     * Exemple:
     * 
     * array(
     *     0 => array(
     *         "name"   => string(className),
     *         "method" => string(static method),
     *         "args"   => array(
     *             string,
     *             number,
     *             object(set string ClassName)
     *         )
     *     )
     * )
     * 
     * @var array()
     */
    private $configurations = [];
    /**
     * Exemple:
     * 
     * array(
     *     string(aliens/className) => array(
     *         "namespace" => string,
     *         "alias"     => string,
     *         "singleton" => bool,
     *         "auto"      => bool   
     *     )
     * )
     * 
     * @var array() 
     */
    private $register = [];
    /**
     * Exemple:
     * 
     * array(
     *     string(old className) => string(new className) 
     * )
     * 
     * @var array() 
     */
    private $rewrites = [];
    /**
     * Exemple:
     * 
     * array(
     *     string(className) => string(aliens) 
     * )
     * 
     * @var array() 
     */
    private $aliens = [];
    private $interfaceConfig = [];
    /**
     * Exemple:
     * 
     * array(
     *     0 => string(aliens/className) 
     * )
     * 
     * @var array() 
     */
    private $auto = [];
    public function __construct()
    {
        $this->getConfigurations();
        $this->getRewrites();
        $this->getRegisters();
    }
    public function getConfigurations()
    {
        if (empty($this->configurations) === true) {
            $this->configurations = \ModulesGarden\Servers\ZimbraEmail\Core\SL\Configuration::get();
        }
        return $this->configurations;
    }
    public function getInterfaceConfig()
    {
        if (empty($this->interfaceConfig) === true) {
            $this->interfaceConfig = \ModulesGarden\Servers\ZimbraEmail\Core\SL\InterfaceConfig::get();
        }
        return $this->interfaceConfig;
    }
    public function getRegisters()
    {
        if (empty($this->register) === true) {
            $this->register = \ModulesGarden\Servers\ZimbraEmail\Core\SL\Register::get();
            $this->loadRegistry();
        }
        return $this->register;
    }
    public function getRewrites()
    {
        if (empty($this->rewrites) === true) {
            $this->rewrites = \ModulesGarden\Servers\ZimbraEmail\Core\SL\Rewrite::get();
        }
        return $this->rewrites;
    }
    public function getAllAlias()
    {
        return $this->aliens;
    }
    public function getRewrite($name, $old = NULL)
    {
        return array_key_exists($name, $this->getRewrites()) ? array_get($this->rewrites, $name) == $old ? $name : $this->getRewrite(array_get($this->getRewrites(), $name), $name) : $name;
    }
    public function isRewrite($name)
    {
        return array_key_exists($name, $this->getRewrites());
    }
    public function getAlias($name)
    {
        return array_key_exists($name, $this->aliens) ? array_get($this->aliens, $name) : $name;
    }
    public function getSingleton($name)
    {
        return array_key_exists($name, $this->getRegisters()) ? array_get($this->getRegisters(), $name)["singleton"] : true;
    }
    public function isRegistry($name)
    {
        return array_key_exists($name, $this->getRegisters());
    }
    public function getClassName($name)
    {
        return array_key_exists($name, $this->getRegisters()) ? $this->getRegisters()[$name]["class"] : $name;
    }
    public function getAutoRunRegisters()
    {
        return $this->auto;
    }
    private function loadRegistry()
    {
        $registres = $this->register;
        $this->register = [];
        foreach ($registres as $registry) {
            $key = (int) (preg_replace("/\\s+/", "", $registry["alias"]) == "") ? $registry["namespace"] : $registry["alias"];
            $rewrite = $this->getRewrite((int) $registry["namespace"]);
            if ($key == $registry["alias"]) {
                $this->aliens[(int) $registry["namespace"]] = $key;
                $this->register[(int) $registry["namespace"]] = ["class" => (int) $rewrite, "singleton" => (int) (int) $registry["singleton"], "auto" => (int) (int) $registry["auto"]];
            }
            if ($rewrite != $registry["namespace"]) {
                if ($key == $registry["alias"]) {
                    $this->aliens[(int) $rewrite] = $key;
                    $this->register[(int) $rewrite] = ["class" => (int) $rewrite, "singleton" => (int) (int) $registry["singleton"], "auto" => (int) (int) $registry["auto"]];
                }
                $this->register[(int) $rewrite] = ["class" => (int) $rewrite, "singleton" => (int) (int) $registry["singleton"], "auto" => (int) (int) $registry["auto"]];
            }
            $this->register[(int) $key] = ["class" => (int) $rewrite, "singleton" => (int) (int) $registry["singleton"], "auto" => (int) (int) $registry["auto"]];
            if ($this->register[$key]["auto"] === false) {
                $this->auto[] = $this->register[$key]["class"];
            }
        }
    }
}

?>