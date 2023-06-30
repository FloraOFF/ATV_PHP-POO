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
        
        function getProfessorHTML($professorId) {
            $professor = new Professor();
            $pdc = new ProfessorDisciplinaCurso();
            $enderecos = Endereco::all();

            $html = '';

            if (isset($_POST['idProfessor'])) {
                $professorId = $_POST['idProfessor'];
                $professorData = $professor->find($professorId);

                if ($professorData) {
                    $nome = $professorData->nomeProfessor;
                    $matricula = $professorData->matriculaProfessor;
                    $escolaridade = $professorData->escolaridadeProfessor;
                    $especialidade = $professorData->especialidadeProfessor;

                    $html .= "<h3>Nome do Professor: " . $nome . "</h3>";
                    $html .= "<p>";
                    $html .= "<strong>Matricula do Professor:</strong> " . $matricula. "<br><br> ";
                    $html .= "<strong>Escolaridade do Professor:</strong> " . $escolaridade . "<br><br> ";
                    $html .= "<strong>Especialidade do Professor:</strong> " . $especialidade . ".";
                    $html .= "</p>";  

                    foreach ($enderecos as $endereco) {
                        if ($endereco->idProfessor == $professorId) {
                            $html .= "<p>";
                            $html .= "<strong>Rua:</strong> " . $endereco->rua . "<br><br> ";
                            $html .= "<strong>Bairro:</strong> " . $endereco->bairro . "<br><br> ";
                            $html .= "<strong>Número:</strong> " . $endereco->numero . "<br><br> ";
                            $html .= "<strong>CEP:</strong> " . $endereco->cep;
                            $html .= "</p>";  
                        }
                    }
            
                    $disciplinasECursos = $pdc->getDisciplinasCursosByProfessor($professorId);
                        
                    if (!empty($disciplinasECursos)) {
                        foreach ($disciplinasECursos as $row) {
                            $html .= "<p>";
                            $html .= "<strong>Disciplina:</strong> " . $row['nomeDisciplina'] . ", ";
                            $html .= "<strong>Curso:</strong> " . $row['nomeCurso']. ".";
                            $html .= "</p>";  
                        }
                    } else {
                        $html .= "Nenhum registro encontrado.";
                    }
                } else {
                    $html .= "Professor não encontrado.";
                }
            }

            return $html;
        }

        // Verifica se foi enviado o ID do professor via POST
        if (isset($_POST['idProfessor'])) {
            $professorId = $_POST['idProfessor'];

            // Obtém o HTML do professor
            $professorHTML = getProfessorHTML($professorId);

            // Retorna o HTML do professor
            echo $professorHTML;
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>