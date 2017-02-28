<?php

namespace Postmates\Resources;

class Delivery extends AbstractResource
{

    protected $endpoint = 'customers/[customer_id]/deliveries';

    /**
     * Create a new delivery
     *
     * https://postmates.com/developer/docs/endpoints#create_delivery
     *
     * @param array $delivery_params
     * @return mixed
     */
    public function create(array $delivery_params = [])
    {

        return $this->call('POST', $delivery_params);

    }

    /**
     * Get all deliveries
     *
     * https://postmates.com/developer/docs/endpoints#list_deliveries
     *
     * @param string $filter
     * @return mixed
     */
    public function list(string $filter = '')
    {
        $this->setParams([
            'filter' => $filter
        ]);

        return $this->call('GET');

    }

    /**
     * Get a delivery by id
     *
     * https://postmates.com/developer/docs/endpoints#get_delivery
     *
     * @param string $delivery_id
     * @return mixed
     */
    public function get(string $delivery_id)
    {

        $this->setEndpoint($this->getEndpoint() . '/' . $delivery_id);

        return $this->call('GET');

    }

    /**
     * Cancel a delivery
     *
     * https://postmates.com/developer/docs/endpoints#cancel_delivery
     *
     * @param string $delivery_id
     * @return mixed
     */
    public function cancel(string $delivery_id)
    {

        $this->setEndpoint($this->getEndpoint() . '/' . $delivery_id . '/cancel');

        return $this->call('POST');

    }

    /**
     * Add tip to a delivery
     *
     * https://postmates.com/developer/docs/endpoints#tip_delivery
     *
     * @param string $delivery_id
     * @param int $amount_in_cents
     * @return mixed
     */
    public function addTip(string $delivery_id, int $amount_in_cents)
    {

        $this->setEndpoint($this->getEndpoint() . '/' . $delivery_id);

        $this->setParams([
            'tip_by_customer' => $amount_in_cents
        ]);

        return $this->call('POST');

    }

}