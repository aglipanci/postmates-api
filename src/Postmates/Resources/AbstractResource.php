<?php

namespace Postmates\Resources;

use Postmates\PostmatesClient;
use Postmates\PostmatesException;

/**
 * @package Postmates\Resources
 */
abstract class AbstractResource {

    /**
     * HTTP Client
     *
     * @var PostmatesClient
     */
    protected $client;

    /**
     * Endpoint URL
     *
     * @var
     */
    protected $endpoint;

    /**
     * Request parameters
     *
     * @var array
     */
    protected $params = [];


    /**
     * Constructor
     *
     * @param PostmatesClient $client
     */
    public function __construct(PostmatesClient $client)
    {
        $this->client = $client;
    }

    /**
     * Handle API Calls
     *
     * @param $method
     * @return mixed
     * @throws PostmatesException
     */
    protected function call($method)
    {
        try {

            // in case of customer_id being in the URL replace it here with the customer_id from config
            $this->setEndpoint(str_replace('[customer_id]', $this->client->getConfig()['customer_id'], $this->getEndpoint()));

            $params = [];

            // include params if present
            if( !empty($this->getParams()) ) {

                if($method == 'POST') {

                    $params =  [
                        'form_params' => $this->getParams()
                    ];

                }

                if($method == 'GET') {

                    $params = [
                        'query' => $this->getParams()
                    ];

                }

            }

            $response = $this->client->getHttpClient()->request($method, $this->getEndpoint(), $params);


        } catch (\Exception $e) {

            throw new PostmatesException($e->getMessage(), $e->getCode());

        }

        $parsed_response = json_decode($response->getBody(), true);

        if($parsed_response === null) {

            throw new PostmatesException('Empty body response.');

        }

        if(is_array($parsed_response) && isset($parsed_response['kind']) && $parsed_response['kind'] == 'error') {

            if($parsed_response['code'] == 'invalid_params') {

                throw new PostmatesException($parsed_response['message'], 0, null, $parsed_response['params']);

            }

            throw new PostmatesException($parsed_response['message']);

        }

        return $parsed_response;

    }

    /**
     * @return mixed
     */
    protected function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    protected function setEndpoint(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }


}