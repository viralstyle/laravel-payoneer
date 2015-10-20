<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/11/14
 * Time: 11:23 PM
 */

namespace koizoinno\LaravelPayoneer;


use koizoinno\LaravelPayoneer\Requests\BasicPaymentRequest;
use koizoinno\LaravelPayoneer\Requests\BasicRequest;
use koizoinno\LaravelPayoneer\Requests\ChangePayeeIdRequest;
use koizoinno\LaravelPayoneer\Requests\GetPayeesReportRequest;
use koizoinno\LaravelPayoneer\Requests\GetPaymentStatusRequest;
use koizoinno\LaravelPayoneer\Requests\PayeeRequest;
use koizoinno\LaravelPayoneer\Requests\PayeeSignupAutoPopulationRequest;
use koizoinno\LaravelPayoneer\Requests\PayeeSignupRequest;
use koizoinno\LaravelPayoneer\Requests\PerformPayoutPaymentRequest;
use koizoinno\LaravelPayoneer\Services\BaseService;
use SimpleXMLElement;

/**
 * Class PayoneerAPI
 * @package koizoinno\LaravelPayoneer
 */
class PayoneerAPI extends BaseService {

    const PAYOUT_CARD = 'PrepaidCard';
    const PAYOUT_DEPOSIT = 'DirectDeposit';
    const PAYOUT_ACH = 'iACH';
    const PAYOUT_CHECK = 'PaperCheck';

    const ACH_MODE_REGULAR = 'Regular';
    const ACH_MODE_EXPRESS = 'Express';

    /**
     * @param PayoneerConfig $config
     */
    function __construct(PayoneerConfig $config)
    {
        parent::__construct($config);
    }

    /**
     * The payee sign-up page URL is unique and is generated
     * by Payoneer specifically for each sign-up session.
     *
     * @param PayeeSignupRequest $request
     * @throws \Exception
     * @return array
     */
    public function getToken(PayeeSignupRequest $request)
    {
        $response = $this->call('GetToken', $request);
        $xml = simplexml_load_string($response->getBody()->getContents());
        return $this->xmlToArray($xml);
    }

    /**
     * The payee sign-up page URL is unique and is generated
     * by Payoneer specifically for each sign-up session.
     *
     * @param PayeeSignupAutoPopulationRequest $request
     * @throws \Exception
     * @return array
     */
    public function getTokenXML(PayeeSignupAutoPopulationRequest $request)
    {

        $response = $this->call('GetTokenXML', $request);
//        return $this->xmlToArray($response->xml());

        /**
         * The XML returned by the GetTokenXML method is
         * not well formed.  We must work around this
         * and manually parse the response.
         */

        $response = html_entity_decode((string)$response->getBody());
        $xml      = simplexml_load_string($response);
        return $this->xmlToArray($xml);

    }

    /**
     * This method provides the status of the API and payout
     * services (Heart Beep).
     *
     * @return mixed
     */
    public function getApiStatus()
    {
        $response = $this->call('Echo', new BasicRequest());
        $xml = simplexml_load_string($response->getBody()->getContents());
        return $this->xmlToArray($xml);
    }

    /**
     * This method provides the API version.
     *
     * @return mixed
     */
    public function getVersion()
    {
        $response = $this->call('GetVersion', new BasicRequest());
        $xml = simplexml_load_string($response->getBody()->getContents());
        return $this->xmlToArray($xml);
    }

    /**
     * This method, if successful, creates a payment request
     * in the Payoneer system. Prior to issuing payment
     * instructions, the partner’s account balance in the
     * Payoneer system must be credited relative to the
     * payment request. Payout instruction submission will
     * fail if the partner’s account balance does not have
     * sufficient funds to perform the account loads. In
     * addition the payee ID must be active.
     *
     * @param PerformPayoutPaymentRequest $request
     * @return mixed
     */
    public function performPayoutPayment(PerformPayoutPaymentRequest $request)
    {
        $response = $this->call('PerformPayoutPayment', $request);
        $xml = simplexml_load_string($response->getBody()->getContents());
        return $this->xmlToArray($xml);
    }


    /**
     * This method, if successful, reports the status of a
     * payment that was earlier sent to the Payoneer system.
     *
     * @param $payeeId
     * @param $paymentId
     * @return mixed
     */
    public function getPaymentStatus($payeeId, $paymentId)
    {
        $request  = new GetPaymentStatusRequest($payeeId, $paymentId);
        $response = $this->call('GetPaymentStatus', $request);
        $xml = simplexml_load_string($response->getBody()->getContents());
        return $this->xmlToArray($xml);
    }

    /**
     * This method returns the partner’s available account balance.
     *
     * @return mixed
     */
    public function getAccountDetails()
    {
        $request  = new BasicRequest();
        $response = $this->call('GetAccountDetails', $request);
        $xml = simplexml_load_string($response->getBody()->getContents());
        return $this->xmlToArray($xml);
    }

    /**
     * This method returns details about the requested
     * payee and his status at Payoneer.
     *
     * @param $payeeId
     * @return mixed
     */
    public function getPayeeDetails($payeeId)
    {
        $request  = new PayeeRequest($payeeId);
        $response = $this->call('GetPayeeDetails', $request);
        $xml = simplexml_load_string($response->getBody()->getContents());
        return $this->xmlToArray($xml);
    }

    /**
     * This method changes the ID of an existing
     * payee (old) to a new one.
     *
     * @param $oldId
     * @param $newId
     * @return mixed
     */
    public function changePayeeId($oldId, $newId)
    {
        $request  = new ChangePayeeIdRequest($oldId, $newId);
        $response = $this->call('ChangePayeeID', $request);
        $xml = simplexml_load_string($response->getBody()->getContents());
        return $this->xmlToArray($xml);

    }

    /**
     * This method returns all payments made to payees,
     * grouped by payment method.
     *
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public function getPayeesReport($startDate, $endDate)
    {
        $request  = new GetPayeesReportRequest($startDate, $endDate);
        $response = $this->call('GetPayeesReport', $request);
        $xml = simplexml_load_string($response->getBody()->getContents());
        return $this->xmlToArray($xml);
    }

    /**
     * This method returns all payments made to a single payee.
     *
     * @param $payeeId
     * @return mixed
     */
    public function getSinglePayeeReport($payeeId)
    {
        $request  = new PayeeRequest($payeeId);
        $response = $this->call('GetSinglePayeeReport', $request);
        $xml = simplexml_load_string($response->getBody()->getContents());
        return $this->xmlToArray($xml);

    }

    /**
     * This method returns an array of all payments that have
     * not yet been claimed.
     *
     * @return mixed
     */
    public function getUnclaimedPayments()
    {
        $request  = new BasicRequest();
        $response = $this->call('GetUnclaimedPaymentsXML', $request);
        $xml = simplexml_load_string($response->getBody()->getContents());
        return $this->xmlToArray($xml);
    }

    /**
     * This method returns a CSV string of all payments that have
     * not yet been claimed.
     *
     * @return string
     */
    public function getUnclaimedPaymentsCSV()
    {
        $request  = new BasicRequest();
        $response = $this->call('GetUnclaimedPaymentsCSV', $request);
        return $response->getBody()->getContents();
    }

    /**
     * This method cancels a payment that has not yet been
     * processed and loaded to an account.
     *
     * @param $paymentId
     * @return mixed
     */
    public function cancelPayment($paymentId)
    {
        $request  = new BasicPaymentRequest($paymentId);
        $response = $this->call('CancelPayment', $request);
        $xml = simplexml_load_string($response->getBody()->getContents());
        return $this->xmlToArray($xml);
    }

    /**
     * This method is poorly documented. Duplicate parameters?
     *
     * @return string
     */
    public function movePayeeProgram()
    {
        return 'Method not implemented due to poor documentation.';
    }

    /**
     * Convert SimpleXML object to array.
     *
     * @param SimpleXMLElement $xml
     * @return mixed
     */
    private function xmlToArray(SimpleXMLElement $xml)
    {
        return unserialize(serialize(json_decode(json_encode((array)$xml), 1)));
    }
} 