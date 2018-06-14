<?php

namespace Shapecode\Bundle\IbanBundle\Iban;

/**
 * Class IbanApiInterface
 *
 * @package Shapecode\Bundle\IbanBundle\Iban
 * @author  Nikita Loges
 * @company tenolo GbR
 */
interface IbanApiInterface
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
}
