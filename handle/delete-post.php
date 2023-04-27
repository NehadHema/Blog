<?php
require_once('../inc/connection.php');
if(!isset($_SESSION['user_id'])){
    header("location:../login.php");
}
if(!empty($_GET['id'])){
    $id = $_GET['id'];
    $query="select * from posts where id=$id";
    $result=mysqli_query($conn,$query);

if(mysqli_num_rows($result)==1){
$post = mysqli_fetch_assoc($result);
$oldImage= $post['image'];
unlink("../uploads/$oldImage");

$query= "delete from posts where id =$id";
$runQuery= mysqli_query($conn,$query);
   if($runQuery){
    $_SESSION['success']="post deleted successfully";
    header("location:../index.php");
    }else{
      $_SESSION['errors']=["error while delete"];
      header("location:../index.php");
    }
}else{
    $_SESSION['errors']=["post not found"];
    header("../index.php");
}
}else{
    header("location:../index.php");
}
