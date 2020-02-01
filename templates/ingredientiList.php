<?php
$ingredienti = getAllIngredienti();
if ($ingredienti) {
    ?>
    <table>
        <tr>
            <th>Nome</th>
            <th>Qnt</th>
            <th>Op.</th>
        </tr>
        <tr>
            <td colspan = "3">
                
                <form method="POST" action="/pizzeria/editIngrediente.php" class="style"> 
                    <label>Nuovo ingrediente</label>
                    <input type="text" name="nome"/>
                    <button name="action" value="createIngrediente" type="submit">Aggiungi</button>
                </form>
            </td>
        </tr>
        <?php
        foreach ($ingredienti as $ingrediente) {
            ?>
            <tr>
                <td><?php echo $ingrediente->getNome() ?></td>
                <td><?php echo $ingrediente->getQuantita() ?></td>
                <td>
                    <form method="POST" action="/pizzeria/editIngrediente.php" class="style"> 
                        <input type="hidden" name="idIngrediente" value="<?php echo $ingrediente->getIdIngrediente() ?>" />
                        <input type="number" name="qnt"/>
                        <button name="action" value="refill" type="submit">Rifornisci</button>
                        <button name="action" value="dropIngrediente" type="submit">Elimina</button>
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
    Non ci sono ordini
    <?php
}