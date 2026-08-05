// PROJETO USANDO JQUERY

$(document).ready(function () {

    // Aplica as máscaras nos campos
    aplicarMascaras();

    // Configura a validação e o envio
    validarFormulario();

});

function aplicarMascaras() {

    // Preço no formato brasileiro
    // Exemplo: 1.234,56
    $("#preco").mask("000.000.000,00", {
        reverse: true
    });

    // Permite até 6 números
    $("#quantidade").mask("000000");

}

function validarFormulario() {

    // Seleciona a div responsável pelas mensagens
    const mensagem = document.getElementById("mensagem");

    // Configura o jQuery Validation
    $("#formFuncionario").validate({
        // Regras de validação
        rules: {
            nome: {
                required: true,
                minlength: 3,
                maxlength:100
            }, 
            cnpj: {
                required: true,
                minlength: 18,
                maxlength: 18
            },
            regFunc: {
               required: true 
            },
            pis: {
                required: true,
                minlength: 14,
                maxlength: 14 
            } 
        },        
        // Mensagens em português
        messages: {
            nome: {
                required: "Informe o nome do produto.",
                minlength: "O nome deve ter pelo menos 3 caracteres.",
                maxlength: "O nome deve ter no máximo 100 caracteres."
            },
            cnpj: {
                required: "Informe o CNPJ do funcionário.",
                minlength: "O CNPJ deve ter 18 caracteres.",
                maxlength: "O CNPJ deve ter 18 caracteres."
            },
            regFunc: {
                required: "Informe o registro do funcionário.",
            },
            pis: {
                required: "Informe o PIS do funcionário.",
                minlength: "O PIS deve ter 18 caracteres.",
                maxlength: "O PIS deve ter 18 caracteres."
            } 
        }, 
         // Não cria novas mensagens de erro
         errorPlacement: function (error, element) {

            // As mensagens já estão no HTML
            // dentro das divs invalid-feedback

            element
            .closest(".input-group")
            .find(".invalid-feedback")
            .text(error.text());

        },

        // Executado quando o campo está inválido
        highlight: function (element) {

            $(element)
                .removeClass("is-valid")
                .addClass("is-invalid");

        },

        // Executado quando o campo está válido
        unhighlight: function (element) {

            $(element)
                .removeClass("is-invalid")
                .addClass("is-valid");

        },

    
        
        // Executado somente quando todos os campos forem válidos
        submitHandler: async function (formulario) {

            // Captura os dados do formulário
            const dados = new FormData(formulario);

        
            // // Mostra os dados no console
            // console.table(
            //     Object.fromEntries(dados.entries())
            // );

            // Exibe mensagem enquanto envia
            mensagem.className = "alert alert-info mt-3";
            mensagem.textContent = "Enviando dados...";

            try {

                // Envia os dados para o Controller
                const resposta = await fetch(
                    "controllers/FuncionarioController.php",
                    {
                        method: "POST",
                        body: dados
                    }
                );

                // Converte a resposta JSON
                const resultado = await resposta.json();

                console.log(resultado);

                // Verifica se ocorreu erro HTTP
                if (!resposta.ok) {

                    mensagem.className =
                        "alert alert-danger mt-3";

                    mensagem.textContent =
                        resultado.mensagem ??
                        "Erro ao cadastrar produto.";

                    return;
                }

                // Exibe mensagem de sucesso
                mensagem.className =
                    "alert alert-success mt-3";

                mensagem.textContent =
                    resultado.mensagem;

                // Limpa os campos
                formulario.reset();

                // Remove as classes da validação
                $(formulario)
                    .find(".form-control")
                    .removeClass("is-valid is-invalid");

            } catch (erro) {

                mensagem.className =
                    "alert alert-danger mt-3";

                mensagem.textContent =
                    "Erro ao enviar os dados para o controller de funcionário.";

                console.error(erro);

            }

        }

    });


    // Quando o formulário for limpo
    $("#formFuncionario").on("reset", function () {

        // Remove as classes de validação
        $(this)
            .find(".form-control")
            .removeClass("is-valid is-invalid");

    });

}