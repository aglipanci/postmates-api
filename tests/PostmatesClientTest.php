<?php

use Postmates\PostmatesClient;


class PostmatesClientTest extends PHPUnit_Framework_TestCase
{

    public function testHttpClientInitialization()
    {
        $client = new PostmatesClient();
        $this->assertInstanceOf('GuzzleHttp\Client', $client->getHttpClient());

    }

    public function testClientConfig()
    {

        $client = new PostmatesClient();
        $config = $client->getConfig();

        $this->assertArrayHasKey('customer_id', $config);
        $this->assertArrayHasKey('api_key', $config);
        $this->assertArrayHasKey('postmates_version', $config);
        $this->assertArrayHasKey('base_path', $config);
        $this->assertArrayHasKey('api_version', $config);

    }

}
