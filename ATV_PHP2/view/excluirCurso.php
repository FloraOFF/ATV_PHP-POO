<div class="form-container">
    <form action="./excluirCurso.php" method="post" class="form-entidade">
        <label>Informe o id do Curso: <input type="text" name="idCurso" id="buscaIdCurso"></label>
        <button>Excluir Curso</button>
    </form>
</div>

<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\CursoGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Curso.php';

    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Curso::setConnection($conn);
        
        $curso = new Curso();
        $cursos = Curso::all();

        echo '<html>';
        echo '<head>';
        echo '<title>Excluir Curso</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';

        if (isset($_POST['idCurso'])) {
            $idCurso = $_POST['idCurso'];

            $success = false;

            foreach ($cursos as $curso) {
                if ($curso->idCurso == $idCurso) {
                    $success = $curso->delete();
                }
            }
            echo '<div class="message"></div>';
        
            if ($success) {
                echo '<script>var messages = document.getElementsByClassName("message"); for (var i = 0; i < messages.length; i++) { messages[i].innerHTML = "Curso excluído com sucesso."; }</script>';
            } else {
                echo '<script>var messages = document.getElementsByClassName("message"); for (var i = 0; i < messages.length; i++) { messages[i].innerHTML = "Falha ao excluir o Curso."; }</script>';
            }
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>