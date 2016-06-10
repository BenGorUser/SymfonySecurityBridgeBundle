<?php

/*
 * This file is part of the BenGorUser package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\BenGorUser\SymfonySecurityBridgeBundle\DependencyInjection;

use BenGorUser\SymfonySecurityBridgeBundle\DependencyInjection\SymfonySecurityBridgeExtension;
use PhpSpec\ObjectBehavior;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

/**
 * Spec file of SymfonySecurityBridgeExtension class.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SymfonySecurityBridgeExtensionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(SymfonySecurityBridgeExtension::class);
    }

    function it_extends_extension()
    {
        $this->shouldHaveType(Extension::class);
    }

    function it_loads(ContainerBuilder $container)
    {
        $this->load([], $container);
    }
}
