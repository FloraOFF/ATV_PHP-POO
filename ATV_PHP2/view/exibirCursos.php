<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\CursoGateway.php';
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Curso.php';

    $username = "root";
    $password = "";

    try{
        $conn = new PDO ('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Curso::setConnection($conn);

        $cursos = Curso::all(); //retorna todos os objetos da tabela

        echo '<html>';
        echo '<head>';
        echo '<title>Mostrar Cursos</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';

        foreach ($cursos as $curso) {
            echo '<div class="curso">';
            echo '<h3>' . $curso->nomeCurso . '</h3>';
            echo '<p><strong>Carga Horária:</strong> ' . $curso->cargaHorariaCurso . '</p>';
            echo '</div>';
        }

        echo '</body>';
        echo '</html>';
    } catch (Exception $e) {
        print $e->getMessage();
    }
?>