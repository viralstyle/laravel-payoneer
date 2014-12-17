<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/12/14
 * Time: 8:18 PM
 */

namespace koizoinno\LaravelPayoneer\Requests;


use koizoinno\LaravelPayoneer\PayoneerConfig;

/**
 * Class BaseRequest
 * @package koizoinno\LaravelPayoneer\Requests
 */
abstract class BaseRequest {

    /**
     * @var
     */
    public $parameters = [];

    /**
     * @var PayoneerConfig
     */
    public $config;


    /**
     *
     */
    public function __construct()
    {
        $this->config           = new PayoneerConfig();
        $this->parameters['p1'] = $this->config->apiUser;
        $this->parameters['p2'] = $this->config->apiPassword;
        $this->parameters['p3'] = $this->config->partnerId;
    }

    /**
     * @return array
     */
    public function getParameterArray()
    {
        return [
            'body' => $this->parameters
        ];
    }

} 