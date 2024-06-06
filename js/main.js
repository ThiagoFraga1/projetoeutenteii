$(document).ready(function () {
    $("#register-form").submit(function (event) {
        event.preventDefault(); // Impede o comportamento padrão de recarregar a página

        var nome = $('#name').val();
        var email = $('#email').val();
        var senha = $('#pass').val();
        
        console.log(nome, email, senha); // Para verificar se os valores foram capturados corretamente

        // Faz a requisição AJAX para adicionar no banco de dados
        $.ajax({
            url: 'http://localhost/colorlib-regform-7/php/cadastra.php', // Certifique-se de que a URL está correta
            type: 'POST',
            data: {
                nome: nome,
                email: email,
                senha: senha,
            },
            dataType: 'json',
            success: function (response) {
                console.log("Requisição bem-sucedida:", response);
            },
            error: function (xhr, status, error) {
                console.error("Erro na requisição:", error);
                alert("Erro na requisição: " + error);
            }
        });
    });
});
