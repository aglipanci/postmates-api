<?php

namespace Postmates;


use GuzzleHttp\Client;


class PostmatesClient
{

    /**
     * API Base URL
     */
    const API_BASE_PATH = 'https://api.postmates.com/';

    /**
     * API Version
     */
    const API_VERSION = 'v1';

    /**
     * HTTP Client
     *
     * @var
     */
    private $http;

    /**
     * Config
     *
     * @var array
     */
    private $config;

    /**
     * Postmates_Client constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {

        $this->config = array_merge(
              [
                  'customer_id' => '',
                  'api_key' => '',
                  'postmates_version' => '',
                  'base_path' => self::API_BASE_PATH,
                  'api_version' => self::API_VERSION

              ],
            $config
        );

    }

    /**
     * Initiating HTTP Client
     *
     * @return Client
     */
    public function getHttpClient()
    {
        if (is_null($this->http)) {

            $options = ['exceptions' => false];
            $options['base_uri'] = $this->config['base_path'] . $this->config['api_version'] . '/';

            if(!empty($this->config['postmates_version']))
                $options['headers'] = ['X-Postmates-Version' => $this->config['postmates_version']];

            $options['auth'] = [$this->config['api_key'], ''];

            $this->http = new Client($options);

        }

        return $this->http;
    }

    /**
     * Get current config
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

}