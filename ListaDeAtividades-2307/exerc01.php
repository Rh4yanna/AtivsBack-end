<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exerc 01</title>
</head>
<body>
    <h2>Verificador de Idade</h2>
    <form method="POST">
        <label>Digite a idade:</label><br>
        <input type="number" name="idade" required><br><br>
        <button type="submit">Verificar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idade = $_POST['idade'];

        if ($idade >= 18) {
            echo "<p>Você é maior de idade</p>";
        } else {
            echo "<p>Você é menor de idade</p>";
        }
    }
    ?>
</body>
</html>