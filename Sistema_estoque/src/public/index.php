<?php 
$name='Hello';
?>


<!DOCTYPE html>
<php lang="en">

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
        <form action="" method="GET">
            <input type="text" class="inputtext" placeholder="Id" name="id" id="">
            <input type="text" class="inputtext" placeholder="Material" name="Material" id="">
            <input type="text" class="inputtext" placeholder="Tipo" name="Tipo" id="">
            <input type="text" class="inputtext" placeholder="Valor" name="Valor" id="">
            <input type="text" class="inputtext" placeholder="Quantidade" name="Quantidade" id="">
        </form>
        
    </div>
   
    <div class="espacamento">
        <a href="#" class="tool_bar">Catalogar</a>
        <a href="#" class="tool_bar">Remover</a>
    </div>

    <!-- Rodapé fixo -->
    <footer class="footerpage">
        <h2>Rodapé Fixo</h2>
    </footer>

</body>

</php>