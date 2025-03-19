<?php 
include './logs/logs.php';
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Sistema de Estoque</title>
</head>

<body>
    <!-- Botão de Entrada de Usuário no topo direito -->
    <div class="login-btn">
        <a href="login.php" class="sign-in-button">Entrar</a>
    </div>

    <!-- Cabeçalho com o nome da empresa -->
    <header class="header">
        <nav>
            <a href="estoque.php">Estoque</a>
            <a href="logs.php">Logs</a>
            <a href="funcionarios.php">Funcionários</a>
        </nav>
    </header>

    <h1 id="empresa-nome">  Pagina inicial</h1>

    </section>

    <div class="espacamento">

    <div id="percapita">
        <p>Exibir o valor de rendimento bruto da empresa</p>
        <table border="1">
            <thead>
                <tr>
                    <th>Total de produtos no estoque</th>
                    <th>Baixo estoque</th>
                    <th>Produto Lider de vendas.</th>
                    <th>Categorias com maior movimentacao</th>
                
                </tr>
            </thead>
        </table>
    </div>
</div>
    <!-- Rodapé fixo -->
    <footer class="footerpage">
        <h2>Rodapé Fixo</h2>
    </footer>

   
    
</body>

</html>
