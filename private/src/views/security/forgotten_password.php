<?php 
    include_once "../private/src/views/layout/header.php";
?>
<h1>Mot de passe oublié</h1>
<form method="post" class="container" novalidate>
        <div class="row">
            <div class="col-4 offset-4">
                <div class="form-group">
                    <input class="form-control" type="email" name="email" placeholder="Votre adresse email">
                </div>
                <button class="btn btn-success btn-block">Valider</button>
                <a href="/connexion">Je me souviens de mon mot de passe.</a>
            </div>
        </div>
    </form>
<?php 
    include_once "../private/src/views/layout/footer.php";
?>