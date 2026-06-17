<?php
$lnk = mysql_connect("localhost", "root", "")
        or die("Could not connect: " . mysql_error());
mysql_select_db('larry', $lnk) or die ('Can\'t use foo : ' . mysql_error());

$sql = "select *from orders1";
$qu = mysql_query($sql);



if(mysql_num_rows($qu)>0) {
	while($row = mysql_fetch_array($qu)) {
		print_r($row);
		//echo $row['id']."<br/>";
	}
}

mysql_close($lnk);





