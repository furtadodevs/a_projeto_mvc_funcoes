<?php

//Definir URL do projeto
//http://localhost/projetos-gabrielle/mvc/a_projeto_mvc_funcoes/index.php?page=produtos

//Definir páginas válidas no projetos
$paginasValidas = [
    "produtos" => __DIR__ . "/views/produto.php",
    "clientes" => __DIR__ . "/views/cliente.php",
    "funcionarios" => __DIR__ . "/views/funcionario.php",
];

//Capturar a página informada na url
$page = $_GET["page"] ?? "produtos"; // Produtos, clientes ou funcionários.

//Verificar se a página existe
if(array_key_exists($page, $paginasValidas)){
    require $paginasValidas[$page];
} else {
    http_response_code(404);
    require __DIR__ . "/views/404.php";
}