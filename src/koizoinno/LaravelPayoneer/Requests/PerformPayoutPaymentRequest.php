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
class PerformPayoutPaymentRequest extends BaseRequest implements RequestInterface {


    /**
     * @param      $programId
     * @param      $paymentId
     * @param      $payeeId
     * @param      $amount
     * @param      $description
     * @param      $paymentDate
     * @param null $groupId
     * @param null $currency
     */
    public function __construct(
        $programId,
        $paymentId,
        $payeeId,
        $amount,
        $description,
        $paymentDate,
        $groupId = null,
        $currency = null
    ) {
        $this->parameters['p4']       = $programId;
        $this->parameters['p5']       = $paymentId;
        $this->parameters['p6']       = $payeeId;
        $this->parameters['p7']       = $amount;
        $this->parameters['p8']       = $description;
        $this->parameters['p9']       = $paymentDate;
        $this->parameters['p11']      = $groupId;
        $this->parameters['Currency'] = $currency;
    }

}