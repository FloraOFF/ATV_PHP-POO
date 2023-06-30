<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\CursoGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Curso.php';

    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Curso::setConnection($conn);
        
        $cursos = new Curso();
        $cursos = Curso::all();

        echo '<html>';
        echo '<head>';
        echo '<title>Excluir Curso</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';
        echo '<div>Excluindo Todos os Curso</div>';

        foreach ($cursos as $curso) {
            $success = $curso->delete();
        }
        
        if ($success) {
                echo '<div class="message success">Curso excluídos com sucesso.</div>';
        } else {
                echo '<div class="message error">Falha ao excluir o Curso.</div>';
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>