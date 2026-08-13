<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exerc 02</title>
</head>
<body>
    <h2>Classe Social</h2>
    <form method="POST">
        <label>Digite quanto dinheiro você tem (R$):</label><br>
        <input type="number" step="any" name="dinheiro" required><br><br>
        <button type="submit">Analisar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dinheiro = $_POST['dinheiro'];

        if ($dinheiro < 1000) {
            echo "<p>Pobre</p>";
        } elseif ($dinheiro < 10000) {
            echo "<p>Classe Média</p>";
        } elseif ($dinheiro < 100000) {
            echo "<p>Riquinho</p>";
        } elseif ($dinheiro < 1000000000) {
            echo "<p>Ricão</p>";
        } else {
            echo "<p>Elon Musk</p>";
        }
    }
    ?>
</body>
</html>