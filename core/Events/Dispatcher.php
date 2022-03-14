<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Events;

class Dispatcher extends \Illuminate\Events\Dispatcher
{
    public function __construct(\ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection\Container $container)
    {
        $this->container = $container;
        $this->initialize();
    }
    protected function initialize()
    {
        $path = \ModulesGarden\Servers\ZimbraEmail\Core\ModuleConstants::getFullPath("app", "Config", "events.php");
        $config = (include $path);
        foreach ($config as $event => $listeners) {
            foreach ($listeners as $listener) {
                $this->listen($event, $listener);
            }
        }
        $this->setQueueResolver(function () {
            return \ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection::create("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Queue\\DatabaseQueue");
        });
    }
    public function queue($class, $arguments)
    {
        $class = implode("@", $this->parseClassCallable($class));
        $this->resolveQueue()->push((int) $class, serialize($arguments));
    }
    protected function createQueuedHandlerCallable($class, $method)
    {
        return function () {
            $arguments = $this->cloneArgumentsForQueueing(func_get_args());
            if (method_exists($class, "queue")) {
                $this->callQueueMethodOnHandler($class, $method, $arguments);
            } else {
                $this->resolveQueue()->push($class . "@" . $method, serialize($arguments));
            }
        };
    }
}

?>