<?php
session_start();
require_once '../connect/connect.php';

$name =trim($_POST['log-upUserName']);
$lastName =trim($_POST['log-upUserLastname']);
$email=trim($_POST['log-upEmail']);
$address =trim($_POST['log-upUserAddress']);
$telethone=trim($_POST['log-upUserTelephone']);
$password=trim($_POST['log-upPassword']);
$password_confirm=trim($_POST['Confirmlog-upPassword']);
$passwordCheck = md5($password.'rty5rtyuyt');
$check_user=mysqli_query($connect,"SELECT * FROM `user` WHERE `email`='$email' and `password`='$passwordCheck'");

   if (mysqli_num_rows($check_user) === 1 ){

	$_SESSION['error_message']='Пользователь с таким email уже существует';
  header('Location:../../../../includes/sign-in-up.php');

	} else
	{

		if ($password === $password_confirm)   {
    
    $password = md5($password.'rty5rtyuyt');
mysqli_query($connect,"INSERT INTO `user` ( `name`, `lastName`, `email`, `address`, `telephone`, `password`) VALUES ('$name','$lastName', 
 '$email','$address','$telethone','$password')");
    $_SESSION['regSuccess_message']='Успешная регистрация';
      header('Location:../../../../includes/sign-in-up.php');
  
    	

} else{
	$_SESSION['regError_message']='Пароли не совпадают';
     header('Location:../../../../includes/sign-in-up.php');
	
}
	}
   $connect->close();
?>
