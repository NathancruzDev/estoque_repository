<?php
// Inicia o log e a sessão
error_log("Acessando remoção de materiais");
include './logs/logs.php';
include 'database.php';
session_start();

// Inicializa variáveis
$msg = '';
$msg_class = '';

// Processa o formulário apenas se for POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remover_material'])) {
    $id_materiais = trim($_POST['id_materiais']);

    // Valida o ID
    if (!filter_var($id_materiais, FILTER_VALIDATE_INT) || $id_materiais <= 0) {
        $msg = 'Erro: ID do material inválido.';
        $msg_class = 'error';
        error_log("Erro: ID do material inválido.");
    } else {
        try {
            // Remove o material
            $delete_sql = "DELETE FROM materiais WHERE id_materiais = ?";
            $delete_stmt = $connect->prepare($delete_sql);

            if (!$delete_stmt) {
                throw new Exception("Erro ao preparar remoção: " . $connect->error);
            }

            $delete_stmt->bind_param("i", $id_materiais);

            if ($delete_stmt->execute()) {
                if ($delete_stmt->affected_rows > 0) {
                    $msg = 'Material removido com sucesso!';
                    $msg_class = 'success';
                    error_log("Sucesso: Material ID $id_materiais removido.");
                } else {
                    $msg = 'Nenhum material foi removido.';
                    $msg_class = 'error';
                    error_log("Aviso: Nenhum material removido (ID: $id_materiais).");
                }
            } else {
                throw new Exception("Erro ao remover: " . $delete_stmt->error);
            }

            $delete_stmt->close();
        } catch (Exception $e) {
            $msg = 'Erro: ' . $e->getMessage();
            $msg_class = 'error';
            error_log("Exception: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Material</title>
    <link rel="stylesheet" href="css/index.css">
    <script>
        function confirmarRemocao() {
            return confirm("Tem certeza que deseja remover este material? Esta ação não pode ser desfeita.");
        }
    </script>
</head>

<body>
    <!-- Botão de Login no topo direito -->
    <div class="login-btn">
        <a href="login.php" class="sign-in-button">Login</a>
    </div>
    <!-- Navegação principal -->

    <header class="header">
        <nav>
            <a href="estoque.php">Voltar</a>
            <a href="logs.php">Logs</a>
            <a href="funcionarios.php">Funcionários</a>
            <a href="catalogar_material.php">Catalogar Material</a>
        </nav>
    </header>


    <!-- Conteúdo principal -->
    <div class="center">
        <div class="around">
            <?php if (!empty($msg)): ?>
                <div class="msg <?php echo $msg_class; ?>">
                    <?php echo $msg; ?>
                </div>
            <?php endif; ?>

            <h2>Remover Material do Estoque</h2>

            <form method="POST" action="" onsubmit="return confirmarRemocao()">
                <div class="input-group">
                    <label for="id_materiais">ID do Material:</label>
                    <input type="text" class="inputtext" placeholder="Digite o ID" name="id_materiais" id="id_materiais"
                        required>
                </div>

                <div class="btn-group">
                    <button type="submit" class="tool_bar" name="remover_material" value="1">
                        Remover Material
                    </button>
                </div>
            </form>

            <div class="info-box">
                <p>Digite o ID do material que deseja remover do sistema.</p>
                <p><strong>Atenção:</strong> Esta ação é permanente e não pode ser desfeita.</p>
            </div>
        </div>
    </div>

    <!-- Footer completo -->
    <footer class="footerpage">
        <div class="container">
            <p>Sistema de Gerenciamento &copy; <?php echo date('Y'); ?></p>
        </div>
    </footer>
</body>

</html>