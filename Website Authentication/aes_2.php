<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link style="text/css" rel="stylesheet" href="style.css">
<title>Public Authentication</title>
</head>
<body style=" padding-left:80px;">
<?php
include('/Crypt/AES.php');
$decipher = new Crypt_AES(CRYPT_AES_MODE_CBC);

if(isset($_POST['submit']))
{
$iv = $_POST['iv'];
$encrypt = $_POST['num'];
$data= $_POST['sid'];
/*echo $iv."<br/>";
echo $encrypt."<br/>";
echo $data."<br/>";*/

$dbhost = 'localhost';
$dbuser = 'root_student';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'student_data');
if(! $conn )
{
die('Could not connect: ' . mysql_error());
}


//echo "before query";
$sql="SELECT `key` FROM `student_aes` WHERE `student_id`=".$data;

$retval = mysqli_query($conn,$sql);
$keyval=mysqli_fetch_assoc($retval);
//echo $keyval["key"]."<br/>";
$keyvalue=$keyval["key"];
//echo "keyvalue from detabase".$keyvalue."<br/>";
$keyvalue1=base64_decode($keyvalue);
//echo $keyvalue1."<br/>";

$ivval=base64_decode($iv);
//echo $ivval."<br/>";

$ci=base64_decode($encrypt);
//echo $ci;
//$ci=($encrypt);
$decipher->setKey($keyvalue1);
$decipher->setIV($ivval);
$dci = $decipher->decrypt($ci);
//echo "decrypted cipher". $dci."<br/>";
 
if( $data==$dci)
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

<div class="headerImage">
</div>
<br/><br/>
<div>
<form id="form1" method="post" action="<?php $_PHP_SELF ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="4">
<tr><td width="16%">Student ID</td><td width="84%"><input type="text" name="sid" /></td></tr>
<tr><td width="16%">IV</td><td width="84%"><input type="text" name="iv" /></td></tr>
<tr><td>Encyption</td><td><input type="text" name="num"  /></td></tr>

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