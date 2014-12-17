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
class PayeeRequest extends BaseRequest implements RequestInterface {

    /**
     * @param $payeeId
     */
    public function __construct($payeeId)
    {
        $this->parameters['p4'] = $payeeId;
    }

}