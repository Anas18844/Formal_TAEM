<?php
interface PaymentStrategy{
    public function pay(float $amount):string;
}
class cashPayment implements PaymentStrategy{
    public function pay(float $amount):string{
        return "Paid $amount in cash";
    }
}
class creditCard implements PaymentStrategy{
    public function pay(float $amount ):string{
        return "Paid $amount using credit card";
    }
}
class PaymentContext{
    public function __construct(private PaymentStrategy $strategy){}
    public function execute (float $amount ):string{
        return $this->strategy->pay($amount);
    }
}