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
 * Class GetPaymentStatusRequest
 * @package koizoinno\LaravelPayoneer\Requests
 */
class GetPaymentStatusRequest extends BaseRequest implements RequestInterface {


    /**
     * @param $payeeId
     * @param $paymentId
     */
    public function __construct($payeeId, $paymentId)
    {
        $this->parameters['p4'] = $payeeId;
        $this->parameters['p5'] = $paymentId;
    }

}