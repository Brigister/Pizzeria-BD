<?php
if (isset($_GET["search"]) && $_GET["search"] != "") {
    $pizze = getPizzeLike($_GET["search"]);
} else {
    $pizze = getAllPizze();
}
if ($isAdmin) {
    ?>
    <form method="POST" action="/pizzeria/editPizza.php" class="style" style="margin-top:1em;">     
        <input type="text" name="nome" />
        <input type="hidden" name="action" value="createPizza"/>
        <button type="submit">Aggiungi Pizza</button>
    </form>
    <?php
}
?>
<h2>Catalogo Pizze</h2>
<ul class="catalogoPizze">
<?php
foreach ($pizze as $pizza) {
    ?>
    <li>
        <div class="left">
        <h3><?php echo $pizza->getNome() ?></h3>
        <ul>
            <?php
            foreach ($pizza->getIngredienti() as $ingrediente) {
                ?>
                <li><?php echo $ingrediente->getNome() ?></li>
                <?php
            }
            ?>
        </ul>
        </div>
        <div class="right">
        <span class="prezzo"><?php echo $pizza->getPrezzo() ?>€</span>
        <?php
        if ($isLogged) {?>
        <form method="GET" action="/pizzeria/carrello.php">
            <input type="number" min="1" value="1" name="qnt" class="qnt"/>
            <input type="hidden" name="idPizza" value="<?php echo $pizza->getIdPizza() ?>"/>
            <button name="action" type="submit" value="newOrder"><i class="fas fa-cart-plus"></i></button>
        </form>
        <?php } ?>
        <?php
        if ($isAdmin) {?>
            <form method="POST" action="/pizzeria/editPizza.php" class="style">
                <input type="hidden" name="idPizza" value="<?php echo $pizza->getIdPizza() ?>"/>
                <button name="action" type="submit" value="dropPizza">Elimina</button>
                <button name="action" type="submit" value="editPizza" >Modifica</button>
            </form>
            <?php } ?>
        </div>
    </li>
    <?php
}
    ?>
</ul>
<?php