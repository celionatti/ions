<?php

declare(strict_types=1);

namespace Ions\Core\Container;

/**
 * ===========================
 * Ions Container Class ======
 * ===========================
 */


class Container
{
    private $bindings = [];
    private $instances = [];

    public function bind($abstract, $concrete = null)
    {
        if (is_null($concrete)) {
            $concrete = $abstract;
        }

        $this->bindings[$abstract] = $concrete;
    }

    public function singleton($abstract, $concrete = null)
    {
        $this->bind($abstract, $concrete);
        $this->instances[$abstract] = null;
    }

    public function make($abstract, $parameters = [])
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        $concrete = $this->bindings[$abstract];

        if ($this->isInstantiable($concrete)) {
            $instance = $this->instantiate($concrete, $parameters);
        } else {
            $instance = $this->make($concrete, $parameters);
        }

        if (isset($this->instances[$abstract])) {
            $this->instances[$abstract] = $instance;
        }

        return $instance;
    }

    public function addDefinitionsFromFile(string $file)
    {
        $definitions = include $file;

        if (!is_array($definitions)) {
            throw new \RuntimeException("Invalid definitions file: $file");
        }

        $this->addDefinitions($definitions);
    }

    public function addDefinitions(array $definitions)
    {
        foreach ($definitions as $abstract => $concrete) {
            $this->bind($abstract, $concrete);
        }
    }

    public function build(string $className, array $parameters = [])
    {
        $reflection = new \ReflectionClass($className);
        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return new $className;
        }

        $dependencies = $this->resolveDependencies($constructor->getParameters(), $parameters);

        return $reflection->newInstanceArgs($dependencies);
    }

    private function isInstantiable($concrete)
    {
        return is_string($concrete) && class_exists($concrete);
    }

    private function instantiate($concrete, $parameters)
    {
        $reflection = new \ReflectionClass($concrete);
        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return new $concrete;
        }

        $dependencies = $this->resolveDependencies($constructor->getParameters(), $parameters);

        return $reflection->newInstanceArgs($dependencies);
    }

    private function resolveDependencies($parameters, $overrides)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $class = $parameter->getClass();

            if ($class && array_key_exists($class->name, $overrides)) {
                $dependencies[] = $overrides[$class->name];
            } elseif ($class) {
                $dependencies[] = $this->make($class->name);
            } elseif ($parameter->isDefaultValueAvailable()) {
                $dependencies[] = $parameter->getDefaultValue();
            }
        }

        return $dependencies;
    }
}
