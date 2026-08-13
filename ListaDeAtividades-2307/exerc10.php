<?php
$pessoa = [
    "Nome" => "Rhayanna",
    "Idade" => 22,
    "Cidade" => "Guarapuava",
    "Tchola" => "Não, nem sei o que é isso."
];

echo "<h2>Array Associativo - Dados da Pessoa</h2>";
foreach ($pessoa as $campo => $valor) {
    echo "<strong>$campo:</strong> $valor <br>";
}
?>