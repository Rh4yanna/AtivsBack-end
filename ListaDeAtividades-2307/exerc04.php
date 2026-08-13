<?php
echo "<h2>Números Pares de 1 até 100:</h2>";

for ($i = 1; $i <= 100; $i++) {
    if ($i % 2 == 0) {
        echo $i . " ";
    }
}
?>