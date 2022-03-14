<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\CommandLine;

/**
 * Class Hypervisor
 * @package ModulesGarden\Servers\ZimbraEmail\Core\CommandLine
 * @todo - clean up!
 */
class Hypervisor
{
    /**
     * command name
     * @var null
     */
    protected $name = NULL;
    /**
     * command params
     * @var null
     */
    protected $params = NULL;
    /**
     * @var int
     */
    protected $counter = 0;
    /**
     * @var \ModulesGarden\Servers\ZimbraEmail\Core\Models\Commands
     */
    protected $entity = NULL;
    protected $tickTime = 1;
    /**
     * @var int
     */
    protected $sleepInterval = 5;
    public function __construct($name, $params)
    {
        $this->name = $name;
        $this->params = $params;
    }
    public function lock()
    {
        if ($this->isActive()) {
            throw new \Exception("Cannot create lock. Command already running");
        }
        $this->registerTickHandler();
        $this->registerSignalHandler();
        $this->getEntity()->setRunning();
        return $this;
    }
    public function unlock()
    {
        $this->getEntity()->setStopped()->clearAction();
        return $this;
    }
    public function ping()
    {
        $this->getEntity()->ping();
        return $this;
    }
    public function sleep($interval)
    {
        $this->getEntity()->setSleeping();
        $counter = 0;
        while ($counter < $interval) {
            if ($interval <= $this->sleepInterval) {
                $time = $interval;
            } else {
                $time = $this->sleepInterval;
            }
            $counter += $time;
            sleep($time);
        }
        $this->getEntity()->setRunning();
        return $this;
    }
    public function shouldBeStopped()
    {
        return $this->getEntity()->shouldBeStopped();
    }
    public function checkIfRunning()
    {
        if (!$this->isRunning()) {
            throw new \Exception("Script is not running");
        }
        return true;
    }
    public function isStopped()
    {
        $this->getEntity()->shouldBeStopped();
    }
    public function isActive()
    {
        $entity = $this->getEntity();
        $diff = time() - $entity->updated_at->timestamp;
        if ($entity->isSleeping() && $diff <= $this->sleepInterval) {
            return true;
        }
        if ($entity->isRunning() && time() < $entity->updated_at->timestamp + $this->tickTime) {
            return true;
        }
        return false;
    }
    protected function getEntity($force = false)
    {
        if ($this->entity && $force === false) {
            return $this->entity;
        }
        $this->entity = \ModulesGarden\Servers\ZimbraEmail\Core\Models\Commands::where("name", $this->name)->first();
        if (!$this->entity) {
            $this->entity = new \ModulesGarden\Servers\ZimbraEmail\Core\Models\Commands();
            $this->entity->name = $this->name;
            $this->entity->uuid = uniqid();
            $this->entity->save();
        }
        return $this->entity;
    }
    protected function registerTickHandler()
    {
        $tick = new Tick(function () {
            $this->ping();
        }, 10);
        $tick->start();
    }
    protected function registerSignalHandler()
    {
        if (!function_exists("pcntl_signal")) {
            return NULL;
        }
        if (function_exists("pcntl_async_signals")) {
            pcntl_async_signals(true);
        }
        $exit = function () {
            $this->getEntity()->setStopped();
            exit;
        };
        pcntl_signal(SIGINT, $exit);
        pcntl_signal(SIGHUP, $exit);
        pcntl_signal(SIGUSR1, $exit);
    }
}

?>