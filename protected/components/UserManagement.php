<?php
/*
   Used for user signup in UserController
 */

class UserManagement
{
    public function createUser($user, $tempStore)
    {
        $model = $this->validateUser($user);
        //print var_dump($user);

        if ($model) {
            $model->save(false);

            if ($tempStore) {
              //print "TEMP STORE\n";
                $smodel = new UserStore;
                $smodel->attributes = $tempStore;
                $smodel->user_id = $model->id;
                $smodel->save();
                TempStore::model()->deleteAll('email="' . $tempStore['email'] . '"');
            }
            //make role as buyer
            $role = new UserRole;
            $role->user_id = $model->id;
            $role->value = 'buyer';
            $role->save(false);
            return $model;
        }

        return null;
    }

    public function validateUser($user)
    {
        $model = new User;
        $model->scenario = 'up_password';
        $model->attributes = $user;
        $model->status = 'inactive';
        $model->activatekey = mt_rand() . mt_rand();
        $xPass = $model->password;

        if ($user['organization_id']) {
            $model->organization_id = $user['organization_id'];
        }
        // before validation remove the default text.
        if ($model->email == 'Email Address')
            $model->email = '';
        if ($model->fname == 'First Name')
            $model->fname = '';
        if ($model->lname == 'Last Name')
            $model->lname = '';
        if ($model->zip == 'Zip Code')
            $model->zip = '';
        if ($model->state_id == 'State')
            $model->state_id = '';
        if ($model->location_id == 'City')
            $model->location_id = '';
        if ($model->cellphone == 'Cellphone')
            $model->cellphone = '';
        if ($model->tax_id == 'Tax id') {
            $model->tax_id = '';
        }

        $isV = $model->validate();
        return $isV ? $model : null;
    }

    private function log($text)
    {
        Yii::log($text . "\n\n\n\n\n\n");
        error_log($text);
    }

    public function signupSeller($in_user, $in_user_store, $is_admin=0)
    {
      $user = new User;
      $user->organization_id = 0; // TODO: update db to have default val
        $user->status = 'inactive';
        $user->activatekey = mt_rand() . mt_rand();

        $store = new UserStore;
      $store->attributes = $in_user_store;
        $user->email = $store->email;

      $valid = false;
      $send_password_link = 0;
      if (isset($in_user)) {

          $user->attributes = $in_user;
          $user->zip = $store->zip;
          $user->cellphone = $store->phone;
          $user->location_id = $store->location_id;
          $user->state_id = $store->state_id;

            $store->owner_name = $user->fname;
            // split name into first and last
            $full_name = explode(' ', $user->fname, 2);
            $user->fname = $full_name[0];
            if (count($full_name) > 1) {
              $user->lname = $full_name[1];
            }
          $store->verifyCode = $user->captcha_code;
      } else {
          // created without explicitly setting user info, so create one ourselves
          $loc = Location::model()->findByAttributes(array('value' => 'NY'));
          $attribs = array(
              'fname' => $store->name,
              'tax_id' => '', // TODO: make not required
              'zip' => '11111', // TODO: make not required
              'cellphone' => '1111111111', // TODO: make not required
              'password' => 'garbage',
              'state_id' => $loc->id, // default to NY
              'location_id' => 'Brooklyn'
          );
          $user->attributes = $attribs;
        }

        // begin validation
        $user_valid = $user->validate();
        if ($user->getErrors()) {
          $this->log(var_dump($user->getErrors()));
          return null;
        }

        $store_valid = $store->validate();
        if ($store->getErrors()) {
            $this->log(var_dump($store->getErrors()));
            return null;
        }

        $valid = $store_valid && $user_valid;
        if ($valid) {
        // TODO: eventually add transactioning
          $user->save(false);
          if (!isset($in_user)) {
            // send them resetPassword type link
            $this->_set_secret_key($user);
            $send_password_link = 1;
          }

          $this->activateUser($user);
          if ($is_admin == 1) {
            // admin signup flow:
            // User is auto-approved and we move onto creating
            // a new deal
            $store->is_verified = 1;
          }
          $store->user_id = $user->id;
          $store->save(false);

        if ($store->user_id == 0) {
          $this->log("Created store but user_id = 0");
          $store->delete();
          $user->delete();
          return null;
        }

          //make role as buyer
          $role = new UserRole;
          $role->user_id = $user->id;
          $role->value = 'seller';
          $role->save(false);
          
          $cm = new CentralMailing();
          $notify_team = !$is_admin;
	      $cm->welcome_seller($store, $notify_team, $send_password_link);
          return $store;
        } 
        return null;
    }

    public function activateUser($user) {
        if (!$user) {
            $this->log("No user provided to activate!");
            return 0;
        }

        $user->status = 'active';
        $user->activatekey = 'z';
        $user->save(false);
        return 1;
    }

    public function update($post, $model, $store, $id) {
        $old_password = $model->password;
        $model->attributes = $post['User'];
        $store->attributes = $post['UserStore'];
        if ($model->password == '' || $model->password == $old_password) {
            //echo '123'; exit;
            $command = Yii::app()->db->createCommand();
            $command2 = Yii::app()->db->createCommand();
            $command->update('tbl_user', array(
                    'zip' => $model->zip,
                    'fname' => $model->fname,
                    'lname' => $model->lname,
                    'cellphone' => $model->cellphone,
                    'location_id' => $model->location_id,
                    'state_id' => $model->state_id,),
                'id=:id',
                array(':id' => $model->id));
            $command2->update('tbl_user_store', array(
                    'name' => $store->name,
                    'website' => $store->website,
                    'address' => $store->address,
                    'address2' => $store->address2,
                    'zip' => $model->zip,
                    'location_id' => $model->location_id,),
                'user_id=:user_id',
                array(':user_id' => $model->id));
            $this->redirect(array('view', 'id' => $model->id));
        } else {
            //	echo '234'; exit;
            $valid = $model->validate();
            $valid2 = $store->validate();
            if ($valid) {
                $model->save(false);
                $store->user_id = $model->id;
                $store->save();

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        return array(
            'model' => $model,
            'store' => $store,
        );
    }

    public function delete($id) {
        $stores = UserStore::model()->findAll('user_id=' . $id);
        $arr = array();
        if (count($stores)) {
            foreach ($stores as $store)
                $arr[] = $store->id;
            $str = implode(',', $arr);
            ProductStore::model()->deleteAll('store_id IN(' . $str . ')');
            UserPurchase::model()->deleteAll('store_id IN(' . $str . ')');
        }
        $products = Product::model()->findAll('user_id=' . $id);
        $arr = array();
        if (count($products)) {
            foreach ($products as $product)
                $arr[] = $product->id;
            $str = implode(',', $arr);
            UserPurchase::model()->deleteAll('product_id IN(' . $str . ')');
        }
        UserPurchase::model()->deleteAll('user_id=' . $id);
        UserStore::model()->deleteAll('user_id=' . $id);
        Product::model()->deleteAll('user_id=' . $id);
        UserRole::model()->deleteAll('user_id=' . $id);
        $this->loadModel($id)->delete();
    }

    private function _set_secret_key($user) {
        if (!$user) {
            $this->log("Can't reset secret key because no user was provided");
            return;
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < 12; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        $user->secret_key = $randomString;
        $user->save(false, array('secret_key'));
    }

    public function resetPassword($user) {
        if (!$user) {
            $this->log("Can't reset password because no user was provided");
            return;
        }

        $this->_set_secret_key($user);

        $cm = new CentralMailing();
        $cm->reset_password($user);
    }

    public function updatePassword($user, $post) {
        $user->password = $post['password'];
        $user->password_repeat = $post['password_repeat'];
        $user->secret_key = 'Password Update';
        
        $user->save(true); //, array('password'));
        if ($user->getErrors()) {
            $this->log(var_dump($user->getErrors()));
            return false;
        } else {
            return true;
        }
    }
}

// TODO: put in defensive checks

?>