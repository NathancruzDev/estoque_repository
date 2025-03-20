<?php
    error_log("catalogo");
    include './logs/logs.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (isset($_POST['id_materiais'])) {

            $material = $_POST["material"];
            switch ($_POST['gerenciar']) {
                case "Catalogar":
                    if(empty($_POST['material']) || empty($_POST['tipo']) || empty($_POST['valor']) || empty($_POST['quantidade_estoque'])){
                        error_log("Erro: Todos os campos são obrigatórios.");
                        //adicionar abaixo o script de mensagem de erro rapido do JS.
                        echo "<p>Erro: Todos os campos são obrigatórios.</p>";
                        

                    }
                    else if(isset($_POST['id_materiais']) && isset($_POST['material']) && isset($_POST['tipo']) && isset($_POST['valor']) && isset($_POST['quantidade_estoque'])) {
                        //catalogar
                        //verificacoes
                        if (!is_string($_POST['material']) || !is_string($_POST['tipo'])) {
                            error_log("Erro: Material e tipo devem ser strings.");
                            //adicionar abaixo o script de mensagem de erro rapido do JS.
                            echo "<p>Erro: Material e tipo devem ser strings.</p><script>window.history.back</script>";
                            
                        }
                        if (!is_numeric($_POST['valor']) || 0>= $_POST['valor']) {
                            error_log("Erro: Valor deve ser um número e maior que zero.");
                            echo "<p>Erro: Valor deve ser um número e maior que zero.</p><script>window.history.back</script>";
                            
                        }
                        if (!filter_var($_POST['quantidade_estoque'], FILTER_VALIDATE_INT)) {
                            error_log("Erro: Quantidade em estoque deve ser um número inteiro.");
                            echo "<p>Erro: Quantidade em estoque deve ser um número inteiro.</p><script>window.history.back</script>";
                           
                        }
                        $material = filter_var($_POST['material'], FILTER_SANITIZE_STRING);
                        $tipo = filter_var($_POST['tipo'], FILTER_SANITIZE_STRING);
                        $valor = filter_var($_POST['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $quantidade_estoque = filter_var($_POST['quantidade_estoque'], FILTER_SANITIZE_NUMBER_INT);

                        if ($valor <= 0) {
                            error_log("Erro: O valor deve ser maior que zero.");
                            echo "<p>Erro: O valor deve ser maior que zero.</p><script>window.history.back</script>";
                         
                        }

                        if ($quantidade_estoque < 0) {
                            error_log("Erro: A quantidade em estoque não pode ser negativa.");
                            echo "<p>Erro: A quantidade em estoque não pode ser negativa.</p><script>window.history.back</script>";
                           
                        }

                        // Validação de ID
                        if (!filter_var($_POST['id_materiais'], FILTER_VALIDATE_INT) || $_POST['id_materiais'] <= 0) {
                            error_log("Erro: ID do material inválido.");
                            echo "<p>Erro: ID do material inválido.</p> <script>window.history.back</script>";
                           
                        }
                        //tem que catalogar no sgbd
                        
                        //abaixo voce tem que fazer a limpeza das variaveis temporarias.
                        unset($material, $tipo, $valor, $quantidade_estoque);
                    } else {
                        error_log("Tem que preencher todos os campos para catalogar.");
                        echo "<p>Erro: Tem que preencher todos os campos para catalogar.</p> <script>window.history.back</script>";
                    }
                    break;
                case "Remover":
                    if(!empty($_POST['material']) && !isnumeric($_POST['material'])){
                        
                        error_log("Erro: Para remover um material o campo ID e obrigatorio.");
                        //adicionar abaixo o script de mensagem de erro rapido do JS.
                        echo "<p>Erro: Para remover um material o campo ID e obrigatorio. </p> <script>window.history.back</script>";
                        
                        unset($material);
                    }
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