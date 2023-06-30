<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\AlunoGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Aluno.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\MatriculaGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Matricula.php';

    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Aluno::setConnection($conn);
        Matricula::setConnection($conn);
        
        $aluno = new Aluno();
        $alunos = Aluno::all();

        echo '<html>';
        echo '<head>';
        echo '<title>Excluir Alunos</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';
        echo '<div>Excluindo Todos os Alunos</div>';

        foreach ($alunos as $aluno) {
            $success = $aluno->delete();
        }
        
        echo '<div class="excluir">';
        if ($success) {
                echo '<div class="message success">Alunos excluídos com sucesso.</div>';
        } else {
                echo '<div class="message error">Falha ao excluir o alunos.</div>';
        }
        echo '</div>';

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>