<?php namespace koizoinno\LaravelPayoneer\Requests;

use koizoinno\LaravelPayoneer\Contracts\RequestInterface;

class ChargeAccountRequest extends BaseRequest implements RequestInterface
{

    /**
     * ChargeAccountRequest constructor.
     * @param $amount
     * @param $accountId
     * @param string $description
     * @param null $paymentId
     */
    public function __construct($amount, $accountId, $description = '', $paymentId = null)
    {
        $this->parameters['p4'] = $accountId;
        $this->parameters['p5'] = $amount;
        $this->parameters['p6'] = $paymentId ?: uniqid($accountId . ':', true);;
        $this->parameters['p7'] = $description;
    }
}