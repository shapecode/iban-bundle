<?php

namespace Shapecode\Bundle\IbanBundle\Iban;

/**
 * Class IbanGeneratorInterface
 *
 * @package Shapecode\Bundle\IbanBundle\Iban
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface IbanGeneratorInterface
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
     * Checks if iban is valid
     *
     * @param $iban
     *
     * @return boolean
     */
    public function validateIban($iban);

    /**
     * Generates BIC from IBAN
     *
     * @param $iban
     *
     * @return string
     */
    public function generateBic($iban);
}
