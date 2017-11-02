<?php

namespace Shapecode\Bundle\IbanBundle\Iban;

use Shapecode\Bundle\IBANBundle\Exception\IbanApiException;

/**
 * Class IbanApiInterface
 *
 * @package Shapecode\Bundle\IbanBundle\Iban
 * @author  Nikita Loges
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
     * @throws IbanApiException
     * @return string
     */
    public function generateIban($countryCode, $bankIdentification, $accountNr);

    /**
     * Tests get BIC code from IBAN
     *
     * @param $iban
     *
     * @throws IbanApiException
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
}
