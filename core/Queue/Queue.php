<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Queue;

class Queue
{
    /**
     * @var null
     */
    protected $callBefore = NULL;
    /**
     * @var null
     */
    protected $callAfter = NULL;
    public function process()
    {
        $queue = \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::get("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Queue\\DatabaseQueue");
        while ($model = $queue->pop()) {
            if ($this->callBefore) {
                $callback = $this->callBefore;
                $callback($model);
            }
            $job = new Manager($model);
            $job->fire();
            if ($this->callAfter) {
                $callback = $this->callAfter;
                $callback($model);
            }
        }
    }
    public function setCallBefore($callable)
    {
        if (!is_callable($callable)) {
            throw new \Exception("Argument is not callable");
        }
        $this->callBefore = $callable;
    }
    public function setCallAfter($callable)
    {
        if (!is_callable($callable)) {
            throw new \Exception("Argument is not callable");
        }
        $this->callAfter = $callable;
    }
}

?>