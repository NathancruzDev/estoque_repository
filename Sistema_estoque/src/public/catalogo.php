<?php
// Inicia o log e a sessão
error_log("Acessando catálogo de materiais - Página de Adição");
include './logs/logs.php';
include 'database.php';
session_start();

// Inicializa variáveis
$msg = '';
$msg_class = '';

// Processa o formulário apenas se for POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adicionar'])) {
    // Verificação de campos obrigatórios
    if (empty($_POST['material']) || empty($_POST['tipo']) || empty($_POST['valor']) || empty($_POST['quantidade_estoque'])) {
        $msg = 'Erro: Todos os campos são obrigatórios.';
        $msg_class = 'error';
        error_log("Erro: Todos os campos são obrigatórios.");
    } else {
        // Sanitização dos dados
        $material = trim(filter_var($_POST['material'], FILTER_SANITIZE_STRING));
        $tipo = trim(filter_var($_POST['tipo'], FILTER_SANITIZE_STRING));
        $valor = filter_var($_POST['valor'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $quantidade = filter_var($_POST['quantidade_estoque'], FILTER_SANITIZE_NUMBER_INT);

        // Validações
        $erros = [];
        if (empty($material)) {
            $erros[] = "Material inválido";
        }
        if (empty($tipo)) {
            $erros[] = "Tipo inválido";
        }
        if (!is_numeric($valor) || $valor <= 0) {
            $erros[] = "Valor deve ser um número positivo";
        }
        if (!is_numeric($quantidade) || $quantidade < 0) {
            $erros[] = "Quantidade deve ser um número inteiro positivo";
        }

        // Se houve erros
        if (!empty($erros)) {
            $msg = 'Erro: ' . implode("<br>", $erros);
            $msg_class = 'error';
            error_log("Erros: " . implode(", ", $erros));
        } else {
            // Tenta inserir no banco
            try {
                $sql = "INSERT INTO materiais (material, tipo, valor, quantidade_estoque) VALUES (?, ?, ?, ?)";
                $stmt = $connect->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("ssdi", $material, $tipo, $valor, $quantidade);

                    if ($stmt->execute()) {
                        $msg = 'Material cadastrado com sucesso!';
                        $msg_class = 'success';
                        error_log("Sucesso: Material '{$material}' cadastrado.");
                    } else {
                        $msg = 'Erro ao cadastrar material: ' . $stmt->error;
                        $msg_class = 'error';
                        error_log("Erro ao cadastrar: " . $stmt->error);
                    }
                    $stmt->close();
                } else {
                    throw new Exception("Erro ao preparar a query: " . $connect->error);
                }
            } catch (Exception $e) {
                $msg = 'Erro no sistema: ' . $e->getMessage();
                $msg_class = 'error';
                error_log("Exception: " . $e->getMessage());
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Material</title>
    <link rel="stylesheet" href="css/index.css">
    <script>
        function confirmarAdicao() {
            return confirm("Tem certeza que deseja adicionar este material? Verifique os dados antes de confirmar.");
        }
    </script>
</head>

<body>
    <!-- Botão de Login no topo direito -->
    <div class="login-btn">
        <a href="login.php" class="sign-in-button">Login</a>
    </div>

    <!-- Header completo -->
    <header class="header">
        <nav>
            <a href="estoque.php">Voltar</a>
            <a href="logs.php">Logs</a>
            <a href="funcionarios.php">Funcionários</a>
            <a href="remover_material.php">Remover Material</a>
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

            <h2>Adicionar Novo Material</h2>

            <form method="POST" action="" onsubmit="return confirmarAdicao()">
                <div class="input-group">
                    <label for="material">Nome do Material:</label>
                    <input type="text" class="inputtext" placeholder="Digite o nome do material" name="material"
                        id="material" required>
                </div>

                <div class="input-group">
                    <label for="tipo">Tipo:</label>
                    <input type="text" class="inputtext" placeholder="Digite o tipo do material" name="tipo" id="tipo"
                        required>
                </div>

                <div class="input-group">
                    <label for="valor">Valor Unitário (R$):</label>
                    <input type="number" class="inputtext" placeholder="0.00" name="valor" id="valor" step="0.01"
                        min="0" required>
                </div>

                <div class="input-group">
                    <label for="quantidade">Quantidade em Estoque:</label>
                    <input type="number" class="inputtext" placeholder="0" name="quantidade_estoque" id="quantidade"
                        min="0" required>
                </div>

                <div class="btn-group">
                    <button type="submit" class="tool_bar" name="adicionar" value="1">
                        Adicionar Material
                    </button>
                </div>
            </form>
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