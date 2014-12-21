<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/12/14
 * Time: 8:18 PM
 */

namespace koizoinno\LaravelPayoneer\Requests;


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
     * @return array
     */
    public function getParameterArray()
    {
        return $this->parameters;
    }

} 