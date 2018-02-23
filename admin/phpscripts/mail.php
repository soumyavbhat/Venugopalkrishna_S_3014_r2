<?php

// soumyav-com.mail.protection.outlook.com
  // echo "From mail file";

  function submitMessage($direct, $username, $email, $password){
    $to = $email;
    $subject = "User login - Do not reply";
    $msg = "Username: ".$username."\n\nEmail: ".$email."\n\nPassword: ".$password; 
    mail($to,$subject,$msg);
    $direct = $direct."?name={$username}";
    redirect_to($direct);
  }

 ?>
