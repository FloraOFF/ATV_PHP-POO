<?php
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\gateway\AlunoGateway.php';
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Aluno.php';
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
        Aluno::setConnection($conn);
        Disciplina::setConnection($conn);
        Curso::setConnection($conn);
        Endereco::setConnection($conn);
        
        $nome = $_POST["nomeAluno"];
        $matricula = $_POST["matriculaAluno"];
        $rua = $_POST["ruaAluno"];
        $bairro = $_POST["bairroAluno"];
        $numero = $_POST["numAluno"];
        $cep = $_POST["cepAluno"];

        $a1 = new Aluno();
        $a1->nomeAluno = $nome;
        $a1->matriculaAluno = $matricula;
        $a1->save();

        $alunos = Aluno::all(); //retorna todos os objetos da tabela

        foreach ($alunos as $aluno) {
            $idAluno = $aluno->idAluno;
        }

        $e1 = new Endereco();
        $e1->rua = $rua;
        $e1->bairro = $bairro;
        $e1->numero = $numero;
        $e1->cep = $cep;
        $e1->idAluno = $idAluno;
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
        <form action="./matriculaTeste.php" method="post" class="form-entidadeInserir1">
            <h3>INSERIR CURSO E DISCIPLINA ALUNO</h3>
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

            <button type="submit">Inserir Aluno</button>
        </form>
    </div>
</body>
</html>
