
<form method="post" class="crud-form">
    <div>
        <label for="name">Nom du produit</label><br>
        <input class="form-control" type="text" name="name" id="name" placeholder="Titre de l'article" value='<?= $name ?>'>
    </div>
    <div>
        <label for="description">Description du produit</label><br>
        <textarea  class="form-control" name="description" id="description" cols="30" rows="10"><?= $description ?></textarea>
    </div>
    <div>
        <label for="illustration">Illustration</label><br>
        <input  class="form-control" type="text" name="illustration" id="illustration" value='<?= $illustration ?>'>
    </div>
    <div>
        <label for="price">prix</label><br>
        <input  class="form-control" type="number" name="price" id="price" step="0.01"value='<?= $price ?>'>
    </div>
    <div class="form-group">
        <label for="type">Catégorie de l'article</label><br>
        <select name="type" id="type">
            <?php foreach(getEnumData('products', "type") as $typeOp): ?>
            <option value="<?= $typeOp; ?>" <?= ($typeOp == $type? "selected": null); ?> >
                <?= $typeOp ?>
            </option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="ingredients">ingrédients</label><br>
        <select name="ingredients[]" id="ingredients" multiple>
            <?php foreach(getIngredients() as $ingre): ?>
            <option value="<?= $ingre['id']; ?>" <?= (in_array($ingre['name'], $ingredients)? "selected": null); ?> >
                <?= $ingre['name'] ?>
            </option>
            <?php endforeach; ?>
        </select>
        <button>Valider</button>
    </div>
</form>
