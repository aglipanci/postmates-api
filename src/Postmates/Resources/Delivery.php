<?php

namespace Postmates\Resources;

class Delivery extends AbstractResource
{
    /**
     * Delivery Status Event Type
     */
    const EVENT_DELIVERY_STATUS = 'event.delivery_status';

    /**
     * Courier Update Event Type
     */
    const EVENT_COURIER_UPDATE = 'event.courier_update';

    /**
     * Pickup is being happening status
     */
    const STATUS_PICKUP = 'pickup';

    /**
     * Pickup has been completed status
     */
    const STATUS_PICKUP_COMPLETE = 'pickup_complete';

    /**
     * Dropoff is being happening status
     */
    const STATUS_DROPOFF = 'dropoff';

    /**
     * Delivery has been completed status
     */
    const STATUS_DELIVERED = 'delivered';

    /**
     * Base endpoint for Deliveries
     *
     * @var string
     */
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
    public function get($delivery_id)
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