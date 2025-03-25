<?php
   session_start();
   error_log("catalogo");
   include './logs/logs.php';
   include './SGBD/database.php';
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (isset($_POST['id_materiais'])) {
           $id_materiais = $_POST['id_materiais'];
           $material = $_POST["material"];
           
           switch ($_POST['gerenciar']) {
               case "Catalogar":
                   if (empty($_POST['material']) || empty($_POST['tipo']) || empty($_POST['valor']) || empty($_POST['quantidade_estoque'])) {
                       error_log("Erro: Todos os campos são obrigatórios.");
                       echo '<p id="clear">Erro: Todos os campos são obrigatórios.</p>';
                   } else {
                       // Verificações
                       if (!is_string($_POST['material']) || !is_string($_POST['tipo'])) {
                           error_log("Erro: Material e tipo devem ser strings.");
                           echo '<p id="clear">Erro: Material e tipo devem ser strings.</p>';
                       } if (!is_numeric($_POST['valor']) || $_POST['valor'] <= 0) {
                           error_log("Erro: Valor deve ser um número e maior que zero.");
                           echo '<p id="clear">Erro: Valor deve ser um número e maior que zero.</p>';
                       } if(!filter_var($_POST['quantidade_estoque'], FILTER_VALIDATE_INT)) {
                           error_log("Erro: Quantidade em estoque deve ser um número inteiro.");
                           echo '<p id="clear">Erro: Quantidade em estoque deve ser um número inteiro.</p>';
                       } else {
                           // Sanitização dos dados
                           $material = filter_var($_POST['material'], FILTER_SANITIZE_STRING);
                           $tipo = filter_var($_POST['tipo'], FILTER_SANITIZE_STRING);
                           $valor = filter_var($_POST['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                           $quantidade_estoque = filter_var($_POST['quantidade_estoque'], FILTER_SANITIZE_NUMBER_INT);
   
                           // Validações adicionais
                           if ($valor <= 0) {
                               error_log("Erro: O valor deve ser maior que zero.");
                               echo '<p id="clear">Erro: O valor deve ser maior que zero.</p>';
                           } if ($quantidade_estoque < 0) {
                               error_log("Erro: A quantidade em estoque não pode ser negativa.");
                               echo '<p id="clear">Erro: A quantidade em estoque não pode ser negativa.</p>';
                           } if (!filter_var($_POST['id_materiais'], FILTER_VALIDATE_INT) || $_POST['id_materiais'] <= 0) {
                               error_log("Erro: ID do material inválido.");
                               echo '<p id="clear">Erro: ID do material inválido.</p>';
                           } else {
                               // Inserir no banco de dados
                               $sql = "INSERT INTO materiais (material, tipo, valor, quantidade_estoque) VALUES ('$material', '$tipo', $valor, $quantidade_estoque)";
                               // Executar a query (não implementado no exemplo)
                               // Limpeza das variáveis temporárias
                               unset($material, $tipo, $valor, $quantidade_estoque);
                           }
                       }
                   }
                   break;
   
               case "Remover":
                   if (!empty($_POST['material']) && !is_numeric($_POST['material'])) {
                       error_log("Erro: Para remover um material o campo ID é obrigatório.");
                       echo '<p id="clear">Erro: Para remover um material o campo ID é obrigatório.</p>';
                   } else {
                       // Remover do banco de dados
                       $sql = "DELETE FROM materiais WHERE id = ?";
                       $stmt = $conn->prepare($sql);
                       if ($stmt) {
                           $stmt->bind_param("i", $id_materiais);
                           $stmt->execute();
                           
                           if ($stmt->affected_rows > 0) {
                               error_log("Registro removido com sucesso!");
                           } else {
                               error_log("Nenhum registro foi removido (ID não encontrado).");
                           }
                           $stmt->close();
                       } else {
                           error_log("Erro ao preparar a consulta: " . $conn->error);
                       }
                   }
                   break;
   
               default:
                   error_log("Ação não reconhecida.");
                   echo '<p id="clear">Erro: Ação não reconhecida.</p>';
                   break;
           }
       } else {
           error_log("Erro: ID do material não fornecido.");
           echo '<p id="clear">Erro: ID do material não fornecido.</p>';
       }
   } else {
       error_log("Método de requisição inválido.");
       echo '<p id="clear">Erro: Método de requisição inválido.</p>';
   }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <script src="../scripts/block.js"></script>
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
