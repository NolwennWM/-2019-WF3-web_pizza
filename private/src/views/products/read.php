<?php 
    include_once "../private/src/views/layout/header.php";
?>
<div class="container">
    <h1><?= $pageTitle ?></h1>
    <div class="row">
        <?php 
                if($results): 
                    foreach($results as $article): ?>
                    <div class="col-6 article">
                    <h3><?= $article['name'] ?></h3>
                    <img src="./assets/images/<?= $article['illustration'] ?>" alt="produit">
                    <br><?= $article['price'] ?> &euro; <br>
                    
                    <?php if(isset($_SESSION["user"]) && $_SESSION['user']['fullname']== 'Admin ADMIN'): ?>
                    <a href="<?= url("update")."?id=".$article['id']; ?>">Modifier</a> /
                    <a href="<?= url("delete")."?id=".$article['id']; ?>">Supprimer</a>
                    <?php endif; ?>
                    <a href="<?= url("add")."?id=".$article['id']; ?>" class="btn btn-success btn-block">Ajouter au Panier</a>
                    </div>
                <?php 
                    endforeach; 
                    else: 
                ?>
                <div class="col-12">Aucune pizza dans la base de donnée</div>
        <?php endif; ?>
    </div>
</div>
<?php 
    include_once "../private/src/views/layout/footer.php";
?>