<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link style="text/css" rel="stylesheet" href="style.css">
<title>Public Authentication</title>
</head>

<body style=" padding-left:80px;">

<?php
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

if(isset($_POST['submit']))
{
$data = $_POST['sid'];
$hash = $_POST['num'];

$dbhost = 'localhost';
$dbuser = 'root_student';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'student_data');
if(! $conn )
{
die('Could not connect: ' . mysql_error());
}


//echo "before query";
$sql="SELECT `key` FROM `student_hmac` WHERE `student_id`=".$data;

$retval = mysqli_query($conn,$sql);

$keyval=mysqli_fetch_assoc($retval);
//echo $keyval["key"]."<br/>";
$keyvalue=$keyval["key"];

$output = hmac_sha2($keyvalue,$data);
 
if( $hash==$output)
{

 header("Location:authenticate.php");
    exit;

}
else
{
die('UNAUTHENTICATE STUDENT: ' . mysql_error());

}

mysqli_close($conn);
}
else
{
?>

<body style=" padding-left:80px;">
<div class="headerImage">
</div>
<br/><br/>
<div>
<form id="form1" method="post" action="<?php $_PHP_SELF ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="4">
<tr><td width="16%">Student Id</td><td width="84%"><input type="text" name="sid" /></td></tr>
<tr><td>Hash</td><td><input type="text" name="num"  /></td></tr>

<tr><td height="89"></td><td><input type="submit" value="SUBMIT" name="submit" class="button"/></td></tr>
</table>
</form>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<div>
<img src="image/logo-gobeach.jpg" style="padding-left:900px;"/>
</div>
<?php
}
?>
</body>
</html>

