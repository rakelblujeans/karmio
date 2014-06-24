<?php
require_once dirname(Yii::app()->basePath) . '/mandrill-api-php/src/Mandrill.php';

/**
 * CentalMailing is designed, so we can generate mails from anywhere within the application.

 */
class CentralMailing
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */

    private $homeUrl = 'http://beta.karm.io/index.php'; // = Yii::app()->getBaseUrl(true); // TODO!
    private $commonHeader = '';
    private $async = false;
    private $global_merge_vars = array(
        array(
            'name' => 'list_company',
            'content' => 'karmio technology'
        ),
        array(
            'name' => 'html_list_address_html',
            'content' => 'karmio technology<br />
347 5th ave<br />
Suite 807<br />
New York, NY 10016',
        ),
        array(
            'name' => 'facebook_profileurl',
            'content' => 'https://www.facebook.com/karmio.nyc'
        ),
        array(
            'name' => 'twitter_profileurl',
            'content' => 'https://twitter.com/karm_io',
        ),
        array(
            'name' => 'signature',
            'content' => '<p>Sincerely,<br/>
Sibte, Ali, and Raquel - the team at Karmio<br/>
<a href="mailto:team@karm.io?subject=Support%20Request">team@karm.io</a></p>',
        ),
    );

    private function _send_template($template_name, $message) {
        $key = Yii::app()->params['MANDRILL_KEY'];
        $mandrill = new Mandrill($key);

        $template_content = array();

        $message['track_opens'] = true;
        $message['track_clicks'] = true;
        $message['auto_text'] = true;

        $result = $mandrill->messages->sendTemplate($template_name, $template_content, $message);
        //var_dump($result);

        $success = $result[0]['status'] === 'queued' || is_null($result[0]['reject_reason']);
        if ($success) {
            return true;
        } else {
            var_dump($result[0]['reject_reason']);
            return false;
        }
    }

    private function _send($message) {
        $key = Yii::app()->params['MANDRILL_KEY'];
        $mandrill = new Mandrill($key);

        $message['track_opens'] = true;
        $message['track_clicks'] = true;
        $message['auto_text'] = true;

        $result = $mandrill->messages->send($message);
        //var_dump($result);

        $success = is_null($result[0]['reject_reason']);
        if ($success) {
            return true;
        } else {
            print $result[0]['reject_reason'];
            return false;
        }
    }

    public function welcome_buyer($user)
    {
        if (!$user) {
            error_log("Failed sending email. Could not find user with id=" . $uid);
            return false;
        }

        $message = array(
            'to' => array(
                array(
                    'email' => $user->email,
                    'name' => $user->fullName,
                    'type' => 'to'
                )
            ),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => $user->email,
                    'vars' => array(
                        array(
                            'name' => 'activation_url',
                            'content' =>  $this->homeUrl . '?r=user/activation&activkey=' . $user->activatekey . '&email=' . $user->email),
                    ),
                )
            ),
        );

        return $this->_send_template('buyer-signup', $message);
    }


    public function welcome_seller($store, $notify_admins=0, $send_password_url=0)
    {
        if (!$store) {
            error_log("Failed sending email. No store provided");
            return false;
        }

        $vars = array(
            array(
                'name' => 'fname',
                'content' => $store->owner_name),
            array(
                'name' => 'store_name',
                'content' => $store->name),
        );
        if ($send_password_url) {
            $vars[3] = array(
                'name' => 'new_password_url',
                'content' => $this->homeUrl . "?r=site/NewPassword&secret_key=" . $store->user->secret_key);
        }

        $message = array(
            'to' => array(
                array(
                    'email' => $store->email,
                    'name' => $store->owner_name,
                    'type' => 'to'
                )
            ),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => $store->email,
                    'vars' => $vars,
                )
            )
        );


        return $this->_send_template('seller-signup', $message);

        if ($notify_admins == 1) {
            // additionally, send an email to our admins notifying them to take action
            $admin_email = 'team@karm.io';
            $message = array(
                'to' => array(
                    array(
                        'email' => $admin_email,
                        'name' => 'Team',
                        'type' => 'to'
                    )
                ),
                'from_email' => $admin_email,
                'html' => '<p>Please look into the new business that just registered on Karmio with following information.
Approve them within 24 hours.</p>
<p>Business Name: *|BNAME|*</p>
<p>Owner Name: *|OWNER_NAME|*</p>
<p>Email: *|EMAIL|*</p>',
                'subject' => 'Check out the new store on Karmio',
                'headers' => array('Reply-To' => $store->email),
                'global_merge_vars' => $this->global_merge_vars,
                'merge_vars' => array(
                    array(
                        'rcpt' => $admin_email,
                        'vars' => array(
                            array(
                                'name' => 'bname',
                                'content' => $store->name),
                            array(
                                'name' => 'owner_name',
                                'content' => $store->owner_name),
                            array(
                                'name' => 'email',
                                'content' => $store->email),
                        )
                    )
                )
            );
            return $this->_send($message);
        }
    }

    // TODO: missing template
    public function newNonprofitAdmin($organization) {
        /*$to      = $user->email;
        $subject = 'Non-profit Admin Confirmation Email';
        $message = '<b>Dear User</b><br> Congratulations! You are now a non-profit administrator.<br>
				Your password has been reset." <br><b>Best Regards,</b> <br> Support Team<br>Thank you for using Karmio.';

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: support@karm.io' . "\r\n" .
            'Reply-To: support@karm.io' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);*/
    }

    public function deal_created($user, $deal)
    {
        if ($deal == null) {
            error_log("Failed sending email. No deal specified.");
            return false;
        }

        $user = User::model()->findByPk($deal->user_id);
        if ($user == null) {
            error_log("Failed sending email. Could not find user with id=" . $deal->user_id);
            return false;
        }

        $charity_info = $deal->charity ? ' supporting '. $deal->charity->name : '';
        $message = array(
            'to' => array(
                array(
                    'email' => $user->email,
                    'name' => $user->fullName,
                    'type' => 'to'
                )
            ),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => $user->email,
                    'vars' => array(
                        array(
                            'name' => 'deal',
                            'content' => $deal->name),
                        array(
                            'name' => 'deal_link',
                            'content' => $this->homeUrl . '?r=product/index&product_id=' . $deal->id),
                        array(
                            'name' => 'charity_info',
                            'content' => $charity_info),
                        array(
                            'name' => 'deal_ref_code',
                            'content' => $deal->couponcode),
                    )
                )
            )
        );

        return $this->_send_template('seller-deal-created', $message);
    }

    // TODO: missimg template
    // UserConroller::actionGiftthis
    public function gift_complete($id, $pid, $em, $body)
    {
        /*$result = false;
        $model = User::model()->findByPk($id);
        $criteria = new CDbCriteria;
        $criteria->condition = "user_id = $id and product_id = $pid";
        $UPdata = UserPurchase::model()->find($criteria);
        $coupon = $UPdata->invoice_id;
        $name = $model->fname;
        if ($UPdata != null) {
            $message = 'Dear friend, <br><br> Deal has been gifted to you by <b>' . $name . '</b> from Karmio.<br><br>Here is your coupon code <b>' . $coupon . '</b><br><br>';
            $message .= 'Here is the message for you from ' . $name . ': <br><br> ' . $body . ' <br><br>Thanks for using Karmio<br> Best Regards, <br>Karmio Team<br>';

            //$mail->SetFrom('team@karm.io', 'Karmio');
            $subject = '[Karmio] - Deal has been gifted to you by ' . $name;
            $from = 'team@karm.io';
            $header = "From: Karmio <" . $from . ">\r\n";
            $header .= "Content-type: text/html\r\n";
            $result = mail($user->email, $subject, $message, $header);

        }
        return $result;*/
    }

    public function deal_approved($pid)
    {
        $deal = Product::model()->findByPk($pid);
        if ($deal == null) {
            error_log("Failed sending email. Could not find deal with id=" . $pid);
            return false;
        }

        $user = User::model()->findByPk($deal->user_id);
        if ($user == null) {
            error_log("Failed sending email. Could not find user with id=" . $deal->user_id);
            return false;
        }

        $charity_info = $deal->charity ? ' supporting '. $deal->charity->name : '';
        $message = array(
            'to' => array(
                array(
                    'email' => $user->email,
                    'name' => $user->fullName,
                    'type' => 'to'
                )
            ),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => $user->email,
                    'vars' => array(
                        array(
                            'name' => 'deal',
                            'content' => $deal->name),
                        array(
                            'name' => 'deal_link',
                            'content' => $this->homeUrl . '?r=product/index&product_id=' . $pid),
                        array(
                            'name' => 'charity_info',
                            'content' => $charity_info),
                        array(
                            'name' => 'deal_ref_code',
                            'content' => $deal->couponcode),
                    )
                )
            )
        );

        return $this->_send_template('seller-deal-approved', $message);
    }

    public function deal_suspended($pid)
    {
        $deal = Product::model()->findByPk($pid);
        if (!$deal) {
            error_log("Failed sending email. Could not find deal with id=" . $pid);
            return false;
        }

        $user = User::model()->findByPk($deal->user_id);
        if (!$user) {
            error_log("Failed sending email. Could not find user with id=" . $deal->user_id);
            return false;
        }

        $charity_info = $deal->charity ? ' supporting '. $deal->charity->name : '';

        $message = array(
            'to' => array(
                array(
                    'email' => $user->email,
                    'name' => $user->fullName,
                    'type' => 'to'
                )
            ),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => $user->email,
                    'vars' => array(
                        array(
                            'name' => 'deal',
                            'content' => $deal->name),
                        array(
                            'name' => 'charity_info',
                            'content' => $charity_info),
                        array(
                            'name' => 'deal_ref_code',
                            'content' => $deal->couponcode),
                    )
                )
            )
        );

        return $this->_send_template('seller-deal-suspended', $message);
    }

    public function purchase_complete($purchase)
    {
        if (!$purchase) {
            error_log("Failed sending email. Could not find user purchase with id=" . $upid);
            return false;
        }

        $user = User::model()->findByPk($purchase->user_id);
        if (!$user) {
            error_log("Failed sending email. Could not find user with id=" . $purchase->user_id);
            return false;
        }

        $message = array(
            'to' => array(
                array(
                    'email' => $user->email,
                    'name' => $user->fullName,
                    'type' => 'to'
                )
            ),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => $user->email,
                    'vars' => array(
                        array(
                            'name' => 'url',
                            'content' => $this->homeUrl . "?r=user/buyersDashboard"),
                        array(
                            'name' => 'fname',
                            'content' => $user->fname),
                        array(
                            'name' => 'business_name',
                            'content' => $purchase->store->name),
                        array(
                            'name' => 'donation_amount',
                            'content' => $purchase->donated),
                    )
                )
            )
        );

        return $this->_send_template('buyer-purchase-complete', $message);
    }

    public function reset_password($user)
    {
        if (!$user) {
            error_log("Failed sending email. No user provided");
            return false;
        }

        $message = array(
            'to' => array(
                array(
                    'email' => $user->email,
                    'name' => $user->fullName,
                    'type' => 'to'
                )
            ),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => $user->email,
                    'vars' => array(
                        array(
                            'name' => 'fname',
                            'content' => $user->fname),
                        array(
                            'name' => 'login_url',
                            'content' => $this->homeUrl . "?r=site/login"),
                        array(
                            'name' => 'using_facebook',
                            'content' => $user->fbId ? true : false),
                        array(
                            'name' => 'new_password_url',
                            'content' => $this->homeUrl . "?r=site/NewPassword&secret_key=" . $user->secret_key),
                    )
                )
            )
        );

       return $this->_send_template('reset-password', $message);
    }

    public function new_charity_registered($charity) {

        if (!$charity) {
            error_log("Failed sending email. No charity provided");
            return false;
        }

        $message = array(
            'to' => array(
                array(
                    'email' => $charity->email,
                    'name' => $charity->owner_name,
                    'type' => 'to'
                )
            ),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => $charity->email,
                    'vars' => array(
                        array(
                            'name' => 'fname',
                            'content' => $charity->owner_name),
                        array(
                            'name' => 'charity',
                            'content' => $charity->name),

                    )
                )
            )
        );

        $this->_send_template('charity-signup', $message);

        // additionally notify admins of the new signup
        $admin_email = 'team@karm.io';
        $message = array(
            'to' => array(
                array(
                    'email' => $admin_email,
                    'name' => 'Team',
                    'type' => 'to'
                )
            ),
            'html' => '<p>A new charity has just been created on karm.io with following information.
Please follow up with any additional info within 24 hours.</p>
<p>Charity Name: *|CHARITY_NAME|*</p>
<p>Owner Name: *|OWNER_NAME|*</p>
<p>Email: *|EMAIL|*</p>
<p>EIN: *|EIN|*</p>',
            'subject' => 'New charity created on Karmio',
            'from_email' => $admin_email,
            'headers' => array('Reply-To' => $admin_email),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => $admin_email,
                    'vars' => array(
                        array(
                            'name' => 'charity_name',
                            'content' => $charity->name),
                        array(
                            'name' => 'owner_name',
                            'content' => $charity->owner_name),
                        array(
                            'name' => 'email',
                            'content' => $charity->email),
                        array(
                            'name' => 'ein',
                            'content' => $charity->ein),
                    )
                )
            )
        );

        return $this->_send($message);
    }

    public function seller_check_in($coupon)
    {
        if (!$coupon) {
            error_log("Failed sending email. No coupon provided");
            return false;
        }

        $user = User::model()->findByPk($coupon->user_id);
        if (!$user) {
            error_log("Failed sending email. No user provided");
            return false;
        }

        $message = array(
            'to' => array(
                array(
                    'email' => $user->email,
                    'name' => $user->fullName,
                    'type' => 'to'
                )
            ),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => $user->email,
                    'vars' => array(
                        array(
                            'name' => 'fname',
                            'content' => $user->fname),
                        array(
                            'name' => 'invoice_id',
                            'content' => $coupon->invoice_id),
                        array(
                            'name' => 'store',
                            'content' => $coupon->store->name),

                    )
                )
            )
        );

        return $this->_send_template('seller-check-in', $message);
    }

    public function contact($contactForm) {
        $message = array(
            'to' => array(
                array(
                    'email' => 'team@karm.io',
                    'name' => 'Team',
                    'type' => 'to'
                )
            ),
            'html' => '<p>A guest has submitted a contact request with the following information:</p>
<p>Name: *|NAME|*</p>
<p>Email: *|EMAIL|*</p>
<p>Subject: *|USER_SUBJECT|*</p>
<p>Message: *|USER_MESSAGE|*</p>',
            'subject' => '[CONTACT REQUEST] ' . $contactForm->subject,
            'from_email' => $contactForm->email,
            'headers' => array('Reply-To' => $contactForm->email),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => 'team@karm.io',
                    'vars' => array(
                        array(
                            'name' => 'email',
                            'content' => $contactForm->email),
                        array(
                            'name' => 'name',
                            'content' => $contactForm->name),
                        array(
                            'name' => 'user_subject',
                            'content' => $contactForm->subject),
                        array(
                            'name' => 'user_message',
                            'content' => $contactForm->body),
                    )
                )
            )
        );
        return $this->_send($message);
    }

    private function log($text)
    {
        Yii::log($text . "\n\n\n\n\n\n");
        error_log($text);
    }

    // UserStoreController::actionApproveStore
    public function store_approved($store) {
        if (!$store) {
            error_log("Failed sending email. No store provided");
            return false;
        }

        $message = array(
            'to' => array(
                array(
                    'email' => $store->email,
                    'name' => $store->owner_name,
                    'type' => 'to'
                )
            ),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => $store->email,
                    'vars' => array(
                        array(
                            'name' => 'fname',
                            'content' => $store->owner_name),
                        array(
                            'name' => 'deal_url',
                            'content' => $this->homeUrl . '?r=product/create'),
                        array(
                            'name' => 'store_name',
                            'content' => $store->name),
                    )
                )
            )
        );

        return $this->_send_template('seller-account-approved', $message);
    }

    // UserStoreController::actionDenyStore
    public function store_denied($store) {
        if (!$store) {
            error_log("Failed sending email. No store provided");
            return false;
        }

        $message = array(
            'to' => array(
                array(
                    'email' => $store->email,
                    'name' => $store->owner_name,
                    'type' => 'to'
                )
            ),
            'global_merge_vars' => $this->global_merge_vars,
            'merge_vars' => array(
                array(
                    'rcpt' => $store->email,
                    'vars' => array(
                        array(
                            'name' => 'fname',
                            'content' => $store->owner_name),
                        array(
                            'name' => 'store_name',
                            'content' => $store->name),
                    )
                )
            )
        );

        return $this->_send_template('seller-account-denied', $message);
    }

}

