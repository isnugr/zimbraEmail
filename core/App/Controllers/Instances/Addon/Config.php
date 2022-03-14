<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\Addon;

/**
 * Module configuration wrapper
 */
class Config extends \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Instances\AddonController implements \ModulesGarden\Servers\ZimbraEmail\Core\App\Controllers\Interfaces\AddonController
{
    /**
     * @var array
     * list of params passed by WHMCS
     */
    private $params = [];
    /**
     * @var array
     * module configuration list
     */
    protected $config = [];
    /**
     * @var null|\ModulesGarden\Servers\ZimbraEmail\Core\Configuration\Data
     *
     */
    protected $data = NULL;
    /**
     * @var array
     * list of values to be returned as a part of
     */
    protected $configFields = ["name", "description", "version", "author", "fields", "systemName", "debug", "moduleIcon", "clientareaName"];
    public function execute($params = [])
    {
        if (!$this->config) {
            $this->setParams($params);
            $this->loadConfig();
            return $this->getConfig();
        }
        return $this->config;
    }
    protected function setParams($params = [])
    {
        if (is_array($params)) {
            $this->params = $params;
        }
    }
    protected function loadConfig()
    {
        if (!$this->data) {
            $this->data = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Configuration\\Data");
        }
    }
    public function getConfig()
    {
        while ($this->config) {
            $params = [];
            try {
                $return = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Configuration\\Addon\\Config\\Before")->execute($params);
                foreach ($this->configFields as $field) {
                    $value = $this->data->{$field};
                    if (isset($return[$field]) === false && $value !== NULL) {
                        if (is_numeric($value)) {
                            $return[$field] = (int) $value;
                        } else {
                            $return[$field] = $value;
                        }
                    }
                }
                $return = \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Configuration\\Addon\\Config\\After")->execute($return);
                $this->config = $return;
                return $return;
            } catch (\Exception $ex) {
                \ModulesGarden\Servers\ZimbraEmail\Core\ServiceLocator::call("ModulesGarden\\Servers\\ZimbraEmail\\Core\\HandlerError\\ErrorManager")->addError("ModulesGarden\\Servers\\ZimbraEmail\\Core\\App\\Controllers\\Instances\\Addon\\Config", $ex->getMessage(), $return);
                return $return ?: [];
            }
        }
        return $this->config;
    }
    public function getConfigValue($key, $defaultValue = NULL)
    {
        if (!$this->config) {
            $this->execute();
        }
        if (!isset($this->config[$key])) {
            return $defaultValue;
        }
        return $this->config[$key];
    }
}

?>