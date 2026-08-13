<?php
$numeros = [4, 7, 12879.5];

foreach ($numeros as $num) {
    echo "<h3>Tabuada do $num</h3>";
    for ($i = 1; $i <= 10; $i++) {
        $res = $num * $i;
        echo "$num x $i = $res<br>";
    }
}
?>