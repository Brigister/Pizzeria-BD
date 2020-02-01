<?php
if (isset($_GET["action"]) && $_GET["action"] == "newOrder") {
    if (!isset($_SESSION["ordine"])) {
        $_SESSION["ordine"] = array();
        $key = null;
    } else {
        $key = array_search($_GET["idPizza"], array_column($_SESSION["ordine"], 'id'));
    }
    
    if (is_null($key) || $key===false) {
        array_push($_SESSION["ordine"], array("id" => $_GET["idPizza"], "pizza" => Pizza::withID($_GET["idPizza"]), "qnt" => $_GET["qnt"]));
    } else {
        $_SESSION["ordine"][$key]["qnt"] += $_GET["qnt"];
    }
} elseif (isset($_GET["action"]) && $_GET["action"] == "delOrder") {
    if (isset($_SESSION["ordine"])) {
        $key = array_search($_GET["idPizza"], array_column($_SESSION["ordine"], 'id'));
        unset($_SESSION["ordine"][$key]);
        $_SESSION["ordine"] = array_values($_SESSION["ordine"]);
        if (empty($_SESSION["ordine"])) {
            unset($_SESSION["ordine"]);
        }
    }
} elseif (isset($_GET["action"]) && $_GET["action"] == "clearCarrello") {
    unset($_SESSION["ordine"]);
}

if (isset($_SESSION["ordine"])) {
    $ordinazione = $_SESSION["ordine"];
    ?>
<div class="carrello">
    <form method="GET" action="#" class="style">                      
        <input type="hidden" name="action" value="clearCarrello" />
        <button type="submit">Svuota Carrello <i class="fas fa-trash"></i></button>
    </form>
    <table class="carrelloTable">
        <tr>
            <th>Nome</th>
            <th>Qnt</th>
            <th>Totale</th>
            <th>Op.</th>
        </tr>
        <?php
        foreach ($ordinazione as $riga) {
            ?>
            <tr>
                <td><?php echo $riga["pizza"]->getNome() ?></td>
                <td><?php echo $riga["qnt"] ?></td>
                <td><?php echo $riga["qnt"] * $riga["pizza"]->getPrezzo() ?></td>
                <td>
                    <form method="GET" action="#">                      
                        <input type="hidden" name="idPizza" value="<?php echo $riga["pizza"]->getIdPizza() ?>" />
                        <input type="hidden" name="action" value="delOrder" />
                        <button type="submit">Remove</button>
                    </form>
                </td>
            </tr>
            <?php
        }

        $totale = 0;
        foreach ($ordinazione as $riga) {
            $totale += $riga["qnt"] * $riga["pizza"]->getPrezzo();
        }
        ?>
        <tr>
            <td style="text-align:right">Totale: <?php echo $totale ?>€</td>
        </tr>
    </table>

    <form method="POST" action="editOrder.php" class="style">
        <div>
            <label>Indirizzo</label>
            <input type="text" name="indirizzo"/>
        </div>
        <div>
            <label>Giorno preferito</label>
            <input type="text" name="giorno"/>
        </div>
        <div>
            <label>Orario preferito</label>
            <input type="text" name="ora"/>
        </div>
        <input type="hidden" name="action" value="createOrder" />
        <button type="submit">Acquista</button>
    </form>
    <?php
} else {
    ?>
    Il carrello è vuoto
    <?php
}
?>
</div>