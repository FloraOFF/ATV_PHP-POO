<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\DisciplinaGateway.php';
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Disciplina.php';

    $username = "root";
    $password = "";

    try{
        $conn = new PDO ('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Disciplina::setConnection($conn);

        $disciplinas = Disciplina::all(); //retorna todos os objetos da tabela

        echo '<html>';
        echo '<head>';
        echo '<title>Mostrar Disciplinas</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';
    
        foreach ($disciplinas as $disciplina) {
            echo '<div class="disciplina">';
            echo '<h3>' . $disciplina->nomeDisciplina . '</h3>';
            echo '<p><strong>Carga Horária:</strong> ' . $disciplina->cargaHorariaDisciplina . '</p>';
            echo '</div>';
        }
    
        echo '</body>';
        echo '</html>';
    } catch (Exception $e) {
        print $e->getMessage();
    }
?>