<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\ProfessorGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Professor.php';

    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Professor::setConnection($conn);
        
        $professores = new Professor();
        $professores = Professor::all();

        echo '<html>';
        echo '<head>';
        echo '<title>Excluir Professores</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';
        echo '<div>Excluindo Todos os Professores</div>';

        foreach ($professores as $professor) {
            $success = $professor->delete();
        }
        
        if ($success) {
                echo '<div class="message success">Professores excluídos com sucesso.</div>';
        } else {
                echo '<div class="message error">Falha ao excluir o professores.</div>';
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>