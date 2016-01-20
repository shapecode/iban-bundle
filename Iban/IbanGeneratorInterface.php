<?php

namespace Shapecode\Bundle\IbanBundle\Iban;

/**
 * Class IbanGeneratorInterface
 * @package Shapecode\Bundle\IbanBundle\Iban
 * @author Nikita Loges
 * @company tenolo GbR
 */
interface IbanGeneratorInterface
{

    /**
     * Generates IBAN code
     *
     * @return string
     */
    public function generateIban($countryCode, $bankIdentification, $accountNr);

    /**
     * Checks if iban is valid
     *
     * @return boolean
     */
    public function validateIban($iban);

    /**
     * Generates BIC from IBAN
     *
     * @return string
     */
    public function generateBic($iban);
}
