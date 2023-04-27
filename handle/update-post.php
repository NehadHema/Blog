<?php
require_once('../inc/connection.php');
if(!isset($_SESSION['user_id'])){
    header("location:../login.php");
}
// submit
if (isset($_POST['submit'])) {
    if(isset($_GET['id'])){
        $id= $_GET['id'];
        // catch
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
    // validation
    
    $errors=[];

    if(empty($title)){
        $errors[]= "title is required";
    }else if(strlen($title)<5){
        $errors[]="title must be more than 5 chars";
    }else if(is_numeric($title)){
        $errors[]="title must be string";
    }

    if(empty($body)){
        $errors[]= "body is required";
    }else if(strlen($body)<5){
        $errors[]="body must be more than 5 chars";
    }else if(is_numeric($body)){
        $errors[]="body must be string";
    }

    
    $arr=["jpg","jpeg","png"];
    if($error != 0){
        $errors[]="choose correct image";
       }else if($size>1){
        $errors[]="image large size";
       }elseif (! in_array($ext,$arr)) {
        $errors[]="image not correct";
       }
   $newName= uniqid().time().".".$ext;
   $query="select * from posts where id=$id";
   $result=mysqli_query($conn,$query);

if(mysqli_num_rows($result)==1){
   // fetch -> image optional , old
   $post = mysqli_fetch_assoc($result);
   $oldImage= $post['image'];
   if (isset($_FILES['image']['name'])) {
       $image=$_FILES['image'];
       $imageName=$_FILES['image']['name'];
       $temp = $_FILES['image']['tmp_name'];
       $ext=pathinfo($imageName,PATHINFO_EXTENSION);
       $newName=uniqid().".".$ext;
       }else{
           $newName= $oldImage;
       }
    }else{
        $_SESSION['errors']=["post not found"];
        header("../index.php");
    
    }
// query
    if(empty($errors)){
        
       $query ="update posts set `title`= '$title',`body` ='$body',`image`='$newName' where id=$_GET[id]";
       $runQuery = mysqli_query($conn,$query);
       if($runQuery){
        if (!empty($_FILES['image']['name'])) {
            unlink("../uploads/$oldImage");
            move_uploaded_file($temp,"../uploads/$newName");
           }
           $_SESSION['success']="post updated successfully";

           header("location:../show-post.php");
        }else{
        $_SESSION['errors']= ["error"] ;
        $_SESSION['title']=$title;
        $_SESSION['body']=$body;
        header("location:../edit-post.php");
       }
    
       
    }else{
        $_SESSION['errors']=$errors;
        $_SESSION['title']=$title;
        $_SESSION['body']=$body;
        header("location:../edit-post.php");
    }

    }else{
        header("location:../index.php");
    }
}else{
    header("location:../index.php");
}