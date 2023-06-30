document.addEventListener('DOMContentLoaded', function() {
    var formBusca = document.getElementById('form-busca');
    var resultadoContainer = document.getElementById('resultado-container');

    formBusca.addEventListener('submit', function(e) {
        e.preventDefault(); // Evita o envio padrão do formulário

        var idAluno = document.getElementById('buscaIdAluno').value;

        // Faz a requisição AJAX usando a API Fetch
        fetch('../ArquivoMani/buscaExibeAluno.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'idAluno=' + encodeURIComponent(idAluno)
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