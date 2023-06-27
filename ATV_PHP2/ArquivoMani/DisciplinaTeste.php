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

        /*//Início do foreach() para exclusão
        foreach ($disciplinas as $disciplina) {
            $disciplina->delete(); //Excluindo cada objeto da tabela
        }//Fim do foreach()*/

        $nome = $_POST["nomeDisciplina"];
        $cargaHoraria = $_POST["CargaHDisciplina"];
        
        $d1 = new Disciplina;
        $d1->nomeDisciplina = $nome;
        $d1->cargaHorariaDisciplina = $cargaHoraria;
        $d1->save();

        //Exibindo informações
        //$d3 = Disciplina::find(1);
        //print 'Nome Disciplina: '.$d3->nomeDisciplina. "<br>\n";
        //print 'Margem de lucro (R$): '.$d3->getMargemLucro(). "%. <br>\n";
        
        //$d3->registrarCompra(400, 10);
        //$d3->save();
    } catch (Exception $e) {
        print $e->getMessage();
    }
?>