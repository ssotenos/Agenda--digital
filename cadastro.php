<?php

include('conexao.php');

if(isset($_POST['nome']) && isset($_POST['senha']) && isset($_POST['csenha'])) {

    $nome = $mysqli->real_escape_string($_POST['nome']);
    $senha = $mysqli->real_escape_string($_POST['senha']);
    $csenha = $mysqli->real_escape_string($_POST['csenha']);


    if ($senha !== $csenha) {
        echo "Erro: As senhas não coincidem!";
    } else {

        $sql_verifica = "SELECT * FROM usuario WHERE nome = '$nome'";
        $query_verifica = $mysqli->query($sql_verifica) or die("Falha na Execução do código SQL: " . $mysqli->error);

        if ($query_verifica->num_rows > 0) {
            echo "Erro: Usuário já cadastrado!";
        } else {
            
            $sql_insert = "INSERT INTO usuario (nome, senha) VALUES ('$nome', '$senha')";
            if ($mysqli->query($sql_insert)) {
                echo "Cadastro realizado com sucesso!";
                header("Location: index.php");
                exit();
            } else {
                echo "Erro ao cadastrar: " . $mysqli->error;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cadastro.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="container">
        <h2>Cadastre-se</h2>
        <form action="" method="POST">
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome" required>

            <label for="senha">Senha: </label>
            <input type="password" name="senha" id="senha" minlength="8" maxlength="20" required>

            <label for="csenha">Confirmar Senha: </label>
            <input type="password" name="csenha" id="csenha" minlength="8" maxlength="20" required>

            <button type="submit" name="cadastro">CADASTRAR</button>
        </form>
    </div>
</body>
</html>
