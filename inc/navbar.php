<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><?php echo $msg['Blog']?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="<?php if($lang == 'ar'): echo'navbar-nav me-auto mb-2 mb-lg-0'; else:echo'navbar-nav ms-auto mb-2 mb-lg-0 '; endif; ?>">
               <li class="nav-item">
                    <a class="nav-link" href="inc/change_lang.php?lang=en">English</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="inc/change_lang.php?lang=ar">العربية</a>
                </li>
                <?php require_once('connection.php');
                if(! isset($_SESSION['user_id'])):
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><?php echo $msg['Login']?></a>
                </li>
                <?php else:?>
                <li class="nav-item">
                    <a class="nav-link" href="handle/logout.php"><?php echo $msg['Logout'] ?></a>
                </li> 
                <?php endif;?>   
            </ul>
        </div>
    </div>
</nav>