<?php
   error_log("catalogo");
   include './logs/logs.php';
   include 'database.php';
   session_start();
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       if (isset($_POST['id_materiais'])) {
           $id_materiais = $_POST['id_materiais'];
           $material = $_POST["material"];
           
           switch ($_POST['gerenciar']) {
            case "Catalogar":
                // Verificar campos obrigatórios
                if (empty($_POST['material']) || empty($_POST['tipo']) || empty($_POST['valor']) || empty($_POST['quantidade_estoque'])) {
                    error_log("Erro: Todos os campos são obrigatórios.");
                    echo '<p id="clear">Erro: Todos os campos são obrigatórios.</p>';
                    break;
                }
            
                // Sanitização
                $material = filter_var($_POST['material'], FILTER_SANITIZE_STRING);
                $tipo = filter_var($_POST['tipo'], FILTER_SANITIZE_STRING);
                $valor = filter_var($_POST['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $quantidade = filter_var($_POST['quantidade_estoque'], FILTER_SANITIZE_NUMBER_INT);
            
                // Validações
                $erros = [];
                if (!is_string($material) || $material === '') {
                    $erros[] = "Material inválido";
                }
                if (!is_string($tipo) || $tipo === '') {
                    $erros[] = "Tipo inválido";
                }
                if (!is_numeric($valor) || $valor <= 0) {
                    $erros[] = "Valor deve ser um número positivo";
                }
                if (!is_numeric($quantidade) || $quantidade < 0) {
                    $erros[] = "Quantidade deve ser um número inteiro positivo";
                }
            
                if (!empty($erros)) {
                    error_log("Erros: " . implode(", ", $erros));
                    echo '<p id="clear">Erro: ' . implode("<br>", $erros) . '</p>';
                    break;
                }
            
                // Inserção no banco (usando prepared statements)
                $sql = "INSERT INTO materiais (materiais, tipo, valor, quantidade_estoque) VALUES (?, ?, ?, ?)";
                $stmt = $connect->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("ssdi", $material, $tipo, $valor, $quantidade);
                    if ($stmt->execute()) {
                        error_log("Material cadastrado com sucesso!");
                        echo '<p id="clear">Material cadastrado com sucesso!</p>';
                    } else {
                        error_log("Erro ao cadastrar: " . $stmt->error);
                        echo '<p id="clear">Erro ao cadastrar material</p>';
                    }
                    $stmt->close();
                } else {
                    error_log("Erro ao preparar a query: " . $connect->error);
                    echo '<p id="clear">Erro no sistema</p>';
                }
                break;
   
                case "Remover":
                    // Verificar se o ID foi fornecido e é válido
                    if (!isset($_POST['id_material']) || !filter_var($_POST['id_material'], FILTER_VALIDATE_INT) || $_POST['id_material'] <= 0) {
                        error_log("Erro: ID do material inválido ou não fornecido.");
                        echo '<p id="clear">Erro: ID do material inválido ou não fornecido.</p>';
                        break;
                    }
                
                    $id_material = $_POST['id_material'];
                
                    // Primeiro verificar se o material existe
                    $check_sql = "SELECT id_material FROM materiais WHERE id_material = ?";
                    $check_stmt = $connect->prepare($check_sql);
                    
                    if (!$check_stmt) {
                        error_log("Erro ao preparar consulta de verificação: " . $connect->error);
                        echo '<p id="clear">Erro no sistema ao verificar material.</p>';
                        break;
                    }
                
                    $check_stmt->bind_param("i", $id_material);
                    $check_stmt->execute();
                    $check_stmt->store_result();
                
                    if ($check_stmt->num_rows === 0) {
                        error_log("Erro: Material com ID $id_material não encontrado.");
                        echo '<p id="clear">Erro: Material não encontrado.</p>';
                        $check_stmt->close();
                        break;
                    }
                    $check_stmt->close();
                
                    // Se chegou aqui, o material existe - podemos remover
                    $delete_sql = "DELETE FROM materiais WHERE id_material = ?";
                    $delete_stmt = $connect->prepare($delete_sql);
                    
                    if (!$delete_stmt) {
                        error_log("Erro ao preparar consulta de remoção: " . $connect->error);
                        echo '<p id="clear">Erro no sistema ao remover material.</p>';
                        break;
                    }
                
                    $delete_stmt->bind_param("i", $id_material);
                    
                    if ($delete_stmt->execute()) {
                        if ($delete_stmt->affected_rows > 0) {
                            error_log("Sucesso: Material ID $id_material removido com sucesso.");
                            echo '<p id="clear">Material removido com sucesso!</p>';
                        } else {
                            error_log("Aviso: Nenhum material foi removido (ID: $id_material).");
                            echo '<p id="clear">Nenhum material foi removido.</p>';
                        }
                    } else {
                        error_log("Erro ao executar remoção: " . $delete_stmt->error);
                        echo '<p id="clear">Erro ao remover material.</p>';
                    }
                    
                    $delete_stmt->close();
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