<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/13/14
 * Time: 11:50 AM
 */

namespace koizoinno\LaravelPayoneer\API;


use koizoinno\LaravelPayoneer\PayoneerAPI;

/**
 * Class PartnerDetails
 * @package koizoinno\LaravelPayoneer\API
 */
class PartnerDetails {

    /**
     * @var
     */
    public $userName;
    /**
     * @var
     */
    public $password;
    /**
     * @var
     */
    public $prid;
    /**
     * @var
     */
    public $apuid;
    /**
     * @var
     */
    public $sessionid;
    /**
     * @var
     */
    public $redirect;
    /**
     * @var
     */
    public $redirectTime;
    /**
     * @var
     */
    public $BlockType;
    /**
     * @var
     */
    public $PayoutMethodList;
    /**
     * @var
     */
    public $RegMode;

    /**
     * @param $userName
     * @param $password
     * @param $partnerId
     * @param $payeeId
     * @param $sessionId
     * @param $redirectUrl
     * @param $redirectTime
     * @param $blockType
     * @param $payoutMethodList
     * @param $regMode
     */
    function __construct(
        $userName,
        $password,
        $partnerId,
        $payeeId,
        $sessionId = '',
        $redirectUrl = '',
        $redirectTime = 10,
        $blockType = '',
        $payoutMethodList = array(
            PayoneerAPI::PAYOUT_CARD
        ),
        $regMode = PayoneerAPI::ACH_MODE_REGULAR
    ) {
        $this->userName         = $userName;
        $this->password         = $password;
        $this->prid             = $partnerId;
        $this->apuid            = $payeeId;
        $this->sessionid        = $sessionId;
        $this->redirect         = $redirectUrl;
        $this->redirectTime     = $redirectTime;
        $this->BlockType        = $blockType;
        $this->PayoutMethodList = $payoutMethodList;
        $this->RegMode          = $regMode;
    }
}