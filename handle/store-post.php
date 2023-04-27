<?php
require_once('../inc/connection.php');
if(!isset($_SESSION['user_id'])){
  header("location:../login.php");
}
//submit , catch , validation ,image ,query,move
if(isset($_POST['submit'])){
    $title= trim(htmlspecialchars($_POST['title']));
    $body= trim(htmlspecialchars($_POST['body']));
    if(!empty($_FILES['image']['name'])){
      $image=$_FILES['image'];
      $imageName=$_FILES['image']['name'];
      $temp = $_FILES['image']['tmp_name'];
      $ext=strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
      $error = $image['error'];
      $size=$image['size']/(1024*1024);
    }else{
        $imageName="";
    }
    $errors=[];
    $arr=["jpg","png","jpeg"];

   if(is_numeric($title)){
    $errors[]="title must be string";
   }else if(strlen($title)<5){
    $errors[]="title must be more than 5 chars ";
   }elseif (empty($title)) {
    $errors[]="title is required";
   }
 
   if(is_numeric($body)){
    $errors[]="body must be string";
   }else if(strlen($body)<5){
    $errors[]="body must be more than 5 chars ";
   }elseif (empty($body)) {
    $errors[]="body is required";
   }
   
   if($error != 0){
    $errors[]="choose correct image";
   }else if($size>1){
    $errors[]="image large size";
   }elseif (! in_array($ext,$arr)) {
    $errors[]="image not correct";
   }
   $newimage= uniqid().time().".".$ext;


    if(empty($errors)){
     $query="insert into posts(`title`,`body`,`image`,`user_id`) values('$title','$body','$newimage',1)";
     $runQuery= mysqli_query($conn,$query);
     if($runQuery){
       if(!empty($_FILES['image']['name'])){
        move_uploaded_file($temp,"../uploads/$newimage");
       }
       $_SESSION['success']= "post inserted successfully" ;

        header("location:../index.php");
     }else{
       $_SESSION['errors']= ["error"] ;
       $_SESSION['title']=$title;
       $_SESSION['body']=$body;
    //    $_SESSION['image']=$newimage;
       header("location:../create-post.php");
     }

    }else{
        $_SESSION['errors']= $errors ;
        $_SESSION['title']=$title;
        $_SESSION['body']=$body;
        // $_SESSION['image']=$newimage;

        header("location:../create-post.php");
    }

}else{
    header("location:../index.php");
}