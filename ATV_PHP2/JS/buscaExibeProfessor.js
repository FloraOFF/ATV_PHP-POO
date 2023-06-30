document.addEventListener('DOMContentLoaded', function() {
    var formBusca = document.getElementById('form-busca');
    var resultadoContainer = document.getElementById('resultado-container');

    formBusca.addEventListener('submit', function(e) {
        e.preventDefault(); // Evita o envio padrão do formulário

        var idProfessor = document.getElementById('buscaIdProfessor').value;

        // Faz a requisição AJAX usando a API Fetch
        fetch('../ArquivoMani/buscaExibeProfessor.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'idProfessor=' + encodeURIComponent(idProfessor)
        })
        .then(function(response) {
            return response.text();
        })
        .then(function(data) {
            // Atualiza o conteúdo do resultado-container com o novo conteúdo
            resultadoContainer.innerHTML = data;
            resultadoContainer.style.display = "block";
        });
    });
});