$(document).ready(function () {
    $("#login-form").submit(function (event) {
        event.preventDefault(); // Impede o comportamento padrão de recarregar a página

        var username = $('#your_name').val();
        var password = $('#your_pass').val();

        // Verifica se os campos não estão vazios
        if (username === "" || password === "") {
            alert("Por favor, preencha todos os campos.");
            return;
        }

        // Faz a requisição AJAX para verificar no banco de dados
        $.ajax({
            url: 'http://localhost/colorlib-regform-7/php/login.php', // Certifique-se de que a URL está correta
            type: 'GET',
            data: {
                nome: username,
                senha: password,
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    // Redireciona para a página inicial ou outra página
                    window.location.href = 'index.html'; // Ajuste conforme necessário
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Erro na requisição:", error);
                alert("Erro na requisição: " + error);
            }
        });
    });
});
