<?php

namespace Shapecode\Bundle\IbanBundle\Provider;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;

/**
 * Class OpenIbanProvider
 *
 * @package Shapecode\Bundle\IbanBundle\Provider
 * @author  Nikita Loges
 * @company tenolo GbR
 */
class OpenIbanProvider implements ProviderInterface
{

    /** @var ClientInterface */
    protected $client;

    /**
     * @inheritDoc
     */
    public function generateIban($countryCode, $bankIdentification, $accountNr)
    {
        $client = $this->getClient();
        $uri = 'https://openiban.com/v2/calculate/' . $countryCode . '/' . $bankIdentification . '/' . $accountNr;

        $response = $client->request('GET', $uri);
        $body = $response->getBody()->getContents();

        $data = json_decode($body);

        if ($data->valid) {
            return $data->iban;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function getBicFromIban($iban)
    {
        $client = $this->getClient();
        $uri = 'https://openiban.com/validate/' . $iban;

        $response = $client->request('GET', $uri, [
            'query' => [
                'getBIC'           => 'true',
                'validateBankCode' => 'true',
            ]
        ]);
        $body = $response->getBody()->getContents();

        $data = json_decode($body);

        if ($data->valid) {
            return $data->bankData->bic;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function validateIban($iban)
    {
        $client = $this->getClient();
        $uri = 'https://openiban.com/validate/' . $iban;

        $response = $client->request('GET', $uri, [
            'query' => [
                'getBIC'           => 'true',
                'validateBankCode' => 'true',
            ]
        ]);
        $body = $response->getBody()->getContents();

        $data = json_decode($body);

        return $data->valid;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'open_iban';
    }

    /**
     */
    protected function getClient()
    {
        if (is_null($this->client)) {
            $this->setClient(new Client());
        }

        return $this->client;
    }

    /**
     * @param ClientInterface $client
     */
    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

}
