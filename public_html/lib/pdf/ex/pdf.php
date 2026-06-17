<?php
require_once ('../config/lang/eng.php');
require_once ('../tcpdf.php');
$oid = $_GET['id'];

//打开连接
$lnk = mysql_connect("localhost", "root", "")
or die("Could not connect: " . mysql_error());
mysql_select_db('coucou_bebe', $lnk) or die ('Can\'t use foo : ' . mysql_error());       

//重新写sql语句
//$result = $this -> Order_Model -> getInvoiceByOrderId($oid);
//@ $db = new mysqli('localhost','root','','larry');
$sql="select * from coucou_bebe_order_number where id=$oid";

mysql_query('set names utf8');
$qu = mysql_query($sql);
//print_r($qu);exit;
$count = 0;
$uid = 0;
$address_id =0;
$shipp_id = 0;
$ctime = "";
$status=0;
$sumprice=0;
$shippprice=0;
$discount=1;
if(mysql_num_rows($qu)>0){
	$row = mysql_fetch_array($qu);
	$uid = $row ['uid'];
	$address_id = $row ['address_id'];
	$status = $row ['status'];
	$shipp_id = $row ['shipp_id'];
	$sumprice=$row['sumprice'];
	$discount=$row['discount'];
	$ctime = $row ['ctime'];
}
$ctime=date('Y-m-d',$ctime);
if($status==0){$status="Preparation in progress";}else{$status="complete";}
$sum = 1;
$pdf = new TCPDF ( PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false );
$pdf->SetCreator ( PDF_CREATOR );
//$pdf->SetAuthor('Nicola Asuni');
//$pdf->SetTitle('SOLD TO');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->SetHeaderData ( PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);
//$pdf->setHeaderFont ( Array (PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN ) );
//$pdf->setFooterFont ( Array (PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA ) );
//$pdf->SetDefaultMonospacedFont ( PDF_FONT_MONOSPACED );
//$pdf->SetMargins ( PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT );
$pdf->SetHeaderMargin ( PDF_MARGIN_HEADER );
//$pdf->SetFooterMargin ( PDF_MARGIN_FOOTER );
$pdf->SetAutoPageBreak ( TRUE, PDF_MARGIN_BOTTOM );
//$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );

$pdf->AddPage ();
$pdf->SetFont ( 'helvetica', 'B', 20 );
$pdf->Write ( 0, ' ', '', 0, 'L', true, 0, false, false, 0 );
 
//
$html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<div style="border:white solid 1px;margin:0 auto;">

<br>
   	<table width="541" height="100" cellpadding="0" cellspacing="0" >
	 <tr><td>Invoice</td><td width="100"></td><td>Delivery</td></tr>';
	$sqluse="select * from  coucou_bebe_user, coucou_bebe_user_information where coucou_bebe_user.id=$uid and coucou_bebe_user_information.uid=$uid and  coucou_bebe_user_information.id=$address_id";
	$qu1 = mysql_query($sqluse);
	$name="";
	$company="";
	$address1="";$address2="";
	$postcode="";
	$phone="";
	$phone_mobile="";
	$city="";
	
	if(mysql_num_rows($qu1)>0){
		$row = mysql_fetch_array($qu1);
		$name=$row ['firstname']." ".$row['lastname'];
		$company=$row ['company'];
		$address1=$row ['address1'];
		$address2=$row ['address2'];
		$postcode=$row ['postcode'];
		$city=$row ['city'];
		$phone=$row ['phone'];
		$phone_mobile=$row ['phone_mobile'];
	}
 		if($phone==""||$phone==null){
              $phone=$phone_mobile;
              }else {
              $phone=$phone;
              }
$html.='
	 <tr>
    		<td>'.$name.'</td><td width="100"></td>
    		<td>'.$name.'</td>
    	</tr>
		<tr>
    		<td>'.$company.'</td>
    		<td width="100"></td>
    		<td>'.$company.'</td>
    	</tr>
		<tr>
    		<td>'.$address1.'</td>
    		<td width="100"></td>
    		<td>'.$address1.'</td>
    	</tr>
    	<tr>
    		<td>'.$address2.'</td>
    		<td width="100"></td>
    		<td>'.$address2.'</td>
    	</tr>
    	<tr>
    		<td>'.$postcode.' '.$city.'</td>
    		<td width="100"></td>
    		<td>'.$postcode.' '.$city.'</td>
    	</tr>
    	<tr>
    		<td>'.$phone.'</td>
    		<td width="100"></td>
    		<td>'.$phone.'</td>
    	</tr>
	</table><br/><br/>
		NO:&nbsp;'.$oid.'<br/>
		Order placed on'.$ctime.'<br/>
	 <table width="541" height="100" cellpadding="0" cellspacing="0" style="border: 1px solid black;">
		<tr style="background-color: #D0D3D8">
    		<td>Date</td>
    		<td>Status</td>
    	</tr>
		<tr>
    		<td>'.$ctime.'</td>
    		<td>'.$status.'</td>
    	</tr>
		
	</table>
	<br/><br/><table width="541px" cellpadding="0" cellspacing="0" style="border: 1px solid black;">
					 <tr style="background-color: #D0D3D8">
						 <td width="107px">Reference</td>
						 <td  width="110px">Product</td>
						 <td  width="97px">Quantity</td>
						 <td  width="113px">Unit price</td>
						 <td  width="114px">Total price</td>
					</tr>
					 ';
$sqlo="select * from coucou_bebe_order where orderno=$oid";
$sumorderprice=0;
$discountprice=0;//优惠
$prototalprice=0;
$qu2 = mysql_query($sqlo);
		if(mysql_num_rows($qu2)>0){
			for($i = 0; $i < mysql_num_rows($qu2); $i++){
				$order = mysql_fetch_array($qu2);
				
				$proid=$order['pcid'];
				$sqlpro="select * from coucou_bebe_allproduct_category where id=$proid";
				$qu3 = mysql_query($sqlpro);
				if(mysql_num_rows($qu3)>0){
					//for($j = 0; $j < mysql_num_rows($qu3); $j++){
						$pro = mysql_fetch_array($qu3);
						$prototalprice+=$order ['count']*$pro['price'];
						$html .= '<tr><td>--</td><td>' . $pro['name'] .'</td><td>'.$order ['count'].'</td><td>'.$pro['price'].'</td><td>'.$order ['count']*$pro['price'].'</td></tr>';
					//}
				}
				
			}
		}
		
		if($discount==1){
			$discountprice=0;
		}else{
			$discountprice=$prototalprice-$prototalprice*$discount;
		}
		//print_r($prototalprice);exit;

						
		$sqlshipp="select * from  coucou_bebe_shipp where id=$shipp_id";
		$qu4 = mysql_query($sqlshipp);
		if(mysql_num_rows($qu4)>0){
			$row = mysql_fetch_array($qu4);
			$shippprice = $row ['price'];
		}
$html.='<tr><td colspan="5" align="right">Total products (tax incl.):&nbsp;<span style="color: red;">HK$'.$prototalprice.'</span></td></tr>
		<tr><td colspan="5" align="right">Discount Price:&nbsp;<span style="color: red;">HK$'.$shippprice.'</span></td></tr>
		<tr><td colspan="5" align="right">Total shipping (tax incl.):&nbsp;<span style="color: red;">HK$'.$discountprice.'</span></td></tr>
		<tr><td colspan="5" align="right">Total :&nbsp;<span style="color: red;">HK$'.$sumprice.'</span></td></tr>
		</table>	
</div>
</html>
';
//	echo $html;
mysql_close($lnk);
$pdf->SetFont ( 'stsongstdlight', '', 10 );
$pdf->writeHTML ( $html, true, 0, true, true );
$pdf->lastPage ();
$pdf->Output ( 'invoice.pdf', 'I' );

//============================================================+
// END OF FILE                                                
//============================================================+
?>
