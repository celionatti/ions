<?php

declare(strict_types=1);

namespace Ions\Core\Container;

use Exception;
use ReflectionClass;

/**
 * ===========================
 * Ions Container Class ======
 * ===========================
 */

class Container implements ContainerInterface
{
    private $bindings = [];

    public function bind($abstract, $concrete)
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function make($abstract)
    {
        if (isset($this->bindings[$abstract])) {
            $concrete = $this->bindings[$abstract];
            if (is_callable($concrete)) {
                return $concrete($this);
            }
            return $this->instantiate($concrete);
        }
        throw new Exception("Binding not found for $abstract");
    }

    public function get($abstract)
    {
        return $this->make($abstract);
    }

    private function instantiate($concrete)
    {
        $reflection = new ReflectionClass($concrete);
        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return new $concrete;
        }

        $parameters = $constructor->getParameters();
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if ($dependency) {
                $dependencies[] = $this->make($dependency->name);
            } else {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new Exception("Cannot resolve dependency for parameter '{$parameter->name}' in class '$concrete'");
                }
            }
        }

        return $reflection->newInstanceArgs($dependencies);
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
}
