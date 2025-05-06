<?php 

    include('protect.php');

    include('conexao.php');

    if(!isset($_SESSION)){
        session_start();
    }

    $user_id = $_SESSION['id'];

if(isset($_POST['data_evento']) && isset($_POST['titulo'])) {

    $data_evento = $mysqli->real_escape_string($_POST['data_evento']);
    $titulo = $mysqli->real_escape_string($_POST['titulo']);
    
    
    
    if (!strtotime($data_evento)) {
        die("Data inválida");
    }
    

    $data_formatada = date('Y-m-d', strtotime($data_evento));


    $sql_insert = "INSERT INTO evento (titulo, data_evento, usuario_id) VALUES ('$titulo', '$data_formatada', '$user_id')";
            if ($mysqli->query($sql_insert)) {
                echo "<script>alert('Operação realizada com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro na inserção!');</script>";
            }
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="painel.css">
    <title>Document</title>
</head>
<body>

    <div class="container">
        <form action="" method="POST">
            <label for="titulo">Título: </label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="data_evento">Data do Evento</label>
            <input type="date" name="data_evento" id="data_evento" required>

            <button type="submit" name="adicionar_evento">ADICIONAR EVENTO: </button>
        </form>
    </div>

    <div class="eventos-container">
        <?php 
            $sql_code = "SELECT titulo, data_evento FROM evento WHERE usuario_id = '$user_id' ORDER BY data_evento ASC";
            $sql_query = $mysqli->query($sql_code) or die("Falha na Execução do código SQL: " . $mysqli->error);
            
            if ($sql_query->num_rows > 0) {
                echo "<table class='eventos' border='1'>";
                echo "<tr><th>Título</th><th>Data do Evento</th></tr>";
            
                while ($row = $sql_query->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
                    echo "<td>" . date("d/m/Y", strtotime($row['data_evento'])) . "</td>";
                    echo "</tr>";
                }
            
                echo "</table>";
            } else {
                echo "Nenhum evento encontrado.";
            }
        ?>
    </div>

    <a href="logout.php" class="logout">LOGOUT</a>
</body>
</html>