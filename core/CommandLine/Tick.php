<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\CommandLine;

/**
 * Count time between callback time. It requires declare(ticks = 1);
 * @package ModulesGarden\Servers\ZimbraEmail\Core\CommandLine
 */
class Tick
{
    /**
     * @var callable
     */
    protected $callback = NULL;
    /**
     * @var int
     */
    protected $callbackTime = 0;
    /**
     * @var int
     */
    protected $callbackInterval = 5;
    public function __construct($callback, $time)
    {
        $this->callback = $callback;
        $this->callbackTime = $time;
    }
    public function start()
    {
        register_tick_function(function () {
            $this->tick();
        }, true);
    }
    public function getTimeFromLastCallback()
    {
        return time() - $this->callbackTime;
    }
    public function tick()
    {
        $difference = $this->getTimeFromLastCallback();
        if ($this->callbackInterval < $difference) {
            $this->callbackTime = time();
            $callback = $this->callback;
            $callback();
        }
    }
}

?>