<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/11/14
 * Time: 11:41 PM
 */

namespace koizoinno\LaravelPayoneer\Services;


use GuzzleHttp\Client;
use koizoinno\LaravelPayoneer\Contracts\RequestInterface;

abstract class BaseService {

    protected $response;


    /**
     * @param                  $methodName
     * @param RequestInterface $request
     * @return mixed
     */
    public function call($methodName, RequestInterface $request)
    {
        $client     = new Client();
        $url        = $request->config->apiEndpoint . '?mname=' . $methodName;
        $parameters = $request->getParameterArray();

        $response =  $client->post($url, $parameters);

        return $response;

    }
} 