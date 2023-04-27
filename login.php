<?php require_once('inc/header.php'); ?>
<?php require_once('inc/connection.php');?>
<?php require_once('inc/navbar.php'); ?>

<div class="container-fluid pt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="d-flex justify-content-between border-bottom mb-5">
                <div>
                    <h3><?php echo $msg['Login'];?></h3>
                </div>
              
            </div>
            <form method="POST" action="handle/handle-login.php">
              <?php require_once('inc/errors.php');?>
                <div class="mb-3">
                    <label for="email" class="form-label"><?php echo $msg['Email'];?></label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
    
                <div class="mb-3">
                    <label for="password" class="form-label"><?php echo $msg['Password'];?></label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                
                <button type="submit" class="btn btn-primary" name="submit"><?php echo $msg['Login'];?></button>
            </form>
        </div>
    </div>
</div>

<?php require('inc/footer.php'); ?>