<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 12/15/14
 * Time: 9:45 PM
 */

namespace koizoinno\LaravelPayoneer;


/**
 * Instant Process Completion Notification (IPCN) is a call triggered from Payoneer
 * system to a partner’s system. Typically, such a call reports an event about which
 * the partner’s payee is to receive notification.
 *
 * This class will process the incoming IPCN request and fire events for the specific
 * IPCN message received.  The raw input for the ICPN request is passed with the event.
 * You can subscribe to these events and process as required.
 *
 * Events that are fired are as follows:
 *
 *
 * PAYMENT REGISTRATION CONFIRMATION EVENTS
 *
 * Payoneer.CardRegistration            Card Registration Confirmation IPCN
 * Payoneer.ACHRegistration             Direct Deposit Registration Confirmation IPCN
 * Payoneer.iACHRegistration            iACH Registration Confirmation IPCN
 * Payoneer.PaperCheckRegistration      Paper Check Registration Confirmation IPCN
 *
 *
 * PAYEE STATUS NOTIFICATIONS
 *
 * Payoneer.IPCNPayeeApproved           IPCN Approved
 * Payoneer.IPCNPayeeDeclined           IPCN Declined
 *
 *
 * PAYMENT NOTIFICATIONS
 *
 * Payoneer.PaymentRequestAccepted      Payment Request Accepted IPCN
 * Payoneer.CardLoaded                  Card Loaded Confirmation IPCN
 * Payoneer.ACHLoaded                   Load Money to Direct Deposit IPCN
 * Payoneer.iACHLoaded                  Load Money to iACH IPCN
 * Payoneer.PaperCheckLoaded            Load Money to Paper Check IPCN
 * Payoneer.PaymentCancelled            Cancel Payment IPCN
 *
 *
 * OTHER NOTIFICATIONS
 *
 * Payoneer.AccountFunded               Account Funded IPCN
 * Payoneer.PayeeAutoCreated            Auto Payee Creation IPCN
 * Payoneer.PayeeProfileEdited          Customer Details Edited IPCN
 * Payoneer.PayeeIdReleased             Reuse Payee ID IPCN
 *
 * Class PayoneerIPCNListener
 * @package koizoinno\LaravelPayoneer
 */
class IPCNEventGenerator {

    /**
     * @param $input
     */
    static function fireEvents(array $input) {

        // Card Registration Confirmation IPCN
        if(isset($input['REG'])) {
            \Event::fire('Payoneer.CardRegistration', $input);
        }

        // Direct Deposit Registration Confirmation IPCN
        if(isset($input['ACHREG'])) {
            \Event::fire('Payoneer.ACHRegistration', $input);
        }

        // iACH Registration Confirmation IPCN
        if(isset($input['iACHREG'])) {
            \Event::fire('Payoneer.iACHRegistration', $input);
        }

        // Paper Check Registration Confirmation IPCN
        if(isset($input['PaperCheck'])) {
            \Event::fire('Payoneer.PaperCheckRegistration', $input);
        }

        // IPCN Approved
        if(isset($input['APPROVED'])) {
            \Event::fire('Payoneer.IPCNPayeeApproved', $input);
        }

        // IPCN Declined
        if(isset($input['DECLINE'])) {
            \Event::fire('Payoneer.IPCNPayeeDeclined', $input);
        }

        // Payment Request Accepted IPCN
        if(isset($input['PAYMENT'])) {
            \Event::fire('Payoneer.PaymentRequestAccepted', $input);
        }

        // Card Loaded Confirmation IPCN
        if(isset($input['LOADCC'])) {
            \Event::fire('Payoneer.CardLoaded', $input);
        }

        // Load Money to Direct Deposit IPCN
        if(isset($input['LOADACH'])) {
            \Event::fire('Payoneer.ACHLoaded', $input);
        }

        // Load Money to iACH IPCN
        if(isset($input['LOADiACH'])) {
            \Event::fire('Payoneer.iACHLoaded', $input);
        }

        // Load Money to Paper Check IPCN
        if(isset($input['PaperCheck'])) {
            \Event::fire('Payoneer.PaperCheckLoaded', $input);
        }

        // Cancel Payment IPCN
        if(isset($input['CancelPayment'])) {
            \Event::fire('Payoneer.PaymentCancelled', $input);
        }

        // Account Funded IPCN
        if(isset($input['BALANCE_UPDATED'])) {
            \Event::fire('Payoneer.AccountFunded', $input);
        }

        // Auto Payee Creation IPCN
        if(isset($input['AUTOPAYEECREATION'])) {
            \Event::fire('Payoneer.PayeeAutoCreated', $input);
        }

        // Customer Details Edited IPCN
        if(isset($input['CustomerDetailsEdited'])) {
            \Event::fire('Payoneer.PayeeProfileEdited', $input);
        }

        // Reuse Payee ID IPCN
        if(isset($input['ReusePayeeID'])) {
            \Event::fire('Payoneer.PayeeIdReleased', $input);
        }

    }
} 