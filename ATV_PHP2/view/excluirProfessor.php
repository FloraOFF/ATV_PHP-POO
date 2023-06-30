<div class="form-container">
    <form action="./excluirProfessor.php" method="post" class="form-entidade">
        <label>Informe o id do Professor: <input type="text" name="idProfessor" id="buscaIdProfessor"></label>
        <button>Excluir Professor</button>
    </form>
</div>

<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\ProfessorGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Professor.php';

    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Professor::setConnection($conn);
        
        $professor = new Professor();
        $professores = Professor::all();

        echo '<html>';
        echo '<head>';
        echo '<title>Excluir Professor</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';

        if (isset($_POST['idProfessor'])) {
            $idProfessor = $_POST['idProfessor'];

            $success = false;

            foreach ($professores as $professor) {
                if ($professor->idProfessor == $idProfessor) {
                    $success = $professor->delete();
                }
            }
        
            echo '<div class="message"></div>';
        
            if ($success) {
                echo '<script>var messages = document.getElementsByClassName("message"); for (var i = 0; i < messages.length; i++) { messages[i].innerHTML = "Professor excluído com sucesso."; }</script>';
            } else {
                echo '<script>var messages = document.getElementsByClassName("message"); for (var i = 0; i < messages.length; i++) { messages[i].innerHTML = "Falha ao excluir o Professor."; }</script>';
            }
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>