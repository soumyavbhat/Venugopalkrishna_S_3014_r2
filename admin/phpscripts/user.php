<?php

function createUser($fname,$username, $email, $lvllist)
{
  include('connect.php');

// SHUFFLE AND GET RANDOM CHAR FOR PASSWORD
  $password_string = '_%#&*-abcdefghijklmnpqrstuwxyzABCDEFGHJKLMNPQRSTUWXYZ1234567890';
$password = substr(str_shuffle($password_string), 0, 8);
// echo $password;

// HASHING PASSWORD 
$enc_method = 'AES-128-CTR';
$enc_key = openssl_digest(gethostname() . "|" . $_SERVER['SERVER_ADDR'], 'SHA256', true);
$enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($enc_method));
$crypted_password = openssl_encrypt($password, $enc_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
// $crypted_password = password_hash($password, PASSWORD_DEFAULT);


  $userstring = "INSERT INTO tbl_user VALUES(NULL, '{$fname}', '{$username}', '{$email}','{$crypted_password}', NULL, '{$lvllist}', 'no','0')";
$userquery = mysqli_query($link, $userstring );
echo $userstring;

if($userquery){
  // return $password;
  $direct = "success.php";
  $sendMail = submitMessage($direct, $username, $email, $password);
}
else {
  $message = "Error";
  return $message;
}
  mysqli_close($link);
}
 ?>
