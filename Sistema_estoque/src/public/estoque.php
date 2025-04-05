<?php 
include './logs/logs.php';
include 'database.php';
session_start();

$consultasql = "SELECT * FROM materiais";
$resultado = mysqli_query($connect, $consultasql); 

if(!$resultado) {
    die("Erro na consulta: " . mysqli_error($connect));
}
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

    <header class="header">
        <nav>
            <a href=index.php">Voltar</a>
            <a href="logs.php">Logs</a>
            <a href="funcionarios.php">Funcionários</a>
        </nav>
    </header>

    <h1>Estoque</h1>

    <div>
        <a href="catalogo.php" class="tool">Catalogar</a>
    </div>

    <div>
    <a href="remover.php" class="tool">Retirar do Calogo</a>
    </div>

    <div class="center">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Material</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Quantidade</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(mysqli_num_rows($resultado) > 0) {
                    while($row = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>
                                <td>".htmlspecialchars($row['id_materiais'])."</td>
                                <td>".htmlspecialchars($row['material'])."</td>
                                <td>".htmlspecialchars($row['tipo'])."</td>
                                <td>R$ ".number_format($row['valor'], 2, ',', '.')."</td>
                                <td>".htmlspecialchars($row['quantidade_estoque'])."</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum item encontrado no estoque.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer class="footerpage">
        <h2>Rodapé Fixo</h2>
    </footer>

    <?php mysqli_close($connect); ?>
</body>
</html>