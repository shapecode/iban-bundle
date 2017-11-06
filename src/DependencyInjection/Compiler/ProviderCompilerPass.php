<?php

namespace Shapecode\Bundle\IbanBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ProviderCompilerPass
 *
 * @package Shapecode\Bundle\IbanBundle\DependencyInjection\Compiler
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class ProviderCompilerPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('shapecode_iban.handler');
        $tags = $container->findTaggedServiceIds('shapecode_iban.provider');

        foreach ($tags as $id => $configs) {
//            foreach ($configs as $config) {
            $definition->addMethodCall('addProvider', [new Reference($id)]);
//            }
        }
    }

}
