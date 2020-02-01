<?php
$pizza = Pizza::withID($_GET["idPizza"]);
$ingredientiPizza = $pizza->getIngredienti();
$ingredienti = getAllIngredienti();
if ($ingredienti) {
    ?>
  <h3>Ingredienti disponibili all'aggiunta</h3>
    <table>
        <tr>
            <th>Nome</th>
            <th>Op.</th>
        </tr>
        <?php
        foreach ($ingredienti as $ingrediente) {
            $next = false;
            foreach ($ingredientiPizza as $ingredientePizza) {
                if ($ingrediente->getIdIngrediente() == $ingredientePizza->getIdIngrediente()) {
                    $next = true;
                    break;
                }
            }
            if ($next)
                continue;
            ?>
            <tr>
                <td><?php echo $ingrediente->getNome() ?></td>
                <td>
                    <form method="POST" action="/pizzeria/editPizza.php"> 
                        <input type="hidden" name="idIngrediente" value="<?php echo $ingrediente->getIdIngrediente() ?>" />
                        <input type="hidden" name="idPizza" value="<?php echo $pizza->getIdPizza() ?>" />
                        <input type="number" name="qnt"/>
                        <button name="action" value="addIngredientePizza" type="submit">Aggiungi</button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} else {
    ?>
    Non ci sono ingredienti
    <?php
}
?>

    <h3>Ingredienti della pizza</h3>
<table>
    <tr>
        <th>Nome</th>
        <th>Qnt</th>
        <th>Op.</th>
    </tr>
    <?php
    foreach ($ingredientiPizza as $ingrediente) {
        ?>
        <tr>
            <td><?php echo $ingrediente->getNome() ?></td>
            <td><?php echo $ingrediente->getQuantita() ?></td>
            <td>
                <form method="POST" action="/pizzeria/editPizza.php"> 
                    <input type="hidden" name="idIngrediente" value="<?php echo $ingrediente->getIdIngrediente() ?>" />
                    <input type="hidden" name="idPizza" value="<?php echo $pizza->getIdPizza() ?>" />
                    <button name="action" value="dropIngredientePizza" type="submit">Elimina</button>
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<form method="POST" action="/pizzeria/editPizza.php" class="style">
    <label>Prezzo Pizza</label>
    <input type="hidden" name="idPizza" value="<?php echo $pizza->getIdPizza() ?>" />
    <input type="text" name="prezzo" value="<?php echo $pizza->getPrezzo() ?>" />
    <button name="action" value="editPrezzo" type="submit">Aggiorna</button>
</form>