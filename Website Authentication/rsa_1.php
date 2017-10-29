<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link style="text/css" rel="stylesheet" href="../style.css">
<title>Public Authentication</title>
</head>

<body style=" padding-left:80px;">

<?php
echo '<html> <head> <meta charset="UTF-8"> </head>';


include('../Crypt/RSA.php');

$rsa = new Crypt_RSA();

$s_id = $_POST['sid'];
$s_name =$_POST['sname'];
$s_type =$_POST['stype'];
$res = openssl_pkey_new(array(
			 'digest_alg' => 'sha256',
              'private_key_bits' => 2048, 
              'private_key_type' => OPENSSL_KEYTYPE_RSA));
			  
openssl_pkey_export($res, $privkey);

$publicKey = openssl_pkey_get_details($res);
$test = $publicKey['key'];



$pr_k=base64_encode($privkey);

$pub_k=base64_encode($test);

$rsa->loadKey($test); // public key

$plaintext = $s_id;


$ciphertext = $rsa->encrypt($plaintext);

$b1= base64_encode($ciphertext);

$amt=0;
$dbhost = 'localhost';
$dbuser = 'root_student';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'student_data');
if(! $conn )
{
die('Could not connect: ' . mysql_error());
}



$sql="INSERT INTO `student_data`.`student_rsa`(`student_id`,`Student_name`, `Student_type`, `Private_key`, `Amount`)".
" VALUES ('".$s_id."','".$s_name."','".$s_type."','".$pr_k."','".$amt."');";
$retval = mysqli_query($conn,$sql);





?>

<div class="headerImage">
</div>
<br/><br/>
<div>

<table width="100%" border="0" cellpadding="0" cellspacing="4">
<tr><td width="16%" class="text">PUBLIC KEY</td><td><?php echo $pub_k ?></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td width="16%" class="text">CIPHER STUDENT ID</td><td><?php echo $b1 ?></td></tr>
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
<img src="../image/logo-gobeach.jpg" style="padding-left:900px;"/>
</div>
</body>
</html>

