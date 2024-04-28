<?php 
use MVC\core\Application;

$guest = Application::isGuest();
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="/public/css/bootstrap.css">
    <title><?php echo $this->title ?></title>
</head>


<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary"> 
    <a class="navbar-brand" href="/">Forum™ (Since 2024)</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link <?=$_SERVER['REQUEST_URI'] == '/' ? 'active' : ''?>" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if(!$guest): ?>
                <li class="nav-item">
                    <a class="nav-link <?=$_SERVER['REQUEST_URI'] == '/thread' ? 'active' : ''?>" href="/thread">Create A Thread</a>
                </li>
            <?php endif ?>
            <li class="nav-item">
                <a class="nav-link <?=$_SERVER['REQUEST_URI'] == '/module' ? 'active' : ''?>" href="/module">Module</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=str_contains($_SERVER['REQUEST_URI'], '/threads') ? 'active' : ''?>" href="/threads">Threads</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=str_contains($_SERVER['REQUEST_URI'], '/contact') ? 'active' : ''?>" href="/contact">Contact</a>
            </li>
        </ul> 
        <?php
        // display Login and Register if guest, display Profile and Logout if user
        if ($guest): ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="btn btn-outline-light" href="/login">Login</a>
                </li>

                <li class="nav-item active">
                    <a class="btn btn-outline-light ml-3" href="/register">Register</a>
                </li>
            </ul>
            <?php else: ?>
            <ul class="navbar-nav ml-auto">
                <?php $user = Application::$app->user ?>
                <?php if($user->is_admin == 1): ?>
                    <li class="nav-item active">
                        <a class="btn btn-outline-light" href="/admin">
                            Admin
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item active">
                        <a class="btn btn-outline-light" href="/profile">
                            Profile
                        </a>
                    </li>
                <?php endif ?>
                <li class="nav-item active">
                    <a class="btn btn-outline-light ml-3" href="/logout">
                        Welcome <?php echo Application::$app->user->getDisplayName() //Display username?> (Logout)
                    </a>
                </li>
            </ul>
        <?php endif; ?>
    </div>
</nav>


<!-- Display main contents if logined -->
<div class="container">
    <?php if (Application::$app->session->getFlash('success')): ?>
        <div class="alert alert-success">
            <p><?php echo Application::$app->session->getFlash('success') ?></p>
        </div>
    <?php endif; ?>
    <br>
    {{content}}
</div>
<br>
<!-- Footer contents -->
<div>
    <footer class="bg-primary text-center text-white">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2024 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    </footer>
</div>


<!-- Bootstrap js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
</body>
</html>