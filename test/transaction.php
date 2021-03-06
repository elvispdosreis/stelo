<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 17/11/2016
 * Time: 21:56
 */
require __DIR__ . '/config.php';
require __DIR__ . '/../vendor/autoload.php';

use Reis\SteloSdk\Customer\BillingAddress;
use Reis\SteloSdk\Customer\Phone\Phone;
use Reis\SteloSdk\Customer\ShippingAddress;
use Reis\SteloSdk\Order\Card;
use Reis\SteloSdk\Order\Cart\Product;
use Reis\SteloSdk\Order\CustomerData;
use Reis\SteloSdk\Order\Order;
use Reis\SteloSdk\Order\OrderData;
use Reis\SteloSdk\Order\PaymentData;
use Reis\SteloSdk\Stelo;

try {


    $card = new Card();
    $card->setNumber('4066553613548107');
    $card->setEmbossing('Fulano');
    $card->setExpiryDate('10/17');
    $card->setCvv('903');

    $stelo = new Stelo(Stelo::SANDBOX, CLIENT_ID, SECRET_ID);
    $cardData = $stelo->getToken($card);


    $orderData = new OrderData();
    $orderData->setOrderId(111);

    $billingAddress = new BillingAddress();
    $billingAddress->setStreet('BILLING Rua')
        ->setNumber('999')
        ->setComplement('XXX')
        ->setNeighborhood('Centro')
        ->setZipCode('07115000')
        ->setCity('Guarulhos')
        ->setState('SP')
        ->setCountry('BR');

    $shippingAddress = new ShippingAddress();
    $shippingAddress->setStreet('SHIPPING Rua')
        ->setNumber('999')
        ->setComplement('XXX')
        ->setNeighborhood('Centro')
        ->setZipCode('07115000')
        ->setCity('Guarulhos')
        ->setState('SP')
        ->setCountry('BR')
        ->setReceiver('Teste Integração');

    $cel1 = new Phone(Phone::TYPE_FIXO, '11', '24242424');
    $cel2 = new Phone(Phone::TYPE_CELL, '11', '998989898');

    $customerData = new CustomerData();

    $customerData->setCustomerIdentity('65776434661')
        ->setCustomerName('Teste Integração')
        ->setCustomerEmail('teste@teste.com.br')
        ->setBirthDate('1991-01-20')
        ->setBillingAddress($billingAddress)
        ->setShippingAddress($shippingAddress)
        ->addPhone($cel1)
        ->addPhone($cel2);


    $product1 = new Product();
    $product1->setProductSku(1)
        ->setProductName('Coalesce: Functioning On Impatience T-Shirt')
        ->setProductPrice(15.90)
        ->setProductQuantity(1);


    $paymentData = new PaymentData();
    $paymentData->setPaymentType(PaymentData::PAYMENT_METHOD_CARTAO)
        ->setCurrency(PaymentData::CURRENCY_BRL)
        ->setCardData($cardData)
        ->setAmount(180.00)
        ->setDiscountAmount(0)
        ->setFreight(45.00)
        ->setInstallment(3)
        ->addProduct($product1);

    $order = new Order();
    $order->setOrder($orderData)
        ->setCustomer($customerData)
        ->setPayment($paymentData);


    $res = $stelo->sendTransaction($order);
    print_r($res);

} catch (\Exception $e) {
    print_r($e->getMessage());
}