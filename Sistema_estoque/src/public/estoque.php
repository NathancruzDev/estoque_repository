<?php 
include './logs/logs.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque Construtora</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="login-btn">
        <a href="login.html" class="sign-in-button">Entrar</a>
    </div>

    <!-- Cabeçalho com o nome da empresa -->
    <header class="header">
        <nav>
            <a href="pagina_inicial.php">Voltar</a>
            <!--<a href="estoque.php">Estoque</a>-->
            <a href="logs.php">Logs</a>
            <a href="funcionarios.php">Funcionários</a>
        </nav>
    </header>

        <h1>Estoque</h1>

    <div >
        <a href="catalogo.php" class="tool">Catalogar</a>
    </div>



    <div class="center">


        <table border="1">
            <thead>
                <tr>
                    <th>0</th>
                    <th>Material</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Madeira</th>
                    <th>construcao</th>
                    <th>2000</th>
                    <th>532</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Rodapé fixo -->
    <footer class="footerpage">
    <h2>Rodapé Fixo</h2>
    </footer>

</body>
</html>