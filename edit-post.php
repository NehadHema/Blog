<?php require_once('inc/header.php'); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/navbar.php'); ?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3><?php echo $msg['Edit post'];?></h3>
                </div>
                <div>
                    <a href="index.php" class="text-decoration-none"><?php echo $msg['Back'];?></a>
                </div>
            </div>
            <?php require_once('inc/errors.php');?>
            
            <form method="POST" action="handle/update-post.php?id=<?php echo $_GET['id']?>" enctype="multipart/form-data">
            <?php
            if(!isset($_SESSION['user_id'])){
                header("location:login.php");
            }
            if(isset($_GET['id'])){
                $id= $_GET['id'];
                $query="select * from posts where id=$id";
                $runQuery=mysqli_query($conn,$query);
                if(mysqli_num_rows($runQuery)==1){
                    $post = mysqli_fetch_assoc($runQuery);
                    $title=$post['title'];
                    $body=$post['body'];
                    $image=$post['image'];
                }else{
                    $_SESSION['errors']=["post not found"];
                }
            }else{
                header("location:index.php");
            }
            ?>
            <input type="hidden"  name="id" value="<?php echo $id?>">
                <div class="mb-3">
                    <label for="title" class="form-label"><?php echo $msg['Title'];?></label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $title?>">
                </div>

                <div class="mb-3">
                    <label for="body" class="form-label"><?php echo $msg['Body'];?></label>
                    <textarea class="form-control" id="body" name="body" rows="5"><?php echo $body ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label"><?php echo $msg['image'];?></label>
                    <input type="file" class="form-control-file" id="image" name="image" ><?php echo $image ?>
                </div>
                <img src="uploads/<?php echo $image;?>" alt="" srcset="" class="w-25">
                <button type="submit" class="btn btn-primary" name="submit"><?php echo $msg['Submit'];?></button>
            </form>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>