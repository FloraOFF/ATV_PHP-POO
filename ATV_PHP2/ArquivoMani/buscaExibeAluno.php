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
        
        function getAlunoHTML($alunoId) {
            $enderecos = Endereco::all();
            $aluno = new Aluno();
            $matricula = new Matricula();

            $html = '';

            if (isset($_POST['idAluno'])) {
                $alunoId = $_POST['idAluno'];
                $AlunoData = $aluno->find($alunoId);

                if ($AlunoData) {
                    $nome = $AlunoData->nomeAluno;
                    $matriculaA = $AlunoData->matriculaAluno;
                    $html .= "<h3>Nome do Aluno: " . $nome . "</h3>";
                    $html .= "<p>";
                    $html .= "<strong>Matricula do Aluno:</strong> " . $matriculaA. "<br><br> ";
                    $html .= "</p>";
                    
                    $disciplinasECursos = $matricula->getDisciplinasCursosByAluno($alunoId);

                    foreach ($enderecos as $endereco) {
                        if ($endereco->idAluno == $alunoId) {
                            $html .= "<p>";
                            $html .= "<strong>Rua:</strong> " . $endereco->rua . "<br><br> ";
                            $html .= "<strong>Bairro:</strong> " . $endereco->bairro . "<br><br> ";
                            $html .= "<strong>Número:</strong> " . $endereco->numero . "<br><br> ";
                            $html .= "<strong>CEP:</strong> " . $endereco->cep;
                            $html .= "</p>";
                        }
                    }
                        
                    if (!empty($disciplinasECursos)) {
                        foreach ($disciplinasECursos as $row) {
                            $html .= "<p>";
                            $html .= "<strong>Disciplina:</strong> " . $row->nomeDisciplina . ", ";
                            $html .= "<strong>Curso:</strong> " . $row->nomeCurso. ".";
                            $html .= "</p>"; 
                        }
                    } else {
                        $html .= "Nenhum registro encontrado.";
                    }
                } else {
                    $html .= "Aluno não encontrado.";
                }
            }

            return $html;
        }

        // Verifica se foi enviado o ID do aluno via POST
        if (isset($_POST['idAluno'])) {
            $alunoId = $_POST['idAluno'];

            // Obtém o HTML do aluno
            $alunoHTML = getAlunoHTML($alunoId);

            // Retorna o HTML do aluno
            echo $alunoHTML;
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>