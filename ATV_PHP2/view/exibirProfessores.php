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
        
        $professores = Professor::all();
        $enderecos = Endereco::all();

        echo '<html>';
        echo '<head>';
        echo '<title>Mostrar Professor</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';

        foreach ($professores as $professor) {
            echo '<div class="professor">';
            $idProfessor = $professor->idProfessor;
            echo "<h3>Nome do Professor " . $professor->nomeProfessor . "</h3>";
            echo "<p>";
            echo "<strong>Matricula do Professor:</strong> " . $professor->matriculaProfessor. "<br><br> ";
            echo "<strong>Escolaridade do Professor:</strong> " . $professor->escolaridadeProfessor . "<br><br> ";
            echo "<strong>Especialidade do Professor:</strong> " . $professor->especialidadeProfessor;
            echo "</p>";  
            
            foreach ($enderecos as $endereco) {
                if ($endereco->idProfessor == $idProfessor) {
                    echo "<p>";
                    echo "<strong>Rua:</strong> " . $endereco->rua . "<br><br> ";
                    echo "<strong>Bairro:</strong> " . $endereco->bairro . "<br><br> ";
                    echo "<strong>Número:</strong> " . $endereco->numero . "<br><br> ";
                    echo "<strong>CEP:</strong> " . $endereco->cep;
                    echo "</p>";  
                }
            }

            
            $pdc = new ProfessorDisciplinaCurso();
            $disciplinasECursos = $pdc->getDisciplinasECursosByProfessores($idProfessor);
 
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
        }

        echo '</div>';

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>