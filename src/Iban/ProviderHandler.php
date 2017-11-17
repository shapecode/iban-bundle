<?php

namespace Shapecode\Bundle\IbanBundle\Iban;

use Doctrine\Common\Collections\ArrayCollection;
use Shapecode\Bundle\IbanBundle\Provider\ProviderInterface;

/**
 * Class ProviderHandler
 *
 * @package Shapecode\Bundle\IbanBundle\Iban
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class ProviderHandler implements ProviderHandlerInterface
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
     * @inheritdoc
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * @inheritdoc
     */
    public function getProvider($name)
    {
        return $this->providers->get($name);
    }

    /**
     * @inheritdoc
     */
    public function addProvider(ProviderInterface $provider)
    {
        if (!$this->providers->contains($provider)) {
            $this->providers->set($provider->getName(), $provider);
        }
    }
}
