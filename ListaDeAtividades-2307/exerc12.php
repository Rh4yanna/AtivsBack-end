<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exerc 12</title>
</head>
<body>
    <h2>Calculadora HTML</h2>
    <form method="POST">
        <label>Num 1:</label><br>
        <input type="number" step="any" name="num1" required><br>
        <label>Num 2:</label><br>
        <input type="number" step="any" name="num2" required><br><br>

        <button type="submit" name="operacao" value="Somar">Somar</button>
        <button type="submit" name="operacao" value="Subtrair">Subtrair</button>
        <button type="submit" name="operacao" value="Multiplicar">Multiplicar</button>
        <button type="submit" name="operacao" value="Dividir">Dividir</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $op = $_POST['operacao'];

        if ($op == "Somar") $res = $num1 + $num2;
        elseif ($op == "Subtrair") $res = $num1 - $num2;
        elseif ($op == "Multiplicar") $res = $num1 * $num2;
        elseif ($op == "Dividir") $res = ($num2 != 0) ? ($num1 / $num2) : "Erro: Divisão por zero";

        echo "<h3>Resultado: $res</h3>";
    }
    ?>
</body>
</html>