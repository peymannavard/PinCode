<?php
session_start();
include_once ('inc/config.php');
$main = new Main();
//End Connect To DB
@$msm = $_GET['ID'];


//Form Login Panel
if(isset($_POST['submit-login']) && !empty($_POST['username-login']) && !empty($_POST['password-login'])){

    $username = $_POST['username-login'];
    $password = $_POST['password-login'];

$main->userlogin($username,$password);
	
} //End Form Login Panel


?>


<!doctype html>
<html>
<head>
<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="css/pincode.css">
<link rel="stylesheet" href="css/profile.css">
<meta charset="utf-8">
<title>سامانه دریافت پین کد</title>
</head>

<body>

<?php 
	// Validation For Include File To INDEX
	if(empty($_SESSION['usernamelogin'])){
		include_once('login.php');
	}elseif($_SESSION['usernamelogin'] && $msm == ''){
		include_once('pincode.php');
		echo "
		<a href='index.php?ID=logout' name='logout'>خروج</a><br>
		<a href='index.php?ID=profile' name='profile'>پروفایل</a>
		";
	}
	if($msm == 'profile' ){
		include_once('profile.php');
	}
	if($msm == 'pincode'){
		include_once('pincode.php');
		echo "
		<a href='index.php?ID=logout' name='logout'>خروج</a><br>
		<a href='index.php?ID=profile' name='profile'>پروفایل</a>
		";
	}
	//End Of Validation Include File
?>



</body>
</html>



<?php
if($msm == 'logout'){
	session_destroy();
	$main->Redirect("index.php");
}//End Quit Portal

if(isset($_POST['pincodeget']) && empty($_POST['tellpincode'])){
	
	echo("
	<div id='showmessagenotell' align='center'>
		فیلد تلفن خالی میباشد
		</div>
	
	");
}

if(isset($_POST['pincodefalse'])){
	$deactivepincode = $_SESSION['showpin'] ;
	$main->DeactivePincode($deactivepincode);
}



?>




