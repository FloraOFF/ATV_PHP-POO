<div class="form-container">
    <form action="./buscaExibeAluno.php" method="post" class="form-entidade">
        <label>Informe o id do Aluno: <input type="text" name="idAluno" id="buscaIdAluno"></label>
        <button>Busca Aluno</button>
    </form>
</div>



<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\AlunoGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Aluno.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\MatriculaGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Matricula.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\EnderecoGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Endereco.php';

    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Aluno::setConnection($conn);
        Matricula::setConnection($conn);
        Endereco::setConnection($conn);
        
        $enderecos = Endereco::all();
        $aluno = new Aluno();
        $matricula = new Matricula();

        echo '<html>';
        echo '<head>';
        echo '<title>Mostrar Aluno</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';

        if (isset($_POST['idAluno'])) {

            echo '<div class="aluno">';
            $alunoId = $_POST['idAluno'];
            $AlunoData = $aluno->find($alunoId);
            $nome = $AlunoData->nomeAluno;
            $matriculaA = $AlunoData->matriculaAluno;

            if ($AlunoData) {
                echo "<h3>Nome do Aluno: " . $nome . "</h3>";
                echo "<p>";
                echo "<strong>Matricula do Aluno:</strong> " . $matriculaA. "<br><br> ";
                echo "</p>"; 
                
                $disciplinasECursos = $matricula->getDisciplinasCursosByAluno($alunoId);

                foreach ($enderecos as $endereco) {
                    if ($endereco->idAluno == $alunoId) {
                        echo "<p>";
                        echo "<strong>Rua:</strong> " . $endereco->rua . "<br><br> ";
                        echo "<strong>Bairro:</strong> " . $endereco->bairro . "<br><br> ";
                        echo "<strong>Número:</strong> " . $endereco->numero . "<br><br> ";
                        echo "<strong>CEP:</strong> " . $endereco->cep;
                        echo "</p>";  
                    }
                }
                    
                if (!empty($disciplinasECursos)) {
                    foreach ($disciplinasECursos as $row) {
                        echo "<p>";
                        echo "<strong>Disciplina:</strong> " . $row->nomeDisciplina . ", ";
                        echo "<strong>Curso:</strong> " . $row->nomeCurso. ".";
                        echo "</p>";  
                    }
                } else {
                    echo "Nenhum registro encontrado.";
                }
            } else {
                echo "Aluno não encontrado.";
            }
        }

        echo '</div>';

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>