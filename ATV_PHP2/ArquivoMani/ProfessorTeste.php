<?php
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\gateway\ProfessorGateway.php';
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Professor.php';
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\gateway\CursoGateway.php';
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Curso.php';
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\gateway\DisciplinaGateway.php';
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Disciplina.php';
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\gateway\EnderecoGateway.php';
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Endereco.php';

    $username = "root";
    $password = "";

    try{
        $conn = new PDO ('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Professor::setConnection($conn);
        Disciplina::setConnection($conn);
        Curso::setConnection($conn);
        Endereco::setConnection($conn);

        //Início do foreach() para exclusão
        //foreach ($professores as $professor) {
          //  $professor->delete(); //Excluindo cada objeto da tabela
        //}//Fim do foreach()
        
        $nome = $_POST["nomeProfessor"];
        $matricula = $_POST["matriculaProfessor"];
        $escolaridade = $_POST["escolaridadeProfessor"];
        $especialidade = $_POST["especialidadeProfessor"];
        $rua = $_POST["ruaProfessor"];
        $bairro = $_POST["bairroProfessor"];
        $numero = $_POST["numProfessor"];
        $cep = $_POST["cepProfessor"];

        $p1 = new Professor;
        $p1->nomeProfessor = $nome;
        $p1->matriculaProfessor = $matricula;
        $p1->escolaridadeProfessor = $escolaridade;
        $p1->especialidadeProfessor = $especialidade;
        $p1->save();  

        $professores = Professor::all(); //retorna todos os objetos da tabela

        foreach ($professores as $professor) {
            $idProfessor = $professor->idProfessor;
        }

        $e1 = new Endereco();
        $e1->rua = $rua;
        $e1->bairro = $bairro;
        $e1->numero = $numero;
        $e1->cep = $cep;
        $e1->idProfessor = $idProfessor;
        $e1->save();

        $disciplinas = Disciplina::all();
        $cursos = Curso::all();
        
    } catch (Exception $e) {
        print $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/inserirDados.css">
    <title>Document</title>
</head>
<body>
    <div class="form-container">
        <form action="./ProfessorDisciplinaCursoTeste.php" method="post" class="form-entidadeInserir1">
            <h3>INSERIR CURSO E DISCIPLINA PROFESSOR</h3>
            <label for="curso">Curso:</label>
            <select id="curso" name="curso" multiple>
                <option value="">Selecione um curso</option>
                <?php
                    foreach ($cursos as $curso) {
                        echo "<option value=\"" . $curso->idCurso . "\">" . $curso->nomeCurso . "</option>";
                    }
                ?>
            </select>

            <label for="disciplina">Disciplina:</label>
            <select id="disciplina" name="disciplinas[]" multiple>
                <option value="">Selecione uma disciplina</option>
                <?php
                    foreach ($disciplinas as $disciplina) {
                        echo "<option value=\"" . $disciplina->idDisciplina . "\">" . $disciplina->nomeDisciplina . "</option>";
                    }
                ?>
            </select>

            <button type="submit">Inserir professor</button>
        </form>  
    </div>  
</body>
</html>

    

    
