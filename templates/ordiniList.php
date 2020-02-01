<?php
$ordini = getOrdiniFromUserId($user->getIdUtente());
if ($ordini) {
    ?>
    <table>
        <tr>
            <th>Data</th>
            <th>Stato</th>
            <th>Pizze</th>
            <th>Op.</th>
        </tr>
        <?php
        foreach ($ordini as $ordine) {
            ?>
            <tr>
                <td><?php echo $ordine->getData() ?></td>
                <td><?php echo $ordine->getStato() ?></td>
                <td>
                    <ul>
                        <?php
                        foreach ($ordine->getPizze() as $pizza) {
                            ?>
                            <li><?php echo $pizza->getNome() ?> - <?php echo $pizza->getQuantita() ?></li>
                            <?php
                        }
                        ?>
                    </ul>
                </td>
                <td>
                    <?php
                    if($ordine->getStato()=='attesa') {
                        ?>
                        <form method="POST" action="/pizzeria/editOrder.php"> 
                            <input type="hidden" name="idOrdine" value="<?php echo $ordine->getIdOrdine() ?>" />
                            <input type="hidden" name="action" value="dropOrder" />
                            <button type="submit">Delete</button>
                        </form>
                        <?php
                    }
                    ?>
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