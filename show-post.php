<?php require_once('inc/header.php'); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/navbar.php'); ?>
<?php 
if(!isset($_SESSION['user_id'])){
    header("location:login.php");
}
if(isset($_GET['id'])){
$id = $_GET['id'];
$query = "select * from posts where id=$id";
$runQuery = mysqli_query($conn,$query);
if(mysqli_num_rows($runQuery)==1){
$post = mysqli_fetch_assoc($runQuery);

}else{
    $msg="post not found";
}


}else{
    header("location:index.php");
}
?>
<div class="container-fluid pt-4">
    <div class="row">
        <?php if(!empty($post)):?>
        <div class="col-md-10 offset-md-1">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3><?php echo $post['title']?></h3>
                </div>
                <div>
                    <a href="index.php" class="text-decoration-none"><?php echo $msg['Back'];?></a>
                </div>
            </div>
            <div>
                <?php echo $post['body']?>
            </div>
            <div>
               <img src="uploads/<?php echo $post['image'] ?>" alt="" srcset="" width="300px">
            </div>
        </div>
    <?php else:echo $msg;
        endif;
        ?>
    </div>
</div>

<?php require('inc/footer.php'); ?>