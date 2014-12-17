<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/12/14
 * Time: 8:21 PM
 */

namespace koizoinno\LaravelPayoneer\Requests;


use koizoinno\LaravelPayoneer\Contracts\RequestInterface;

/**
 * Class BasicRequest
 * @package koizoinno\LaravelPayoneer\Requests
 */
class BasicPaymentRequest extends BaseRequest implements RequestInterface {

    /**
     * @param $paymentId
     */
    public function __construct($paymentId)
    {
        $this->parameters['p4'] = $paymentId;
    }

}