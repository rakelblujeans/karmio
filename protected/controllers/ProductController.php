<?php

class ProductController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';
    public $stickyLogin = 0;

    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
        );
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'viewthis', 'myCategorys', 'xmlr', 'captcha', 'provalue', /*'loadCharities',*/
                    'validateCharity', 'charitySearch', 'setCharitySession', 'findCharity', 'searchOrg'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('update', 'buyThis', 'create', 'buyComplete', 'postComplete', 'postCompleteupdate', 'fun', 'voucher', 'buyNow', 'previewDeal', 'uploadImage', 'setCharity', 'fbPost'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                  'actions' => array('admin', 'delete', 'userPosted', 'create', 'userPostedExport'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    private function log($text)
    {
        Yii::log($text . "\n\n\n\n\n\n");
    }

    public function actionFbPost()
    {
        require str_replace('index.php', '', Yii::app()->request->scriptFile) . '/fb_php_sdk/facebook.php';
        $facebook = new Facebook(array(
            'appId' => Yii::app()->params['FB_APP_ID'],
            'secret' => Yii::app()->params['FB_APP_SECRET'],
            'cookie' => true,
            //'req_perms' => 'offline_access, user_groups, publish_stream',
        ));

        $user = $facebook->getUser();
        if ($user) {
            $token = $facebook->getAccessToken();

            /* try {
           $params = array(
           'access_token'  => $token,
           'message'       =>  "Hurray! This works :)",
           'name'          =>  "This is my title",
           'caption'       =>  "My Caption",
           'description'   =>  "Some Description...",
           'link'          =>  "http://stackoverflow.com",
           'picture'       =>  "http://i.imgur.com/VUBz8.png",
           );

           $url = 'https://graph.facebook.com/'.$user.'/';
           $ch = curl_init();
           curl_setopt_array($ch, array(
           CURLOPT_URL => $url,
           CURLOPT_POSTFIELDS => $params,
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_SSL_VERIFYPEER => false,
           CURLOPT_VERBOSE => true
           ));
           $result = curl_exec($ch);
           print_r($result);
           curl_close($ch);

           }
           catch (FacebookApiException $e) {
           $result = $e->getResult();
           }*/
            $result = $facebook->api(
                '/me/feed/',
                'post',
                array('access_token' => $token, 'message' => 'Playing around with FB Graph..')
            );
        }
        print_r($result);
        exit;
    }

    public function actionSetCharity()
    {
        $product = Product::model()->findByPk($_GET['product_id']);
        $product->ein = $_GET['ein'];
        $product->save(false);
    }

    /*
    // TODO: need to stash Product, store name, user id, user state, user phone
    // then move out all this HTML to view
    public function ActionPreviewDeal()
    {
      //images/orgLogos/GreenBank.jpg
      $user = User::model()->findByPk(Yii::app()->user->id);
      $myCriteria = new CDbCriteria();
      $myCriteria->condition = "user_id = ".Yii::app()->user->id;
      $store = UserStore::model()->find($myCriteria);
      $output = '';
      $output = '<div id="preview" style="width:390px; padding-top:10px; height:595px; z-index:1; background-color:#404040;"><div class="content-centerindex" style="height:590px;"><div class="content-centertop">
  <div class="share">
  <div class="sharebutton">
  <div class="addthis_toolbox addthis_default_style">
  <a class="addthis_counter addthis_pill_style"></a>
  </div>
  </div>
  </div>
  <div class="dealimage"> <img id="img_prev" src="my_deal_image" alt="your image"  width="334" height="198" /></div>
  <div class="deal-des">'
        .$_POST['Product']['name'].'
  <div class="deal-title">
  '.strtoupper($store->name).'
  </div>
  <div class="endline" >
  <a href="#"  style=" float:right; color:#000000;  text-decoration:none; margin-top:-7px; font-family:Arial, Helvetica, sans-serif; font-size:9px;" onclick="show_fineprint(\'fine-print1\')">
  <b>FINE PRINT2</b></a>
  <hr />
  </div>
  <div style="clear:both;"></div>
  <div class="fine-print" style="display:none;" id="fine-print1">
  <p style="text-align:right; margin:0px; margin-bottom:5px; "><a href="#" onclick="close_fineprint(\'fine-print1\')">close</a></p>
  <p>
  '.$_POST['Product']['fine_print'].'
  </p>
  </div>
  <div class="pledge">

  <div class="pledge-amount"><div class="pledge-titleprice">$'.$_POST['Product']['price'].'</div><div class="pledge-title">pledge included</div></div>

  </div>
  </div>
  </div>
  <div class="nonprofit-top"></div>
  <div class="non-profit"><div style="background-color: rgb(242, 61, 52); float: left; width: 100%;">
  <div style="float:left;display:table; vertical-align:middle; height:108px;">
  <div class="non-profit-pledge">$'.$_POST['Product']['amount_share'].'</div>
  <div class="non-profit-main">from every coupon will be donated to</div>
  <div class="non-profit-title">'.$_POST['Product']['oName'].'</div>
  </div>
  </div>
  </div>
  <div class="nonprofit-bottom"></div>
  <div class="location"><div class="lhead">Location: </div>
  <div class="rdes">'.$user->location_id.', '.$user->state_id.'<br>'.$user->cellphone.' </div></div>
  </div>
  </div>';
      echo $output; exit;
    }
  */
    public function actionCharitySearch()
    {
        $product = Product::model()->findByPk($_GET['product_id']);
        $charities = Charities::model()->findAll('type="Partner"');
        $this->render('charity_search', array('product' => $product, 'charities' => $charities));
    }

    public function ActionSearchOrg()
    {
        $orgs = Charities::model()->findAll('name LIKE "%' . $_GET['key'] . '%" LIMIT 10');
        if (count($orgs)) {
            $output = '<ul>';
            foreach ($orgs as $org)
                $output .= '<li onclick="fill(\'' . $org->name . '\',' . $org->ein . ',\'' . $org->tag_line . '\', \'' . $org->state . '\')">' . $org->name . '</li>';
            $output .= '</ul>';
            echo $output;
        } else {
            $output = '<ul>';

            $output .= '<li style="color:red;">No matching record found. <br/> Try using advanced search</li>';
            $output .= '</ul>';
            echo $output;
        }
        exit;
    }

    public function actionSetCharitySession()
    {
        $charity = Charities::model()->find('ein="' . $_GET['charity'] . '"');
        if (count($charity)) {
            Yii::app()->session->add('charity', $charity->ein);
            echo 'done';
        } else
            echo 'failed';
    }

    public function actionValidateCharity()
    {
        //echo 'LOWER(name) LIKE "'.trim(strtolower($_GET['charity'])).'"'; exit;
        $charity = Charities::model()->find('TRIM(LOWER(name)) LIKE "' . trim(strtolower($_GET['charity'])) . '"');
        if (count($charity) > 0) {
            Yii::app()->session->add('charity', $charity->ein);
            echo $charity->ein;
        } else {
            echo 'invalid';
        }
        exit;
    }

    public function actionFindCharity()
    {
        $charity = '';
        $state = '';
        $category = '';
        $offset = 0;

        $charity = ($_GET['charity'] == 'Name or Keyword') ? '' : $_GET['charity'];
        $state = ($_GET['state'] == 'St') ? '' : $_GET['state'];
        $category = ($_GET['category'] == 'Select a Category') ? '' : $_GET['category'];
        $offset = ($_GET['offset'] != '') ? $_GET['offset'] : 0;
        $type = ($_GET['type'] != '' && $_GET['type'] != 'both') ? $_GET['type'] : '';
        $charity_search = new CharitySearch();
        $output = $charity_search->search($charity, $state, $category, $offset, $type);

        echo $output;
        exit;
    }

    /*
      // TODO: enable and move to model, cron script
    public function actionLoadCharities()
    {
      //UNCOMMENT THE CODE BELOW TO ENABLE LOAD CHARITIES FEATURE

      set_time_limit(0);

      // TODO: FUCKING DISASTER
      Charities::model()->deleteAll();
      $this->CategoriesSync();
      $this->StatesSync();

      $fromrec = 1;
      // TODO: remove hard coded IDs
      $xmlstr =file_get_contents("http://www.charitynavigator.org/feeds/search7/?appid=". Yii::app()->params["CHARITY_MAGIC"] ."&fromrec=".$fromrec);

      $xml = new SimpleXMLElement($xmlstr);
      $total =  $xml->attributes()->total;
      for($i=1; $i<$total; $i+=25) // TODO: why 25?
        {
      $xmlstr =file_get_contents("http://www.charitynavigator.org/feeds/search7/?appid=". Yii::app()->params["CHARITY_MAGIC"] ."&fromrec=".$i);
      $xml = new SimpleXMLElement($xmlstr);
      $total =  $xml->attrFibutes()->total;
      foreach($xml->charity as $charity)
        {
          $result = Charities::model()->find('ein="'.$charity->ein.'"');
          // create new charity and add to db
          if(count($result) == 0)
            {
          $record = new Charities;
          $record->name = str_replace("'", '',$charity->charity_name);
          $record->tag_line = str_replace("'", '',$charity->tag_line);
          $record->state = $charity->state;
          $record->city = $charity->city;
          $record->cause =str_replace("'", '',$charity->cause);
          $record->url = $charity->url;
          $record->category = $charity->category;
          $record-> ein = $charity->ein;
          $record->isupdated ='1';
          $record->save();
            }//if
          else
            { // otherwise update
          $result->isupdated='1';
          $record->city = $charity->city;
          $record->cause = $charity->cause;
          $record->url = $charity->url;
          $record->category = $charity->category;
          $result->save();
            }//else
        }//foreach
        }//for

      Charities::model()->deleteAll('isupdated=0');
      Charities::model()->updateAll(array('isupdated'=>0));
    }

    // OMG NO
    // TODO: move this to async, cron script
    public function StatesSync()
    {
      $xmlstate =file_get_contents("http://www.charitynavigator.org/feeds/states/");
      $sat = new SimpleXMLElement($xmlstate);
      foreach($sat->state as $state) {
        $result = States::model()->find('state_code="'.$state->state.'"');
        if(count($result) == 0) {
      $record = new States;
      $record->state_id = $state->stateid;
      $record->state_code =$state->state;
      $record->state_name = $state->statename;
      $record->orgcount = $state->orgcount;
      $record->isupdated ='1';
      $record->save();
        }//if
        else
      {
        $result->isupdated='1';
        $result->save();
      }
      }
      States::model()->deleteAll('isupdated=0');
      States::model()->updateAll(array('isupdated'=>0));
      echo "StatesSync Successfully";
    }

    // OMG NO
    // TODO: move this to async, cron script
    public function CategoriesSync()
    {
      $xmlcat =file_get_contents("http://www.charitynavigator.org/feeds/categories/");
      $cat = new SimpleXMLElement($xmlcat);
      foreach($cat->category as $category)
        {
      $result = Categories::model()->find('cat_value="'.$category->category.'"');
      if(count($result) == 0)
        {
          $record = new Categories;
          $record->cat_value =$category->category;
          $record->cat_id =  $category->categoryid;
          $record->isupdated ='1';
          $record->save();
        }//if
      else
        {
          $result->isupdated='1';
          $result->save();
        }
        }
      Categories::model()->deleteAll('isupdated=0');
      Categories::model()->updateAll(array('isupdated'=>0));
      echo "<br>CategoriesSync Successfully";
    }
    */

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionProvalue()
    {
        $this->render('_value', array(
            'id' => $_POST['p_stateid'],
        ));
    }


    // TODO: don't know how this is called
    public function actionViewthis($id)
    {
        $uid = Yii::app()->user->id;
        if (Yii::app()->user->isGuest) {
            $this->stickyLogin = 1;
            Yii::app()->user->returnUrl = Yii::app()->request->url;
        }

        if (!isset($id)) {
            //$this->redirect(Yii::app()->homeUrl);
            throw new CHttpException(404, 'The product you are trying to buy, do not exists.');
        }

        $data = Product::model()->findByPk($id);
        if ($data == null) {
            // we should give some error rather than redirect
            //$this->redirect(Yii::app()->homeUrl);
            throw new CHttpException(404, 'The product you are trying to buy, do not exists.');
        }

        //Test if total total sales are equal to the coupons

        $myCriteria = new CDbCriteria();
        //$myCriteria->select = 'SUM(quantity) AS quantity';
        $myCriteria->condition = "product_id = $data->id";
        $ups = UserPurchase::model()->findAll($myCriteria);
        foreach ($ups as $model) {
            ;
        }

        //$quantity = $up->quantity + $model->pqty;
        $this->render('viewthis', array('data' => $data, 'model' => $model));
    }


    public function actionXmlr()
    {
        //$this->layout = false;
        /*if(isset($_POST['selectcat']) && ($_POST['selectcat'] != null))
          {
          echo 'fdsfds';
          $xmlstr =file_get_contents("http://www.charitynavigator.org/feeds/search7/?appid=". Yii::app()->params["CHARITY_MAGIC"] ."&keyword=america");
          $xml = new SimpleXMLElement($xmlstr);
          //$output = htmlentities($output);
          $this->render('fun',array(
          'xml'=>$xml, // send it to the view for rendering
          ));
          }*/
        //$xmlstr =file_get_contents("http://www.charitynavigator.org/feeds/search7/?appid=". Yii::app()->params["CHARITY_MAGIC"] ."&keyword=america");
        // $xml = new SimpleXMLElement($xmlstr);
        //$output = htmlentities($output);
        $this->render('xmlr');
    }

    public function actionUserPosted($id)
    {
        if (Yii::app()->user->isGuest) {
            $this->stickyLogin = 1;
            Yii::app()->user->returnUrl = Yii::app()->request->url;
        }

        //	$dataz = Product::model()->findALL('user_id = :user_id',
        //array(':user_id'=>$id));
        /*foreach($dataz as $data)
          {
          ;
          }*/

        $criteria = new CDbCriteria;
        $criteria->condition = "user_id = $id";
        $criteria->order = 'id DESC';
        //$this->render('userPosted', array('data'=>$data));
        $dataProvider = new CActiveDataProvider('Product', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
        $this->render('userPosted', array(
            'dataProvider' => $dataProvider, 'id' => $id,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionBuyThis($id)
    {
        $this->render('buy', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a ?
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
      // handle user login stuff
      // if creating a deal as admin, uid will be passed in
      if (isset($_GET['uid']) && isset(Yii::app()->user->isAdmin)) {
        $uid = $_GET['uid'];
        //$store = UserStore::model()->findByPk($id);
        $store = UserStore::model()->findAll('user_id=' . $uid . ' AND is_verified=1');
      } else {
        $uid = Yii::app()->user->id; // Just to assure that user couldnot modify it by himself.
        $store = UserStore::model()->findAll('user_id=' . $uid . ' AND is_verified=1');
      }
      
        if (count($store) > 0) {
            if (Yii::app()->user->isGuest) {
                $this->stickyLogin = 1;
                Yii::app()->user->returnUrl = Yii::app()->request->url;
            } else {
                $isSeller = UserRole::model()->findByAttributes(array("user_id" => $uid, 'value' => 'seller'));
                if ($isSeller == null || $isSeller == '') {
                    $this->stickyLogin = 2;
                }
            }
            $myCriteria = new CDbCriteria();
            $myCriteria->condition = "user_id = $uid AND is_verified=1";
            $locadd = UserStore::model()->find($myCriteria);

            $store = UserStore::model()->findByAttributes(array("user_id" => $uid, 'is_verified' => 1));
            if (!$store) // WARNING: is this really safe?
                $store = new UserStore;

            // create a new business?
            $model = new Product;

            if (isset($_POST['UserStore'])) {
                $notsend_email = 0;
                $record = UserStore::model()->findByAttributes(array("user_id" => $uid, 'is_verified' => 1));
                $this->log("user_id: " . $uid);
                if ($record) {
                  $this->log('not sending email');
                    $store = $record;
                    $notsend_email = 1;
                }
                $store->attributes = $_POST['UserStore'];
                $store->is_verified = $notsend_email;
                if ($store->save()) {
                    if (!$notsend_email) {
                        $result = false;
                        $user = User::model()->findByPk($uid);
                        if ($user != null) {
                            $cm = new CentralMailing();
                            $mail = $cm->store_created($store);

                            $this->render('store_added');
                            Yii::app()->end();
                        }
                    }
                }
            }

            $product_set = isset($_POST['Product']);
            if ($product_set) {
                $pm = new ProductManagement();
                $model = $pm->create($_POST['Product'], $store, $_POST['ein'], $uid, $_FILES);
                $this->redirect(array('postComplete', 'pid' => $model->id));
            }

            $this->render('create_deal', array(
                'model' => $model, 'dd' => $locadd, 'store' => $store
            ));
        } else {
            $this->render('store_not_verified');
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Product'])) {
            $pm = new ProductManagement();
            $model_out = $pm->update($model, $_POST['Product'], $_POST['ein'], $_FILES);
            if ($model_out) {
                if (isset($_GET['ad'])) {
                  //$this->redirect(array('seller/dashboard', 'status' => $model->status));
                  $this->redirect(array('seller/dashboard', 'status' => 'unpublished'));
                    Yii::app()->end();
                } else {
                  $this->redirect(array('seller/dashboard', 'status' => $model_out->status));
                    Yii::app()->end();
                    //$this->redirect(array('postCompleteupdate','pid'=>$model->id));
                }
                }
        }
        $locadd = array();
        $ups = UserStore::model()->find("user_id = " . $model->user_id);
        if ($ups)
            $locadd = $ups;
        $this->render('update_deal', array(
            'model' => $model,
            'dd' => $locadd,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if ($id) {
            Yii::app()->db->createCommand('SET foreign_key_checks = 0')->query();
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();
            Yii::app()->db->createCommand('SET foreign_key_checks = 1')->query();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            //if(!isset($_GET['ajax']))
            $this->redirect(Yii::app()->request->urlReferrer);
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
      $pm = new ProductManagement();
      $arr = $pm->listAll($_GET['product_id'], $_POST['clear'], $_POST['search']);
      //  var_dump($arr); exit;
      $this->render('index', $arr);
    }

    public function actionBuyNow() {
        require_once 'checkout-php-1.3.2/demo/cartdemo.php';

        $uid = Yii::app()->user->id;
        $user = User::model()->findByPk(Yii::app()->user->getId());

        if (Yii::app()->user->isGuest) {
            $this->stickyLogin = 1;
            Yii::app()->user->returnUrl = Yii::app()->request->url;
        }
        if (!isset($_REQUEST['pid'])) {
            //$this->redirect(Yii::app()->homeUrl);
            throw new CHttpException(404, 'The product you are trying to buy, do not exists.');
        }

        $model = new BuyNowForm;
        $newProduct = new Product;
        $foundProduct = Product::model()->findByPk($_REQUEST['pid']);
        $foundProduct->ein = ($foundProduct->ein != NULL) ? $foundProduct->ein : Yii::app()->session->get('charity');
        if ($foundProduct == null) {
            // we should give some error rather than redirect
            //$this->redirect(Yii::app()->homeUrl);
            throw new CHttpException(404, 'The product you are trying to buy, do not exists.');
        }

        //$quantity = $up->quantity + $model->pqty;
        $model->availableQuantity = $foundProduct->coupons - $up->quantity;
        if (isset($_POST['BuyNowForm'])) {
            $model->attributes = $_POST['BuyNowForm'];

            $sc = new ShoppingCart();
            $response = $sc->purchaseDeal(Yii::app()->user, $model, $foundProduct, Yii::app()->request->getUserHostAddress());
            $foundProduct = $response['foundProduct'];
            $model = $response['model'];

            if (!$response['successful']) {
                $this->render('buyNow', array('data' => $foundProduct, 
                                              'model' => $model, 
                                              'msg' => $response['error_msg']));
            } else {
                // purchase complete!
                $this->redirect(CController::createUrl('/product/buyComplete',
                    array('pid' => $model->pid,
                        'cid' => $response['purchase']->id)));
            }
        }

        // update quantity
        if ($model->pqty == 0 || $model->pqty == '')
            $model->pqty = 1;

        // update model with credit card info
        $row = TransactionsDetails::model()->findByAttributes(array('user_id' => $uid));
        if(!is_null($row)) {
            $model->cnumber = $newProduct->decryptStringArray($row->cnumber);
            $model->edate = $row->edate;
            $model->emonth = substr($model->edate, 0, 2);

            if (substr($model->emonth, 0, 1) == 0) {
                $model->emonth = substr($model->edate, 1, 1);
            }

            $model->eyear = '20' . substr($model->edate, 4, 2);
            $model->ccv = $newProduct->decryptStringArray($row->ccv);
            $model->fname = $row->fname;
            $model->lname = $row->lname;
            $model->address = $row->address;
            $model->city = $row->city;
            $model->state = $row->state;
            $model->country = $row->country;
            $model->zipcode = $row->zipcode;
        }
        $model->phone_number = $user->cellphone;

        $this->render('buyNow', array('data' => $foundProduct,
                                      'model' => $model));
    }

    /**
     * Buy Complete, Thankyou message.
     */

    public function actionBuyComplete()
    {
        if (isset($_REQUEST['pid'])) {
            $model = Product::model()->findByPk($_REQUEST['pid']);
            if ($model == null) {
                //$this->redirect(Yii::app()->homeUrl);
                throw new CHttpException(404, 'The requested page does not exist.');
            }
            $purchase = UserPurchase::model()->findByPk($_REQUEST['cid']);
            $cm = new CentralMailing();
            $mail = $cm->purchase_complete($purchase);
            $this->render('thankyou-buy', array(
                'model' => $model,
                'cid' => $purchase,
                tbl_user_purchase));
        } else {
            //$this->redirect(Yii::app()->homeUrl);
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    /**
     * Thankyou message.
     */
    public function actionPostComplete()
    {
        if (isset($_REQUEST['pid'])) {
            //$_REQUEST['fbox'] = 1;
            //$this->layout = false;
            $model = Product::model()->findByPk($_REQUEST['pid']);

            if ($model == null) {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
            $this->render('thankyou-post', array(
                'model' => $model,
            ));

        } else {
            //$this->redirect(Yii::app()->homeUrl);
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

    public function actionPostCompleteupdate()
    {
        $model = Product::model()->findByPk($_REQUEST['pid']);

        if ($model == null) {
            //$this->redirect(Yii::app()->homeUrl);
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        $this->render('thankyou-post', array(
            'model' => $model,
        ));
        //$this->render('thankyou-post',array('updateid'=>1));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Product('search');
        $model->unsetAttributes(); // clear any default values

        if (isset($_GET['Product']))
            $model->attributes = $_GET['Product'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    protected function loadModel($id)
    {
        $model = Product::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Catergory will be selected dynamically
     */
    public function actionMyCategorys()
    {
        $pid = $_POST['category_M'];
        $data = Category::model()->findALL('parent = :pId',
            array(':pId' => $pid)
        );

        $data = CHtml::listData($data, 'id', 'value');
        foreach ($data as $value => $name) {
            echo CHtml::tag('option',
                array('value' => $value), CHtml::encode($name), true);
        }
    }

    // TODO: bug. can currently view any $id, no restrictions
    public function actionVoucher($id)
    {
        $dg = new DocumentGeneration();
        $dg->voucher($id);
    }

    // TODO: bug. can currently view any $id, no restrictions
    public function actionUserPostedExport($id)
    {
        $dg = new DocumentGeneration();
        $dg->userPostedExport($id);
    }
}