<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web Pizza !</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>

<body>

    <!-- Main Header -->
    <header id="main-header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">

                <a class="navbar-brand" href="/">
                    <img src="assets/images/logo.png" alt="Web Pizza">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto ml-auto">
                        <li class="nav-item">
                            <a class="nav-link <?= ($GLOBALS['route_active']== "pizzas" ? 'active' : '') ?>" href="<?= url("pizzas"); ?>">Pizzas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($GLOBALS['route_active']== "salads" ? 'active' : '') ?>" href="<?= url("salads"); ?>">Salades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($GLOBALS['route_active']== "desserts" ? 'active' : '') ?>" href="<?= url("desserts"); ?>">Desserts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($GLOBALS['route_active']== "drinks" ? 'active' : '') ?>" href="<?= url("drinks"); ?>">Boissons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($GLOBALS['route_active']== "menus" ? 'active' : '') ?>" href="<?= url("menus"); ?>">Menus</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <?php if(isset($_SESSION["user"]) && !empty($_SESSION['user'])): ?>
                            <a class="nav-link dropdown-toggle <?= ($GLOBALS['route_active']== "account" ? 'active' : '') ?>" href="#" id="navbarDropdown" role="button" 
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['user']['fullname'] ?></a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= url("account"); ?>">Mon Compte</a>
                                <a class="dropdown-item" href="<?= url("logout"); ?>">Deconnexion</a>
                                <?php if(isset($_SESSION["user"]) && $_SESSION['user']['email']== 'admin@admin.admin'): ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= url("create"); ?>">Ajouter</a>
                                <!-- <a class="dropdown-item" href="<?= url("update"); ?>">Modifier</a> -->
                                <!-- <a class="dropdown-item" href="<?= url("delete"); ?>">Supprimer</a> -->
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <a class="nav-link <?= ($GLOBALS['route_active']== "account" ? 'active' : '') ?>" href="<?= url("login"); ?>">Connexion</a>
                        <?php endif; ?> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link cart <?= ($GLOBALS['route_active']== "order" ? 'active' : '') ?>" href="<?= url("order"); ?>">Panier</a>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>
    <!-- end #main-header -->
    <?php
        if(hasFlashbag()):
            $flash = getFlashbag();
    ?>
        <div class="alert alert-<?= $flash["state"]; ?>"><?= $flash["message"]; ?></div>
    <?php 
        endif;
    ?>
    
    <!-- Main Content -->
    <div id="main-content">