<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exerc 06</title>
</head>
<body>
    <h2>Função de Saudação</h2>
    <form method="POST">
        <label>Digite seu nome:</label><br>
        <input type="text" name="nome" required><br><br>
        <button type="submit">Enviar</button>
    </form>

    <?php
    function saudar($nome) {
        return "Olá $nome!";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nomeDigitado = $_POST['nome'];
        echo "<p>" . saudar($nomeDigitado) . "</p>";
    }
    ?>
</body>
</html>