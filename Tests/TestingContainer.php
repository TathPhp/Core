<?php
namespace Tath\Core\Tests;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class TestingContainer implements ContainerInterface
{
    private $container;

    private $fakeParameters = [];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function set($id, $service)
    {
        $this->container->set($id, $service);
    }

    public function get($id, $invalidBehavior = self::EXCEPTION_ON_INVALID_REFERENCE)
    {
        return $this->container->get($id, $invalidBehavior);
    }

    public function has($id)
    {
        return $this->container->has($id);
    }

    public function initialized($id)
    {
        return $this->container->initialized($id);
    }

    public function getParameter($name)
    {
        if (isset($this->fakeParameters[$name])) {
            return $this->fakeParameters[$name];
        }
        return $this->container->getParameter($name);
    }

    public function hasParameter($name)
    {
        if (array_key_exists($name, $this->fakeParameters)) {
            return !is_null($this->fakeParameters[$name]);
        }
        return $this->container->hasParameter($name);
    }

    public function setParameter($name, $value)
    {
        $this->fakeParameters[$name] = $value;
    }
}