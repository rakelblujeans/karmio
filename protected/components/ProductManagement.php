<?php
/**
 * Created by JetBrains PhpStorm.
 * User: raquelbujans
 * Date: 10/14/13
 * Time: 7:43 PM
 * To change this template use File | Settings | File Templates.
 */

class ProductManagement
{
    private function log($text)
    {
        Yii::log($text . "\n\n\n\n\n\n");
        error_log($text);
        //print $text . "\n";
    }

    // expects product to be an array of attributes
    public function validate($product, $storeName, $ein, $uid)
    {
        $model = new Product();
        $model->attributes = $product;
        if ($model->name == "TITLE OF YOUR POST") $model->name = "";
        if ($model->fine_print == "FINE PRINT OF YOUR POST") $model->fine_print = "";
        $model->user_id = $uid;
        //status
        //if(isset($_POST['publish']))
        {
            $model->status = 'unpublished';
            $code = $model->generatepubcode($storeName); //$store->name);
            $model->couponcode = $code;
        }
        //else
        //	{$model->status = 'holding';}

        $model->category_id = 0; // TODO: why hardcoded?
        $model->organization_id = 1; // TODO: why hardcoded?
        $model->ipaddress = Yii::app()->request->userHostAddress;
        $model->ein = $ein; //$_POST['ein'];
        $result = $model->validate();
        if (!$result) {
            error_log("MODEL DOESNT VALIDATE");
            error_log(var_dump($model->getErrors()));
        }
        //var_dump($model->ein);
        return ($result) ? $model : null;
    }

    // NOTE: expects product to be an array of attributes
    public function create($product, $store, $ein, $uid, $files)
    {
        $model = $this->validate($product, $store->name, $ein, $uid);
        if (is_null($model)) {
            error_log("FAILED VALIDATION");
            return null;
        }

        $model->expiry_date = date('Y-m-d', strtotime($model->redeming_date_end));
        $model->publish_date = date('Y-m-d', strtotime($model->redeming_date_start));
        $model->end_date = date('Y-m-d', strtotime($model->redeming_date_end));

        $model->redeming_date_start = date('Y-m-d', strtotime($model->redeming_date_start));
        $model->redeming_date_end = date('Y-m-d', strtotime($model->redeming_date_end));
        $model->agree = 1;
        $model->picture = 'default.jpg';
        $model->save(false);
        //print_r($model->attributes);

        //add picture
        if (isset($files['picture']['name']) && $files['picture']['name'] != '') {
            //print "SETTING PICTURE NAME\n";

            if (!empty($files['picture']['name'])) {
                $pic = str_replace(" ", "_", $files['picture']['name']);
                $image_name = mt_rand(4, 6) . $pic;
                $model->picture = $image_name;
                $newname = "images/orgLogos/" . $image_name;
                $copied = copy($files['picture']['tmp_name'], $newname);
                chmod($newname, 0777);
            }
            $npic = '';

            $rand = rand(1000, 9999);
            $npic = "images/orgLogos/" . $rand . str_replace(" ", "_", $files["picture"]["name"]);
            //Thumbnail::resize_crop($files["picture"]["tmp_name"], $npic, 1400, 1000);
            $thumb = new Thumbnail($files["picture"]["tmp_name"], 1400, 1000, $npic);
            $thumb->create();
            $model->picture = $npic;
            $model->save(false, array('picture'));
        }

        //get user store id
        $pStore = new ProductStore;
        $pStore->store_id = $store->id;
        $pStore->product_id = $model->id;
        $pStore->save(false);
        //print_r("\nSaving ProductStore[". $pStore->store_id .", ". $pStore->product_id . "]");

        // send out email
        $cm = new CentralMailing();
        $mail = $cm->deal_created($model->user, $model);

        return $model;
    }

    // $model is a Product
    public function update($model, $updated_product, $ein, $files) {
        $old_pic = $model->picture;
        $model->attributes = $updated_product;
        $model->picture = $old_pic;

        if (!$model->validate()) {
          $this->log(var_dump($model->getErrors()));
          return null; // error
        }

        $model->save(false);

        if (isset($files['picture']['name']) && $files['picture']['name'] != '')
        {
            $dir = dirname(Yii::app()->request->scriptFile) . '/images/orgLogos/';
            if (!empty($files['picture']['name']))
            {
                $pic = str_replace(" ", "_", $files['picture']['name']);
                $image_name = mt_rand(4, 6) . $pic;
                $model->picture = $image_name;
                $newname = "images/orgLogos/" . $image_name;
                $copied = copy($files['picture']['tmp_name'], $newname);
                chmod($newname, 0777);
            } else {
                $model->picture = 'default.jpg';
            }
            $npic = '';
            $rand = rand(1000, 9999);
            $npic = "images/orgLogos/" . $rand . str_replace(" ", "_", $files["picture"]["name"]);
            $thumb = new Thumbnail($files["picture"]["tmp_name"], 1400, 1000, $npic);
            $thumb->create();
            $model->picture = $npic;
        }

        $pub = date('Y-m-d', strtotime($model->publish_date));
        $end = date('Y-m-d', strtotime($model->end_date));
        $exp = date('Y-m-d', strtotime($model->expiry_date));

        $redeming_date_start = date('Y-m-d', strtotime($model->redeming_date_start));
        $redeming_date_end = date('Y-m-d', strtotime($model->redeming_date_end));

        $command = Yii::app()->db->createCommand();

        $command->update('tbl_product',
            array('ein' => $model->ein,
                'name' => $model->name,
                'fine_print' => $model->fine_print,
                'regular_price' => $model->regular_price,
                'price' => $model->price,
                'coupons' => $model->coupons,
                'publish_date' => $pub,
                'expiry_date' => $exp,
                'redeming_date_start' => $redeming_date_start,
                'redeming_date_end' => $redeming_date_end,
                'end_date' => $end,
                'amount_share' => $model->amount_share,
                'picture' => $model->picture,
                'address' => $model->address,
                'location_id' => $model->location_id,
                'state_id' => $model->state_id),
            'id=:id',
            array(':id' => $model->id));

        return $model;
    }

    public function listAll($product_id, $clear, $search) {
        $_id = '';
        $_LIds = '';
        $_ids = '0';
        $ids = '';
        $criteria = new CDbCriteria;

        if (isset($clear)) {
            ; //it will stop search criteria to implement.
        } else if (isset($search) && ($search != null)) {
            $_loc = $_zip = $search;
            $_loc = $_loc;
            //Depending upon location
            $LCriteria = new CDbCriteria();
            $LCriteria->condition = "value LIKE '%$_loc%'";

            $Ldata = Location::model()->findAll($LCriteria);

            $Ldata = CHtml::listData($Ldata, 'id', 'id');
            foreach ($Ldata as $data) {
                $_LIds .= ', ' . $data;
                //Add all childs too
                $L2Criteria = new CDbCriteria();
                $L2Criteria->condition = "parent = $data";
                $L2data = Location::model()->findAll($L2Criteria);
                $L2data = CHtml::listData($L2data, 'id', 'id');
                foreach ($L2data as $data2) {
                    $_LIds .= ', ' . $data2;
                }
            }
            //Depending upon zip codes also the location
            $USCriteria = new CDbCriteria();
            $USCriteria->condition = "zip = :zip OR location_id IN (0 $_LIds)";
            $USCriteria->params = array(
                ':zip' => $_zip,
            );
            //$USCriteria->addInCondition("location_id", $_LIds);
            $USdata = UserStore::model()->findAll($USCriteria);
            $USdata = CHtml::listData($USdata, 'id', 'id');
            foreach ($USdata as $data) {
                $ids .= ', ' . $data;
            }
            //Depending upon product id from stores
            $PSCriteria = new CDbCriteria();
            $PSCriteria->condition = "store_id IN (0 $ids)";
            $PSdata = ProductStore::model()->findAll($PSCriteria);
            $PSdata = CHtml::listData($PSdata, 'product_id', 'product_id');
            foreach ($PSdata as $data) {
                $_ids .= ', ' . $data;
            }
            $criteria->condition = "status = 'published' and end_date >= '" . date('Y-m-d') . "' AND id IN ($_ids) AND DATEDIFF(end_date, CURDATE())>0
";
        } else {
            $criteria->condition = "status = 'published' and end_date >= '" . date('Y-m-d') . "' AND DATEDIFF(end_date, CURDATE())>0
";
        }

        $criteria->order = 'end_date ASC';
        if (isset($product_id)) {
          $criteria2 = new CDbCriteria;
          $criteria2->condition = "status = 'published' and end_date >= '" . date('Y-m-d') . "' AND id=:pid AND DATEDIFF(end_date, CURDATE())>0";
          $criteria2->params = array(':pid'=>$product_id);
          $product = Product::model()->find($criteria2);
        }
        else
            $product = Product::model()->find($criteria);

        $products = Product::model()->findAll($criteria);

        // if an invalid product was selected, reroute to a valid one
        if (!$product && $products) {
          $product = $products[0];
        }

        // if it's still null, just exit. something went wrong
        if (!$product)
            return;

        $prod_arr = array();
        foreach ($products as $prod) {
            $prod_arr[] = $prod->id;
        }
        
        $current = -1;
        $current = array_search($product->id, 
                                $prod_arr);
        if ($current != -1) {
            //print_r("PROD_ID: ". $product->id ." COUNT IS: ". count($prod_arr));
            if (count($prod_arr) == 1) {
                $prev = $next = $current = 0;
            } else {

            if ($current == 0) {
                $prev = $prod_arr[count($prod_arr) - 1];
                $next = $prod_arr[$current + 1];
            } else if ($current == count($prod_arr) - 1) {
                $prev = $prod_arr[$current - 1];
                $next = $prod_arr[0];
            } else {
                $prev = $prod_arr[$current - 1];
                $next = $prod_arr[$current + 1];
            }
            }
        }
        $dataProvider = new CActiveDataProvider('Product', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));

        return array(
            'dataProvider' => $dataProvider,
            'products' => $products,
            'product' => $product,
            'prev' => $prev,
            'next' => $next,
        );
    }
}

?>