<?php 
    include_once "../private/src/views/layout/header.php";
?>
<h1>Inscription</h1>
<form method="post" class="container" novalidate>
    <div class="row">
        <div class="col-4 offset-4">
            <div class="form-group">
                <input class="form-control" type="text" name="firstname" placeholder="Votre Prénom" value="<?= $firstname ?>">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="lastname" placeholder="Votre Nom" value="<?= $lastname ?>">
            </div>
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Votre adresse email" value="<?= $email ?>">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Votre nouveau mot de passe">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password_check" placeholder="confirmez mot de passe">
            </div>
            <button class="btn btn-success btn-block">Valider</button>
            <a href="/connexion">J'ai déjà un compte.</a>
        </div>
    </div>
</form>

<?php 
    include_once "../private/src/views/layout/footer.php";
?>