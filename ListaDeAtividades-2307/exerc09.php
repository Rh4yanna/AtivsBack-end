<?php
$papagaios = ["Papagaio-verdadeiro", "Papagaio-chauá", "Papagaio-moleiro"];
$papagaios[] = "Papagaio-cinzento";

echo "<h2>Raças de Papagaio</h2>";
foreach ($papagaios as $raca) {
    echo "- $raca <br>";
}
?>