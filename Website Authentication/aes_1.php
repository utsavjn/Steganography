<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link style="text/css" rel="stylesheet" href="style.css">
<title>Public Authentication</title>
</head>

<body style=" padding-left:80px;">

<?PHP
include('/Crypt/AES.php');

$cipher = new Crypt_AES(); 

$size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CBC);
$iv = mcrypt_create_iv($size, MCRYPT_DEV_RANDOM);
$key = mcrypt_create_iv($size, MCRYPT_DEV_RANDOM);
$cipher->setIV($iv);
$cipher->setKey($key);
$plaintext = $_POST['sid'];
$studentname = $_POST['sname'];
$studenttype = $_POST['stype'];
$save = $cipher->encrypt($plaintext);
$cipher = base64_encode($save);
$ivval= base64_encode($iv);
$keyval= base64_encode($key);


$amt=0;
$dbhost = 'localhost';
$dbuser = 'root_student';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'student_data');
if(! $conn )
{
die('Could not connect: ' . mysql_error());
}

$sql="INSERT INTO `student_aes`(`student_name`, `student_type`, `student_id`, `key`, `amount`)" ."VALUES ('".$studentname."','".$studenttype."','".$plaintext."','".$keyval."','".$amt."')";
$retval = mysqli_query($conn,$sql);

?>

<div class="headerImage">
</div>
<br/><br/>
<div>

<table width="100%" border="0" cellpadding="0" cellspacing="4">
<tr><td width="16%" class="text">IV</td><td><?php echo $ivval ?></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td width="16%" class="text">Encrypted Student Id</td><td><?php echo $cipher ?></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>

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
