<?php

namespace Shapecode\Bundle\IbanBundle\Iban;

/**
 * Class IbanGenerator
 *
 * @package Shapecode\Bundle\IbanBundle\Iban
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class IbanGenerator implements IbanGeneratorInterface
{

    /** @var IbanApiInterface */
    protected $api;

    /**
     * @param IbanApiInterface $api
     */
    public function __construct(IbanApiInterface $api)
    {
        $this->api = $api;
    }

    /**
     * @inheritdoc
     */
    public function generateIban($countryCode, $bankIdentification, $accountNr)
    {
        return $this->api->generateIban($countryCode, $bankIdentification, $accountNr);
    }

    /**
     * @inheritdoc
     */
    public function validateIban($iban)
    {
        return $this->api->validateIban($iban);
    }

    /**
     * @inheritdoc
     */
    public function generateBic($iban)
    {
        return $this->api->getBicFromIban($iban);
    }
}
