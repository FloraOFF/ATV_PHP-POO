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

            foreach ($disciplinas as $disciplina) {
                if ($disciplina->idDisciplina == $idDisciplina) {
                    $success = $disciplina->delete();
                }
            }
        
            if ($success) {
                echo '<div class="message success">Disciplina excluído com sucesso.</div>';
            } else {
                echo '<div class="message error">Falha ao excluir o Disciplina.</div>';
            }
        }

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>