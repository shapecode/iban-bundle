<?php

namespace Shapecode\Bundle\IbanBundle;

use Shapecode\Bundle\IbanBundle\DependencyInjection\Compiler\ProviderCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class ShapecodeIbanBundle
 *
 * @package Shapecode\Bundle\IbanBundle
 * @author  Nikita Loges
 */
class ShapecodeIbanBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ProviderCompilerPass());
    }
}
