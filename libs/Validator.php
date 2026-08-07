<?php

class Validator
{
    //Propriedade que receberão os dados e erros
    private $dados = [];
    private $erros = [];

    // Construtor (ao criar o objeto já envia os dados e erros)
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    //Retorna o valor de um campo.
    private function valor($campo)
    {
        //Caso o campo não exista,
        //retorna uma string vazia.
        return $this->dados[$campo] ?? "";
    }

    //Verifica se um campo está vazio.
    private function vazio($campo)
    {
        //Cria variável e recebe valor
        //para validar
        $valor = $this->valor($campo);

        //Se for texto, remove os espaços antes de enviar
        if (is_string($valor)) {
            return trim($valor) === "";
        }

        //Para outros tipos, utiliza empty.
        return empty($valor) &&
               $valor !== 0 &&
               $valor !== "0";
    }

    //Adiciona uma nova mensagem ao array de erros.
    private function adicionarErros($campo, $mensagem)
    {
        //Se o campo ainda não possui erros,
        // cria um array vazio pra ele.
        if (!isset($this->erros[$campo])) {
            $this->erros[$campo] = [];
        }

        //Adicionar a nova mensagem ao final do array.
        $this->erros[$campo][] = $mensagem;  
    }

    //Retorna true quando encontrou pelo menos um erro.
    public function fails()
    {
        return !empty($this->erros);
    }

    //Retorna true quando nenhum erro foi encontrado.
    public function passes()
    {
        return empty($this->erros);
    }

    //Retorna o erro de um campo específico.
    public function first ($campo)
    {
        return $this->erros[$campo][0] ?? null;
    }

    //Retorna todos os erros.
    public function erros()
    {
        return $this->erros;
    }

    //Retorna os dados recebidos.
    public function data()
    {
        return $this->dados;
    }
}

?>