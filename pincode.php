<?php
@$_SESSION['tell'] = $_POST['tellpincode'];

if(empty($_SESSION['usernameloginportal'])){
	
	echo('باید به سیستم وارد شوید');
    echo('آزمایش');
	exit();
}

?>

<!-- Code Start Pincode Form -->
<div class="pincodeform">
<form method="post" accept-charset="utf-8">
<table align="center" class="tablepincode">

<tr><td>
شماره تلفن :
</td><td colspan="2">
<input type="tel" id="tell-pincode" name="tellpincode" maxlength="11" value="<?php print(@$_SESSION['tell']);  ?>">
</td></tr>

<?php if(isset($_POST['pincodeget']) && !empty($_POST['tellpincode'])) { 
	$tell = $_POST['tellpincode'];
	$res_tell = $main->SubmitTell($tell);
	if($res_tell){
	$showpin=$main->getpincode();
	$_SESSION['showpin'] = $showpin;
		}elseif(mysql_error()){
		$main->DublicatedTell();
	}
	
	if(!empty($showpin)){ ?> <!--Start if show pincode-->

<tr><td>
پین کد :
</td><td colspan='2'>
<input type='text' id='pincode-pincode' name='pincodepincode' value='<?php echo($showpin);  ?>' readonly>
</td></tr>
<?php  
} 
	
}//End If Show Code Pin ?>
    <tr>
       
       <?php if(!empty(@$showpin)){  ?>
        <td>
            <input type='submit' id='pincode-false' name='pincodefalse' value='پین کد خراب'>
        </td>
        <?php  }//End If ShowPin ?>
        <td>
            <input type="submit" id="pincode-get" name="pincodeget" value="دریافت پین">
        </td>
        
        <?php if(!empty(@$showpin)){ ?>
        <td>
            <input type="button" id="back-pincode" name="backpincode" value="آزادسازی پین">
        </td>
        <?php   }//End If ShowPin  ?>
   </tr>

</table>
</form>
</div>
<!-- Code End Pincode Form -->
