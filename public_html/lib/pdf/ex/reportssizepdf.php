<?php
require_once ('../config/lang/eng.php');
require_once ('../tcpdf.php');  
$pid = $_GET['pid'];
//打开连接
$lnk = mysql_connect("localhost", "root", "")
or die("Could not connect: " . mysql_error());
mysql_select_db('efedb', $lnk) or die ('Can\'t use foo : ' . mysql_error());       

//重新写sql语句
//$result = $this -> Order_Model -> getInvoiceByOrderId($oid);
//@ $db = new mysqli('localhost','root','','larry');
$pdf = new TCPDF ( PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false );
$pdf->SetCreator ( PDF_CREATOR );
//$pdf->SetAuthor('Nicola Asuni');
//$pdf->SetTitle('SOLD TO');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
//$pdf->SetHeaderData ( PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 039', PDF_HEADER_STRING );
//$pdf->setHeaderFont ( Array (PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN ) );
//$pdf->setFooterFont ( Array (PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA ) );
//$pdf->SetDefaultMonospacedFont ( PDF_FONT_MONOSPACED );
//$pdf->SetMargins ( PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT );
//$pdf->SetHeaderMargin ( PDF_MARGIN_HEADER );
//$pdf->SetFooterMargin ( PDF_MARGIN_FOOTER );
$pdf->SetAutoPageBreak ( TRUE, PDF_MARGIN_BOTTOM );
$pdf->setImageScale ( PDF_IMAGE_SCALE_RATIO );

$pdf->AddPage ();
$pdf->SetFont ( 'helvetica', 'B', 20 );
$pdf->Write ( 0, ' ', '', 0, 'L', true, 0, false, false, 0 );
//
date_default_timezone_set("PRC");
$html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<div><img src="../../images/iyigor_logo1.png" width="200" height="100"></div>
<div style="border:white solid 1px;margin:0 auto;">
	<table border="0" width="650">
		<tr><td colspan="5" align="right">'.date('Y-m-d H:i:s').'</td></tr>
		<tr>
        	<td style="font-size: 38px;">';
        		$sqls="SELECT * from products where pid = $pid";
				mysql_query('set names utf8');
				$qus = mysql_query($sqls);
				$r = "";
				for($k=0;$k<mysql_num_rows($qus);$k++){
					$row = mysql_fetch_array($qus);
					$r = $row['pname'];
            	}
        $html .= $r.'</td>
        </tr>
		<tr style="background-color: #016fc8;">
			<th width="50"></th>
            <th align="center" width="300">Size</th>
            <th align="center" width="100">Sold</th>
            <th align="center" width="100">Balance</th>
            <th align="center" width="100">Price(RMB)</th>
        </tr>';
		$sql="SELECT * from product_size where pid = $pid";
		mysql_query('set names utf8');
		$qu = mysql_query($sql);
		$total = 0;
		$aveall = 0;
        $quall = 0;
		if(isset($qu) && $qu !=null ){
			for($i=0;$i<mysql_num_rows($qu);$i++){
				$product = mysql_fetch_array($qu);
				$html .= '<tr><td width="50">'.($i+1).'</td>
            			<td align="center" width="300">'.$product['size'].$product['unit'].'</td>
            			<td align="center">';
				
				$sql1 = "select * from orders_products where products_id=".$product['pid']." and products_size = ".$product['id'];
				mysql_query('set names utf8');
				$qu1 = mysql_query($sql1);
				$ave = 0;
				for($k=0;$k<mysql_num_rows($qu1);$k++){
					$productaverage = mysql_fetch_array($qu1);
            		$ave += $productaverage['products_quantity'];
            	}
            	$aveall += $ave;
            	$html .= $ave.'</td><td align="center">';
            	
				$sql2 = "select * from product_size where pid=".$product['pid']." and id = ".$product['id'];
				mysql_query('set names utf8');
				$qu2 = mysql_query($sql2);
				$quantity = 0;
				for($j=0;$j<mysql_num_rows($qu2);$j++){
					$productsize = mysql_fetch_array($qu2);
            		$quantity += $productsize['quantity'];
            	}
				$quall += $quantity;
            	$html .= $quantity.'</td><td align="center">';
				$sql3 = "select * from orders_products where products_id=".$product['pid']." and products_size = ".$product['id'];
				mysql_query('set names utf8');
				$qu3 = mysql_query($sql3);
				$price = 0;
				for($q=0;$q<mysql_num_rows($qu3);$q++){
					$productaverage1 = mysql_fetch_array($qu3);
            		$price += $productaverage1['products_price'];
            	}
            	$total += $price;
            	$html .= $price.'</td></tr>';
			}
		}
	$html .= '<tr><td colspan="5" valign="middle"><hr width="100%"/></td></tr>
				<tr>
	            		<td align="center" style="border-top: 1px black solid;"></td>
	            		<td align="center" style="border-top: 1px black solid;">Total</td>
            			<td align="center" style="border-top: 1px black solid;">'.$aveall.'</td>
            			<td align="center" style="border-top: 1px black solid;">'.$quall.'</td>
            			<td align="center" style="border-top: 1px #000 solid;">'.$total.'</td>
            		</tr>
			<tr><td colspan="5" align="right">&nbsp;</td></tr>
			<tr><td colspan="5" align="right">Total : '.$total.'</td></tr></table>
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
