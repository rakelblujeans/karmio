<?php
/**
 * Created by JetBrains PhpStorm.
 * User: raquelbujans
 * Date: 10/18/13
 * Time: 8:38 PM
 * To change this template use File | Settings | File Templates.
 */

class SellerManagement {


 public function listAllData($user, $post) {
     if (isset($post['status']) && $post['status'] == 'suspended' && isset($post['pid'])) {
         $product = Product::model()->findByPk($post['pid']);
         $product->status = "suspended";
         $product->save(false);
     }
     if (isset($post['status']) && $post['status'] == 'published' && isset($post['pid'])) {
         $product = Product::model()->findByPk($post['pid']);
         $product->status = "published";
         $product->save(false);
     }
     $uid = $user->id;
     $cCriteria = new CDbCriteria();
     $cCriteria->condition = "user_id = $uid AND (status = 'published')";
     $cCriteria->order = 'id DESC';
     $cDeal = new CActiveDataProvider('Product', array(
         'criteria' => $cCriteria,
         'pagination' => array(
             'pageSize' => 1,
         ),
     ));

     $myCriteria = new CDbCriteria();
     $myCriteria->select = 'SUM(paid_price) AS paid_price'
         . ', SUM(donated) AS donated'
         . ', SUM(quantity) AS quantity';
     $myCriteria->join = 'LEFT JOIN tbl_product ON tbl_product.id=product_id';
     $myCriteria->condition = "tbl_product.user_id = $uid AND tbl_product.status = 'published'";
     $data = UserPurchase::model()->findAll($myCriteria);
     foreach ($data as $cDatum) {
         ;
     }
     if ($cDatum->quantity == null) {
         $cDatum->paid_price = 0;
         $cDatum->donated = 0;
         $cDatum->quantity = 0;
     }

     $cCriteria = new CDbCriteria();
     $cCriteria->condition = "user_id = $uid AND status IN ('sold_out', 'suspended', 'ended')";
     $cCriteria->order = 'id DESC';

     $pDeal = new CActiveDataProvider('Product', array(
         'criteria' => $cCriteria,
         'pagination' => array(
             'pageSize' => 1,
         ),
     ));

     $myCriteria = new CDbCriteria();
     $myCriteria->select = 'SUM(paid_price) AS paid_price'
         . ', SUM(donated) AS donated'
         . ', SUM(quantity) AS quantity';
     $myCriteria->join = 'LEFT JOIN tbl_product ON tbl_product.id=product_id';
     $myCriteria->condition = "tbl_product.user_id = $uid AND tbl_product.status NOT IN ('published','unpublished')";
     $data = UserPurchase::model()->findAll($myCriteria);

     foreach ($data as $pDatum) {
         ;
     }
     if ($pDatum->quantity == null) {
         $pDatum->paid_price = 0;
         $pDatum->donated = 0;
         $pDatum->quantity = 0;
     }

     return array(
         'cDeal' => $cDeal,
         'cData' => $cDatum,
         'pDeal' => $pDeal,
         'pData' => $pDatum);
     }

 public function getDashboardData($user, $post, $request, $files) {
        //$uid = Yii::app()->user->id;
     $uid = $user->id;
        $pr = new Product;
        $status = 'published';
        //var_dump($post);// exit;
        if (isset($request['status']))
            $status = $request['status'];
        if (isset($post['unpublished_x']))
            $status = 'unpublished';
        if (isset($post['holding_x']))
            $status = 'holding';
        if (isset($post['suspended_x']))
            $status = 'suspended';
        $s = $pr->overAllSale();
        $q = $s->quantity;
        if (isset($post['status_update']) && isset($post['id'])) {
            if ($post['status_update'] == 'published' || $post['status_update'] == 'suspended') {
                $store = UserStore::model()->findByPk($uid);
                $product = Product::model()->findByPk((int) $post['id']);
                $old_pic = $product->picture;
                $daten = floor($pr->dateDiff($product->publish_date, $product->end_date));
                if ($product != null) {
                    $product->status = $post['status_update'];
                    $product->twitter_text = $post['twitter_text'];
                    $product->facebook_text = $post['facebook_text'];
                    if ($post['status_update'] == 'published') {
                        if (isset($post['admin_share']))
                            $product->admin_share = $post['admin_share'];
//					$date = date("Y-m-d");

                        if (empty($post['Product']['publish_date']) && empty($post['Product']['end_date']) ) {

                            $publish_date = date('Y-m-d');
                            $product->publish_date = $publish_date;
                            $date = strtotime($publish_date);
                            $enddate = strtotime("+7 day", $date);
                            $enddate=date('Y-m-d', $enddate);
                            $product->expiry_date = $enddate;
                            $product->end_date = $enddate;
                        } else {

                            $product->publish_date =date('Y-m-d', strtotime($post['Product']['publish_date']));
                            $product->end_date =date('Y-m-d', strtotime($post['Product']['end_date']));
                            $product->expiry_date =date('Y-m-d', strtotime($post['Product']['end_date']));
                            //$product->publish_date = $post['publish_date'];
                            // $product->expiry_date = $post['end_date'];

                        }
                        // $product->expiry_date=Date('Y-m-d', strtotime("+$daten days"));

                        if (isset($files['picture']['name']) && $files['picture']['name'] != '') {

                            $npic = '';
                            $npic = $product->generate_resized_image($files["picture"]["name"], $files["picture"]["tmp_name"], $files["picture"]["size"]);
                            $product->picture = $npic;
                        } else {
                            $product->picture = $old_pic;
                        }
                        }
                    $product->twitter_text = $post['twitter_text'];
                    $product->facebook_text = $post['facebook_text'];
                    //print_r($product->attributes); exit;
                    $product->save(false);
                    }
                }
            }


        if ($status == 'published') {
            $cCriteria = new CDbCriteria();
            $cCriteria->condition = "status = '$status' and end_date >= '" . date("Y-m-d") . "'";
            $cCriteria->order = 'id DESC';
        } elseif ($status == 'ended') {
            $cCriteria = new CDbCriteria();
            $cCriteria->condition = "status = 'published' and end_date < '" . date("Y-m-d") . "'";
            $cCriteria->order = 'id DESC';
        } elseif ($status == 'sold_out') {
            $cCriteria = new CDbCriteria;
            $cCriteria->select = 'p.*';
            $cCriteria->alias = 'p';
            $cCriteria->join = 'join tbl_user_purchase u on (u.product_id=p.id)';
            $cCriteria->condition = "p.coupons = (select sum(quantity) from tbl_user_purchase where product_id=p.id)";
            $cCriteria->order = 'p.id desc';
            //$cCriteria=Yii::app()->db->createCommand("select * from  tbl_product p inner join tbl_user_purchase u on (u.product_id=p.id) where p.coupons = (select sum(quantity) from tbl_user_purchase where product_id=p.id)")->queryAll();
        } else {
            $cCriteria = new CDbCriteria();
            $cCriteria->condition = "status = '$status'";
            $cCriteria->order = 'id DESC';
        }

        $cDeal = new CActiveDataProvider('Product', array(
            'criteria' => $cCriteria,
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));

        $countpub = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_product where status='published' and end_date >= '" . date("Y-m-d") . "'")->queryScalar();
        $countunpub = Yii::app()->db->createCommand('SELECT COUNT(*) FROM tbl_product where status="unpublished"')->queryScalar();
        $counthold = Yii::app()->db->createCommand('SELECT COUNT(*) FROM tbl_product where status="holding"')->queryScalar();
        $countsus = Yii::app()->db->createCommand('SELECT COUNT(*) FROM tbl_product where status="suspended"')->queryScalar();
        $countend = Yii::app()->db->createCommand("SELECT COUNT(*) FROM tbl_product where status = 'published' and end_date < '" . date("Y-m-d") . "'")->queryScalar();
        $countsold = Yii::app()->db->createCommand("select count(*) from  tbl_product p inner join tbl_user_purchase u on (u.product_id=p.id) where p.coupons = (select sum(quantity) from tbl_user_purchase where product_id=p.id)")->queryScalar();

        return array(
            'cDeal' => $cDeal,
            'status' => $status,
            'countpub' => $countpub,
            'countunpub' => $countunpub,
            'counthold' => $counthold,
            'countsus' => $countsus,
            'countend' => $countend,
            'countsold' => $countsold);
    }


    public function checkIn($user, $post) { // $post['invoice']
        $status = '';
        $coupon = '';
        $prodOwner = '';
        if (isset($post['invoice'])) {
            $inv = $post['invoice'];
            $today = date('Y-m-d');
            $pc = PurchasedCoupons::model()->findByAttributes(array('invoice_id' => $post['invoice']));
            $coupon = UserPurchase::model()->find('invoice_id LIKE "%' . $post['invoice'] . '%"');

            if ($coupon != null) {
                $prodOwner = Product::model()->findByPk($coupon->product_id);
            }

            if ($coupon != null && ($prodOwner->user_id == $user->id || isset($user->isAdmin))) {
                $status = $pc->consumption_status;
                if ($pc->consumption_status == 'valid') {
                    $status = 'valid';

                    if ($user->id == 1) {
                        $cm = new CentralMailing();
                        $cm->seller_check_in($coupon);
                    }

                    if ($coupon->expiry_date > $today) {
                        $pc->consumption_status = 'consumed';
                        $pc->collection_date = $today;
                        $pc->save(false);
                        $all_coupons = PurchasedCoupons::model()->findAll('purchase_id=' . $coupon->id . ' AND consumption_status="consumed"');
                        //echo count($all_coupons).' = '.$coupon->quantity.' = purchase_id='.$coupon->id.' AND consumption_status="consumed"'; exit;
                        if (count($all_coupons) == $coupon->quantity)
                            $coupon->consumption_status = 'consumed';
                        $coupon->collection_date = $today;
                        $coupon->save(false);
                    }
                    else {
                        $pc->consumption_status = 'expired';
                        $pc->save(false);
                        $all_coupons = PurchasedCoupons::model()->findAll('purchase_id=' . $coupon->id . 'AND consumption_status="consumed"');
                        if (count($all_coupons) == $coupon->quantity)
                            $coupon->consumption_status = 'expired';
                        //$coupon->consumption_status = 'expired';
                        $coupon->save(false);
                        $status = 'expired';
                    }
                }
            }
            else {
                $status = 'invalid';
            }
        }
        $total = 0;
        $used = 0;
        $products = Product::model()->findAll('user_id=' . $user->id);
        if (count($products)) {
            $ids_arr = array();
            $ids_str = '-1';
            foreach ($products as $p) {
                $ids_arr[] = $p->id;
                $total += $p->coupons;
            }
            $ids_str = implode(',', $ids_arr);
            $coupons = CHtml::listData(UserPurchase::model()->findAll('product_id IN(' . $ids_str . ')'), 'id', 'id'); // AND consumption_status="consumed"');
            if (count($coupons)) {
                $ids = implode(',', $coupons);
                $coupons = PurchasedCoupons::model()->findAll('purchase_id IN(' . $ids . ')');
            }
            $used = count($coupons);
        }

        return array(
            'status' => $status,
            'coupon' => $coupon,
            'total' => $total,
            'used' => $used,
        );
    }
}
?>