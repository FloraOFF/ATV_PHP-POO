<div class="form-container">
    <form action="./buscaExibeProfessor.php" method="post" class="form-entidade">
        <label>Informe o id do Professor: <input type="text" name="idProfessor" id="buscaIdProfessor"></label>
        <button>Busca Professor</button>
    </form>
</div>

<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\ProfessorGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Professor.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\ProfessorDisciplinaCursoGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\ProfessorDisciplinaCurso.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\EnderecoGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Endereco.php';

    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Professor::setConnection($conn);
        ProfessorDisciplinaCurso::setConnection($conn);
        Endereco::setConnection($conn);
        
        $professor = new Professor();
        $pdc = new ProfessorDisciplinaCurso();
        $enderecos = Endereco::all();

        echo '<html>';
        echo '<head>';
        echo '<title>Mostrar Professor</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';

        if (isset($_POST['idProfessor'])) {
            echo '<div class="professor">';
            $professorId = $_POST['idProfessor'];
            $professorData = $professor->find($professorId);
            $nome = $professorData->nomeProfessor;
            $matricula = $professorData->matriculaProfessor;
            $escolaridade = $professorData->escolaridadeProfessor;
            $especialidade = $professorData->especialidadeProfessor;

            if ($professorData) {
                echo "<h3>Nome do Professor: " . $nome . "</h3>";
                echo "<p>";
                echo "<strong>Matricula do Professor:</strong> " . $matricula. "<br><br> ";
                echo "<strong>Escolaridade do Professor:</strong> " . $escolaridade . "<br><br> ";
                echo "<strong>Especialidade do Professor:</strong> " . $especialidade . ".";
                echo "</p>";  

                foreach ($enderecos as $endereco) {
                    if ($endereco->idProfessor == $professorId) {
                        echo "<p>";
                        echo "<strong>Rua:</strong> " . $endereco->rua . "<br><br> ";
                        echo "<strong>Bairro:</strong> " . $endereco->bairro . "<br><br> ";
                        echo "<strong>Número:</strong> " . $endereco->numero . "<br><br> ";
                        echo "<strong>CEP:</strong> " . $endereco->cep;
                        echo "</p>";  
                    }
                }
        
                $disciplinasECursos = $pdc->getDisciplinasCursosByProfessor($professorId);
                    
                if (!empty($disciplinasECursos)) {
                    foreach ($disciplinasECursos as $row) {
                        echo "<p>";
                        echo "<strong>Disciplina:</strong> " . $row['nomeDisciplina'] . ", ";
                        echo "<strong>Curso:</strong> " . $row['nomeCurso']. ".";
                        echo "</p>";  
                    }
                } else {
                    echo "Nenhum registro encontrado.";
                }
            } else {
                echo "Professor não encontrado.";
            }
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>