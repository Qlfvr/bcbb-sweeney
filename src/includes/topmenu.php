<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a href="/" class="navbar-brand">Sweeney</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar7">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse justify-content-stretch" id="navbar7">

        <?php

    if (empty($_SESSION)): ?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link btn btn-outline-secondary" href="#">Sign Up</a>
            </li>

            &nbsp;

            <li class="nav-item">
                <a class="nav-link btn btn-primary text-white" href="#">Sign In</a>
            </li>
        </ul>
        <?php
        else : ?>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a href="#" class="nav-link"><?php echo $_SESSION["nickname"]; ?></a> <!-- replace # by profil link -->
            </li>
            <li class="nav-item">
                <a href="signout.php" class="nav-link">Sign Out</a> <!-- replace # by profil link -->
            </li>
        </ul>
        <?php endif;?>





    </div>
</nav>