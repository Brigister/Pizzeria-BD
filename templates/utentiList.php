<?php
$clienti = getAllClienti();


if ($clienti) {
    ?>
    <table>
        <tr>
            <th>Email</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Op.</th>
        </tr>
        <?php
        foreach ($clienti as $cliente) {
            ?>
            <tr>
                <td><?php echo $cliente->getEmail() ?></td>
                <td><?php echo $cliente->getNome() ?></td>
                <td><?php echo $cliente->getCognome() ?></td>
                <td>
                    <form method="POST" action="/pizzeria/editUtente.php" class="style"> 
                        <input type="hidden" name="idUtente" value="<?php echo $cliente->getIdUtente() ?>" />
                        <input type="hidden" name="action" value="dropUtente" />
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>


            <?php
            $ordini = getOrdiniFromUserId($cliente->getIdUtente());
            if ($ordini) {
                ?>

                <tr>
                    <td style="text-align: center; background-color: gainsboro">Ordini</td>
                    <td colspan="3">
                        <table>
                            <tr>
                                <th>Data</th>
                                <th>Stato</th>
                                <th>Pizze</th>
                                <th>Indirizzo</th>
                                <th>Giorno</th>
                                <th>Ora</th>
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
                                    <td><?php echo $ordine->getIndirizzo() ?></td>
                                    <td><?php echo $ordine->getGiorno() ?></td>
                                    <td><?php echo $ordine->getOra() ?></td>
                                    <td>
                                        <form method="POST" action="/pizzeria/editOrder.php" class="style"> 
                                            <input type="hidden" name="idOrdine" value="<?php echo $ordine->getIdOrdine() ?>" />
                                            <!--<input type="hidden" name="action" value="dropOrder" />-->
                                            <?php if ($ordine->getStato() == 'attesa') { ?>
                                                <button name="action" value="dropOrder" type="submit">Delete</button>
                                                <button name="action" value="sendOrder" type="submit">Consegnato</button>
                                            <?php } ?>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </td>

                </tr>

                <?php
            }
        }
        ?>
    </table>
    <?php
} 