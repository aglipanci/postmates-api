<?php

namespace Postmates\Resources;


class DeliveryZones extends AbstractResource
{
    protected $endpoint = 'delivery_zones';

    /**
     * List all delivery zones
     *
     * https://postmates.com/developer/docs/endpoints#get_zones
     *
     * @return mixed
     */
    public function list()
    {
        return $this
            ->setMethod('GET')
            ->send();

    }
}