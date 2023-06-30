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
        
        $alunos = Aluno::all();
        $enderecos = Endereco::all();
        $matricula = new Matricula();

        echo '<html>';
        echo '<head>';
        echo '<title>Mostrar Alunos</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';

        foreach ($alunos as $aluno) {
            echo '<div class="aluno">';
            $idAluno = $aluno->idAluno;
            echo "<h3>Nome do Aluno: " . $aluno->nomeAluno . "</h3>";
            echo "<p>";
            echo "<strong>Matricula do Aluno:</strong> " . $aluno->matriculaAluno. "<br><br> ";
            echo "</p>";  

            foreach ($enderecos as $endereco) {
                if ($endereco->idAluno == $idAluno) {
                    echo "<p>";
                    echo "<strong>Rua:</strong> " . $endereco->rua . "<br><br> ";
                    echo "<strong>Bairro:</strong> " . $endereco->bairro . "<br><br> ";
                    echo "<strong>Número:</strong> " . $endereco->numero . "<br><br> ";
                    echo "<strong>CEP:</strong> " . $endereco->cep;
                    echo "</p>";  
                }
            }
            
            $matricula = new Matricula();
            $disciplinasECursos = $matricula->getDisciplinasECursosByAlunos($idAluno);
            
            if (!empty($disciplinasECursos)) {
                foreach ($disciplinasECursos as $row) {
                    echo "<p>";
                    echo "<strong>Disciplina:</strong> " . $row->nomeDisciplina . ", ";
                    echo "<strong>Curso:</strong> " . $row->nomeCurso;
                    echo "</p>";             
                }
            } else {
                echo "Nenhum registro encontrado.";
            }
            echo '</div>';
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>