<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/12/14
 * Time: 9:14 PM
 */

namespace koizoinno\LaravelPayoneer\Contracts;


/**
 * Interface RequestInterface
 * @package koizoinno\LaravelPayoneer\Contracts
 */
interface RequestInterface {

    /**
     * @return array
     */
    public function getParameterArray();
} 