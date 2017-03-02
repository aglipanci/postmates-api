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
        return $this
            ->setMethod('POST')
            ->setParams($delivery_params)
            ->send();

    }

    /**
     * Get all deliveries
     *
     * https://postmates.com/developer/docs/endpoints#list_deliveries
     *
     * @param string $filter
     * @return mixed
     */
    public function listDeliveries($filter = '')
    {
        return $this
            ->setMethod('GET')
            ->setParams([
                'filter' => $filter
            ])
            ->send();

    }

    /**
     * Get a delivery by id
     *
     * https://postmates.com/developer/docs/endpoints#get_delivery
     *
     * @param string $delivery_id
     * @return mixed
     */
    public function get(\string $delivery_id)
    {

        return $this
            ->setEndpoint($this->getEndpoint() . '/' . $delivery_id)
            ->setMethod('GET')
            ->send();

    }

    /**
     * Cancel a delivery
     *
     * https://postmates.com/developer/docs/endpoints#cancel_delivery
     *
     * @param string $delivery_id
     * @return mixed
     */
    public function cancel($delivery_id)
    {

        return $this
            ->setEndpoint($this->getEndpoint() . '/' . $delivery_id . '/cancel')
            ->setMethod('POST')
            ->send();

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
    public function addTip($delivery_id, $amount_in_cents)
    {

        return $this
            ->setEndpoint($this->getEndpoint() . '/' . $delivery_id)
            ->setMethod('POST')
            ->setParams([
                'tip_by_customer' => $amount_in_cents
            ])
            ->send();

    }

}