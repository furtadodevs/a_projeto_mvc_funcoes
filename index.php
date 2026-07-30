<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema MVC 1</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">

</head>

<body class="bg-light d-flex flex-column min-vh-100">
    <!-- Cabeçalho -->
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <h1 class="h3 mb-3 mb-md-0"> Sistema de Cadastro </h1>

                <!-- Menu principal -->
                <nav class="nav">
                    <a href="index.php?page=produtos" class="nav-link text-white"> Produtos </a>

                    <a href="index.php?page=clientes" class="nav-link text-white"> Clientes </a>

                    <a href="index.php?page=funcionarios" class="nav-link text-white"> Funcionarios </a>

                </nav>
            </div>
        </div>

    </header>

    <!-- Conteúdo carregado pelas rotas -->
    <main class="flex-grow-1">
        <?php
        // Carrega o arquivo que controla as páginas do sistema
        require __DIR__ . "/routes.php";
        ?>

    </main>

    <!-- Rodapé -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0"> Sistema MVC de Cadastro </p>
    </footer>


    <!-- JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>