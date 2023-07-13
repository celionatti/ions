<?php

declare(strict_types=1);

namespace Ions\Core\Container;

use ReflectionClass;
use ReflectionParameter;

/**
 * ===========================
 * Ions Container Class ======
 * ===========================
 */
class Container implements ContainerInterface
{
    private $bindings = [];
    private $instances = [];

    public function bind(string $abstract, $concrete): void
    {
        $this->bindings[$abstract] = $concrete;
    }

    public function make(string $abstract)
    {
        if (isset($this->instances[$abstract])) {
            return $this->instances[$abstract];
        }

        if (isset($this->bindings[$abstract])) {
            $concrete = $this->bindings[$abstract];

            if (is_callable($concrete)) {
                $instance = $concrete($this);
            } else {
                $instance = $this->instantiate($concrete);
            }

            $this->instances[$abstract] = $instance;

            return $instance;
        }

        throw new NotFoundException("Binding not found for $abstract");
    }

    public function get(string $abstract)
    {
        return $this->make($abstract);
    }

    private function instantiate(string $concrete)
    {
        $reflection = new ReflectionClass($concrete);
        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return new $concrete;
        }

        $dependencies = $this->resolveDependencies($constructor->getParameters());

        return $reflection->newInstanceArgs($dependencies);
    }

    private function resolveDependencies(array $parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();

            if ($dependency) {
                $dependencies[] = $this->make($dependency->name);
            } else {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new BindingResolutionException("Cannot resolve dependency for parameter '{$parameter->name}'");
                }
            }
        }

        return $dependencies;
    }

    public function addDefinitionsFromFile(string $file): void
    {
        $definitions = include $file;

        if (!is_array($definitions)) {
            throw new \RuntimeException("Invalid definitions file: $file");
        }

        $this->addDefinitions($definitions);
    }

    public function addDefinitions(array $definitions): void
    {
        foreach ($definitions as $abstract => $concrete) {
            $this->bind($abstract, $concrete);
        }
    }
}
