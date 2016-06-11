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

namespace BenGorUser\SymfonySecurityBridgeBundle\DependencyInjection\Compiler;

use BenGorUser\SymfonySecurityBridge\Infrastructure\Security\SymfonyUserPasswordEncoder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

/**
 * Register security services compiler pass.
 *
 * Service declaration via PHP allows more
 * flexibility with customization extend users.
 *
 * @author Beñat Espiña <benatespina@gmail.com>
 */
class SecurityServicesPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $config = $container->getParameter('bengor_user.config');

        foreach ($config['user_class'] as $key => $user) {
            $container->setDefinition(
                $key . '_password_encoder',
                (new Definition(
                    BCryptPasswordEncoder::class, [
                        $user['class'],
                    ]
                ))->setFactory([new Reference('security.encoder_factory'), 'getEncoder'])
            )->setPublic(false);

            $container->setDefinition(
                'bengor.user.infrastructure.security.symfony.' . $key . '_password_encoder',
                new Definition(
                    SymfonyUserPasswordEncoder::class, [
                        $container->getDefinition($key . '_password_encoder'),
                    ]
                )
            )->setPublic(false);

            $container->setAlias(
                'bengor_user.' . $key . '.symfony_password_encoder',
                'bengor.user.infrastructure.security.symfony.' . $key . '_password_encoder'
            );
        }
    }
}
