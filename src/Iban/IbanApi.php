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
}
