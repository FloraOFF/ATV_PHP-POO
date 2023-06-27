<?php
 require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\gateway\AlunoGateway.php';
 require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Aluno.php';
 require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\gateway\CursoGateway.php';
 require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Curso.php';
 require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\gateway\DisciplinaGateway.php';
 require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Disciplina.php';
 require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\MatriculaGateway.php';
 require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Matricula.php';


$username = "root";
$password = "";

try {
    $conn = new PDO('mysql:host=localhost; dbname=bdacademico', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    Disciplina::setConnection($conn);
    Aluno::setConnection($conn);
    Matricula::setConnection($conn);
    Curso::setConnection($conn);
    
    $alunos = Aluno::all();

    $curso = $_POST["curso"];
    $disciplinas = $_POST["disciplinas"];

    foreach ($alunos as $aluno) {
        $idAluno = $aluno->idAluno;
    }

    foreach ($disciplinas as $disciplina) {
        $matricula = new Matricula();
        $matricula->idDisciplina = $disciplina;
        $matricula->idCurso = $curso;
        $matricula->idAluno = $idAluno;
        $matricula->save();
    }

    header("Location: ../view/adm.html");
    exit();
    
} catch (Exception $e) {
    print $e->getMessage();
}
?>
