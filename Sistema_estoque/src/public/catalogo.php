<?php
    error_log("catalogo");
    include './logs/logs.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['id_materiais'])) {
            $material = $_POST["material"];
            switch ($_POST['gerenciar']) {
                case "Catalogar":
                    if (isset($_POST['id_materiais']) && isset($_POST['material']) && isset($_POST['tipo']) && isset($_POST['valor']) && isset($_POST['quantidade_estoque'])) {
                        //catalogar
                        $tipo = $_POST["tipo"];
                        $valor = $_POST["valor"];
                        $quantidade_estoque = $_POST["quantidade_estoque"];
                        //tem que catalogar no sgbd
    
                        //abaixo voce tem que fazer a limpeza das variaveis temporarias.
                    } else {
                        error_log("Tem que preencher todos os campos para catalogar.");
                        echo "<p>Erro: Tem que preencher todos os campos para catalogar.</p>";
                    }
                    break;
                case "Remover":
                    //id ja foi declarado
                    break;
    
                default:
                    //falta acabar aq
                    break;
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Catalogo</title>
</head>

<body>
    <div class="login-btn">
        <a href="login.php" class="sign-in-button">Entrar</a>
    </div>

    <!-- Cabeçalho com o nome da empresa -->
    <header class="header">
        <nav>
            <a href="estoque.php">Voltar</a>
            <a href="estoque.php">Estoque</a>
            <a href="logs.php">Logs</a>
            <a href="funcionarios.php">Funcionários</a>
        </nav>
    </header>



    <div class="espacamento">
        <p>Caso deseja remover digitar apenas o Id do produto.</p>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>;" method="POST">
            <input type="text" class="inputtext" placeholder="Id" name="id_materiais" id="" required>
            <input type="text" class="inputtext" placeholder="Material" name="material" id="">
            <input type="text" class="inputtext" placeholder="Tipo" name="tipo" id="">
            <input type="text" class="inputtext" placeholder="Valor" name="valor" id="">
            <input type="text" class="inputtext" placeholder="Quantidade" name="quantidade_estoque" id="">
        </form>
       
    </div>

    <div class="espacamento">
        <a href="#" class="tool_bar" name='gerenciar'>Catalogar</a>
        <a href="#" class="tool_bar" name='gerenciar'>Remover</a>
    </div>

    <!-- Rodapé fixo -->
    <footer class="footerpage">
        <h2>Rodapé Fixo</h2>
    </footer>

</body>

</html>