<?php





class Main{
public $dbconnect;
    public $ipdb = "localhost";
    public $userdb = "root";
    public $passdb = "";
    public $db = "pinportal";


    function __construct()
    {
        $this->dbconnect = mysql_connect("$this->ipdb","$this->userdb","$this->passdb") or die("مشکل در اتصال به دیتابیس میباشد");
        mysql_query("SET NAMES 'utf8'", $this->dbconnect);
        mysql_select_db("$this->db",$this->dbconnect) or die("نام دیتابیس به درستی تنظیم نشده است");
    }//End Construct

    function userlogin($username,$password)
    {
        $login_check = "SELECT login.username,login.password FROM login WHERE login.username = '$username' AND login. PASSWORD = '$password'"; //End Query Login
        $query_check_user = mysql_query($login_check, $this->dbconnect);
        $user_alerdy = mysql_fetch_assoc($query_check_user);
		$_SESSION['usernameloginportal'] = $user_alerdy['username'];
        if ($user_alerdy['username']) {
            $reu = $user_alerdy['username'];
			$_SESSION['usernamelogin'] = $reu;

        }else{
            echo('نام کاربری و پسورد اشتباه است');
            die();
        }
    }//End UserLogin Func
	
	function Redirect($page){
	
	header("Location: $page");
	
}//End Redirect Func
	
	function getpincode(){
    $query = "SELECT pincode FROM pincode WHERE active = 1 AND used = 0 LIMIT 1";
    $pin_check = mysql_query($query);
    $result_pin = mysql_fetch_assoc($pin_check);
	$pinok = $result_pin['pincode'];
		if($pinok){
			$query_update_use = " UPDATE pincode SET used='1' WHERE pincode='$pinok' ";
			$update_use_pin =mysql_query($query_update_use);
		}/*else{echo "
		<div id='showmessagenopin' align='center'>
		پین در دیتابیس موجود نیست اطلاع دهید
		</div>
		
		";}*/
	
	return($pinok);
}//End Get Pincode
	

	function SubmitTell($tell){
		$query_check_pincode = "SELECT pincode FROM pincode WHERE active = 1 AND used = 0 LIMIT 1";
		$pin_check = mysql_query($query_check_pincode);
    	$result_pin_check = mysql_fetch_assoc($pin_check);
		$check_pincode_avalable = $result_pin_check['pincode'];
		$_SESSION['resultpincodebeforetell'] = $check_pincode_avalable;
		$query_dublicated = "SELECT pincodeuse FROM pinuse WHERE tell = '$tell'";
		$sendtomysql = mysql_query($query_dublicated);
		$resdubltell = mysql_fetch_assoc($sendtomysql);
		$show_pin_dublicated_tell = $resdubltell['pincodeuse'];
		
		if(empty($check_pincode_avalable) && empty($show_pin_dublicated_tell)){
			echo('پین در دیتابیس موجود نیست لطفا اطلاع دهید');
			}elseif(mysql_errno() == 1062 ){
			$this->DublicatedTell();
		}
		else{
			$tell = $_REQUEST['tellpincode'];
			$pincode = $_SESSION['resultpincodebeforetell'];
			$userlogin = $_SESSION['usernameloginportal'];
		$ins_tell = "INSERT INTO pinuse (pincodeuse, userid, tell, editorid) VALUES ('$pincode', '$userlogin', '$tell', '$userlogin')";
		$saved = mysql_query($ins_tell);
		return ($saved);
		}
	}//End Submit Tell
	
	function DublicatedTell(){
		if(mysql_errno() == 1062){
			$tell = $_SESSION['tell'];
			$query_dublicated = "SELECT pinuse.pincodeuse FROM pinuse WHERE pinuse.tell = '$tell'";
			$sendtomysql = mysql_query($query_dublicated);
			$resdubltell = mysql_fetch_assoc($sendtomysql);
			$show_pin_dublicated_tell = $resdubltell['pincodeuse'];
			echo('<div name="showpindublicated" align="center" dir="rtl">');
			echo('شماره تلفن تکراری است و شماره پین :'. $show_pin_dublicated_tell );
			echo('</div>');
		
		}
	}//End Dublicated Tell
	
	function DeactivePincode($deactivepincode){
		$query_update_active = " UPDATE pincode SET active='0' WHERE pincode='$deactivepincode' ";
		$query_ins = mysql_query($query_update_active);
		if($query_ins){
			echo('پین کد اعلام شده غیرفعال شد');
		}
	}
	
	

}//End Class ConnectDb









?>