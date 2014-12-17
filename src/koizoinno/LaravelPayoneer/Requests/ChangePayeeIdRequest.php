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
class ChangePayeeIdRequest extends BaseRequest implements RequestInterface {

    /**
     * @param $oldId
     * @param $newId
     */
    public function __construct($oldId, $newId)
    {
        $this->parameters['p4'] = $oldId;
        $this->parameters['p5'] = $newId;
    }

}