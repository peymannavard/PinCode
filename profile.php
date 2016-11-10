<?php
if(empty($_SESSION['usernameloginportal'])){
	
	echo('باید به سیستم وارد شوید');
	exit();
}
?>
<!-- Code Start Profile Form -->
<div class="profile" align="center">
<form method="post" accept-charset="utf-8" >
<table class="tableprofile" align="center">
<tr><td>
نام کاربری :
</td><td>
<input type="text" id="username-profile" name="username-profile" value="<?php if($_SESSION['usernameloginportal']){ echo($_SESSION['usernameloginportal']);}   ?>" readonly>
</td></tr>


<tr><td>
پسورد :
</td><td>
<input type="password" id="password-profile" name="password-profile">
</td></tr>


<tr><td>
تایید پسورد :
</td><td>
<input type="password" id="password-profile-confirm" name="password-profile-confirm">
</td></tr>


<tr><td>
نام و نام خانوادگی :
</td><td>
<input type="text" id="firstname-lastname" name="firstname-lastname" value="پیمان نوردیچیان" readonly>
</td></tr>

<tr><td>
کد پرسنلی :
</td><td>
<input type="text" id="personeli-code" name="personeli-code" value="9408030" readonly>
</td></tr>


<tr>
    <td>
        <input type="submit" id="submit-profile" name="submit-profile" value="ذخیره">
    </td>
    <td>
       <a href="index.php?ID=pincode" id="buttomback" name="buttomback">
        <input type="button" id="reset-profile" name="reset-profile" value="بازگشت">
		</a>
    </td>



</tr>

</table>
</form>
</div>
<!-- Code End Profile Form -->
