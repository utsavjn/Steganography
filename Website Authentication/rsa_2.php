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





if(isset($_POST['submit']))
{
$s_id = $_POST['sid'];
$pub_k = $_POST['num'];
$cipher = $_POST['crypt'];
//echo $cipher."<br/>";

$dbhost = 'localhost';
$dbuser = 'root_student';
$dbpass = '';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,'student_data');
if(! $conn )
{
die('Could not connect: ' . mysql_error());
}



$sql="select `Private_key` from `student_rsa` where student_id = ".$s_id ;
$retval = mysqli_query($conn,$sql);
//$test = $retval->num_rows;


$img=mysqli_fetch_assoc($retval);
//echo $img["Private_key"]."<br/>";
$pri_key = $img["Private_key"];
//echo $keyval;
/*$pri_key="LS0tLS1CRUdJTiBQUklWQVRFIEtFWS0tLS0tCk1JSUNkUUlCQURBTkJna3Foa2lHOXc
wQkFRRUZBQVNDQWw4d2dnSmJBZ0VBQW9HQkFMbUZmekFDa3F3MWc0QWMKS202Q2dxMDBGTHJIUHVuMWNZTD
RKbUphWUJLK2VieW4ycGtRVis5dzEvYU9hbjlZdmQrZFNPcEVQR2Y3OWU2Ngo1elExL0Z4SkdhYXJNcWhpUit
4MVNWb3BxT216Smk4c1dvNmhrTTZ4YnorZG52elI0UkxlaUt1QmJPemdRVTZyCkhzSkZ1bWNvM3BUalR5dy9Ba
lBTdExrcjM5emxBZ01CQUFFQ2dZQmR4b3dHMFpZZ05DQ1hWaVZnbk5tL0FTOWwKUmllWURUZm1jdGE4S21DYnVPcENJV
HFPMmtNSXhpcHo5NEwvZ2ZUZ0hsbm9DTHZiOS9GVlRlWm1iczl6WFRBQgp0TkRFL1Z5RW9tK3pKSnFqNFlNSnJkT1hSTm5
GZHgvNU5yOHdJYUtBYjNjYml6V3hFeW1NS0NGcytJMFFjZVhBCnlJSHlScytMU2hZSXZzNmJGUUpCQU8vVEZMMHBrc3ZQdGZOMF
hsL0pzSFVVb0tHMk1QRVVldlZoUDYrMFUzcWgKbE0xZzFkdjZiL2dVenBJZi8xNFN4RllybDR0T25ZQkdHcmZmditlZlpIOENRUURHQ0
10bk1sQlhiQWF5QlNtQgpDK2p3KytyYUF6ZDR5blA3MEV4T1E2SU1EeHVoVG5OU2xHOGhHNUx1eitnZFZ2OEFQdG0zWjRaaXFxM0NvNjNjCkQ
veWJBa0FEU2k3M3BWRlpNR0U3bExZU3RFNlNYSlVUZ3M5TEQwL2NlOWdHemY5ektESkZXdlcwRGN4cFo4ZXAKbzN5NlNxR2MyUDQ4TC9qaklKTVBRS2QrUXVaN0FrQmxjR2ZRYXFOZ3hJTUJlVWR6Uk1
pRGVHY3FXVzkydmkxLwpGWW1ncFdCQ1VSTFVJNzFLMWFHL0VjTEg5Vk51Zy91SEFxcS9HWlpxd0FiVnBzWU43VnAxQWtBNXN4Z0QzY2Y5CmlTbHRnYml0NkQrdmhWQVNOOTNkSDhoeGc0eS9jSVBJZk4yY0
J5SlJHQmx2SmpFcTlCek5IZnh4TkFaRm1Zd2QKY3lvQytETnJiaWtyCi0tLS0tRU5EIFBSSVZBVEUgS0VZLS0tLS0K";*/
$ci=base64_decode($cipher);
$pr_k=base64_decode($pri_key);
//echo $pr_k;
$rsa->loadKey($pr_k); // private key
$decipher= $rsa->decrypt($ci);





if( $decipher==$s_id)
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
echo "</html>";
?>






<body style=" padding-left:80px;">
<div class="headerImage">
</div>
<br/><br/>
<div>
<form id="form1" method="post" action="<?php $_PHP_SELF ?>">
<table width="100%" border="0" cellpadding="0" cellspacing="4">
<tr><td width="16%">ID</td><td width="84%"><input type="text" name="sid" /></td></tr>
<tr><td>INTEGER</td><td><input type="text" name="num"  /></td></tr>
<tr><td height="22">CRYPT</td><td><input type="text" name="crypt"  /></td></tr>
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
<img src="../image/logo-gobeach.jpg" style="padding-left:900px;"/>
</div>
<?php
}
?>
</body>
</html>

