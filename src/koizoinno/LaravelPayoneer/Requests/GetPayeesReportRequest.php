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
 * Class BasicRequest
 * @package koizoinno\LaravelPayoneer\Requests
 */
class GetPayeesReportRequest extends BaseRequest implements RequestInterface {

    // Only XML reports are supported (API v3.5.0.0)
    const REPORT_TYPE_XML = 0;

    /**
     * @param $startDate
     * @param $endDate
     */
    public function __construct($startDate, $endDate)
    {
        $this->parameters['p5'] = $startDate;
        $this->parameters['p6'] = $endDate;
        $this->parameters['p4'] = self::REPORT_TYPE_XML;
    }
}