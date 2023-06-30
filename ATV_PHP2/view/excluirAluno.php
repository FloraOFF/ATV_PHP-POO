<div class="form-container">
    <form action="./excluirAluno.php" method="post" class="form-entidade">
        <label>Informe o id do Aluno: <input type="text" name="idAluno" id="buscaIdAluno"></label>
        <button>Excluir Aluno</button>
    </form>
</div>

<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\AlunoGateway.php';
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\Aluno.php';

    $username = "root";
    $password = "";

    try {
        $conn = new PDO('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Aluno::setConnection($conn);
        
        $aluno = new Aluno();
        $alunos = Aluno::all();

        echo '<html>';
        echo '<head>';
        echo '<title>Excluir Aluno</title>';
        echo '<link rel="stylesheet" type="text/css" href="../CSS/exibirDados.css">';
        echo '</head>';
        echo '<body>';

        if (isset($_POST['idAluno'])) {
            $idAluno = $_POST['idAluno'];
        
            $success = false; // Inicializa a variável $success como false
        
            foreach ($alunos as $aluno) {
                if ($aluno->idAluno == $idAluno) {
                    $success = $aluno->delete();
                    break; // Sai do loop após encontrar o aluno correspondente
                }
            }

            echo '<div class="message"></div>';
        
            if ($success) {
                echo '<script>var messages = document.getElementsByClassName("message"); for (var i = 0; i < messages.length; i++) { messages[i].innerHTML = "Aluno excluído com sucesso."; }</script>';
            } else {
                echo '<script>var messages = document.getElementsByClassName("message"); for (var i = 0; i < messages.length; i++) { messages[i].innerHTML = "Falha ao excluir o Aluno."; }</script>';
            }
            
        }
        

    } catch (Exception $e) {
        print $e->getMessage();
    }
?>