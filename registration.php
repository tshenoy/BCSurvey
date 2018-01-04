<?Php
session_start();
$email=$_POST['email'];
if(filter_var($email,FILTER_VALIDATE_EMAIL)){
$_SESSION['email']=$email;
header ("Location: poll.php");
}else{
echo " Email validation failed ";
}

?>

<html>

<head>
<title>plus2net online survey questions Registration</title>
</head>

<body>
<form method=post action=''>
Email <input type=text name=email>
<input type=Submit value='Start Survey'>
</form>


</body>

</html>
