<?php

namespace Postmates\Resources;


class DeliveryZones extends AbstractResource
{
    /**
     * Base endpoint for Delivery Quote
     *
     * @var string
     */
    protected $endpoint = 'delivery_zones';

    /**
     * List all delivery zones
     *
     * https://postmates.com/developer/docs/endpoints#get_zones
     *
     * @return mixed
     */
    public function listZones()
    {
        return $this
            ->setMethod('GET')
            ->send();

    }
}