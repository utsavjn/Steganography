<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link style="text/css" rel="stylesheet" href="style.css">
<title>Public Authentication</title>
</head>

<body style=" padding-left:80px;">

<?php

 $size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CBC);
 $ivval = mcrypt_create_iv($size, MCRYPT_DEV_RANDOM);
 $key= base64_encode($ivval);
 
$data = $_POST['sid'];
$studentname = $_POST['sname'];
$studentype = $_POST['stype'];

$output= hmac_sha2($key,$data);
//echo $output;
function hmac_sha2($key, $data)
{
    // Adjust key to exactly 64 bytes
    if (strlen($key) > 64) {
        $key1 = str_pad(hash('sha256', $key ), 64, chr(0));
		//echo $key1."<br/>";
		//echo "size of key greater than 64";
    }
    if (strlen($key) < 64) {
        $key1 = str_pad($key, 64, chr(0));
		//echo $key1."<br/>";
//echo "size of key less than 64"."<br/>";
    }
    // Outer and Inner pad
    $opad = str_repeat(chr(0x5C), 64);
    $ipad = str_repeat(chr(0x36), 64);
    // Xor key with opad & ipad
    for ($i = 0; $i < strlen($key1); $i++) {
        $opad[$i] = $opad[$i] ^ $key1[$i];
        $ipad[$i] = $ipad[$i] ^ $key1[$i];
    }
    //return sha1($opad.sha1($ipad.$data, true));
	 //  return sha1($opad.hash( 'sha256', $ipad.$data ));
	   $a=hash( 'sha256', $ipad.$data );
	   $b=$opad.$a;
	   $x=hash('sha256',$b);
	   return $x;
	   }
	   $amt=0;
$dbhost = 'localhost';
$dbuser = 'root_student';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'student_data');
if(! $conn )
{
die('Could not connect: ' . mysql_error());
}


$sql="INSERT INTO `student_hmac`(`student_id`, `key`, `student_name`, `student_type`, `amount`)"." VALUES ('".$data."','".$key."','".$studentname."','".$studentype."','".$amt."')";
$retval = mysqli_query($conn,$sql);

	   
 ?>
<body style=" padding-left:80px;">
<div class="headerImage">
</div>
<br/><br/>
<div>
<table width="100%" border="0" cellpadding="0" cellspacing="4">
<tr><td width="16%">Hash</td><td><?php echo $output ?></td></tr>

</table>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<div>
<img src="image/logo-gobeach.jpg" style="padding-left:900px;"/>
</div>
</body>
</html>



