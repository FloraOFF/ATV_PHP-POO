<?php
 require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\gateway\ProfessorGateway.php';
 require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Professor.php';
 require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\gateway\CursoGateway.php';
 require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Curso.php';
 require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\gateway\DisciplinaGateway.php';
 require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Disciplina.php';
 require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\ProfessorDisciplinaCursoGateway.php';
 require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\ProfessorDisciplinaCurso.php';


$username = "root";
$password = "";

try {
    $conn = new PDO('mysql:host=localhost; dbname=bdacademico', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    Disciplina::setConnection($conn);
    Professor::setConnection($conn);
    ProfessorDisciplinaCurso::setConnection($conn);
    Curso::setConnection($conn);
    
    $professores = Professor::all();

    $curso = $_POST["curso"];
    $disciplinas = $_POST["disciplinas"];
    
    foreach ($professores as $professor) {
        $idProfessor = $professor->idProfessor;
    }

    foreach ($disciplinas as $disciplina) {
        $pdc = new ProfessorDisciplinaCurso();
        $pdc->idProfessor = $idProfessor;
        $pdc->idDisciplina = $disciplina;
        $pdc->idCurso = $curso;
        $pdc->save();
    }

    header("Location: ../view/adm.html");
    exit();
/*
    $d1 = new Disciplina;
    $d1->nomeDisciplina = "Física2";
    $d1->cargaHorariaDisciplina = "40 horas";
    $d1->save();

    $p1 = new Professor;
    $p1->nomeProfessor = "Cooper2";
    $p1->matriculaProfessor = "98765241";
    $p1->escolaridadeProfessor = "Ensino Médio Completo";
    $p1->especialidadeProfessor = "Físico Teórico Sênio";
    $p1->save();

    $idDisciplina = $disciplinas[0]->idDisciplina;
    $idProfessor = $professores[0]->idProfessor;

    // Criar novo registro de MinistraDisciplina
    $ministraDisciplina = new MinistraDisciplina();
    $ministraDisciplina->idDisciplina = $idDisciplina;
    $ministraDisciplina->idProfessor = $idProfessor;
    $ministraDisciplina->save();*/
    
} catch (Exception $e) {
    print $e->getMessage();
}
?>
