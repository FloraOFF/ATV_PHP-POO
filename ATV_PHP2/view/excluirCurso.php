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

            foreach ($cursos as $curso) {
                if ($curso->idCurso == $idCurso) {
                    $success = $curso->delete();
                }
            }
        
            if ($success) {
                echo '<div class="message success">Curso excluído com sucesso.</div>';
            } else {
                echo '<div class="message error">Falha ao excluir o Curso.</div>';
            }
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>