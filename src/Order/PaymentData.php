<?php
/**
 * Created by PhpStorm.
 * User: Elvis
 * Date: 17/11/2016
 * Time: 14:45
 */

namespace Reis\SteloSdk\Order;


use Reis\SteloSdk\Order\Cart\CartData;
use Reis\SteloSdk\Contract\Arrayable;
use Reis\SteloSdk\Order\Cart\Product;

class PaymentData implements Arrayable
{
    const PAYMENT_METHOD_CARTAO = 'credit';
    const PAYMENT_METHOD_BOLETO = 'bankSlip';

    const CURRENCY_BRL = 'BRL';

    /**
     * @var string Tipo de pagamento (credit / bankSlip)
     */
    private $paymentType;
    /**
     * @var string Moeda (BRL)
     */
    private $currency;
    /**
     * @var CardData
     */
    private $cardData;
    /**
     * @var double Valor total da compra incluindo frete
     */
    private $amount;
    /**
     * @var double Valor do desconto
     */
    private $discountAmount;
    /**
     * @var double Valor do frete
     */
    private $freight;
    /**
     * @var int Número de parcelas
     */
    private $installment;
    /**
     * @var CartData Dados do carrinho
     */
    private $cartData;

    /**
     * Payment constructor.
     * @param string $paymentType
     * @param string $currency
     * @param CardData $cardData
     * @param float $amount
     * @param float $discountAmount
     * @param float $freight
     * @param int $installment
     * @param CartData $cartData
     */
    public function __construct($paymentType = self::PAYMENT_METHOD_CARTAO, $currency = self::CURRENCY_BRL, CardData $cardData = null, $amount = 0, $discountAmount = 0, $freight = 0, $installment = 1, CartData $cartData = null)
    {
        $this->setPaymentType($paymentType);
        $this->setCurrency($currency);
        $this->setAmount($amount);
        $this->setDiscountAmount($discountAmount);
        $this->setFreight($freight);
        $this->setInstallment($installment);
        if($cardData instanceof CardData) {
            $this->setCardData($cardData);
        }
        if($cartData instanceof CartData){
            $this->setCartData($cartData);
        }
    }



    /**
     * @param string $paymentType
     * @return PaymentData
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    /**
     * @param string $currency
     * @return PaymentData
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param string $cardData
     * @return PaymentData
     */
    public function setCardData(CardData &$cardData)
    {
        $this->cardData = $cardData;
        return $this;
    }

    /**
     * @param float $amount
     * @return PaymentData
     */
    public function setAmount($amount)
    {
        $this->amount = (double)$amount;
        return $this;
    }

    /**
     * @param float $discountAmount
     * @return PaymentData
     */
    public function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = (double)$discountAmount;
        return $this;
    }

    /**
     * @param float $freight
     * @return PaymentData
     */
    public function setFreight($freight)
    {
        $this->freight = (double)$freight;
        return $this;
    }

    /**
     * @param int $installment
     * @return PaymentData
     */
    public function setInstallment($installment)
    {
        $this->installment = (int)$installment;
        return $this;
    }

    /**
     * @param CartData $cartData
     * @return PaymentData
     */
    public function setCartData(CartData &$cartData)
    {
        $this->cartData = $cartData;
        return $this;
    }

    /**
     * @param Product $product
     * @return PaymentData
     */
    public function addProduct(Product &$product)
    {
        if(is_null($this->cartData)){
            $this->cartData = new CartData();
        }
        $this->cartData->setItem($product);
        return $this;
    }

    /**
     * Returns a array representation of the object.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'paymentType' => $this->paymentType,
            'currency' => $this->currency,
            'cardData' => $this->cardData->toArray(),
            'amount' => $this->amount,
            'discountAmount' => $this->discountAmount,
            'freight' => $this->freight,
            'installment' => $this->installment,
            'cartData' => $this->cartData->toArray(),
        ];
    }


}