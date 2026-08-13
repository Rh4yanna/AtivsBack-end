<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exerc 03</title>
</head>
<body>
    <h2>Calculadora com IF/Switch</h2>
    <form method="POST">
        <label>Número 1:</label><br>
        <input type="number" step="any" name="numero1" required><br>
        
        <label>Número 2:</label><br>
        <input type="number" step="any" name="numero2" required><br>
        
        <label>Operação (+, -, *, /):</label><br>
        <input type="text" name="operacao" required maxlength="1"><br><br>
        
        <button type="submit">Calcular</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];
        $operacao = $_POST['operacao'];

        switch ($operacao) {
            case '+':
                $resultado = $numero1 + $numero2;
                break;
            case '-':
                $resultado = $numero1 - $numero2;
                break;
            case '*':
                $resultado = $numero1 * $numero2;
                break;
            case '/':
                $resultado = ($numero2 != 0) ? ($numero1 / $numero2) : "Divisão por zero não existe!";
                break;
            default:
                $resultado = "Operação inválida!";
        }

        echo "<p>Resultado: $resultado</p>";
    }
    ?>
</body>
</html>