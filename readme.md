# PHP API Client for Postmates
[![Build Status](https://travis-ci.org/aglipanci/postmates-api.svg?branch=master)](https://travis-ci.org/aglipanci/postmates-api)

A PHP client for consuming the Postmates API.

## Install

Via Composer

``` bash
$ composer require aglipanci/postmates-api
```

> Note that the minimum required version of PHP is 5.6

## Usage

### Create client

```php
$client = new Postmates\PostmatesClient([
    'customer_id' => 'some_customer_id',
    'api_key' => 'production_or_test_api_key'
]);
```
*Retrieve an API Key [here](https://postmates.com/developer/apikey) after creating a developer account.*

### Get a Delivery Quote

```php
$delivery_quote = new Postmates\Resources\DeliveryQuote($client);
$delivery_quote->getQuote('501-525 Brannan St, San Francisco, CA 94107', '6 Colin P Kelly Jr St, San Francisco, CA 94107');
```
[https://postmates.com/developer/docs/endpoints#get_quote](https://postmates.com/developer/docs/endpoints#get_quote)

### Get Delivery Zones

```php
$delivery_zones = new Postmates\Resources\DeliveryZones($client);
$delivery_zones->listZones();
```

[https://postmates.com/developer/docs/endpoints#get_zones](https://postmates.com/developer/docs/endpoints#get_zones)

### Create a Delivery

```php
$delivery = new Postmates\Resources\Delivery($client);

$params = [
    'manifest' => 'test manifest',
    'pickup_name' => 'test pickup nanme',
    'pickup_address' => '501-525 Brannan St, San Francisco, CA 94107',
    'pickup_phone_number' => '222 551 1234',
    'dropoff_name' => 'test dropoff name',
    'dropoff_address' => '6 Colin P Kelly Jr St, San Francisco, CA 94107',
    'dropoff_phone_number' => '222 555 5432',
];

$delivery->create($params);
```

[https://postmates.com/developer/docs/endpoints#create_delivery](https://postmates.com/developer/docs/endpoints#create_delivery)

### List Deliveries

```php
$delivery = new Postmates\Resources\Delivery($client);
$delivery->listDeliveries();
```

[https://postmates.com/developer/docs/endpoints#list_deliveries](https://postmates.com/developer/docs/endpoints#list_deliveries)

### Get a Delivery

```php
$delivery = new Postmates\Resources\Delivery($client);
$delivery->get('del_LAPCo_EAxDv6z-');
```

[https://postmates.com/developer/docs/endpoints#get_delivery](https://postmates.com/developer/docs/endpoints#get_delivery)

### Cancel a Delivery

```php
$delivery = new Postmates\Resources\Delivery($client);
$delivery->cancel('del_LAPCo_EAxDv6a-');
```

[https://postmates.com/developer/docs/endpoints#cancel_delivery](https://postmates.com/developer/docs/endpoints#cancel_delivery)

### Add Tip to a Delivery

```php
$delivery = new Postmates\Resources\Delivery($client);
$delivery->addTip('del_LAPCo_EAxDv6a-', 1000); // amount in cents
```

[https://postmates.com/developer/docs/endpoints#tip_delivery](https://postmates.com/developer/docs/endpoints#tip_delivery)


### Handing WebHooks

```php
$webhook = new Postmates\PostmatesWebhook('signature_secret_key');
$webhook_request = $webhook->parseRequest() // this will validate and return the webhook request

if($webhook_request['kind'] == Delivery::EVENT_DELIVERY_STATUS) {
    //this is a delivery status event
}

if($webhook_request['kind'] == Delivery::EVENT_COURIER_UPDATE) {
    //this is a courrier update event
}
```
if you want to just validate the request but handing it on your own:
```php
$webhook = new Postmates\PostmatesWebhook('signature_secret_key');
$webhook_request_is_valid = $webhook->validateRequest($payload, $key)
```

[https://postmates.com/developer/docs#webhooks](https://postmates.com/developer/docs#webhooks)

### Errors
All requests will throw an Postmates\PostmatesException in case API returns an Error.
An Example:
```php
$params = [
    'manifest' => 'test manifest',
    'pickup_name' => 'test pickup nanme',
    'pickup_address' => '501-525 Brannan St, San Francisco, CA 94107',
    'pickup_phone_number' => '222 551 1234',
    'dropoff_name' => 'test dropoff name',
    'dropoff_address' => '6 Colin P Kelly Jr St, San Francisco, CA 94107',
    'dropoff_phone_number' => '222 555 5432',
];


try {

    $delivery->create($params);
    
} catch (Postmates\PostmatesException $e) {
    
    $e->getMessage();
    $e->getInvalidParams();
    
}
```


## Testing

``` bash
$ ./vendor/bin/phpunit
```

## Credits

[Agli Panci](https://github.com/aglipanci)


## WooCommerce Integration

[WooCommerce Postmates Integration Plugin](https://wordpress.org/plugins/woo-postmates-integration/)

## License

The [MIT License](https://opensource.org/licenses/MIT) (MIT).
