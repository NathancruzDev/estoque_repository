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
        <a href="login.html" class="sign-in-button">Entrar</a>
    </div>

    <!-- Cabeçalho com o nome da empresa -->
    <header class="header">
        <nav>
            <a href="#estoque">Estoque</a>
            <a href="#logs">Logs</a>
            <a href="#funcionarios">Funcionários</a>
        </nav>
    </header>

    <h1 id="empresa-nome">Empresa Tal</h1>

    
    </section>

    <!-- Exibição de rendimento bruto -->
    <div id="percapita">
        <p>Exibir o valor de rendimento bruto da empresa</p>
    </div>

    <!-- Rodapé fixo -->
    <footer class="footerpage">
        <h2>Rodapé Fixo</h2>
    </footer>

    <script>
        // Exemplo de como adicionar um produto à tabela de produtos
        const formProduto = document.getElementById('form-produto');
        const tabelaProdutos = document.getElementById('tabela-produtos').getElementsByTagName('tbody')[0];

        formProduto.addEventListener('submit', function (e) {
            e.preventDefault();

            const nome = document.getElementById('nome-produto').value;
            const quantidade = document.getElementById('quantidade-produto').value;
            const preco = document.getElementById('preco-produto').value;

            const newRow = tabelaProdutos.insertRow();

            newRow.innerHTML = `
                <td>${nome}</td>
                <td>${quantidade}</td>
                <td>R$ ${parseFloat(preco).toFixed(2)}</td>
                <td><button class="button" onclick="removerProduto(this)">Remover</button></td>
            `;

            // Limpar campos após adicionar
            formProduto.reset();
        });

        // Função para remover um produto da tabela
        function removerProduto(btn) {
            const row = btn.closest('tr');
            row.remove();
        }
    </script>
</body>

</html>
