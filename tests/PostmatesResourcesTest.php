<?php

use Postmates\PostmatesClient;
use Postmates\Resources\DeliveryZones;
use Postmates\Resources\DeliveryQuote;
use Postmates\Resources\Delivery;

class PostmatesResourcesTest extends PHPUnit_Framework_TestCase
{
    
    private $_postmates_client;

    protected function setUp()
    {
        $this->_postmates_client = new PostmatesClient([
            'customer_id' => getenv('CUSTOMER_ID'),
            'api_key' => getenv('API_KEY')
        ]);

    }

    public function testDeliveryZones()
    {
        $zones = new DeliveryZones($this->_postmates_client);

        foreach ($zones->listZones() as $zone) {

            $this->assertArrayHasKey('type', $zone);

        }

    }

    public function testDeliveryQuote()
    {

        $delivery_quote = new DeliveryQuote($this->_postmates_client);
        $quote = $delivery_quote->getQuote('224 Townsend Street, San Francisco, CA', '222 Townsend Street, San Francisco, CA');
        $this->assertArrayHasKey('fee', $quote);

    }

    public function testDeliveryCreate()
    {

        $delivery = new Delivery($this->_postmates_client);

        $params = [
            'manifest' => 'test manifest',
            'pickup_name' => 'test pickup nanme',
            'pickup_address' => '222 Townsend Street, San Francisco, CA',
            'pickup_phone_number' => '222 551 1234',
            'dropoff_name' => 'test dropoff name',
            'dropoff_address' => '224 Townsend Street, San Francisco, CA',
            'dropoff_phone_number' => '222 555 5432',
        ];

        $delivery_response = $delivery->create($params);

        $this->assertArrayHasKey('id', $delivery_response);

    }

    public function testGetADelivery()
    {

        $delivery = new Delivery($this->_postmates_client);

        $delivery_response = $delivery->get('del_LAPCo_EAxDv6z-');

        $this->assertArrayHasKey('id', $delivery_response);
        $this->assertEquals('del_LAPCo_EAxDv6z-', $delivery_response['id']);

    }


}
