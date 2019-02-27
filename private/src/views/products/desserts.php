<?php 
    include_once "../private/src/views/layout/header.php";
?>
<div class="container">
    <div class="row">
        <?php 
                if($results): 
                    foreach($results as $article): ?>
                    <div class="col-6 article">
                    <h3><?= $article['name'] ?></h3>
                    <img src="./assets/images/<?= $article['illustration'] ?>" alt="dessert">
                    <br><?= $article['price'] ?> &euro; <br>
                    
                    <?php if(isset($_SESSION["user"]) && $_SESSION['user']['fullname']== 'Admin ADMIN'): ?>
                    <a href="<?= url("update")."?id=".$article['id']; ?>">Modifier</a> /
                    <a href="<?= url("delete")."?id=".$article['id']; ?>">Supprimer</a> 
                    <?php endif; ?>
                    </div>
                <?php 
                    endforeach; 
                    else: 
                ?>
                <div class="col-12">Aucun dessert dans la base de donnée</div>
        <?php endif; ?>
    </div>
</div>
<?php 
    include_once "../private/src/views/layout/footer.php";
?>