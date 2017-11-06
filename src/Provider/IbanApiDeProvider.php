<?php

namespace Shapecode\Bundle\IbanBundle\Provider;

/**
 * Class IbanApiDeProvider
 *
 * @package Shapecode\Bundle\IbanBundle\Provider
 * @author  Nikita Loges
 */
class IbanApiDeProvider implements ProviderInterface
{

    const WSDL = 'http://www.iban-api.de:8081/IbanService?wsdl';
    const ERROR = 'ERROR';

    /** @var \SoapClient */
    protected $client;

    /**
     * @inheritdoc
     */
    public function generateIban($countryCode, $bankIdentification, $accountNr)
    {
        $function = 'generateIban';

        $soapCall = $this->getClient()->__soapCall($function, [
            [
                'contryCode'    => $countryCode,
                'bankIdent'     => $bankIdentification,
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
        $function = 'getBicFromIban';

        $soapCall = $this->getClient()->__soapCall($function, [
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

        $soapCall = $this->getClient()->__soapCall($function, [
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
     */
    protected function parseResult(\stdClass $result, $function)
    {
        if ($result->$function == self::ERROR) {
            return false;
        }

        return $result->$function;
    }

    /**
     * @return \SoapClient
     */
    public function getClient()
    {
        if (is_null($this->client)) {
            $this->client = new \SoapClient(self::WSDL, ['trace' => true]);
        }

        return $this->client;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'iban_api_de';
    }
}
