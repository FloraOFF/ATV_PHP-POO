<div class="form-container">
    <form action="./excluirDisciplina.php" method="post" class="form-entidade">
        <label>Informe o id do Disciplina: <input type="text" name="idDisciplina" id="buscaIdDisciplina"></label>
        <button>Excluir Disciplina</button>
    </form>
</div>

<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\DisciplinaGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Disciplina.php';

    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Disciplina::setConnection($conn);
        
        $disciplina = new Disciplina();
        $disciplinas = Disciplina::all();

        echo '<html>';
        echo '<head>';
        echo '<title>Excluir Disciplina</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';

        if (isset($_POST['idDisciplina'])) {
            $idDisciplina = $_POST['idDisciplina'];

            $success = false;

            foreach ($disciplinas as $disciplina) {
                if ($disciplina->idDisciplina == $idDisciplina) {
                    $success = $disciplina->delete();
                }
            }
            echo '<div class="message"></div>';
        
            if ($success) {
                echo '<script>var messages = document.getElementsByClassName("message"); for (var i = 0; i < messages.length; i++) { messages[i].innerHTML = "Disciplina excluído com sucesso."; }</script>';
            } else {
                echo '<script>var messages = document.getElementsByClassName("message"); for (var i = 0; i < messages.length; i++) { messages[i].innerHTML = "Falha ao excluir o Disciplina."; }</script>';
            }
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>