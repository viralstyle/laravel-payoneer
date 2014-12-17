<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/12/14
 * Time: 8:21 PM
 */

namespace koizoinno\LaravelPayoneer\Requests;


use koizoinno\LaravelPayoneer\API\PartnerDetails;
use koizoinno\LaravelPayoneer\API\PayeeDetails;
use koizoinno\LaravelPayoneer\Contracts\RequestInterface;
use koizoinno\LaravelPayoneer\Util\Array2XML;

/**
 * Class PayeeSignupAutoPopulationRequest
 * @package koizoinno\LaravelPayoneer\Requests
 */
class PayeeSignupAutoPopulationRequest extends BaseRequest implements RequestInterface {


    /**
     * @var PartnerDetails
     */
    private $partnerDetails;
    /**
     * @var PayeeDetails
     */
    private $payeeDetails;

    /**
     * @param PartnerDetails $partnerDetails
     * @param PayeeDetails   $payeeDetails
     */
    public function __construct(
        PartnerDetails $partnerDetails,
        PayeeDetails $payeeDetails
    ) {
        $this->partnerDetails    = $partnerDetails;
        $this->payeeDetails      = $payeeDetails;
        $this->parameters['xml'] = $this->buildXML();
    }

    /**
     * @return string
     */
    private function buildXML()
    {
        $details         = (array)$this->partnerDetails;
        $personalDetails = (array)$this->payeeDetails;

        $xmlArray = [
            'Details'         => $details,
            'PersonalDetails' => $personalDetails,
        ];

        $xml = Array2XML::createXML('PayoneerDetails', $xmlArray);

        return $xml->saveXML();
    }
}