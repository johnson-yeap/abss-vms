<?php
session_start ();
function random($length) {
	$hash = '';
// 	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
	$chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789abcdefghijklmnpqrstuvwxyz';
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

imagefill ( $im, 78, 40, $gray );
for($i = 0; $i < strlen ( $authnum ); $i ++) {
// 	imagestring ( $im, 10, 13 * $i + 15, 11, substr ( $authnum, $i, 1 ), $white );
    imagettftext ( $im, 16, 0, (15 * $i + 10), 27, $white, './timesnewroman.ttf', substr ( $authnum, $i, 1 ) );
}
for($i = 0; $i < 150; $i ++) {
	imagesetpixel ( $im, rand () % 78, rand () % 40, $gray );
}

ImagePNG ( $im );
ImageDestroy ( $im );

?> 