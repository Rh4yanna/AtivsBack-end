<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exerc 07</title>
</head>
<body>
    <h2>Função com Retorno Duplo e Frase</h2>
    <form method="POST">
        <label>Número 1:</label><br>
        <input type="number" step="any" name="n1" required><br>
        <label>Número 2:</label><br>
        <input type="number" step="any" name="n2" required><br><br>
        <button type="submit">Processar</button>
    </form>

    <?php
    function calcular($a, $b) {
        $soma = $a + $b;
        $sub = $a - $b;
        return "Soma: $soma | Subtração: $sub. Frase: O código só funciona se você não desistir!";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<p>" . calcular($_POST['n1'], $_POST['n2']) . "</p>";
    }
    ?>
</body>
</html>