<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 22/11/2016
 * Time: 08:39
 */

namespace Reis\SteloSdk\Order;


use Reis\SteloSdk\Contract\Arrayable;

class Order implements Arrayable
{
    /**
     * @var OrderData
     */
    private $order;
    /**
     * @var PaymentData
     */
    private $payment;
    /**
     * @var CustomerData
     */
    private $customer;

    /**
     * Order constructor.
     * @param OrderData $order
     * @param PaymentData $payment
     * @param CustomerData $customer
     */
    public function __construct(OrderData $order = null, PaymentData $payment = null, CustomerData $customer = null)
    {
        $this->order = $order;
        $this->payment = $payment;
        $this->customer = $customer;

        /*
            if (!is_null($order)) {
                self::setOrder($order);
            }
            if (!is_null($payment)) {
                self::setPayment($payment);
            }
            if (!is_null($customer)) {
                self::setCustomer($customer);
            }

            if (is_null($this->cardData)) {
                self::sendToken();
            }

            $this->payment->setCardData($this->cardData);
         */
    }

    /**
     * @param OrderData $order
     * @return Order
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @param PaymentData $payment
     * @return Order
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @param CustomerData $customer
     * @return Order
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    public function toArray()
    {
        return [
            'orderData' => $this->order->toArray(),
            'paymentData' => $this->payment->toArray(),
            'customerData' => $this->customer->toArray()
        ];
    }

}