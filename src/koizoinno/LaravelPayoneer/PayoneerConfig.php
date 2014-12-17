<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/11/14
 * Time: 11:46 PM
 */

namespace koizoinno\LaravelPayoneer;


class PayoneerConfig
{

    /**
     * @var
     */
    public $apiEndpoint;

    /**
     * @var
     */
    public $apiUser;

    /**
     * @var
     */
    public $apiPassword;

    /**
     * @var
     */
    public $partnerId;

    /**
     * @param $apiEndpoint
     * @param $apiUser
     * @param $apiPassword
     * @param $partnerId
     */
    public function __construct($apiEndpoint, $apiUser, $apiPassword, $partnerId)
    {

        $this->apiEndpoint = $apiEndpoint;
        $this->apiUser = $apiUser;
        $this->apiPassword = $apiPassword;
        $this->partnerId = $partnerId;
    }

} 