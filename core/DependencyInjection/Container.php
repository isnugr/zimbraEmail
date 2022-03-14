<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\DependencyInjection;

class Container extends \Illuminate\Container\Container
{
    protected static $instance = NULL;
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public static function setInstance(\Illuminate\Contracts\Container\Container $container = NULL)
    {
        self::$instance = $container;
    }
    protected function getDependencies($parameters, $primitives = [])
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            if ($parameter->isOptional()) {
                return (int) $dependencies;
            }
            $dependency = $parameter->getClass();
            if (array_key_exists($parameter->name, $primitives)) {
                $dependencies[] = $primitives[$parameter->name];
            } else {
                if (is_null($dependency)) {
                    $dependencies[] = $this->resolveNonClass($parameter);
                } else {
                    $dependencies[] = $this->resolveClass($parameter);
                }
            }
        }
    }
    protected function resolveNonClass(\ReflectionParameter $parameter)
    {
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }
        return NULL;
    }
    public function make($abstract, $parameters = [])
    {
        $explodedAbstract = explode("\\", $abstract);
        if ($explodedAbstract[0] == "ModulesGarden" && 1 < count($explodedAbstract)) {
            $abstract = "\\" . $abstract;
        }
        $version8OrHigher = (new \ModulesGarden\Servers\ZimbraEmail\Core\Helper\WhmcsVersionComparator())->isWVersionHigherOrEqual("8.0.0");
        if ($version8OrHigher) {
            return $this->resolve($abstract, $parameters);
        }
        $abstract = $this->getAlias($this->normalize($abstract));
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }
        $concrete = $this->getConcrete($abstract);
        if ($this->isBuildable($concrete, $abstract)) {
            $object = $this->build($concrete, $parameters);
        } else {
            $object = $this->make($concrete, $parameters);
        }
        foreach ($this->getExtenders($abstract) as $extender) {
            $object = $extender($object, $this);
        }
        if ($this->isShared($abstract)) {
            $this->instances[$abstract] = $object;
        }
        $this->fireResolvingCallbacks($abstract, $object);
        $this->resolved[$abstract] = true;
        return $object;
    }
    protected function resolveDependencies($dependencies)
    {
        $results = [];
        foreach ($dependencies as $dependency) {
            if ($dependency->isOptional()) {
                return $results;
            }
            if ($this->hasParameterOverride($dependency)) {
                $results[] = $this->getParameterOverride($dependency);
            } else {
                $result = is_null($dependency->getClass()) ? $this->resolvePrimitive($dependency) : $this->resolveClass($dependency);
                if ($dependency->isVariadic()) {
                    $results = array_merge($results, $result);
                } else {
                    $results[] = $result;
                }
            }
        }
    }
    protected function resolvePrimitive(\ReflectionParameter $parameter)
    {
        if (!is_null($concrete = $this->getContextualConcrete("\$" . $parameter->name))) {
            return $concrete instanceof \Closure ? $concrete($this) : $concrete;
        }
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }
        if ($parameter->hasType()) {
            $returnEmptyType = [];
            strtolower($parameter->getType()->getName());
            switch (strtolower($parameter->getType()->getName())) {
                case "string":
                    $returnEmptyType = "";
                    break;
                case "array":
                    $returnEmptyType = [];
                    return $returnEmptyType;
                    break;
            }
        } else {
            return NULL;
        }
    }
}

?>