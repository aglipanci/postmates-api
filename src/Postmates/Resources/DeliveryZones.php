<?php

namespace Postmates\Resources;


class DeliveryZones extends AbstractResource
{
    protected $endpoint = 'delivery_zones';

    /**
     * List all delivery zones
     *
     * @return mixed
     */
    public function list()
    {
        return $this->call('GET');
    }
}