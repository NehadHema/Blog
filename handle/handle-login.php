<?php 
require_once('../inc/connection.php');

if(isset($_POST['submit'])){
    
$email= trim(htmlspecialchars($_POST['email']));
$password= trim(htmlspecialchars($_POST['password']));

$errors=[];
if(empty($email)){
    $errors[]="email is required";
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors[]="email is not correct";
}else if(is_numeric($email)){
    $errors[]="email must be string";
}

if(empty($password)){
    $errors[]="password is required";
}else if(strlen($password)<5){
    $errors[]="password must be more than 5 chars";
}

if(empty($errors)){
$query="select * from users where email='$email'";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)==1){
 $user=mysqli_fetch_assoc($result);
 $oldpassword=$user['password'];
 $is_valid=password_verify($password,$oldpassword);
 if($is_valid){
    $_SESSION['user_id']=$user['id'];
    $_SESSION['name']=$user['name'];
    $_SESSION['success']="welcome "."".$_SESSION['name'];
    header("location:../index.php");
 }else{
    $_SESSION['errors']=["credintials not correct"];
    header("location:../login.php");
 }
}else{
    $_SESSION['errors']=["This account not exist"];
    header("location:../login.php");
}
}else{
    $_SESSION['errors']=$errors;
    header("location:../login.php");
}
}else{
    header("location:../login.php");
}