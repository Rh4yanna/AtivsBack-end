<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exerc 13</title>
</head>
<body>
    <h2>Formulário de Cadastro</h2>
    <form method="POST">
        <label>Nome:</label><br><input type="text" name="nome" required><br>
        <label>Email:</label><br><input type="email" name="email" required><br>
        <label>Telefone:</label><br><input type="text" name="telefone" required><br>
        <label>Data de Nascimento:</label><br><input type="date" name="nascimento" required><br>
        <label>Cidade:</label><br><input type="text" name="cidade" required><br>
        <label>Estado:</label><br><input type="text" name="estado" required><br>
        <label>Sexo:</label><br>
        <select name="sexo">
            <option value="Masculino">Masculino</option>
            <option value="Feminino">Feminino</option>
            <option value="Outro">Outro</option>
        </select><br>
        <label>Curso:</label><br><input type="text" name="curso" required><br>
        <label>Observações:</label><br><textarea name="observacoes"></textarea><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<hr>";
        echo "<h3>🪪 Cartão de Cadastro</h3>";
        echo "<p><strong>Nome:</strong> " . $_POST['nome'] . "</p>";
        echo "<p><strong>Email:</strong> " . $_POST['email'] . "</p>";
        echo "<p><strong>Telefone:</strong> " . $_POST['telefone'] . "</p>";
        echo "<p><strong>Data de Nascimento:</strong> " . $_POST['nascimento'] . "</p>";
        echo "<p><strong>Cidade/UF:</strong> " . $_POST['cidade'] . "/" . $_POST['estado'] . "</p>";
        echo "<p><strong>Sexo:</strong> " . $_POST['sexo'] . "</p>";
        echo "<p><strong>Curso:</strong> " . $_POST['curso'] . "</p>";
        echo "<p><strong>Observações:</strong> " . $_POST['observacoes'] . "</p>";
    }
    ?>
</body>
</html>