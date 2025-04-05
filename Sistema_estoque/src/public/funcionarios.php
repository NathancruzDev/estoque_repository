<?php 
include './logs/logs.php';
include 'database.php';
session_start();

$consultasql="SELECT * FROM funcionarios";
$resultado=mysqli_query($connect,$consultasql);

if(!$resultado) {
    die("Erro na consulta: " . mysqli_error($connect));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Funcionarios</title>
</head>
<body>
    <div class="login-btn">
        <a href="login.html" class="sign-in-button"></a>
    </div>

    <header class="header">
        <nav>
            <a href="index.php">Voltar</a>
            <a href="estoque.php">Estoque</a>
            <a href="logs.php">Logs</a>
            <a href="funcionarios.php">Funcionários</a>
        </nav>
    </header>
    <h3>Os numeros 0 e 1 nas tabelas correspondem a 0 sendo falso e 1 verdadeiro</h3>
    <h1>Funcionarios</h1>
    <div class="center">
    <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>nome</th>
                    <th>cargo</th>
                    <th>qualificação</th>
                    <th>cnhb</th>
                    <th>cnhc</th>
                    <th>salário</th>
                    <th>início na empresa</th>
                    <th>efetivo</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(mysqli_num_rows($resultado) > 0) {
                    while($row = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>
                                <td>".htmlspecialchars($row['id'])."</td>
                                <td>".htmlspecialchars($row['nome'])."</td>
                                <td>".htmlspecialchars($row['cargo'])."</td>
                                <td>".htmlspecialchars($row['qualificacao'], 2, ',', '.')."</td>
                                <td>".htmlspecialchars($row['cnhb'])."</td>
                                <td>".htmlspecialchars($row['cnhc'])."</td>
                                <td>R$".htmlspecialchars($row['salario'])."</td>
                                <td>".htmlspecialchars($row['inicio_na_empresa'])."</td>
                                <td>".htmlspecialchars($row['efetivo'])."</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Nenhum item encontrado no estoque.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>





    
    <footer class="footerpage">
        <h2>Rodapé Fixo</h2>
    </footer>
</body>
</html>