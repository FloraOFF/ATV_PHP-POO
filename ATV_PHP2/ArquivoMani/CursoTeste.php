<?php
    require_once 'C:\xampp\htdocs\ATV_PHP2\Classes\gateway\CursoGateway.php';
    require_once 'C:\\xampp\htdocs\ATV_PHP2\Classes\Curso.php';

    $username = "root";
    $password = "";

    try{
        $conn = new PDO ('mysql:host=localhost; dbname=bdacademico', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Curso::setConnection($conn);

        $cursos = Curso::all(); //retorna todos os objetos da tabela

        /*//Início do foreach() para exclusão
        foreach ($cursos as $curso) {
            $curso->delete(); //Excluindo cada objeto da tabela
        }//Fim do foreach()*/

        $nome = $_POST["nomeCurso"];
        $cargaHoraria = $_POST["CargaHCurso"];
        
        $c1 = new Curso;
        $c1->nomeCurso = $nome;
        $c1->cargaHorariaCurso = $cargaHoraria;
        $c1->save();

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