<?php

namespace Shapecode\Bundle\IbanBundle\Iban;

use Shapecode\Bundle\IbanBundle\Exception\IbanApiException;

/**
 * Class IbanApiDeApi
 * @package Shapecode\Bundle\IbanBundle\Iban
 * @author Nikita Loges
 * @company tenolo GbR
 */
class IbanApiDeApi implements IbanApiInterface
{

    const WSDL = 'http://www.iban-api.de:8081/IbanService?wsdl';
    const ERROR = 'ERROR';

    /** @var \SoapClient */
    protected $client;

    /**
     *
     */
    public function __construct()
    {
        $this->client = new \SoapClient(self::WSDL, ['trace' => true]);
    }

    /**
     * @inheritdoc
     */
    public function generateIban($countryCode, $bankIdentification, $accountNr)
    {
        if (!($countryCode && $bankIdentification && $accountNr)) {
            throw new IbanApiException("Missing data");
        }

        $function = 'generateIban';

        $soapCall = $this->client->__soapCall($function, [
            [
                'contryCode' => $countryCode,
                'bankIdent' => $bankIdentification,
                'accountNumber' => $accountNr
            ]
        ]);

        $result = $this->parseResult($soapCall, $function);

        if ($result == static::WSDL) {
            return false;
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function getBicFromIban($iban)
    {
        if (!$iban) {
            throw new IbanApiException("Missing data");
        }

        $function = 'getBicFromIban';

        $soapCall = $this->client->__soapCall($function, [
            [
                'iban' => $iban
            ]
        ]);

        return $this->parseResult($soapCall, $function);
    }

    /**
     * @inheritdoc
     */
    public function validateIban($iban)
    {
        $function = 'validateIban';

        $soapCall = $this->client->__soapCall($function, [
            [
                'iban' => $iban
            ]
        ]);

        return $this->parseResult($soapCall, $function) == 'true';
    }

    /**
     * Parses the result
     *
     * @param \stdClass $result
     * @param           $function
     *
     * @return mixed
     * @throws IbanApiException
     */
    protected function parseResult(\stdClass $result, $function)
    {
        if ($result->$function == self::ERROR) {
            return false;
        }

        return $result->$function;
    }
}
