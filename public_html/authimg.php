<?php
session_start ();
function random($length) {
	$hash = '';
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
//	$chars = '0123456789';
	
	$max = strlen ( $chars ) - 1;
	
	for($i = 0; $i < $length; $i ++) {
		$hash .= $chars [mt_rand ( 0, $max )];
	}
	return $hash;

}
$authnum = random ( 4 );

$_SESSION ['yan'] = $authnum;
//$authnum = $_SESSION ['yan'];
//$this->session->set_userdata('yan',$authnum);

Header ( "Content-type: image/PNG" );
$im = imagecreate ( 78, 40 );
$red = ImageColorAllocate ( $im, 157, 191, 237 );
$white = ImageColorAllocate ( $im, 10, 10, 10 );
$gray = ImageColorAllocate ( $im, 102, 102, 0 );

imagefill ( $im, 90, 40, $gray );
for($i = 0; $i < strlen ( $authnum ); $i ++) {
	imagestring ( $im, 30, 13 * $i + 15, 11, substr ( $authnum, $i, 1 ), $white );
}
for($i = 0; $i < 150; $i ++) {
	imagesetpixel ( $im, rand () % 90, rand () % 40, $gray );
}
ImagePNG ( $im );
ImageDestroy ( $im );

?> 