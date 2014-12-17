<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/12/14
 * Time: 8:21 PM
 */

namespace koizoinno\LaravelPayoneer\Requests;


use koizoinno\LaravelPayoneer\Contracts\RequestInterface;
use koizoinno\LaravelPayoneer\PayoneerAPI;

/**
 * Class PayeeSignupRequest
 * @package koizoinno\LaravelPayoneer\Requests
 */
class PayeeSignupRequest extends BaseRequest implements RequestInterface {

    /**
     * @param int    $payeeId
     * @param        $sessionId
     * @param        $redirectUrl
     * @param        $redirectTime
     * @param        $testAccount
     * @param        $xmlResponse
     * @param array  $payoutMethods
     * @param string $achMode
     */
    function __construct(
        $payeeId,
        $redirectUrl,
        $sessionId = '',
        $redirectTime = '10',
        $testAccount = 'false',
        $xmlResponse = 'true',
        array $payoutMethods = array(
            PayoneerAPI::PAYOUT_CARD,
            PayoneerAPI::PAYOUT_ACH,
// TODO Figure out why enabling the two options below causes an 'Unauthorized action' error.
//            PayoneerAPI::PAYOUT_CHECK,
//            PayoneerAPI::PAYOUT_DEPOSIT
        ),
        $achMode = PayoneerAPI::ACH_MODE_REGULAR
    ) {
        $this->parameters['p4']  = $payeeId;
        $this->parameters['p5']  = $sessionId;
        $this->parameters['p6']  = $redirectUrl;
        $this->parameters['p8']  = $redirectTime;
        $this->parameters['p9']  = $testAccount;
        $this->parameters['p10'] = $xmlResponse;
        $this->parameters['p11'] = implode(',', $payoutMethods);
        $this->parameters['p12'] = $achMode;
    }
}