<?php

namespace Shapecode\Bundle\IbanBundle\Iban;

use Doctrine\Common\Collections\ArrayCollection;
use Shapecode\Bundle\IbanBundle\Provider\ProviderInterface;

/**
 * Class IbanHandler
 *
 * @package Shapecode\Bundle\IbanBundle\Iban
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class IbanHandler
{

    /** @var ProviderInterface[] */
    protected $providers;

    /**
     *
     */
    public function __construct()
    {
        $this->providers = new ArrayCollection();
    }

    /**
     * @return ProviderInterface[]
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * @param $name
     *
     * @return ProviderInterface|null
     */
    public function getProvider($name)
    {
        return $this->providers->get($name);
    }

    /**
     * @param ProviderInterface $provider
     */
    public function addProvider(ProviderInterface $provider)
    {
        if (!$this->providers->contains($provider)) {
            $this->providers->set($provider->getName(), $provider);
        }
    }
}
