<?php 
    include_once "../private/src/views/layout/header.php";   
?>
<h1>Connexion</h1>
<form method="post" class="container" novalidate>
    <div class="row">
        <div class="col-4 offset-4">
            <div class="form-group">
                <input class="form-control" type="email" name="email" placeholder="Votre adresse email">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Votre mot de passe">
            </div>
            <button class="btn btn-success btn-block">Valider</button>
            <a href="/inscription">Je n'ai pas de compte.</a><br>
            <a href="/mot-de-passe-oublie">J'ai oublié mon mot de passe.</a>
        </div>
    </div>
</form>

<?php 
    include_once "../private/src/views/layout/footer.php";
?>