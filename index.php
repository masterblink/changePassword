<?php
function changePassword($oldPassword,$newPassword,$newPasswordCnf){
  global $message;
  global $message_css;
 
  $link= mysql_connect ("localhost","root","mysql")or die("Could not connect: ".mysql_error());
mysql_select_db("usuarios") or die(mysql_error());
  
  $sql = "select * from usuario where idusuario = 1";
  $exe = mysql_query($sql,$link);
  $rows = mysql_fetch_array($exe);
  if(mysql_num_rows($exe) > 0){
	  $userid = $rows['usuario'];
	  $fullname = $rows['nombre'];
	  $pass = $rows['password'];
	  
	  if ($oldPassword != $pass ) {
	    $message[] = "Error - You password is wrong!";
	    return false;
	  }
	  
	  if (strlen($newPassword) < 8 ) {
	    $message[] = "Error - Your password must be at least 8 characters long.";
	    return false;
	  }
	  
	  if ($newPassword != $newPasswordCnf ) {
	    $message[] = "Error - Your New passwords do not match!";
	    return false;
	  }
	  if (!preg_match('/[a-zA-Z]/', $newPassword) || !preg_match('/\d/', $newPassword)) {
	    $message[] = "Error - Your new password must be alphanumeric.";
	    return false;
	  }
	  
	  if (!preg_match("/[A-Z]/",$newPassword)) {
	    $message[] = "Error - Your new password must contain at least one uppercase letter.";
	    return false;
	  }
	  if (false === strpbrk($newPassword,'#$@')){
		$message[] = "Error - The use of special characters @ - $ - # is mandatory.";
	    return false;
	  
	  }
	  if(stristr($newPassword, $userid) !== false){ // password contains username

	    $message[] = "Error - Password should not contain user id";
	    return false;  
	  }

	  $arrayLng = count(str_split($fullname));
	  for($i=0;$i<$arrayLng;$i++){  	
	  	if(strpos(strtolower($newPassword), substr($fullname, $i, $i+1))!==false){
	  		$message[] = "Error - Password should not contain more than 2 consecutive characters of the user's full name";
	        return false;
	  	}
	  }

	  $sql = "select oldpass from lastpass where idusuario = 1 order by idlastpass desc limit 12";
  	  $exe = mysql_query($sql,$link);
  	  if(mysql_num_rows($exe) > 0){
  	  	while($lastpass = mysql_fetch_array($exe)){
	  	  	if($newPassword == $lastpass['oldpass']){
	  	  		$message[] = "Error - Your pasword must be different from the last 12 used previously";
		        return false;	
	  	  	}
	  	}
  	  }

	  $sql = "UPDATE usuario SET password='".$newPassword."' where idusuario = 1";	 

	  if( $exe = mysql_query($sql,$link)){
	  	$message_css = "yes";
	  	return true;
	  }
	} else {
		$message[] = "Error - The user does not exists";
        return false;	
	}
  
}

?>

<html>
<head></head>
<body>
<?php
  if (isset($_POST["curpass"])) {
    if(changePassword($_POST['curpass'],$_POST['newpass'],$_POST['rptpass']) === true){?>
    <div class="msg_yes"><?php
      $message[] = "Success - Your password was changed correctly!.";
     } else {
      ?><div class="msg_no"><?php
      $message[] = "Your password was not changed.";
    }
    foreach ( $message as $one ) { echo "<p>$one</p>"; }
  ?></div><?php
 } ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="passwordchange">
	<label>Current Password *</label>
	<input type="password" name="curpass" placeholder="Current Password" id="curpass" required>
	<br>
	<label>New Password *</label>
	<input type="password" name="newpass" placeholder="New Password" id="newpass" required>
	<br>
	<label>Repeat Password *</label>
	<input type="password" name="rptpass" placeholder="Repeat Password" id="rptpass" required>	
	<br>
	<button id="IngresoLog" type="submit">Save</button>
	</form>
</body>
</html>