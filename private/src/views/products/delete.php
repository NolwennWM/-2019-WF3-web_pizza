<?php 
    include_once "../private/src/views/layout/header.php";
?>
<h1>Suppression d'un article</h1>
    <?php if($article == false): ?>
    <div>Aucun article</div>
    <?php else: ?>
<div class="container">
    <div class="row">
        <div class="col-12 article">
            <h3><?= $article['name'] ?></h3>
            <img src="./assets/images/<?= $article['illustration'] ?>" alt="pizza">
            <br><?= $article['price'] ?> &euro; <br>
            <div><?= $article['description'] ?></div>

            <div>Confirmer la suppression de l'article :</div>
            <form method="post">
                <button type='button' onclick="window.location.href='/'">Non</button>
                <button type='submit'>Oui</button>
            </form>
        </div>  
    </div>
</div>
    <?php endif; ?>
<?php 
    include_once "../private/src/views/layout/footer.php";
?>