<?php 
    include_once "../private/src/views/layout/header.php";
?>
<h1>Votre Panier</h1>
    <div class="container">
        <?php if(!empty($orderlist)): ?>
        <div class="row order">
            <form method="post">
                <div class="col-12 article">
                    <table>
                        <thead>
                            <tr>
                                <th>Produits</th>
                                <th>Quantité</th>
                                <th>Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orderlist as $item): ?>
                            <tr>
                                <td><?= $listproduct[$item['id_product']][0] ?></td>
                                <td><input type="number" name="quantity" id="quantity" value="<?= $item['qty'] ?>"></td>
                                <td><?= $item['amount'] ?>&euro;</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <td>Total :</td>
                            <td> <?= $total ?> </td>
                            <td> <?= empty($order)? '0' :$order['amount']; ?> &euro; </td>
                        </tfoot>
                    </table>
                </div>
                <div class="row">
                    <div class="col4">
                        <a href="<?= url("delete") ?>" class="btn btn-success btn-block">Commander(sup)</a>
                    </div>
                    <div class="col4">
                        <button class="btn btn-success btn-block">Mettre à jour</button>
                    </div>
                    <div class="col4">
                        <a href="<?= url("cancel") ?>" class="btn btn-success btn-block">Annuler</a>
                    </div>
                 </div>
            </form>
        </div>
    <?php else: ?>
    <div class="article">Aucun article dans votre panier.</div>
    <?php endif; ?>
    </div>
<?php 
    include_once "../private/src/views/layout/footer.php";
?>