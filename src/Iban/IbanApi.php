<?php

namespace Shapecode\Bundle\IbanBundle\Iban;

/**
 * Class IbanApi
 *
 * @package Shapecode\Bundle\IbanBundle\Iban
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class IbanApi implements IbanApiInterface
{

    /** @var ProviderHandlerInterface */
    protected $handler;

    /** @var string */
    protected $providerName;

    /**
     * @param ProviderHandlerInterface $handler
     * @param                          $providerName
     */
    public function __construct(ProviderHandlerInterface $handler, $providerName)
    {
        $this->handler = $handler;
        $this->providerName = $providerName;
    }

    /**
     * @inheritdoc
     */
    public function generateIban($countryCode, $bankIdentification, $accountNr)
    {
        return $this->getProvider()->generateIban($countryCode, $bankIdentification, $accountNr);
    }

    /**
     * @inheritdoc
     */
    public function validateIban($iban)
    {
        return $this->getProvider()->validateIban($iban);
    }

    /**
     * @inheritdoc
     */
    public function generateBic($iban)
    {
        return $this->getProvider()->getBicFromIban($iban);
    }

    /**
     * @return null|\Shapecode\Bundle\IbanBundle\Provider\ProviderInterface
     */
    public function getProvider()
    {
        return $this->handler->getProvider($this->providerName);
    }

    /**
     * @param string $providerName
     */
    public function setProviderName($providerName)
    {
        $this->providerName = $providerName;
    }
}
