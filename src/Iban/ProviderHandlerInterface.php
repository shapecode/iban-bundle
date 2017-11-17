<?php

namespace Shapecode\Bundle\IbanBundle\Iban;

use Shapecode\Bundle\IbanBundle\Provider\ProviderInterface;

/**
 * Interface ProviderHandlerInterface
 *
 * @package Shapecode\Bundle\IbanBundle\Iban
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface ProviderHandlerInterface
{

    /**
     * @return ProviderInterface[]
     */
    public function getProviders();

    /**
     * @param $name
     *
     * @return ProviderInterface|null
     */
    public function getProvider($name);

    /**
     * @param ProviderInterface $provider
     */
    public function addProvider(ProviderInterface $provider);
}
