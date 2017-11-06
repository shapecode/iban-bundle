<?php

namespace Shapecode\Bundle\IbanBundle\Provider;

/**
 * Interface ProviderInterface
 *
 * @package Shapecode\Bundle\IbanBundle\Provider
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface ProviderInterface
{

    /**
     * Generates IBAN code
     *
     * @param $countryCode
     * @param $bankIdentification
     * @param $accountNr
     *
     * @return string
     */
    public function generateIban($countryCode, $bankIdentification, $accountNr);

    /**
     * Tests get BIC code from IBAN
     *
     * @param $iban
     *
     * @return string
     */
    public function getBicFromIban($iban);

    /**
     * Validates IBAN
     *
     * @param $iban
     *
     * @return boolean
     */
    public function validateIban($iban);

    /**
     * @return string
     */
    public function getName();
}
