<?php

namespace Tath\Core\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContainerAwareTestCase extends KernelTestCase
{
    private $container;

    /**
     * Gets the current container.
     *
     * @return ContainerInterface A ContainerInterface instance
     */
    protected function getContainer()
    {
        if (!isset($this->container)) {
            self::bootKernel();
            $this->container = new TestingContainer(self::$kernel->getContainer());
        }
        return $this->container;
    }

    protected static function getKernelClass()
    {
        return 'AppKernel';
    }
}
