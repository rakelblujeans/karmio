<?php
/**
 * Created by JetBrains PhpStorm.
 * User: raquelbujans
 * Date: 10/17/13
 * Time: 4:17 PM
 * To change this template use File | Settings | File Templates.
 */

class DocumentGeneration extends CComponent
{
    // TODO: is this even used?
    public function voucher($id) {
        require_once('protected/extensions/tcpdf/config/lang/eng.php');
        require_once('protected/extensions/tcpdf/tcpdf.php');
        $uid = Yii::app()->user->id;

        $data = Yii::app()->db->createCommand('select * from tbl_user_purchase p inner join tbl_user u on p.user_id=u.id inner join tbl_product pro on p.product_id=pro.id where pro.id="' . $id . '"')->queryAll();
        foreach ($data as $dt) {
            $invoice = $dt['invoice_id'];
            $name = $dt['fname'];
            $lname = $dt['lname'];
            $exp = $dt['expiry_date'];
            $named = $dt['name'];
            $price = $dt['price'];
        }

        $pdf = new TCPDF();
        $pdf->SetAuthor('Karmio');
        $pdf->SetTitle('Voucher');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetHeaderData('logo.jpg', 21, 'Karmio', '');
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //set image scale factor
        //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //set some language-dependent strings
        $pdf->setLanguageArray($l);
        // ---------------------------------------------------------
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 8, '', true);
        $pdf->AddPage();
        // Set some content to print
        $html = <<<EOD
      <h1>Voucher</h1>
      <table width="489" height="145">
      <tr>
      <td width="226" height="32"><strong>Coupon Number: </strong></td>
      <td width="429">$invoice</td>
      </tr>
      <tr>
      <td height="28"><strong>Deal Name: </strong></td>
      <td>$named</td>
      </tr>
      <tr>
      <td height="28"><strong>Purchased By: </strong></td>
      <td>$name</td>
      </tr>
      <tr>
      <td height="29"><strong>Valid till: </strong></td>
      <td>$exp</td>
      </tr>
      <tr>
      <td><strong>Deal Price </strong></td>
      <td>$price</td>
      </tr>
      </table>
EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output('Karmio_voucher.pdf', 'I');
    }

    // TODO: don't use $id
    public function userPostedExport($id) {
        require_once('protected/extensions/tcpdf/config/lang/eng.php');
        require_once('protected/extensions/tcpdf/tcpdf.php');
        $uid = Yii::app()->user->id;

        $data = Yii::app()->db->createCommand('select * from tbl_product p inner join tbl_user u on p.user_id=u.id where p.user_id="' . $id . '" order by p.id desc')->queryAll();

        $pdf = new TCPDF();
        $pdf->SetAuthor('Karmio');
        $pdf->SetTitle('User Posted Deals List');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetHeaderData('logo.jpg', 21, 'User Posted Deals List', 'by Karmio');
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //set image scale factor
        //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //set some language-dependent strings
        $pdf->setLanguageArray($l);
        // ---------------------------------------------------------
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 7, '', true);
        $pdf->AddPage();
        $test = '';
        foreach ($data as $key => $list) {
            $test .= '<tr>
<td>' . $list['fname'] . '</td>
<td>' . $list['lname'] . '</td>
<td>' . $list['email'] . '</td>
<td>' . $list['zip'] . '</td>
<td>' . $list['cellphone'] . '</td>
<td>' . $list['name'] . '</td>
<td>' . $list['couponcode'] . '</td>
</tr>';
        }

        // Set some content to print
        $html = <<<EOD
      <h1>User Posted Deals List</h1>
      <table width="478" height="48" border="1">
      <tr>
      <td width="56">First Name </td>
      <td width="55">Last Name </td>
      <td width="54">Email</td>
      <td width="62">Zip code</td>
      <td width="59">Cellphone</td>
      <td width="59">Deal</td>
      <td width="87">Coupon code </td>
      </tr>
      $test
      </table>
EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output('Karmio_userPostedlist.pdf', 'I');
    }

    public function exportBuyersList($deal_id) {
        $product = Product::model()->findByPk($_GET['deal_id']);
        $seller = User::model()->findByPk($product->user_id);
        $store = UserStore::model()->find('user_id=' . $product->user_id);
        $purchases = UserPurchase::model()->findAll('product_id=' . $product->id);
        $charity = ($product->ein == '') ? 'buyer choose their own' : $product->charity->name;

        $output = '<table style="width:850px; border:none">';
        $output .= '<tr><td bgcolor="#999999" align="center" colspan="3"><h1>KARM.IO</h1></td></tr>';
        $output .= '<tr><td align="center" colspan="3"><h3>Customer Service 9am-9pm (347) 460-5110</h3></td></tr>';
        $output .= '<tr><td align="center">&nbsp;</td></tr>';
        $output .= '<tr><td align="left">Vendor/Merchant</td><td align="left" colspan="2">' . $seller->fname . ' </td></tr>';
        $output .= '<tr><td align="left">Business Name</td><td align="left" colspan="2">' . $store->name . '</td></tr>';
        $output .= '<tr><td align="left">Address</td><td align="left" colspan="2">' . $store->address . '</td></tr>';
        $phone = ($store->phone != '') ? $store->phone : $seller->phone;
        $output .= '<tr><td align="left">Phone Number</td><td align="left" colspan="2">' . $phone . '</td></tr>';
        $output .= '<tr><td align="left">Website</td><td align="left" colspan="2">' . $store->website . '</td></tr>';
        $output .= '<tr><td align="left">Email</td><td align="left" colspan="2">' . $seller->email . '</td></tr>';
        $output .= '<tr><td bgcolor="#999999" colspan="3"></td></tr>';
        $output .= '<tr><td align="left" valign="top" >Deal Details</td><td align="left" colspan="2">' . $product->description . '</td></tr>';
        $output .= '<tr><td align="left" valign="top">Deal FinePrint</td><td align="left" colspan="2">' . $product->fine_print . '</td></tr>';
        $disc = round(($product->price * $product->regular_price) / 100);
        $output .= '<tr><td align="left">Original Price</td><td align="left" colspan="2">$' . round($product->regular_price) . '</td></tr>';

        $output .= '<tr><td align="left">Discounted Price</td><td align="left" colspan="2">$' . round($product->regular_price - $disc) . '</td></tr>';
        $output .= '<tr><td align="left">Savings</td><td align="left" colspan="2">' . round($product->price) . '%</td></tr>';
        //$output .= '<tr><td align="left">Sales Dates</td><td align="left" colspan="2">'.$product->publish_date.' - '.$product->expiry_date.'</td></tr>';

        $date_start = new DateTime($product->redeming_date_start);
        $date_end = new DateTime($product->redeming_date_end);
        $output .= '<tr bgcolor="#000000" style="color:#FFF;"><td align="left" style="width:425px" >Coupon Redeeming Dates</td><td style="width:425px" align="left" colspan="2">' . $date_start->format('d M Y') . ' - ' . $date_end->format('d M Y') . '</td></tr>';
        $output .= '<tr bgcolor="#999999" style="color:#FFF"><td align="left">Number of coupons Sold</td><td align="left" colspan="2">' . $product->soldCoupons . '</td></tr>';
        $output .= '<tr bgcolor="#FF0000" style="color:#FFF;"><td align="left">Supported Charity</td><td align="left" colspan="2">' . $charity . '</td></tr>';

        $output .= '<tr bgcolor="#999999" style="color:#F00"><td align="left">Code</td><td align="left"> Name</td></tr>';
        if (count($purchases))
            foreach ($purchases as $val) {
                $all_coupons = PurchasedCoupons::model()->findAll('purchase_id=' . $val->id);
                if (count($all_coupons))
                    foreach ($all_coupons as $cp) {
                        $style = '';
                        $cps = '';
                        if ($cp->consumption_status != 'valid')
                            $style = 'style="text-decoration:line-through;"';
                        $cps = '<span ' . $style . '>' . $cp->invoice_id . '</span>';

                        $output .= '<tr><td align="left">' . $cps . '</td><td align="left">' . substr($val->user->fname, 0, 3) . '</td></tr>';
                    }
            }
        $output .= '</table>';
        header("Content-type: text/html");
        $file_name = str_replace(' ', '', $store->name) . '-' . $product->couponcode . '.xls';
        header("Content-Disposition: attachment; filename=" . $file_name);
        return $output;
    }

    // called from seller/downloadpdf&id=XXX
    public function downloadPurchaseDetailPdf($id) {
        require_once('protected/extensions/tcpdf/config/lang/eng.php');
        require_once('protected/extensions/tcpdf/tcpdf.php');
        $uid = Yii::app()->user->id;

        $dataz = Yii::app()->db->createCommand('select * from tbl_user_purchase p inner join tbl_user u on p.user_id=u.id inner join tbl_product pro on p.product_id=pro.id where pro.id="' . $id . '"')->queryAll();
        $pdf = new TCPDF();
        $pdf->SetAuthor('Karmio');
        $pdf->SetTitle('Deal Purchase Detail');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetHeaderData('logo.jpg', 21, 'Deal Purchase Detail', 'by Karmio');
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //set image scale factor
        //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //set some language-dependent strings
        $pdf->setLanguageArray($l);
        // ---------------------------------------------------------
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 7, '', true);
        $pdf->AddPage();
        foreach ($dataz as $key => $list) {
            $fname = $list['fname'];
            $lname = $list['lname'];
            $email = $list['email'];
            $zip = $list['zip'];
            $cell = $list['cellphone'];
            $name = $list['name'];
            $invoice = $list['invoice_id'];
            $des = $list['description'];
            $fine = $list['fine_print'];
            $col = $list['collection_date'];
            $reg = $list['regular_price'];
            $pr = $list['price'];
        }
        // Set some content to print
        $html = <<<EOD
	<h1>Deal Purchase Detail</h1>
<table width="453" cellspacing="5">
  <tr>
    <td width="159"><b>Deal Title:</b></td>
    <td width="207">$name</td>
  </tr>
  <tr>
    <td><b>First Name:</b></td>
    <td>$fname</td>
  </tr>
  <tr>
    <td><b>Last Name:</b></td>
    <td>$lname</td>
  </tr>
  <tr>
    <td><b>Email:</b></td>
    <td>$email</td>
  </tr>
  <tr>
    <td><b>Zip Code:</b></td>
    <td>$zip</td>
  </tr>
  <tr>
    <td><b>Cell#:</b></td>
    <td>$cell</td>
  </tr>
  <tr>
    <td><b>Coupon#:</b></td>
    <td>$invoice</td>
  </tr>
  <tr>
    <td><strong>Deal Regular Price:</strong></td>
    <td>$reg</td>
  </tr>
  <tr>
    <td><strong>Deal Coupon Price:</strong></td>
    <td>$pr</td>
  </tr>
  <tr>
    <td><strong>Description: </strong></td>
    <td>$des</td>
  </tr>
  <tr>
    <td><strong>Fine Print: </strong></td>
    <td>$fine</td>
  </tr>
  <tr>
    <td><strong>Deal Collect Date: </strong></td>
    <td>$col</td>
  </tr>
</table>
EOD;
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output('Karmio_deal_purchaselist.pdf', 'I');
    }

    // called from SellerController::actionPrint_deal
    public function printDealDetail($id, $html) {
        require_once('protected/extensions/tcpdf/config/lang/eng.php');
        require_once('protected/extensions/tcpdf/tcpdf.php');
        $data = Product::model()->findByPk($id);

        $pdf = new TCPDF();
        $pdf->SetAuthor('Karmio');
        $pdf->SetTitle('Deal Purchase Detail');
        $pdf->SetSubject('Deal Detail');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetHeaderData('logo.jpg', 21, 'Deal Detail by Karmio', $data->name);
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //set image scale factor
        //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //set some language-dependent strings
        $pdf->setLanguageArray($l);
        // ---------------------------------------------------------
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 7, '', true);
        $pdf->AddPage();
        // Set some content to print
        //$html='<a href="www.google.com">Google</a>';
        // Print text using writeHTMLCell()
        //print $html;
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output('Karmio_deal_purchaselist.pdf', 'I');
        // TODO: make name more descriptive
    }

    // userPurchaseController::actionDownloadpdf
    public function downloadUserPurchaseListPdf($dataz) {
        require_once('protected/extensions/tcpdf/config/lang/eng.php');
        require_once('protected/extensions/tcpdf/tcpdf.php');
        $pdf = new TCPDF();
        $pdf->SetAuthor('Karmio');
        $pdf->SetTitle('User Purchase List');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetHeaderData('logo.jpg', 21, 'User Purchase List', 'by Karmio');
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //set image scale factor
        //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //set some language-dependent strings
        $pdf->setLanguageArray($l);
        // ---------------------------------------------------------
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 7, '', true);
        $pdf->AddPage();
        $test = '';
        foreach ($dataz as $key => $list) {
            $test .= '<tr>
    <td>' . $list['fname'] . '</td>
    <td>' . $list['lname'] . '</td>
    <td>' . $list['email'] . '</td>
    <td>' . $list['zip'] . '</td>
    <td>' . $list['cellphone'] . '</td>
    <td>' . $list['name'] . '</td>
    <td>' . $list['invoice_id'] . '</td>
  </tr>';
        }
        // Set some content to print
        $html = <<<EOD
	<h1>User List</h1>
<table width="310" height="48" border="1">
  <tr>
    <td width="72"><b>First Name</b> </td>
    <td width="70"><b>Last Name</b>  </td>
    <td width="78"><b>Email</b> </td>
    <td width="83"><b>Zip Code </b> </td>
    <td width="81"><b>Cell#</b> </td>
    <td width="50"><b>Deal Title </b> </td>
    <td width="77"><b>Coupon#  </b> </td>
  </tr>
  $test
</table>
EOD;
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output('Karmio_User_DealPurcahaseList.pdf', 'I');
    }

    // UserPurchasedController::actionUserPurchasedExport
    // TODO: same as function above?
    public function userPurchasedExport() {
        require_once('protected/extensions/tcpdf/config/lang/eng.php');
        require_once('protected/extensions/tcpdf/tcpdf.php');
        $uid = Yii::app()->user->id;
        $test = '';
        $data = Yii::app()->db->createCommand('select * from tbl_user_purchase p inner join tbl_user u on p.user_id=u.id inner join tbl_product pro on p.product_id=pro.id where p.user_id="' . $id . '" order by pro.id Asc')->queryAll();
        $pdf = new TCPDF();
        $pdf->SetAuthor('Karmio');
        $pdf->SetTitle('User Purchased List');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetHeaderData('logo.jpg', 21, 'User Purchased List', 'by Karmio');
        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        //set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //set image scale factor
        //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //set some language-dependent strings
        $pdf->setLanguageArray($l);
        // ---------------------------------------------------------
        // set default font subsetting mode
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('dejavusans', '', 7, '', true);
        $pdf->AddPage();
        foreach ($data as $key => $list) {
            $test .= '<tr>
    <td>' . $list['fname'] . '</td>
    <td>' . $list['lname'] . '</td>
    <td>' . $list['email'] . '</td>
    <td>' . $list['zip'] . '</td>
    <td>' . $list['cellphone'] . '</td>
    <td>' . $list['name'] . '</td>
    <td>' . $list['invoice_id'] . '</td>
  </tr>';
        }
        // Set some content to print
        $html = <<<EOD
	<h1>User Purchased List</h1>
<table width="478" height="48" border="1">
  <tr>
    <td width="56">First Name </td>
    <td width="55">Last Name </td>
    <td width="54">Email</td>
    <td width="62">Zip Code</td>
    <td width="59">Cellphone#</td>
    <td width="59">Product</td>
    <td width="87">Coupon code </td>
  </tr>
 $test
</table>
EOD;
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output('Karmio_userPurchasedlist.pdf', 'I');
    }


}
?>