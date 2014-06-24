<?php
/**
 * Created by JetBrains PhpStorm.
 * User: raquelbujans
 * Date: 10/18/13
 * Time: 10:33 PM
 * To change this template use File | Settings | File Templates.
 */

class FacebookManagement {

    // SiteController::actionLoginWithFB
    public function loginWithFB($post_data) {
        $data = array();
        $data = unserialize(base64_decode($post_data));

        $user = User::model()->findByAttributes(array('fbId' => $data['id']));
        if ($user) {

        } else {
            $user = User::model()->findByAttributes(array('email' => $data['email']));
            if ($user) {
                $user->fbId = $data['id'];
                $user->fb_profile_url = $data['link'];
                $newDate = date("Y-m-d", strtotime($data['birthday']));
                $user->fb_dob = $newDate;
                $user->fb_email_address = $data['email'];
                $user->fb_bio = $data['bio'];
                $user->fb_current_city = $data['location']['name'];
                $user->status = 'active';
                $user->save(false);
                ;
            } else {
                $user = new User;
                $user->fname = $data['first_name'];
                $user->lname = $data['last_name'];
                $user->fbId = $data['id'];
                $user->fb_profile_url = $data['link'];
                $newDate = date("Y-m-d", strtotime($data['birthday']));
                $user->fb_dob = $newDate;
                $user->fb_email_address = $data['email'];
                $user->email = $data['email'];
                $user->fb_bio = $data['bio'];
                $user->fb_current_city = $data['location']['name'];
                $user->status = 'active';
                if ($user->save(false)) {
                    $role = new UserRole;
                    $role->user_id = $user->id;
                    $role->value = 'buyer';
                    $role->save(false);
                }
            }
        }

        return $user;
    }
}
?>