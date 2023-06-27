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

            foreach ($professores as $professor) {
                if ($professor->idProfessor == $idProfessor) {
                    $success = $professor->delete();
                }
            }
        
            if ($success) {
                echo '<div class="message success">Professor excluído com sucesso.</div>';
            } else {
                echo '<div class="message error">Falha ao excluir o professor.</div>';
            }
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>